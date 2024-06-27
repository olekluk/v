<?php

namespace App\Http\Controllers;

use App\Helper\Verify;
use Illuminate\Http\Request;
use App\Models\Store;

class InfoController extends Controller
{
    /**
     * Search for stores based on the provided license key, customer name or url.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $storeModel
     * @return \Illuminate\Contracts\View\View
     */

    public function search(Request $request, Store $storeModel)
    {
        $lic = $request->input('lic');
        $stores = $storeModel::where('lic', $lic)
            ->orWhere('customer', $lic)
            ->orWhere('url', 'like', '%' . $lic . '%')
            ->paginate(15);

        if (preg_match("/^[0-9a-z]{8}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{4}-[0-9a-z]{12}$/", $lic)) {
            $licInfo = Verify::talkEnvatoApi($lic);
        } else {
            $licInfo = false;
        }

        return view('info', ['stores' => $stores, 'licInfo' => $licInfo]);
    }



    /**
     * Retrieve all stores and display them in the info view.
     *
     * @param  Request  $request
     * @param  Store  $storeModel
     * @return \Illuminate\Contracts\View\View
     */

    public function all(Request $request, Store $storeModel)
    {
        $stores = Store::paginate(1000);
        return view('info', ['stores' => $stores]);
    }



    /**
     * Deactivates a store based on the provided license key and returns the updated store information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Store  $storeModel
     * @return \Illuminate\Contracts\View\View
     */

    public function deactivate(Request $request, Store $storeModel)
    {
        $lic = trim($request->input('lic'));

        // Deactivate the store with the provided license key
        $storeModel::where('lic', $lic)->update(['active' => 0]);

        // Retrieve the updated store information
        $stores = $storeModel::where('lic', $lic)->paginate(15);

        // Return the 'info' view with the updated store information
        return view('info', ['stores' => $stores]);
    }
}
