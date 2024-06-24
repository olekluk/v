<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TestStore;

class TestStoreController extends Controller
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

    public function addteststore(Request $request, TestStore $testStore) {
        if(strlen($request->input('lic')) > 0 ) {
            $lic = trim($request->input('lic'));
        } else {
            return view('addforms')->withData('Error! Empty license!');
        }

        if(strlen($request->input('url')) > 0 ) {
            $url = trim($request->input('url'));
        } else {
            return view('addforms')->withData('Error! Empty store URL!');
        }

        if (TestStore::where('lic', '=', $lic)->where('teststore', '=', $url)->exists()) {
            // user found
            $message = "Error. The test store is already added for this license";
        } else {
            $testStore->lic = $lic;
            $testStore->themeId = $request->input('themeid');
            $testStore->teststore = $url;
            $testStore->save();

            $message = 'Done. The test store (' . $url . ') is added for the license (' . $lic . ')';
        }

        return view('addforms')->withData($message);
    }

    public function viewteststore(TestStore $testStore, Request $request) {
        if ($request->input('action') == 'delete') {
            $testStore->findOrFail($request->input('id'))->delete();
        }

        $testStores = $testStore->get();

        return view('viewteststore')->withData($testStores);
    }

}
