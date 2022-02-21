<?php

/**
 * Boa Portal SSO Library
 * @author      LMWN <contact@lmwn.co.uk>
 * @license     Apache-2.0 License
 */

namespace Boa\Authentication;

use Boa\App;

class PortalSSO extends App
{
    public array $settings;

    public function __construct() {
        parent::__construct();
        global $settings;
        $settings = parent::Settings();
    }

    public function Login(): bool
    {
        global $settings;
        $token = $_GET['token'];
        $sig = $_GET['sig'];
        if(!empty($token) && !$_SESSION['token'])
        {
            $algorithm = file_get_contents('https://portal.lmwn.co.uk/assets/common/ptkhash.txt');
            if (hash_equals(hash_hmac($algorithm, $token, $settings['portal_secret']), $sig)) {
                $_SESSION['token'] = $token;
                return true;
            } else {
                header('Location: https://portal.lmwn.co.uk/authenticate/?redirect_url='.$settings['portal_redirect_url'].'&permissions='.$settings['portal_permissions']);
                return false;
            }
        } else {
            header('Location: https://portal.lmwn.co.uk/authenticate/?redirect_url='.$settings['portal_redirect_url'].'&permissions='.$settings['portal_permissions']);
            return false;
        }
    }

    private function Authenticate(): bool|string
    {
        if($_SESSION['token']) {
            $url = "https://portal.lmwn.co.uk/authenticate/authservice.php?token=".$_SESSION['token'];

            $response = json_decode($this->RequestData($url, "GET"));
            $user = $response->data;

            if ($response->code != 200) {
                unset($_SESSION['token']);
                return false;
            } else {
                return $user;
            }
        } else {
            return false;
        }
    }

    private function RequestData($url, $method = "GET", $postdata = null): bool|string
    {
        $ch = curl_init($url);

        $headers = array(
            'Accept: application/json',
        );

        if ($method == "POST") {
            curl_setopt_array($ch, array(
                CURLOPT_POST  => 1,
                CURLOPT_HTTPHEADER  => $headers,
                CURLOPT_POSTFIELDS  => $postdata,
                CURLOPT_RETURNTRANSFER  =>true,
                CURLOPT_VERBOSE     => 1
            ));
        }else{
            curl_setopt_array($ch, array(
                CURLOPT_HTTPGET  => 1,
                CURLOPT_HTTPHEADER  => $headers,
                CURLOPT_RETURNTRANSFER  =>true,
                CURLOPT_VERBOSE     => 1
            ));
        }

        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }
}