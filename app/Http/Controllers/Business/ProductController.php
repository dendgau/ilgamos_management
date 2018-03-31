<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\ContractModel;
use App\Models\ProductDetailModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    function show() {
        $products  = ProductModel::orderBy('product_type', 'DESC')->paginate(15);
        $links     = $products->links("pagination::bootstrap-4");
        $total     = $products->total();

        return view('product\show')->with(array(
            'products'      => $products,
            'links'         => $links,
            'total'         => $total,
        ));
    }

    function create(Request $request) {
        $product_type = ProductModel::PRODUCT_TYPES_LANG;

        if ($request->isMethod('post')) {
            if ($this->_process_form_validation(__FUNCTION__, $request)) {
                try {
                    DB::beginTransaction();
                        $new_product = new ProductModel();
                        $new_product->product_name_vi = $request->product_name_vi;
                        $new_product->product_name_en = $request->product_name_en;
                        $new_product->product_type    = get_product_type_id_by_key($request->product_type);
                        if (!$new_product->save()) {
                            throw new \Exception('Can create new product');
                        }

                        $new_product_detail = new ProductDetailModel();
                        $new_product_detail->product_id = $new_product->id;
                        $new_product_detail->price      = $request->price;
                        $new_product_detail->version_no = 1;
                        if (!$new_product_detail->save()) {
                            throw new \Exception('Can create new product detail');
                        }
                    DB::commit();

                    $request->session()->flash('message', 'Tạo sản phẩm mới thanh công. Hãy cập nhật giá mới tại màn hình này');
                    return Redirect::to('business/product/edit/product_id/'.$new_product->id)->send();
                    exit;
                } catch (\Exception $e) {
                    DB::rollback();
                    $request->session()->flash('error', 'Không thể tạo sản phẩm mới. Hãy thử lại lần nữa');
                }
            }
        }

        return view('product\create')->with(array(
            'product_type'  => $product_type,
        ));
    }

    function edit(Request $request) {
        if (!($product_id = $request->route('product_id'))) {
            $request->session()->flash('error', 'Không tìm thấy mã hóa đơn');
            Redirect::to('business/product/show')->send();
        }

        if (!($product = ProductModel::find($product_id))) {
            $request->session()->flash('error', 'Không tìm thấy mã sản phẩm HD00'. $product_id);
            Redirect::to('business/product/show')->send();
        }

        if (!($product_detail = ProductDetailModel::where('product_id', '=', $product_id)->orderBy('version_no', 'DESC')->first())) {
            $request->session()->flash('error', 'Không tìm thấy chi tiết sản phẩm HD00'. $product_id);
            Redirect::to('business/product/show')->send();
        }

        $product->product_type = array_search($product->product_type, ProductModel::PRODUCT_TYPES);
        $product_type = ProductModel::PRODUCT_TYPES_LANG;

        if ($request->isMethod('post')) {
            if ($this->_process_form_validation(__FUNCTION__, $request)) {
                try {
                    DB::beginTransaction();
                        $product->product_name_vi = $request->product_name_vi;
                        $product->product_name_en = $request->product_name_en;
                        $product->product_type = get_product_type_id_by_key($request->product_type);

                        if (!$product->save()) {
                            throw new \Exception('Can not update product detail');
                        }

                        if ($product_detail->price != $request->price) {
                            $new_product_detail = new ProductDetailModel();
                            $new_product_detail->product_id = $product->id;
                            $new_product_detail->price      = $request->price;
                            $new_product_detail->version_no = $product_detail->version_no + 1;
                            if (!$new_product_detail->save()) {
                                throw new \Exception('Can not update product detail');
                            }
                        }
                    DB::commit();

                    $request->session()->flash('message', 'Cập nhật thông tin sản phầm thành công');
                    return Redirect::to('business/product/edit/product_id/'.$product->id)->send();
                    exit;
                } catch (\Exception $e) {
                    DB::rollback();
                    $request->session()->flash('error', 'Không thể cập nhật sản phẩm này. Hãy thử lại lần nữa');
                }
            }
        }

        return view('product\edit')->with(array(
            'product_type'    => $product_type,
            'product'         => $product,
            'product_detail'  => $product_detail,
        ));
    }

    protected function _process_form_validation($stage, $request) {
        switch ($stage) {
            case "create":
            case "edit":
                $this->validate($request,[
                    'product_name_vi' => 'required',
                    'product_name_en' => 'required',
                    'product_type'    => 'required|in:'.implode(",",array_keys(ProductModel::PRODUCT_TYPES_LANG)),
                    'price'           => 'required|numeric|max:1000000|min:1000'
                ],[
                    'product_name_vi.required'  => 'Bạn phải nhập mục này',
                    'product_name_en.required'  => 'Bạn phải nhập mục này',
                    'price.required'            => 'Bạn phải nhập mục này',
                    'product_type.required'     => 'Bạn phải nhập mục này',
                    'product_type.in'           => 'Loại sản phẩm ko tồn tại',
                    'price.max'                 => 'Giá tiền này không được chấp nhận <= 1,000,000 vnđ',
                    'price.min'                 => 'Giá tiền này không được chấp nhận > 1,000 vnđ',
                    'price.numeric'             => 'Giá tiền là kiểu số',
                ]);
        }

        return $this->errorBag();
    }

    public function insert_data_to_product_table() {
        $products = array(
            array(1, "Vietnamese beef stew with carros, potatoes, beans, bread.","Súp bò kho, bánh mì.",79000),
            array(1, "Borsch soup","Súp kiểu Nga",79000),
            array(1, "Cheesy beef or chicken burger","Bơ gơ bò hoặc gà phô mai",85000),
            array(1, "Cheesy beef burger with bacon","Bơ gơ bò phô mai với thịt xông khói",105000),
            array(1, "Double cheesy beef burger","Bơ gơ bò phô mai lớn",105000),
            array(1, "Mozzarella cheese sticks","Phô mai lăn bột chiên giòn",79000),
            array(1, "Crispy pork spring rolls","Chả giò thịt",79000),
            array(1, "Mixed green salad, tomatoes, onion, cucumber, olive oil and vinegar sauce","Xà lách trộn dầu giấm",75000),
            array(1, "Beef salad","Xà lách bò, sốt tiêu chanh",105000),
            array(1, "Tuna salad","Xà lách cá ngừ",115000),
            array(1, "Salmon salad","Xà lách cá hồi",135000),
            array(1, "Grilled AUS/USA Rib eye with sauce array(250gr)","Thăn bò Úc/Mỹ nướng, sốt tiêu/nấm",229000),
            array(1, "Grilled AUS/USA T-Bone with sauce array(250gr)","Thăn bò T-Bone Úc/Mỹ nướng, sốt tiêu/nấm",199000),
            array(1, "Grilled AUS lamb chops, Red wine sauce array(250gr)","Sườn cừu Úc nướng, sốt rượu vang đỏ",199000),
            array(1, "Stewed AUS lamb fillet with red wine array(250gr)","Thịt cừu Úc hầm rượu vang đỏ",199000),
            array(1, "Grilled pork chop, creamy sauce array(250gr)","Thịt cốc lết nướng, sốt kem",159000),
            array(1, "Two pcs of steamed or grilled pork/ chicken, mustard sausages","Xúc xích heo/ gà luộc hoặc nướng, mù tạt",139000),
            array(1, "French style pork in oven array(250gr)","Thịt heo đút lò",169000),
            array(1, "Chicken schnitzel, pepper/mushroom sauce array(250gr)","Gà tẩm bột chiên xù, sốt tiêu/nấm",149000),
            array(1, "Pork schnitzel, pepper/mushroom sauce array(250gr)","Thịt heo tẩm bột chiên xù, sốt tiêu/nấm",159000),
            array(1, "Veal AUS schnitzel, pepper sauce/mushroom sauce array(250gr)","Thịt bê tẩm bột chiên xù, sốt tiêu/nấm",179000),
            array(1, "German style fried mincedbeef balls, mustard vinegar sauce array(300gr)","Thịt bò băm viên chiên kiểu Đức",159000),
            array(1, "German style stewed pork thigh, creamy sauce array(350gr)","Chân giò heo hầm kiểu Đức, sốt kem",179000),
            array(1, "Stewed beef with Red wine array(250gr)","Thịt bò hầm sốt rượu vang đỏ",189000),
            array(1, "Stewed beef with green pepper array(beef muscle 250gr)","Bắp bò hầm tiêu xanh",179000),
            array(1, "BBQ pork ribs array(400gr)","Sườn heo nướng BBQ",169000),
            array(1, "BBQ chicken thighs array(400gr)","Đùi gà nướng sốt BBQ",149000),
            array(1, "BBQ chicken wings array(400gr)","Cánh gà nướng sốt BBQ",159000),
            array(1, "Pan seared chicken breast array(250gr)","Ức gà áp chảo",135000),
            array(1, "Chicken kiev array(250gr)","Ức gà cuộn phô mai phủ bột chiên xù",169000),
            array(1, "French style chicken breast in oven array(250gr)","Ức gà phủ nấm đút lò",169000),
            array(1, "Pan seared fillet sea bass, passion fruit sauce array(250gr)","Cá chẽm áp chảo sốt chanh dây",179000),
            array(1, "Pan seared salmon, passion fruit sauce array(250gr)","Cá hồi áp chảo sốt chanh đây",239000),
            array(1, "Pan seared tuna steak, vinegar sauce array(250gr)","Cá ngừ đại dương áp chảo sốt nấm",199000),
            array(1, "Grilled squid/shrimp with butter, garlic array(250gr)","Mực/tôm nướng bơ tỏi",179000),
            array(1, "Grilled chili, salt squid/ shrimp array(250gr)","Mực/tôm nướng muối ớt",179000),
            array(1, "Grilled satay octopus, pineapple, bell pepper array(330gr)","Bạch tuộc nướng sa tế, dứa, ớt chuông",159000),
            array(1, "Sauteed sweet and sour octopus array(330gr)","Bạch tuộc xào chua ngọt",159000),
            array(1, "Baked oysters with cheese","Hàu phủ phô mai đút lò",125000),
            array(1, "Calamari/shrimp tempura array(250gr)","Mực/tôm lăn bột chiên giòn",169000),
            array(1, "Stir-fried chicken with ginger, lemon grass, chili array(250gr)","Gà ta xào gừng, xả ớt",149000),
            array(1, "Stir-fried chicken with pineapple, bell pepper array(250gr)","Gà ta xào dứa, ớt chuông",149000),
            array(1, "Sauteed sweet and sour chicken array(250gr) ","Gà ta sốt chua ngọt",149000),
            array(1, "Grilled half chicken with honey array(700gr)","Gà ta nướng mật ong",179000),
            array(1, "Grilled whole chicken with honeyarray(1400gr)","Gà ta nguyên con nướng mật ong",249000),
            array(1, "Seafood fried rice","Cơm chiên hải sản",105000),
            array(1, "Stir-fried chicken noodles","Mì xào gà",85000),
            array(1, "Stir-fried beef noodles","Mì xào bò",105000),
            array(1, "Stir-fried seafood noodles","Mì xào hải sản",105000),
            array(1, "French fries 'Big'","Khoai tây chiên",45000),
            array(1, "Mashes potatoes","Khoai tây nghiền",45000),
            array(1, "Bolled potatoes cakes","Khoai tây luộc",45000),
            array(1, "Steamed vegetables","Rau củ luộc",45000),
            array(1, "Spaghetti carbonara, Jambon","Mì Ý sốt kem và thịt giăm bông",105000),
            array(1, "Spaghetti Bolognese","Mì Ý sốt bò bằm truyền thống",115000),
            array(1, "Creamy sauce chicken spaghetti, mushroom","Mì Ý gà, nấm sốt kem",105000),
            array(1, "BBQ beef spaghetti, onion, mushroom","Mì Ý bò sốt BBQ, hành tây và nấm",115000),
            array(1, "BBQ beef/pork sausage spaghetti","Mì Ý xúc xích bò/heo sốt BBQ",115000),
            array(1, "Creamy garlic seafood spaghetti","Mì Ý hải sản sốt kem tỏi",125000),
            array(1, "Seafood spaghetti, spicy tomato sauce","Mì Ý hải sản sốt cà chua cay",125000),
            array(1, "Bacon spaghetti, creamy sauce","Mì Ý thịt hun khói, hành tây sốt kem",105000),
            array(1, "Salmon spaghetti, creamy sauce","Mì Ý cá hồi sốt kem",145000),
            array(1, "Salmon spaghetti, tomato sauce","Mì Ý cá hồi sốt cà chua",145000),
            array(1, "Tuna spaghetti, creamy sauce","Mì Ý cá ngừ sốt kem",125000),
            array(1, "Tuna spaghetti with tomato sauce","Mì Ý cá ngừ sốt cà chua",125000),
            array(1, "Hawaii pizza, tomato sauce, mozzarella, pineapple, jambon","Pizza sốt cà chua, phô mai, giăm bông, dứa",149000),
            array(1, "Olives pizza, tomato, mozzarella, bell pepper, mishroom, onion","Pizza sốt cà chua, phô mai, ooliu ớt chuông, nấm, hành tây",159000),
            array(1, "Spicy salami pizza, tomato sauce, mozzarela","Pizza sốt cà chua, phô mai, xúc xích tiêu cay",159000),
            array(1, "Bolognese pizza, tomato, mozzarella, bell pepper","Pizza sốt cà chua, phô mai, bò bằm, ớt chuông",159000),
            array(1, "BBQ chicken pizza, mozzarella, onion, bell pepper","Pizza sốt gà nướng BBQ, phô mai, hành tây, ớt chuông",159000),
            array(1, "Meatlovers' supreme pizza, tomato sauce, mozzarella, onion, bacon, sausage, salami","Pizza xốt cà chua, phô mai, thịt xông khói, xúc xích tiêu cay, hành tây",169000),
            array(1, "Beefy pizza, tomato sauce, mozzarella, minced beef, jambon, sakami","Pizza xốt cà chua, phô mai, bò băm, jambon, salami",169000),
            array(1, "Seafood pizza, tomato sauce, mozzarella, onion, bell pepper","Pizza xốt cà chua, phô mai, hải sản, hành tây, ớt chuông",169000),
            array(1, "Tuna pizza, tomato sauce, mozzarella, pineapple","Pizza cá ngừ, sốt cà chua, phô mai, dứa",179000),
            array(1, "Salmon Pizza tomato sauce, mozzarella, onion, bell pepper","Pizza cá hồi, sốt cà chua, phô mai, hành tây, ớt chuông",189000),
            array(1, "Special Pizza four seasons Ilgamos","Pizza đặc biệt bốn mùa Ilgamos",199000),
            array(2, "Saigon Lager","Saigon Lager",17000),
            array(2, "Saigon Export","Saigon Export",17000),
            array(2, "Saigon Special","Saigon Special",22000),
            array(2, "Tiger","Tiger",25000),
            array(2, "Tiger Crystal","Tiger Crystal",25000),
            array(2, "Heineken","Heineken",29000),
            array(2, "Strongbow Cider","Strongbow Cider",29000),
            array(3, "Vikoda 500ml","Vikoda 500ml",15000),
            array(4, "Coca Cola","Coca Cola",20000),
            array(4, "Diet Coke","Diet Coke",20000),
            array(4, "Sprite","Sprite",20000),
            array(4, "Soda water","Soda water",20000),
            array(4, "Tonic Water","Tonic Water",20000),
            array(4, "Sea Bird's","Sea Bird's",18000),
            array(4, "Red Bull","Red Bull",25000),
            array(5, "Classic lemon iced tea","Trà đá chanh",30000),
            array(5, "Lipton tea array(hot/ice)","Trà lipton",25000),
            array(5, "Lipton tea with milk array(hot/ice)","Trà lipton sữa",30000),
            array(5, "Cocoa array(hot/ice)","Cacao array(nóng/đá)",30000),
            array(6, "Espresso","Espresso",35000),
            array(6, "Double Espresso","Double Espresso",45000),
            array(6, "Cappuccino","Cappuccino",45000),
            array(6, "Café Latte","Café Latte",50000),
            array(6, "Ca Phe Den Vietnam array(hot/ice)","Ca Phe Den Vietnam array(hot/ice)",25000),
            array(6, "Ca Phe Sua Da Vietnam array(milk hot/ice)","Ca Phe Sua Da Vietnam array(milk hot/ice)",30000),
            array(7, "Martini Dry","Martini Dry",25000),
            array(7, "Martini Bianco","Martini Bianco",25000),
            array(8, "Orange Juice","Cam Ép",45000),
            array(8, "Pineapple Juice","Dứa Ép",35000),
            array(8, "Passion Juice","Nước Chanh Dây",40000),
            array(8, "Lemon Juice","Nước Chanh Dây",30000),
            array(8, "Apple Juice","Nước Ép Táo",45000),
            array(8, "Water melon Juice","Nước Dưa Hấu",30000),
            array(8, "Young Coconut ","Dừa Tươi",45000),
            array(8, "Carrot Juice","Nước Ép Cà Rốt",40000),
            array(8, "Tomato Juice","Nước Ép Cà Chua",30000),
            array(9, "Mango Smoothie","Sinh tố xoài",40000),
            array(9, "Banana Smoothie","Sinh tố chuối",40000),
            array(9, "Papaya Smoothie","Sinh tố đu đủ",40000),
            array(9, "Strawberry Smoothie","Sinh tố dâu tây",45000),
            array(9, "Sapoche Smoothie","Sinh tố Sa pô chê",40000),
            array(10, "JW Red Label","JW Red Label",45000),
            array(10, "JW Black Label","JW Black Label",75000),
            array(10, "Ballantine's Finest","Ballantine's Finest",40000),
            array(10, "Ballantine's 12","Ballantine's 12",75000),
            array(10, "Chivas Regal 12y","Chivas Regal 12y",75000),
            array(10, "Wall Street VN","Wall Street VN",20000),
            array(10, "Whisky ISC VN","Whisky ISC VN",20000),
            array(11, "Dalat Classic Red","Dalat Classic Red",40000),
            array(11, "Dalat Classic White","Dalat Classic White",40000),
            array(12, "Tequila Jose Cuervo Gold 7 Coins","Tequila Jose Cuervo Gold 7 Coins",40000),
            array(12, "Sauza Gold","Sauza Gold",40000),
            array(13, "Barcadi Light","Barcadi Light",40000),
            array(13, "Havana Club Blanco","Havana Club Blanco",45000),
            array(13, "Captain Morgan Original Black Label","Captain Morgan Original Black Label",45000),
            array(13, "Captain Morgan Original Spice Gold","Captain Morgan Original Spice Gold",50000),
            array(13, "Rhum Asia VN","Rhum Asia VN",20000),
            array(13, "Rhum ISC VN","Rhum ISC VN",20000),
            array(13, "Rhum Cacao VN","Rhum Cacao VN",20000),
            array(13, "Rhum Coffee VN","Rhum Coffee VN",20000),
            array(13, "Rhum Chauvet Dark ","Rhum Chauvet Dark ",25000),
            array(13, "Rhum Chauvet Balanco","Rhum Chauvet Balanco",25000),
            array(14, "Malibu","Malibu",45000),
            array(14, "Kahlua","Kahlua",45000),
            array(14, "Baley's Irish Cream","Baley's Irish Cream",50000),
            array(14, "Cointreau","Cointreau",50000),
            array(15, "Bombay Shapphir","Bombay Shapphir",45000),
            array(15, "Gordon's ","Gordon's ",40000),
            array(15, "Beefeater London Dry","Beefeater London Dry",50000),
            array(15, "Beefeater Vietnam Dry","Beefeater Vietnam Dry",20000),
            array(16, "Smirnoff Red","Smirnoff Red",40000),
            array(16, "Smirnoff Black","Smirnoff Black",45000),
            array(16, "Absolute","Absolute",45000),
            array(16, "Danzka Red","Danzka Red",45000),
            array(16, "Putinka Gold","Putinka Gold",40000),
            array(16, "Standard Vodka","Standard Vodka",40000),
            array(16, "Vodka Aligator Russian","Vodka Aligator Russian",40000),
            array(16, "Vodka Aligator Vietnam","Vodka Aligator Vietnam",20000),
            array(16, "Men's Vodka","Men's Vodka",20000),
            array(16, "Vodka Hanoi","Vodka Hanoi",20000),
            array(17, "Jim Beam White","Jim Beam White",40000),
            array(17, "Jameson Irish","Jameson Irish",50000),
            array(17, "Canadian Club","Canadian Club",45000),
            array(18, "Ilgamos Passion","Ilgamos Passion",70000),
            array(18, "Espresso Martini","Espresso Martini",85000),
            array(18, "Nha Trang Martini","Nha Trang Martini",85000),
            array(18, "Lychee Martini","Lychee Martini",70000),
            array(18, "Classic Mojito","Classic Mojito",75000),
            array(18, "Caipiroska","Caipiroska",70000),
            array(18, "Pina Colada","Pina Colada",75000),
            array(18, "Whisky Sour","Whisky Sour",70000),
            array(18, "Blue Hawaiian","Blue Hawaiian",75000),
            array(18, "B52","B52",85000),
            array(18, "JUG FOR 2 / Green Paradise","JUG FOR 2 / Green Paradise",145000),
            array(18, "Signature Sangrira","Signature Sangrira",145000),
        );

        DB::beginTransaction();
            foreach ($products as $p) {
                $new_product = new ProductModel();
                $new_product->product_type    = $p[0];
                $new_product->product_name_vi = $p[1];
                $new_product->product_name_en = $p[2];
                if (!$new_product->save()) {
                    throw new \Exception('Can create new product');
                }

                $new_product_detail = new ProductDetailModel();
                $new_product_detail->product_id = $new_product->id;
                $new_product_detail->price      = $p[3];
                $new_product_detail->version_no = 1;
                if (!$new_product_detail->save()) {
                    throw new \Exception('Can create new product detail');
                }
            }
        DB::commit();
    }
}
