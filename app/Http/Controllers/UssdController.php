<?php

namespace App\Http\Controllers;

use App\UserSession; //All Sessions

use App\Session;
use App\Payment;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\Return_;
use Illuminate\Support\Facades\Http;

class UssdController extends Controller
{
    // http://127.0.0.1:8000//api/receive?MSISDN=o710474283&SERVICE_CODE=*401#&SESSION_ID=8327383838&USSD_STRING=
    public function Request(Request $request)
    {
        $menu_items = '';
        $msisdn = $request->MSISDN;
        $serviceCode = $request->SERVICE_CODE;
        $ussdString = $request->USSD_STRING;
        $sessionId = $request->SESSION_ID;
        $selection = '';

        $allsess = UserSession::where('session', $sessionId)->first();
        if (!$allsess) {
            UserSession::create(
                [
                    'session' => $sessionId,
                    'service_code' => $serviceCode,
                    'msisdn' => $this->FormatTelephone($msisdn),
                    'created_at' => now(),
                    'updated_at' => now()
                ]
            );
        }

        $bundled = $ussdString;
        $ussdString = str_replace('*', '', $ussdString);
        $session = Session::where('session', $sessionId)->first();

        #################################################################
        # USSD CODE = *401#
        #################################################################
        if ($serviceCode == '*401#') {
            //ongoing
            //get the selection
            // Eg *401*10#, (level 2)
            if ($session) {
                if (strlen($ussdString) >= 1 &&  $ussdString == $session->selection &&  $session->level == 1) {
                    //shortcuts
                    switch ((int) $ussdString) {
                        /**
                         * ###################################
                         * REGIONS = > case 1-8
                         * 1 to 9 => assigned to regions
                         * eg: *401*1# => takes you to central
                         * ####################################
                         */
                        case 1: # Central *401*1# => takes you to central
                            $response = $this->get_401_menus($session, 2, 1, null);
                            $menu_items = $response[0];
                            $min = $response[1];
                            $max = $response[2];
                            $this->update_session($session, $ussdString, $menu_items, 1, $min, $max, 'Central');
                            break;


                            /**
                             * ###################################
                             * ARTISTS = > case 10-99
                             * 10 to 99 => assigned to artists
                             * eg: *401*10# => takes you to Njeri Waithaka (artist)
                             * ####################################
                             */
                            // case 10: # Njeri Waithaka *401*10# => takes you to Njeri Waithaka (artist)
                        //     $response = $this->get_401_menus($session, 3, 1, 'Central'); #go to main menu level 3 with title 'Central' => case 1
                        //     $menu_items = $response[0];
                        //     $min = $response[1];
                        //     $max = $response[2];
                        //     $this->update_session($session, $ussdString, $menu_items, 1, $min, $max, 'Njeri Waithaka');
                        //     break;




                            /**
                             * ###################################
                             * MUSIC CODE = > case 1000-9999
                             * 1000 to 9999 => assigned to music codes/songs to be downloaded
                             * eg: *401*8040# => takes you to Riu ni Metho by Karis (Kariuki) (artist)
                             * ####################################
                             */

                        case 8040: # *401*8040#
                            $response = $this->get_401_menus($session, 4, 1, 'Karis (Kariuki)');
                            $menu_items = $response[0];
                            $min = $response[1];
                            $max = $response[2];
                            $this->update_session($session, $ussdString, $menu_items, 1, $min, $max, 'Riu ni Metho');
                            break;

                            // DJ Karis
                        case 7950: # *401*7950#
                            $response = $this->get_401_menus($session, 4, 1, 'DJ Karis');
                            $menu_items = $response[0];
                            $min = $response[1];
                            $max = $response[2];
                            $this->update_session($session, $ussdString, $menu_items, 1, $min, $max, 'DJ Karis Intro');
                            break;

                        default:
                            return response("END Thank you for checking out our USSD Platform. Dial *401# to get more services.", 200)
                            ->header('Content-Type', 'text/plain');
                            break;
                    }
                } else {
                    $len = strlen($session->ussd_string);
                    $selection = substr($ussdString, $len);
                    if ($selection == "0") {
                        return response("END Thank you for checking out our USSD Platform. Dial *401# to get more services.", 200)
                            ->header('Content-Type', 'text/plain');
                    }
                    $response = $this->get_401_menus($session, $session->level + 1, $selection, null);
                    $menu_items = $response[0];
                    $min = $response[1];
                    $max = $response[2];
                    $title = $response[3];
                    $this->update_session($session, $ussdString, $menu_items, $selection, $min, $max, $title);
                }
            }
            // new session
            else {
                //get main menu
                $response = $this->get_401_menus('', 1, '');

                $menu_items = $response[0];
                $min = $response[1];
                $max = $response[2];
                $selection = $ussdString;

                Session::insert([
                    'session' => $sessionId,
                    'service_code' => $serviceCode,
                    'msisdn' => $msisdn,
                    'ussd_string' => $ussdString,
                    'title' => 'Main Menu',
                    'level' => 1,
                    'selection' =>  (int)$selection,
                    'menu' => $menu_items,
                    'min_val' => $min,
                    'max_val' => $max,
                    'session_date' => Carbon::now(),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }


        }

        if #################################################################
        # USSD CODE = *220#
        # For testing purposes
        #################################################################
        ($serviceCode == '*220#') {
            $transaction_fee = 10;
            $cost = 100;
            $menu_items = "END Machiegni e Thedho omenda. Donji e draw gi KES 100. Siro tugo en KES 10. Kiyie donjo e draw to Ket mpesa pin".PHP_EOL;
            $min = '';
            $max='';
            $selection = $ussdString;
            Session::insert([
                'session' => $sessionId,
                'service_code' => $serviceCode,
                'msisdn' => $msisdn,
                'ussd_string' => $ussdString,
                'title' => 'Main Menu',
                'level' => 1,
                'selection' =>  (int)$selection,
                'menu' => $menu_items,
                'min_val' => $min,
                'max_val' => $max,
                'session_date' => Carbon::now(),
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // sleep(1);

            $url = "https://mlp.taifamobile.co.ke/api/checkout";

            $this->doSTKPush($url, ($transaction_fee + $cost), $msisdn, 'NAMLOLWE'/** account */, 'talash7', 'Draw Payment');
        }


        return response($menu_items, 200)
            ->header('Content-Type', 'text/plain');
    }
    public function update_session($session, $ussdstring, $menus, $selection, $min, $max, $header)
    {
        if ($header == '') {
            $header = $session->title;
        }

        $session->update([
            'ussd_string' => $ussdstring,
            'selection' =>  (int)$selection,
            'level' => $session->level + 1,
            'title' => $header,
            'menu' => $menus,
            'min_val' => (int)$min,
            'max_val' => (int) $max,
            'session_date' => Carbon::now(),
            'updated_at' => now()
        ]);
    }
    public function get_401_menus($session, $level, $selection, $nTitle = null)
    {
        $transaction_fee = 10;
        $url = "https://mlp.taifamobile.co.ke/api/checkout";
        $menu = '';
        $title = '';
        $min = 0;
        $max = 0;
        if ($session != null) {
            if ((int)$selection < (int)$session->min_val || (int)$selection > (int)$session->min_val) {
                //wrong selection, return previous Menu
                if ((int)$selection == 0) {
                    $menu = 'END Thank you for checking out Taifa Music. Dial *401# for more options.';
                    return [$menu, 0, 0];
                }
            }
        }

        // switch in between menus
        switch ($level) {
            case 1: #level 1
                /**
                 * 1. Central
                 * 2. Coast
                 * 3. Eastern
                 * 4. Nairobi
                 * 5. North Eastern
                 * 6. Nyanza
                 * 7. Rift Valley
                 * 8. Western
                 */
                $menu = 'CON Welcome to Taifa Music. Select' . PHP_EOL;
                $menu .= '1. Central' . PHP_EOL;
                // $menu .= '2. Coast' . PHP_EOL;
                // $menu .= '3. Eastern' . PHP_EOL;
                // $menu .= '4. Nairobi' . PHP_EOL;
                // $menu .= '5. North Eastern' . PHP_EOL;
                // $menu .= '6. Nyanza' . PHP_EOL;
                // $menu .= '7. Rift Valley' . PHP_EOL;
                // $menu .= '8. Western' . PHP_EOL;
                $menu .= '0. Exit';
                $min = 1;
                $max = 1;
                $title = 'Main Menu';

                break;
            case 2: #level 2
                switch ($selection) {
                    case 1: #Central
                        $menu = 'CON Central Region Musicians. Select'.PHP_EOL;
                        $menu .= '1. Karis (Kariuki)'.PHP_EOL; # shortcut: *401*10#
                        $min = 1;
                        $max = 1;
                        $title = 'Central';

                        break;
                }
                break;
            case 3: #level 3

                switch ((($nTitle == null) ? $session->title : $nTitle)) {
                    case 'Central':
                        switch ($selection) {
                            case 1:
                                $menu = "CON Karis (Kariuki) Music. Select" . PHP_EOL;
                                $menu .= "1. Riu ni Metho".PHP_EOL; #tmusic code (8040)
                                $min = 1;
                                $max = 1;
                                $title = 'Karis (Kariuki)';

                                break;
                        }

                        break;
                }

                break;
            case 4: #level 4
                switch ((($nTitle == null) ? $session->title : $nTitle)) {
                    case 'Karis (Kariuki)':
                        switch ($selection) {
                            case 1: #music code: 8040
                                $menu = 'END Download "Riu ni Metho" by Karis (Kariuki).'.PHP_EOL;
                                $menu .= 'Song Purchase KES 50'.PHP_EOL;
                                $menu .= 'M & Support fee  KES '.$transaction_fee.PHP_EOL;

                                $menu .= 'Confirm music purchase by entering M-Pesa pin'.PHP_EOL;

                                $this->doSTKPush($url, ($transaction_fee + 50), $session->msisdn, '8040', 'taifa mobile ltd', 'music purchase');
                                break;
                        }

                        break;

                    case 'DJ Karis':
                        switch ($selection) {
                            case 1: #music code: 7950
                                $menu = 'END Download "DJ Karis Intro" by DJ Karis.'.PHP_EOL;
                                $menu .= 'Song Purchase KES 50'.PHP_EOL;
                                $menu .= 'M & Support fee  KES '.$transaction_fee.PHP_EOL;

                                $menu .= 'Confirm music purchase by entering M-Pesa pin'.PHP_EOL;

                                $this->doSTKPush($url, ($transaction_fee + 50), $session->msisdn, '7950', 'taifa mobile ltd', 'music purchase');
                                break;
                        }

                        break;
                }

                break;
        }

        return [$menu, $min, $max, $title];
    }

    // For testing purposes
    // public function get_220_menus($session, $level, $selection, $nTitle = null)
    // {
    //     $transaction_fee = 10;
    //     $menu = '';
    //     $title = '';
    //     $min = 0;
    //     $max = 0;
    //     if ($session != null) {
    //         if ((int)$selection < (int)$session->min_val || (int)$selection > (int)$session->min_val) {
    //             //wrong selection, return previous Menu
    //             if ((int)$selection == 0) {
    //                 $menu = 'END Thank you for checking out our service. Dial *220*129# for more options.';
    //                 return [$menu, 0, 0];
    //             }
    //         }
    //     }

    //     // switch in between menus
    //     switch ($level) {
    //         case 1: #level 1
    //             $menu = 'CON Welcome. Select' . PHP_EOL;
    //             $menu .= '1. Test 220' . PHP_EOL;

    //             $menu .= '0. Exit';
    //             $min = 1;
    //             $max = 1;
    //             $title = 'Main Menu';

    //             break;
    //         case 2: #level 2
    //             switch ($selection) {
    //                 case 1: #Test
    //                     $menu = 'END Test is working. Goodbye!!'.PHP_EOL;
    //                     $title = 'Test';

    //                     break;
    //             }
    //             break;
    //     }

    //     return [$menu, $min, $max, $title];
    // }

    public function doSTKPush($apiURL, $amount, $phone, $account, $group, $description=null)
    {
        // POST Data
        $postInput = [
            'amount'=> $amount,
            'msisdn'=> $phone,
            'account'=> $account,
            'description' => $description,
            'group'=> $group
        ];

        // Headers
        $headers = [
            //...
        ];

        $response = Http::withHeaders($headers)->post($apiURL, $postInput);

        $statusCode = $response->status();
        $responseBody = json_decode($response->getBody(), true);

        return $statusCode;  // status code

        // dd($responseBody); // body response
    }

    public function FormatTelephone($tel)
    {
        $tel = '254'.substr(trim($tel), -9);


        return $tel;
    }
}
