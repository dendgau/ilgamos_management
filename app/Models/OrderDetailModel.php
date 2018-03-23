<?php

namespace App\Models;

use App\Models\Inherit\IL_Model;

class OrderDetailModel extends IL_Model
{
    protected $table = "order_detail";

    function product() {
        return $this->belongsTo('App\Models\ProductModel', 'product_id');
    }
}
