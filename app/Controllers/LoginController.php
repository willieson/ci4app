<?php

namespace App\Controllers;

use App\Models\UserModel;
use Google\Service\Oauth2;
use Google_Client;
use Google_Service;
use Google_Service_Exception;
use Google_Service_Resource;

class LoginController extends BaseController
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function index()
    {


        $client_id = '723636028103-hrfvflkrc73tevcnh354kud3svo288mj.apps.googleusercontent.com';
        $client_secret = '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';
        $redirect_uri = 'http://localhost:8080/login';

        $client = new Google_Client();
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->addScope('email');
        $client->addScope('profile');
        $uri_google = $client->createAuthUrl();

        $code = $this->request->getGet('code');
        if (isset($code)) {
            $token = $client->fetchAccessTokenWithAuthCode($code);
            $access_token = $token['access_token'];
            if (!isset($token['error'])) {
                $client->setAccessToken($access_token);
                $service = new Oauth2($client);
                $profile = $service->userinfo->get();
                $g_name = $profile['name'];
                $g_email = $profile['email'];
                $g_id = $profile['id'];

                $check_query = $this->userModel->where('oauth_id', $g_id)->first();

                if ($check_query) {
                    // Jika pengguna sudah ada, lakukan update
                    $this->userModel->update($check_query['id'], [
                        'fullname' => $g_name,
                        'email'    => $g_email
                        // Tambahkan field lain jika perlu
                    ]);
                } else {
                    $this->userModel->save([
                        'fullname' => $g_name,
                        'email' => $g_email,
                        'oauth_id' => $g_id
                    ]);
                }

                $data = [
                    'title' => 'Home | CI4 - Michael'
                ];

                $user_session = [
                    'status' => 'true',
                    'access_token' => $access_token,
                    'name' => $g_name
                ];
                session()->set($user_session);

                return view('index', $data);
            } else {
                echo 'Login Gagal';
            }
        }

        $data = [
            'title' => 'Login | CI4 - Michael',
            'uri_google' => $uri_google
        ];

        return view('login', $data);
    }

    public function userLogout()
    {
        session()->destroy();
        $access_token = session()->get('access_token');
        $revoke_client = new Google_Client();
        $revoke_client->revokeToken($access_token);
        $client_id = '723636028103-hrfvflkrc73tevcnh354kud3svo288mj.apps.googleusercontent.com';
        $client_secret = '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';
        $redirect_uri = 'http://localhost:8080/login';

        $client = new Google_Client();
        $client->setClientId($client_id);
        $client->setClientSecret($client_secret);
        $client->setRedirectUri($redirect_uri);
        $client->addScope('email');
        $client->addScope('profile');
        $uri_google = $client->createAuthUrl();
        $data = [
            'title' => 'Login | CI4 - Michael',
            'uri_google' => $uri_google
        ];
        return view('login', $data);
    }
}
