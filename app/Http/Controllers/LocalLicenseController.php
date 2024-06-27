<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\License;
use App\Models\Theme;

class LocalLicenseController extends Controller
{

    /**
     * Display the add form and list all local codes form.
     *
     * @param  \App\Models\Theme  $themeModel
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Theme $themeModel, License $license)
    {
        $licenses = $license->paginate(100);
        $themes = $themeModel->get();
        return view('local', ['themes' => $themes, 'codes' => $licenses, 'message' => '']);
    }



    /**
     * Add a new local license.
     *
     * @param  Request  $request
     * @param  License  $license
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request, License $license)
    {
        var_dump($request->input('themeid'));
        if (strlen($request->input('lic')) > 0) {
            $lic = trim($request->input('lic'));
        } else {
            return view('local', ['message' => 'Error! Empty code!']);
        }

        if (License::where('lic', '=', $lic)->exists()) {
            // local code already exists
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

        return Redirect::route('local.index')->with('message', $message);
    }



    /**
     * Delete a local code.
     *
     * @param  Request  $request
     * @param  License  $license
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request, License $license)
    {
        $license->findOrFail($request->input('id'))->delete();
        return Redirect::route('local.index')->with('message', "Local code deleted.");
    }
}
