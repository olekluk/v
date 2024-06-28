<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class StatsController extends Controller
{

    /**
     * Retrieve skin statistics.
     *
     * This method retrieves skin statistics from the 'stores' table in the database.
     * It selects the 'themeName' column and counts the number of occurrences for each theme.
     * The results are grouped by theme name, filtered by active stores, and ordered by the total count in descending order.
     * The paginated results are then passed to the 'stats/skin' view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function skin()
    {
        $data = DB::table('stores')
            ->select('themeName', DB::raw('count(*) as total'))
            ->groupBy('themeName')
            ->where('active', 1)
            ->orderBy('total', 'DESC')
            ->paginate(1000);

        return view('stats/skin', ['data' => $data]);
    }



    /**
     * Retrieve sales data from the database and display it in the sales view.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function sales()
    {
        $data = DB::table('stores')
            ->select('customer', DB::raw('count(*) as total'))
            ->groupBy('customer')
            ->where('active', 1)
            ->orderBy('total', 'DESC')
            ->paginate(1000);

        return view('stats/sales', ['data' => $data]);
    }
}
