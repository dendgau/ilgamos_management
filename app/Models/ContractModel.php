<?php

namespace App\Models;

use App\Models\Inherit\IL_Model;

class ContractModel extends IL_Model
{
    protected $table = "contract";

    public function order_detail() {
        return $this->hasMany('App\Models\OrderDetailModel', 'contract_id');
    }
}
