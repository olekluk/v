<?php

namespace App\Helper;

use Illuminate\Support\Facades\Cache;

class Verify
{
    /**
     * The message displayed for theme editor.
     *
     * This constant stores the message that is displayed specifically for theme editors.
     *
     * @var string
     */
    const ADMIN_MESSAGE = '<div class="wokieesupportmessage" style="display: flex;flex-direction: row;flex-wrap: nowrap;justify-content: flex-start;align-content: flex-start;align-items: flex-end;position:fixed;top:0;left:0;width:100%;height: 100%;z-index:9999999999;margin: 0;padding: 0;-moz-user-select: none;-ms-user-select: none;-o-user-select: none;-webkit-user-select: none;"><div style="width: 100%;background-color:rgb(0, 0, 0);background-color:rgb(0, 0, 0, 0.9);padding: 20px;color: #ffffff;position: relative;font-size: 18px;line-height: 24px;"><svg width="150" height="36" viewBox="0 0 150 36" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.59541 35.638L0 12.7044H7.03624L9.08653 20.2585C9.58357 22.1583 10.003 23.8772 10.3447 25.4151C10.6864 26.9229 10.8883 27.9633 10.9504 28.5363L11.0902 29.3957C11.3077 27.5864 12.0688 24.5406 13.3735 20.2585L15.6568 12.7044H21.5281L23.7648 20.2585C24.3239 22.1885 24.7899 23.9224 25.1627 25.4604C25.5355 26.9682 25.7685 28.0086 25.8617 28.5815L26.0015 29.3957C26.2189 27.6165 26.9489 24.5708 28.1915 20.2585L30.3816 12.7044H37.0917L29.5429 35.638H22.5532L20.5029 28.1292C20.068 26.5008 19.6797 24.9779 19.338 23.5606C19.0274 22.1432 18.8254 21.133 18.7322 20.5299L18.5924 19.6252C18.2818 21.6456 17.6294 24.4803 16.6353 28.1292L14.585 35.638H7.59541Z" fill="#417DFB"/><path d="M50.5427 35.9999C46.846 35.9999 43.988 34.9294 41.9688 32.7883C39.9496 30.6171 38.9399 27.8427 38.9399 24.4652C38.9399 20.937 39.9961 18.042 42.1086 15.7803C44.221 13.4885 47.0324 12.3425 50.5427 12.3425C54.2084 12.3425 57.0509 13.4432 59.0701 15.6446C61.0893 17.846 62.0989 20.6505 62.0989 24.0581C62.0989 27.5261 61.0738 30.3909 59.0235 32.6526C57.0043 34.8841 54.1773 35.9999 50.5427 35.9999ZM50.4961 17.5444C49.005 17.5444 47.8867 18.1626 47.1411 19.399C46.3956 20.6354 46.0228 22.2337 46.0228 24.1938C46.0228 26.154 46.3956 27.7673 47.1411 29.0339C47.9177 30.2703 49.0671 30.8885 50.5893 30.8885C52.0805 30.8885 53.1833 30.2853 53.8978 29.0791C54.6433 27.8427 55.0161 26.2444 55.0161 24.2843C55.0161 19.7911 53.5095 17.5444 50.4961 17.5444Z" fill="#417DFB"/><path d="M88.7706 35.638H80.8956L73.3468 24.3748V35.638H66.5435V4.42659H73.3468V22.9725L80.8024 12.7044H88.6308L80.4296 23.6963L88.7706 35.638Z" fill="#417DFB"/><path d="M92.3051 35.638V12.7044H99.1083V35.638H92.3051Z" fill="#417DFB"/><path d="M118.603 22.0678V21.525C118.386 18.8411 117.174 17.4992 114.969 17.4992C113.881 17.4992 112.918 17.8912 112.08 18.6753C111.241 19.4292 110.682 20.56 110.402 22.0678H118.603ZM123.496 28.8077V34.3262C121.881 35.3515 119.411 35.8642 116.087 35.8642C112.204 35.8642 109.175 34.7786 107 32.6073C104.857 30.406 103.785 27.5864 103.785 24.1486C103.785 20.4997 104.826 17.65 106.907 15.5994C109.02 13.5186 111.614 12.4782 114.689 12.4782C117.858 12.4782 120.358 13.3829 122.191 15.1923C124.024 16.9715 124.941 19.6403 124.941 23.1987C124.941 23.8923 124.816 25.0834 124.568 26.7722H110.682C111.148 28.0387 111.955 29.0188 113.105 29.7124C114.254 30.406 115.637 30.7528 117.252 30.7528C119.644 30.7528 121.725 30.1044 123.496 28.8077Z" fill="#417DFB"/><path d="M143.449 22.0678V21.525C143.232 18.8411 142.02 17.4992 139.815 17.4992C138.727 17.4992 137.764 17.8912 136.926 18.6753C136.087 19.4292 135.528 20.56 135.248 22.0678H143.449ZM148.342 28.8077V34.3262C146.727 35.3515 144.257 35.8642 140.933 35.8642C137.05 35.8642 134.021 34.7786 131.846 32.6073C129.703 30.406 128.631 27.5864 128.631 24.1486C128.631 20.4997 129.672 17.65 131.753 15.5994C133.866 13.5186 136.46 12.4782 139.535 12.4782C142.704 12.4782 145.204 13.3829 147.037 15.1923C148.87 16.9715 149.787 19.6403 149.787 23.1987C149.787 23.8923 149.662 25.0834 149.414 26.7722H135.528C135.994 28.0387 136.801 29.0188 137.951 29.7124C139.1 30.406 140.483 30.7528 142.098 30.7528C144.49 30.7528 146.571 30.1044 148.342 28.8077Z" fill="#417DFB"/><path d="M98.0897 0.568462V2.01804C97.4685 1.62012 96.7638 1.42116 95.9756 1.42116C95.4656 1.42116 95.0623 1.53959 94.7656 1.77644C94.4781 2.00383 94.3344 2.30701 94.3344 2.68598C94.3344 3.06496 94.4781 3.36814 94.7656 3.59552C95.053 3.82291 95.4934 4.06924 96.0869 4.33452C96.4763 4.50506 96.7777 4.65192 96.991 4.77508C97.2135 4.89825 97.4639 5.07352 97.742 5.30091C98.0295 5.51882 98.2381 5.7841 98.3679 6.09676C98.507 6.39994 98.5766 6.75049 98.5766 7.14841C98.5766 7.99163 98.2845 8.65484 97.7003 9.13803C97.1161 9.62122 96.3604 9.86282 95.4332 9.86282C94.4039 9.86282 93.5509 9.65912 92.874 9.25172V7.73109C93.6065 8.29007 94.4549 8.56957 95.4193 8.56957C95.9293 8.56957 96.3326 8.45114 96.6293 8.21428C96.926 7.96794 97.0744 7.6316 97.0744 7.20526C97.0744 6.94945 96.9863 6.71733 96.8101 6.50889C96.634 6.29098 96.4439 6.12992 96.2399 6.0257C96.0359 5.91201 95.7299 5.76042 95.3219 5.57093C95.0808 5.45724 94.9093 5.3767 94.8073 5.32933C94.7146 5.28196 94.5569 5.19669 94.3344 5.07352C94.1118 4.95036 93.9449 4.84614 93.8337 4.76087C93.7317 4.6756 93.6019 4.55717 93.4442 4.40558C93.2866 4.25399 93.1707 4.1024 93.0965 3.95081C93.0316 3.79922 92.9667 3.62395 92.9018 3.42498C92.8461 3.21655 92.8183 2.9939 92.8183 2.75704C92.8183 1.94225 93.1058 1.29799 93.6807 0.82427C94.2648 0.350552 95.0159 0.113693 95.9339 0.113693C96.7777 0.113693 97.4963 0.265283 98.0897 0.568462Z" fill="white"/><path d="M106.234 6.12518V0.18475H107.667V6.09676C107.667 7.3379 107.352 8.2806 106.721 8.92486C106.09 9.56911 105.219 9.89124 104.106 9.89124C103.012 9.89124 102.15 9.57859 101.519 8.95328C100.889 8.3185 100.573 7.40422 100.573 6.21045V0.18475H102.006V6.19624C102.006 7.01103 102.196 7.60792 102.576 7.98689C102.966 8.35639 103.476 8.54114 104.106 8.54114C105.525 8.54114 106.234 7.73582 106.234 6.12518Z" fill="white"/><path d="M111.428 5.15879H112.652C113.329 5.15879 113.843 4.98826 114.196 4.64718C114.557 4.3061 114.738 3.85607 114.738 3.29708C114.738 2.70967 114.557 2.24543 114.196 1.90435C113.834 1.56327 113.31 1.39273 112.624 1.39273H111.428V5.15879ZM109.995 0.18475H112.68C113.755 0.18475 114.608 0.478456 115.239 1.06587C115.87 1.6438 116.185 2.38754 116.185 3.29708C116.185 4.20662 115.865 4.94562 115.225 5.51408C114.595 6.08255 113.774 6.36678 112.763 6.36678H111.428V9.76334H109.995V0.18475Z" fill="white"/><path d="M119.396 5.15879H120.62C121.297 5.15879 121.812 4.98826 122.164 4.64718C122.526 4.3061 122.706 3.85607 122.706 3.29708C122.706 2.70967 122.526 2.24543 122.164 1.90435C121.802 1.56327 121.278 1.39273 120.592 1.39273H119.396V5.15879ZM117.963 0.18475H120.648C121.723 0.18475 122.577 0.478456 123.207 1.06587C123.838 1.6438 124.153 2.38754 124.153 3.29708C124.153 4.20662 123.833 4.94562 123.193 5.51408C122.563 6.08255 121.742 6.36678 120.731 6.36678H119.396V9.76334H117.963V0.18475Z" fill="white"/><path d="M125.556 4.93141C125.556 3.44393 125.945 2.25016 126.724 1.3501C127.503 0.450033 128.546 0 129.854 0C131.189 0 132.241 0.450033 133.011 1.3501C133.781 2.24069 134.165 3.43446 134.165 4.93141C134.165 6.42836 133.776 7.62687 132.997 8.52693C132.228 9.427 131.184 9.87703 129.868 9.87703C128.56 9.87703 127.512 9.427 126.724 8.52693C125.945 7.62687 125.556 6.42836 125.556 4.93141ZM127.795 2.3307C127.304 2.96548 127.058 3.83238 127.058 4.93141C127.058 6.03044 127.313 6.90208 127.823 7.54634C128.333 8.19059 129.015 8.51272 129.868 8.51272C130.749 8.51272 131.435 8.19533 131.926 7.56055C132.418 6.92576 132.663 6.04939 132.663 4.93141C132.663 3.82291 132.413 2.95127 131.912 2.31648C131.421 1.6817 130.735 1.36431 129.854 1.36431C128.982 1.36431 128.296 1.68644 127.795 2.3307Z" fill="white"/><path d="M137.573 1.40694V4.90299H138.867C139.46 4.90299 139.91 4.74666 140.216 4.434C140.522 4.11188 140.675 3.68553 140.675 3.15496C140.675 1.98962 140.049 1.40694 138.797 1.40694H137.573ZM141.009 9.76334L138.811 6.12518H137.573V9.76334H136.141V0.18475H138.756C139.831 0.18475 140.661 0.45477 141.245 0.994809C141.829 1.52537 142.121 2.25016 142.121 3.16918C142.112 3.84186 141.945 4.41506 141.621 4.88877C141.296 5.35302 140.847 5.68936 140.272 5.8978L142.72 9.76334H141.009Z" fill="white"/>
                            <path d="M150 0.18475V1.40694H147.538V9.76334H146.105V1.40694H143.658V0.18475H150Z" fill="white"/></svg><div><div style="font-weight: bold; font-size: 28px; line-height: 30px; margin: 14px 0 0 0;">Attention! Important Performance Update.</div><div style="margin: 6px 0 0 0;"><a href="https://bit.ly/2Js7DjB" style="display: inline-flex;flex-direction: column;flex-wrap: nowrap;justify-content: center;align-content: center;align-items: center;font-weight: 600;font-size: 16px;line-height: 20px;padding: 5px 45px 2px;height:60px;color: #ffffff;background-color: #417DFB;border: none;box-sizing: border-box;border-radius: 6px;text-decoration:none;outline: none;" target="_blank">VIEW INSTRUCTION<div style="font-size: 14px;display: block;line-height: 16px;
                                font-weight: 400;">Right-click. Open link in new tab
                            </div></a>Due to the high load of our APP Server we strongly recommend our customers to make urgent updates.  DON\'T WORRY! You will not lose any information and customizations.</div><div style="font-weight: 600; font-size: 15px; line-height: 18px; color: #3FAA3C;margin: 15px 0 0 0;"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin:0px 2px 0 0; position: relative; top:3px;"><path d="M9 18C13.9706 18 18 13.9706 18 9C18 4.02944 13.9706 0 9 0C4.02944 0 0 4.02944 0 9C0 13.9706 4.02944 18 9 18Z" fill="#3FAA3C"/><path d="M8.36262 13L4 9.70519L5.24045 8.16191L7.91944 10.1851L12.3409 4L14 5.1142L8.36262 13Z" fill="white"/></svg>Your storefront works as usual.</div><div style="font-size: 15px; line-height: 18px; margin:9px 0 0 0;">This is an admin-only message. The usual visitor doesn\'t see it.</div></div><div class="btclose" style="position:absolute;top:10px;right: 10px;cursor: pointer;color:#ffffff;outline: none;"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9 7.49587L1.50403 0L0 1.50435L7.49598 9L0 16.4956L1.50403 18L9 10.5041L16.496 18L18 16.4956L10.504 9L18 1.50435L16.496 0L9 7.49587Z" fill="currentColor"/></svg></div></div><style>.wokieesupportmessage div div > div:nth-child(2) a{transition: color .2s linear,background-color .2s linear;}.wokieesupportmessage div div > div:nth-child(2) a:hover{background-color: #224BA3 !important;}.wokieesupportmessage div > div:last-child{transition: color .2s linear;}.wokieesupportmessage > div > div:last-child:hover{color: #417DFB!important;}@media (min-width: 767px){.wokieesupportmessage > div > div:nth-child(2){width:calc(100% - 300px);}.wokieesupportmessage >  div > div > div:nth-child(2) a{position: absolute;right:20px;}}@media (max-width: 768px){.wokieesupportmessage >  div > div > div:nth-child(2){display: flex;flex-direction: row;flex-wrap: wrap;justify-content: flex-start;align-content: flex-start;align-items: flex-start;}.wokieesupportmessage >  div > div > div:nth-child(2) a{order: 2;margin-top: 13px;}}</style><script class="scclass">
                            if($(\'.wokieesupportmessage\').length){
                            var p = $(\'.wokieesupportmessage\').parent().parent().parent();
                            var d = $(\'.wokieesupportmessage\').detach();
                            p.replaceWith(d);
                            $(".wokieesupportmessage .btclose").click(function(e){e.preventDefault();$(\'.wokieesupportmessage\').remove()})
                            $(\'.wokieesupportmessage a\').click(function(e){e.stopPropagation()})
                            }
                            $(\'.scclass\').length && $(\'.scclass\').remove();
                            </script></div>';



    /**
     * Checks if a given theme is the target theme.
     *
     * @param string $theme The theme to check.
     * @return bool Returns true if the theme is the target theme, false otherwise.
     */
    public static function isTargetTheme($themeId)
    {
        if (config('verify.target_theme_id') == $themeId) {
            // Code to execute if the constant matches the value
            return true;
        } else {
            // Code to execute if the constant does not match the value
            return false;
        }
    }



    /**
     * Checks if the request goes from the theme editor.
     *
     * @return bool Returns true if the user is an admin, false otherwise.
     */
    public static function isAdmin()
    {
        $referer = request()->headers->get('referer');
        if (strpos($referer, "editor_domain") === false) {
            return false;
        } else {
            return true;
        }
    }



    /**
     * Retrieves the cache for a given license and store.
     *
     * @param string $lic The license key.
     * @param string $url The URL associated with the license.
     * @return bool|array Returns false if cache is not enabled or the lic registered for another URL.
     *                    Returns an array with 'code' and 'msg' keys if the lic & URL is found.
     */
    public static function getLicenseCache($lic, $url)
    {
        if (config('verify.cache_use') != "TRUE") {
            return false;
        }

        $cachedUrl = Cache::get($lic, 'notset');
        if ($cachedUrl == 'notset') {
            return false;
        }

        if ($url <> $cachedUrl) {
            return [
                'code' => '21',
                'msg' => 'Purchase code is already used for ' . $cachedUrl . ' website. cache',
            ];
        } else {
            return [
                'code' => '2',
                'msg' => 'Purchase code is already activated for current website. cache',
            ];
        }
    }



    /**
     * Sets the license cache with the given license and URL.
     *
     * @param string $lic The license key.
     * @param string $url The URL associated with the license.
     * @return bool Returns true if the license cache is set successfully, false otherwise.
     */
    public static function setLicenseCache($lic, $url)
    {
        if (config('verify.cache_use') != "TRUE") {
            return false;
        }
        Cache::put($lic, $url, now()->addHours((int)config('verify.cache_ttl')));
    }



    /**
     * Retrieves the check result for a registered store.
     *
     * @param string $lic The license code to check.
     * @param string $url The URL of the store to check.
     * @param string $storeModel ORM object to retrive store data from database.
     * @return array|false Returns an array with 'code' and 'msg' keys if the store is registered and the check result is found. Returns false otherwise.
     */
    public static function getRegisteredStoreCheckResult($lic, $url, $storeModel)
    {
        $store = $storeModel::where('active', 1)->where('lic', $lic)->first();
        if ($store) {
            if ($url <> $store->url) {
                return [
                    'code' => '21',
                    'msg' => 'Purchase code is already used for ' . $store->url . ' website. db',
                ];
            } else {
                self::setLicenseCache($lic, $url);
                return [
                    'code' => '2',
                    'msg' => 'Purchase code is already activated for current website. db',
                ];
            }
        } else {
            return false;
        }
    }



    /**
     * Retrieves the local license check result.
     *
     * @param string $lic The license code to check.
     * @param string $url The URL of the website.
     * @param int $themeId The ID of the theme.
     * @param object $storeModel The store model object.
     * @param object $licenseModel The license model object.
     * @return array|false Returns an array with the status code and message if the local license exists, otherwise returns false.
     */
    public static function getlocalLicenseCheckResult($lic, $url, $themeId, $storeModel, $licenseModel)
    {
        $locLic = $licenseModel::where('active', 1)->where('lic', $lic)->first();
        if ($locLic) {
            // if local license exists, register it for give store
            $storeModel->lic = $lic;
            $storeModel->url = $url;
            $storeModel->themeId = $themeId;
            $storeModel->themeName = $locLic->themeName;
            $storeModel->active = 1;
            $storeModel->customer = $locLic->comment;
            $storeModel->save();

            return [
                'code' => '1',
                'msg' => 'Local purchase code activated for ' . $url . ' website. db',
            ];
        } else {
            return false;
        }
    }



    /**
     * Talks to the Envato API to verify an item purchase code.
     *
     * @param string $item_purchase_code The item purchase code to verify.
     * @return mixed Returns the response from the Envato API if the verification is successful, otherwise returns false.
     */
    public static function talkEnvatoApi($item_purchase_code)
    {
        $url = config('verify.envato_api_endpoint') . "author/sale?code=" . $item_purchase_code;
        $curl = curl_init($url);

        $header = array();
        $header[] = 'Authorization: Bearer ' . config('verify.envato_api_token');
        $header[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:41.0) Gecko/20100101 Firefox/41.0';
        $header[] = 'timeout: 20';
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);

        $envatoRes = curl_exec($curl);
        curl_close($curl);

        $envatoRes = json_decode($envatoRes, true);

        if (isset($envatoRes['buyer'])) {
            return $envatoRes;
        } else {
            return false;
        }
    }



    /**
     * Checks the result of an Envato sale verification.
     *
     * @param string $lic The purchase code to verify.
     * @param string $url The URL of the website where the purchase code is being activated.
     * @param int $themeId The ID of the theme being verified.
     * @param StoreModel $storeModel The model representing the store where the verification result will be saved.
     * @return array An array containing the verification result code and message.
     */
    public static function getEnvatoSaleCheckResult($lic, $url, $themeId, $storeModel)
    {
        $apiResponse = self::talkEnvatoApi($lic);

        if ($apiResponse !== false && $apiResponse['item']['id'] == $themeId) {

            $storeModel->customer = $apiResponse['buyer'];
            $storeModel->themeId = $apiResponse['item']['id'];
            $storeModel->themeName = $apiResponse['item']['name'];
            $storeModel->lic = $lic;
            $storeModel->url = $url;
            $storeModel->active = 1;
            $storeModel->save();

            return [
                'code' => '1',
                'msg' => 'Purchase code activated for ' . $url . ' website. api',
            ];
        } else {
            return [
                'code' => '32',
                'msg' => 'Invalid purchase code. api'
            ];
        }
    }



    /**
     * Adds an admin message to the response array.
     *
     * @param array $responseIn The input response array.
     * @return array The updated response array with the admin message added.
     */
    public static function addAdminMessage($responseIn)
    {
        return array_merge($responseIn, [
            'code' => '4',
            'msg' => self::ADMIN_MESSAGE,
        ]);
    }



    /**
     * Add common data to the response array.
     *
     * @param array $responseIn The input response array.
     * @param string $url The URL of the store.
     * @return array The updated response array with common data added.
     */
    public static function addCommon($responseIn, $url)
    {
        return array_merge($responseIn, [
            'owner_url' => config('verify.url'),
            'owner_email' => config('verify.email'),
            'store' => $url,
        ]);
    }
}
