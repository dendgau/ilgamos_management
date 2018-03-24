<?php

namespace App\Models;

use App\Models\Inherit\IL_Model;

class ContractModel extends IL_Model
{
    protected $table = "contract";

    const TABLES_NAME = array(
        "bns"  => "Bàn ngoài sân",
        "bbtc" => "Bàn bên trái cửa",
        "bbfc" => "Bàn bên phải cửa",
        "bbtg" => "Bàn bên trái giữa",
        "bbfg" => "Bàn bên phải giữa",
        "bl"   => "Bàn lớn",
        "qb"   => "Quầy bar"
    );

    public function order_detail() {
        return $this->hasMany('App\Models\OrderDetailModel', 'contract_id');
    }
}
