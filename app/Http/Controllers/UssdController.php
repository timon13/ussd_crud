<?php

namespace App\Http\Controllers;

use App\UserSession; //All Sessions
// use App\Content;
// use App\Feedback;
// use App\Menu;
// use App\Service;
use App\Session;
use App\Payment;
// use App\Sessionlog;
// use App\Songofthehour;
// use App\Subscriber;
// use App\Subscription;
// use App\Topgospel;
// use App\Topmusic;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\Return_;

class UssdController extends Controller
{
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
        if ($session) {
            //ongoing
            //get the selection
            // Eg *401*10#, (level 2)
            if (strlen($ussdString) == 2 &&  $ussdString == $session->selection &&  $session->level == 1) {
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
                        $response = $this->get_menus($session, 2, 1, null);
                        $menu_items = $response[0];
                        $min = $response[1];
                        $max = $response[2];
                        $this->update_session($session, $ussdString, $menu_items, 1, $min, $max, 'Central');
                        break;

                    case 2: # Coast
                        $response = $this->get_menus($session, 2, 2, null);
                        $menu_items = $response[0];
                        $min = $response[1];
                        $max = $response[2];
                        $this->update_session($session, $ussdString, $menu_items, 1, $min, $max, 'Coast');
                        break;
                    case 3: # Eastern
                        $response = $this->get_menus($session, 2, 3, null);
                        $menu_items = $response[0];
                        $min = $response[1];
                        $max = $response[2];
                        $this->update_session($session, $ussdString, $menu_items, 1, $min, $max, 'Eastern');
                        break;
                    case 4: # Nairobi
                        $response = $this->get_menus($session, 2, 4, null);
                        $menu_items = $response[0];
                        $min = $response[1];
                        $max = $response[2];
                        $this->update_session($session, $ussdString, $menu_items, 1, $min, $max, 'Nairobi');
                        break;
                    case 5: # North Eastern
                        $response = $this->get_menus($session, 2, 5, null);
                        $menu_items = $response[0];
                        $min = $response[1];
                        $max = $response[2];
                        $this->update_session($session, $ussdString, $menu_items, 1, $min, $max, 'North Eastern');
                        break;
                    case 6: # Nyanza
                        $response = $this->get_menus($session, 2, 6, null);
                        $menu_items = $response[0];
                        $min = $response[1];
                        $max = $response[2];
                        $this->update_session($session, $ussdString, $menu_items, 1, $min, $max, 'Central');
                        break;
                    case 7: # Rift Valley
                        $response = $this->get_menus($session, 2, 7, null);
                        $menu_items = $response[0];
                        $min = $response[1];
                        $max = $response[2];
                        $this->update_session($session, $ussdString, $menu_items, 1, $min, $max, 'Rift Valley');
                        break;
                    case 8: # Western
                        $response = $this->get_menus($session, 2, 8, null);
                        $menu_items = $response[0];
                        $min = $response[1];
                        $max = $response[2];
                        $this->update_session($session, $ussdString, $menu_items, 1, $min, $max, 'Western');
                        break;

                        /**
                         * ###################################
                         * ARTISTS = > case 10-99
                         * 10 to 99 => assigned to artists
                         * eg: *401*10# => takes you to Njeri Waithaka (artist)
                         * ####################################
                         */
                    case 10: # Njeri Waithaka *401*10# => takes you to Njeri Waithaka (artist)
                        $response = $this->get_menus($session, 3, 1, 'Central'); #go to main menu level 3 with title 'Central' => case 1
                        $menu_items = $response[0];
                        $min = $response[1];
                        $max = $response[2];
                        $this->update_session($session, $ussdString, $menu_items, 1, $min, $max, 'Njeri Waithaka');
                        break;
                    case 11: # James Kamau *401*11# => takes you to James Kamau (artist)
                        $response = $this->get_menus($session, 3, 2, 'Central'); #go to main menu level 3 with title 'Central' => case 2
                        $menu_items = $response[0];
                        $min = $response[1];
                        $max = $response[2];
                        $this->update_session($session, $ussdString, $menu_items, 1, $min, $max, 'James Kamau');
                        break;

                        /**
                         * ###################################
                         * MUSIC CODE = > case 100-999
                         * 100 to 999 => assigned to music codes/songs to be downloaded
                         * eg: *401*4020# => takes you to Wa Mungu by Njeri Waithaka (artist)
                         * ####################################
                         */
                    case 4020: # *401*4020# => takes you to 'Wa Mungu' by Njeri Waithaka (artist)
                        $response = $this->get_menus($session, 4, 1, 'Njeri Waithaka'); #go to level 4 of main menu and select 1
                        $menu_items = $response[0];
                        $min = $response[1];
                        $max = $response[2];
                        $this->update_session($session, $ussdString, $menu_items, 1, $min, $max, 'Wa Mungu');
                        break;
                    case 4021: # *401*4021# => takes you to 'Kimbilio' by Njeri Waithaka (artist)
                        $response = $this->get_menus($session, 3, 2, 'Njeri Waithaka');
                        $menu_items = $response[0];
                        $min = $response[1];
                        $max = $response[2];
                        $this->update_session($session, $ussdString, $menu_items, 1, $min, $max, 'Kimbilio');
                        break;

                    case 4022:
                        $response = $this->get_menus($session, 4, 1, 'James Kamau'); #go to level 4 of main menu and select 1
                        $menu_items = $response[0];
                        $min = $response[1];
                        $max = $response[2];
                        $this->update_session($session, $ussdString, $menu_items, 1, $min, $max, 'Wa Mungu');
                        break;
                    case 4023:
                        $response = $this->get_menus($session, 3, 2, 'James Kamau');
                        $menu_items = $response[0];
                        $min = $response[1];
                        $max = $response[2];
                        $this->update_session($session, $ussdString, $menu_items, 1, $min, $max, 'Kimbilio');
                        break;
                }
            } else {
                $len = strlen($session->ussd_string);
                $selection = substr($ussdString, $len);
                if ($selection == "0") {
                    return response("END Thank you for checking out our USSD Platform. Dial *401# to get more services.", 200)
                        ->header('Content-Type', 'text/plain');
                }
                $response = $this->get_menus($session, $session->level + 1, $selection, null);
                $menu_items = $response[0];
                $min = $response[1];
                $max = $response[2];
                $title = $response[3];
                $this->update_session($session, $ussdString, $menu_items, $selection, $min, $max, $title);
            }
        } else {
            //new
            $response = $this->get_menus('', 1, '', null);
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
                'session_date' => Carbon::now()
            ]);
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
            'session_date' => Carbon::now()
        ]);
    }
    public function get_menus($session, $level, $selection, $nTitle = null)
    {
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
                if ((int)$selection == 99) {
                    $session->update([
                        'level' => $session->level - 1,
                    ]);
                    return [$session->menu, $session->min_val, $session->max_val];
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
                $menu .= '2. Coast' . PHP_EOL;
                $menu .= '3. Eastern' . PHP_EOL;
                $menu .= '4. Nairobi' . PHP_EOL;
                $menu .= '5. North Eastern' . PHP_EOL;
                $menu .= '6. Nyanza' . PHP_EOL;
                $menu .= '7. Rift Valley' . PHP_EOL;
                $menu .= '8. Western';
                $menu .= '0. Exit';
                $min = 1;
                $max = 8;
                $title = 'Main Menu';

                break;
            case 2: #level 2
                switch ($selection) {
                    case 1: #Central
                        $menu = 'CON Central Region Musicians. Select'.PHP_EOL;
                        $menu .= '1. Njeri Waithaka'.PHP_EOL; # shortcut: *401*10#
                        $menu .= '2. James Kamau'.PHP_EOL; #shortcut: *401*11#
                        $min = 1;
                        $max = 2;
                        $title = 'Central';

                        break;
                }
                break;
            case 3: #level 3

                switch (($nTitle == null) ? $session->title : $nTitle) {
                    case 'Central':
                        switch ($selection) {
                            case 1:
                                $menu = 'CON Njeri Waithaka Music' . PHP_EOL;
                                $menu .= '1. Wa Mungu'.PHP_EOL; #has a certain  tmusic code (4020) assigned to it
                                $menu .= '2. Kimbilio'.PHP_EOL;
                                $min = 1;
                                $max = 2;
                                $title = 'Njeri Waithaka';

                                break;
                            case 2:
                                $menu = 'CON James Kamau Music' . PHP_EOL;
                                $menu .= '1. Nishike'.PHP_EOL;
                                $menu .= '2. Mwenyeji'.PHP_EOL;
                                $min = 1;
                                $max = 2;
                                $title = 'James Kamau';
                        }

                        break;
                }

                break;
            case 4: #level 4
                switch (($nTitle == null) ? $session->title : $nTitle) {
                    case 'Njeri Waithaka':
                        switch ($selection) {
                            case 1: #music code: 4020
                                $menu = 'END Thank you for downloading. Wa Mungu by '. $session->title;
                                $title = 'Wa Mungu';
                                break;
                            case 2: #music code: 4021
                                $menu = 'END Thank you for downloading Kimbilio by '. $session->title;
                                $title = 'Kimbilio';
                                break;
                        }

                        break;
                    case 'James Kamau':
                        switch ($selection) {
                            case 1: #music code: 4022
                                $menu = 'END Thank you for downloading. Wa Mungu by '. $session->title;
                                $title = 'Wa Mungu';
                                break;
                            case 2: #music code: 4023
                                $menu = 'END Thank you for downloading Kimbilio by '. $session->title;
                                $title = 'Kimbilio';
                                break;
                        }

                        break;
                }

                break;

            default:
        }

        return [$menu, $min, $max, $title];
    }

    public function FormatTelephone($tel)
    {
        $tel = '254'.substr(trim($tel), -9);


        return $tel;
    }
    public function doSTKPush($account, $group, $amount, $telephone, $description=null, $apiURL)
    {
        $payload = array(
            'account'   => $account,
            'group'     => $group,
            'amount'    => $amount,
            'msisdn'    => $telephone,
            'description' => $description
        );
        $apiurl = $apiURL;
        $client = new Client();
        $response = $client->request('POST', $apiurl, [
            'form_params' => $payload,
            'headers' => ["Accept: application/json", "Accept-Language: en-us"]
        ]);
        $headers = $response->getHeaders();
        $body = $response->getBody();
        $body_array = json_decode($body);

        return $body_array;
    }
}
