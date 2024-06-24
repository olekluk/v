<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Store;
use App\TestStore;

class HomeController extends Controller
{

    // public function deactivate(Request $request, Store $storeModel, TestStore $testStore)
    // {

    //     if ($request->input('all') == 'true') {
    //         $stores = $storeModel::where('active', 1)->orderBy('created_at', 'desc')->get();
    //         return view('home')->withData($stores)->withTeststores('');
    //     }

    //     if (strlen($request->input('lic')) > 0) {
    //         $lic = trim($request->input('lic'));
    //     } else {
    //         return view('home')->withData('Error! Empty code!')->withTeststores('');
    //     }

    //     if ($request->input('updatedb') == 'true') {
    //         $storeModel::where('lic', $lic)
    //             ->update(['active' => 0]);
    //     }

    //     $stores = $storeModel::where('lic', $lic)
    //         ->orWhere('customer', $lic)
    //         ->orWhere('url', 'like', '%' . $lic . '%')
    //         ->get();

    //     try {

    //         $apiResponse = envatoApi2($lic);
    //         //            $apiResponse['themeId']
    //         if ($apiResponse) {
    //             // if OK add to db
    //             //check themeID
    //             $purchaseDetails = $apiResponse;
    //         } else {
    //             // if not return message validation failed
    //             $purchaseDetails = "Failed to get purchase details.";
    //         }
    //     } catch (Exception $e) {
    //     }

    //     if ($stores->count() > 0) {
    //         $testStores = $testStore::where('lic', $lic)->get();
    //         return view('home')->withData($stores)->withPurchase($purchaseDetails)->withTeststores($testStores->count() > 0 ? $testStores : '');
    //     } else {
    //         return view('home')->withData('Error! Purchase code not active.')->withPurchase($purchaseDetails)->withTeststores('');
    //     }
    // }
}
