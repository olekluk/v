<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\License;

class LocalLicenseController extends Controller
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

    public function addforms() {
        return view('addforms')->withData('');
    }

    public function addlocalcode(Request $request, License $license) {
        if(strlen($request->input('lic')) > 0 ) {
            $lic = trim($request->input('lic'));
        } else {
            return view('addforms')->withData('Error! Empty code!');
        }

        if (License::where('lic', '=', $lic)->exists()) {
            // user found
            $message = "Error. The local license is already exist. Use a unique text string.";
        } else {
            $license->lic = $lic;
            $license->themeId = $request->input('themeid');
            $license->themeName = $request->input('themeid');
            $license->comment = $request->input('themeid');
            $license->active = 1;
            $license->save();

            $message = 'Done. The local purchase code added. Code - ' . $lic . '';
        }

        return view('addforms')->withData($message);
    }

    public function viewlocalcode(License $license, Request $request) {
        if ($request->input('action') == 'delete') {
            $license->findOrFail($request->input('id'))->delete();
        }

        $codes = $license->get();

        return view('viewlocalcode')->withData($codes);
    }

}
