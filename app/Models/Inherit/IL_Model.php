<?php

namespace App\Models\Inherit;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class IL_Model extends Model
{
    public function scopeupdate_item_by_id($query, $id, $item) {
        $item += array(
            'updated_at' => Carbon::now()
        );
        return DB::table($this->table)->where('id', $id)->update($item);
    }

    public function scopeupdate_item_by_conditions($query, $conditions, $item) {
        $item += array(
            'updated_at' => Carbon::now()
        );
        return DB::table($this->table)->where($conditions)->update($item);
    }

    public function scopeget_item_by_conditions($query, $conditions, $is_sigle_row = false) {
        $results = DB::table($this->table)->where($conditions);

        if ($is_sigle_row) {
            $results->first();
        }
        return $results->get();
    }
}
