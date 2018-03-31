<?php

namespace App\Models;

use App\Models\Inherit\IL_Model;

class ProductModel extends IL_Model
{
    protected $table = "product";

    const PRODUCT_TYPES = array(
        'food'          => 1,
        'beer'          => 2,
        'alcohol_free'  => 3,
        'soft_drink'    => 4,
        'tea'           => 5,
        'coffee'        => 6,
        'arperatif'     => 7,
        'fresh_juices'  => 8,
        'smoothies'     => 9,
        'whiskey'       => 10,
        'wine'          => 11,
        'tequila'       => 12,
        'rum'           => 13,
        'liquier'       => 14,
        'gin'           => 15,
        'vodka'         => 16,
        'bourbon'       => 17,
        'cocktail'      => 18,
    );

    const PRODUCT_TYPES_LANG = array(
        'food'          => "Đồ ăn",
        'beer'          => "Bia",
        'alcohol_free'  => "Nước khoáng",
        'soft_drink'    => "Nước ngọt",
        'tea'           => "Trà",
        'coffee'        => "Coffee",
        'arperatif'     => "Arperatif",
        'fresh_juices'  => "Nước trái cây",
        'smoothies'     => "Sinh tố",
        'whiskey'       => "Whiskey",
        'wine'          => "Rượu",
        'tequila'       => "Tequila",
        'rum'           => "Rum",
        'liquier'       => "Liquier",
        'gin'           => "Gin",
        'vodka'         => "Vodka",
        'bourbon'       => "Bourbon",
        'cocktail'      => "Cocktail",
    );

    function product_detail() {
        return $this->hasMany('App\Models\ProductDetailModel', 'product_id');
    }
}
