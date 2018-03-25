<?php
/**
 * @author		Duy Trần
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * Ilgamos Helpers
 *
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Duy Trần
 */

// ------------------------------------------------------------------------

/**
 * Formats to vnd money
 *
 * @access	public
 * @param	$num	    // will be cast as int
 * @param	$currency	// will be cast as string
 */

if ( ! function_exists('format_money'))
{
	function format_money($number) {
	    if (!is_numeric($number)) {
	        throw new Exception('Ilgamos bar helpers: Can not use string for format money');
        }
        return number_format($number, 0, '.', ',') . ' vnđ';
	}
}

if ( ! function_exists('calculate_total_price'))
{
    function calculate_total_price($order_details) {
        if (!is_array($order_details)) {
            throw new Exception('Ilgamos bar helpers: Can not get order detail');
        }

        $total_price = 0;
        foreach ($order_details as $o) {
            $total_price += $o['total_price'];
        }

        return $total_price;
    }
}

if ( ! function_exists('get_table_name_by_key'))
{
    function get_table_name_by_key($key) {
        $table_names = \App\Models\ContractModel::TABLES_NAME;
        return array_key_exists($key, $table_names) ? $table_names[$key] : '';
    }
}

if ( ! function_exists('get_product_type_id_by_key'))
{
    function get_product_type_id_by_key($key) {
        $product_type = \App\Models\ProductModel::PRODUCT_TYPES;
        return array_key_exists($key, $product_type) ? $product_type[$key] : false;
    }
}

if ( ! function_exists('show_message'))
{
    function show_message() {
        $alert_type = '';
        $icon_type  = '';
        if ($message = session('message')) {
            $alert_type = 'success';
            $icon_type  = 'fa-info-circle';
        } else if ($message = session('error')) {
            $alert_type = 'danger';
            $icon_type  = 'fa-warning';
        }

        if (!empty($alert_type)) {
            ?>
                <div class="alert alert-<?php echo $alert_type; ?> global-alert alert-dismissible fade show" role="alert">
                    <strong><i class="fa <?php echo $icon_type; ?>"></i> <span style="text-decoration: underline">THÔNG BÁO</span>: <?php echo $message; ?></strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php
        }
    }
}

if ( ! function_exists('active_menu'))
{
    function active_menu($key) {
        $current_url = url()->current();
        if (strpos($current_url, $key) !== false) {
            echo 'active';
        }
    }
}

if ( ! function_exists('ajax_response_order_detail'))
{
    function ajax_response_order_detail($order_details) {
        if (!is_array($order_details)) {
            throw new Exception('Ilgamos bar helpers: Can not get order detail');
        }

        ob_start();
            ?>
                <div class="table-responsive column_table_order_detail">
                    <table class="table table-bordered">
                        <thead>
                            <th>No</th>
                            <th>Tên món</th>
                            <th>Đơn giá</th>
                            <th>Số lượng</th>
                            <th>Tổng tiền</th>
                            <th>Thêm/Xóa</th>
                        </thead>
                        <tbody>
                            <?php foreach ($order_details as $key => $o): ?>
                                <?php if($o['amount'] > 0): ?>
                                    <tr>
                                        <td style="text-align: center"><?php echo ($key + 1) ?></td>
                                        <td><?php echo $o['product_name'] ?></td>
                                        <td style="text-align: center"><?php echo format_money($o['unit_price']) ?></td>
                                        <td style="text-align: center">x<?php echo $o['amount'] ?></td>
                                        <td style="text-align: center"><?php echo format_money($o['total_price']) ?></td>
                                        <td style="text-align: center">
                                            <button data-order_detail_id="<?php echo $o['id'] ?>" class="add_order_detail btn-default btn-sm"><i class="fa fa-plus"></i></button>
                                            <button data-order_detail_id="<?php echo $o['id'] ?>" class="remove_order_detail btn-default btn-sm"><i class="fa fa-minus"></i></button>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php
        $html_order_detail = ob_get_contents();
        ob_end_clean();

        return $html_order_detail;
    }
}

/* End of file ilgamos_helper.php */