<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helper\Verify;
use App\Models\Store;
use App\Models\License;

class VerifyController extends Controller
{

    public function index(Request $request, Store $storeModel, License $licenseModel)
    {


        try {
            // validate request input parameters
            $request->validate([
                'lic' => 'required|string|max:100',
                'url' => 'required|string|max:200|ends_with:myshopify.com',
                'themeId' => 'required'
            ]);

            $lic = $request->input('lic');
            $url = $request->input('url');
            $themeId = $request->input('themeId');
            // TODO add skin tracking 
            // $skin = $request->input('skin', 'not set');
            $isTargetTheme = Verify::isTargetTheme($themeId);
            $isAdmin = Verify::isAdmin();
            $response = [];

            // check lic in cache (Redis)
            $cacheCheck = Verify::getLicenseCache($lic, $url);
            if ($cacheCheck != false) {
                $response = $cacheCheck;
            } else {

                // check lic in registered stores (MySQL)
                $registeredStoreCheck = Verify::getRegisteredStoreCheckResult($lic, $url, $storeModel);
                if ($registeredStoreCheck != false) {
                    $response = $registeredStoreCheck;
                } else {

                    // check lic in local licenses list (MySQL)
                    $localLicenseCheck = Verify::getlocalLicenseCheckResult($lic, $url, $themeId, $storeModel, $licenseModel);
                    if ($localLicenseCheck != false) {
                        $response = $localLicenseCheck;
                    } else {

                        // check lic in Envato API (External API)
                        $response = Verify::getEnvatoSaleCheckResult($lic, $url, $themeId, $storeModel);
                    }
                }
            }

            // add common response values
            $response = Verify::addCommon($response, $url);

            // replace with message for admin
            if ($isAdmin && $isTargetTheme) {
                $response = Verify::addAdminMessage($response);
            }

            return response()->json($response);
        } catch (\Exception $e) {

            return response()->json([
                'code' => '500',
                'msg' => $e->getMessage(),
                'owner_url' => config('verify.url'),
                'owner_email' => config('verify.email')
            ]);
        }
    }
}
