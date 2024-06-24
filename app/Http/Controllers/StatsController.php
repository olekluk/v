<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function skinstats() {

        $data = DB::table('stores')
            ->select('themeName', DB::raw('count(*) as total'))
            ->groupBy('themeName')
            ->where('active', 1)
            ->orderBy('total', 'DESC'   )
            ->get();

        return view('stats/skinstats')->withData($data);
    }

    public function salepercustomer() {

        $data = DB::table('stores')
            ->select('customer', DB::raw('count(*) as total'))
            ->groupBy('customer')
            ->where('active', 1)
//            ->where('total', '>=', 2)
            ->orderBy('total', 'DESC'   )
            ->get();

        return view('stats/salepercustomer')->withData($data);

    }

}
