<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    function show(Request $request) {
        $now = new \DateTime('now');
        $month = $now->format('m');
        if ($request->get('month')) {
            $month = $request->get('month');
        }

        $revenues = DB::select(
            "SELECT SUM(total_price) as `total`, DATE_FORMAT(`created_at`, '%d/%m/%Y') as `date`
            FROM `contract` 
            WHERE (DATE_FORMAT(`created_at`, '%d') between 0 and 31) and DATE_FORMAT(`created_at`, '%m') = " .$month. "
            GROUP BY DATE_FORMAT(`created_at`, '%d/%m/%Y')"
        );

        return view('revenue\show')->with(array(
            'revenues' => $revenues,
            'month'    => $month
        ));
    }
}
