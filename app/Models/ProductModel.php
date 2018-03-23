<?php

namespace App\Models;

use App\Models\Inherit\IL_Model;

class ProductModel extends IL_Model
{
    protected $table = "product";

    const PRODUCT_TYPES = array(
        'wine'      => 3,
        'food'      => 1,
        'beverage'  => 2,
    );

    const PRODUCT_TYPES_LANG = array(
        'wine'      => 'Rượu',
        'food'      => 'Đồ ăn',
        'beverage'  => 'Đồ uống',
    );

    function product_detail() {
        return $this->hasMany('App\Models\ProductDetailModel', 'product_id');
    }
}
