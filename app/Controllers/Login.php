<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LoginModel;

class Login extends BaseController
{
    public $loginModel;
    public $session;
    public function __construct()
    {
        helper('form');
        $this->loginModel = new LoginModel();
        $this->session = session();
    }

    public function index()
    {
        $data['pageinfo'] = (object)[
            "pageTitle" => "Codeigniter 4 Practice",
            "pageHeading" => "Users Login Page",
        ];

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|valid_email',
                'password' => 'required|min_length[6]|max_length[20]',
            ];
            if ($this->validate($rules)) {
                $email = $this->request->getVar('email');
                $password = $this->request->getVar('password');

                $userdata = $this->loginModel->verifyEmail($email);
                if ($userdata) {
                    if (password_verify($password, $userdata['password'])) {
                        if ($userdata['status'] == 'active') {
                            $loginInfo = [
                                'uniid' => $userdata['uniid'],
                                'agent' => $this->getUserAgentInfo(),
                                'ip' => $this->request->getIPAddress(),
                                'login_time' => date('Y-m-d h:i:s'),
                            ];
                            $last_id = $this->loginModel->saveLoginInfo($loginInfo);
                            if ($last_id) {
                                $this->session->set('logged_info', $last_id);
                            }

                            $this->session->set('logged_user', $userdata['uniid']);
                            return redirect()->to(base_url() . 'dashboard');
                        } else {
                            $this->session->setTempdata('error', 'Please Activate your account. Contact Admin', 3);
                            return redirect()->to(current_url());
                        }
                    } else {
                        $this->session->setTempdata('error', 'Sorry! Wrong password entered for the email', 3);
                        return redirect()->to(current_url());
                    }
                } else {
                    $this->session->setTempdata('error', 'Sorry! Email does not exist', 3);
                    return redirect()->to(current_url());
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        // Google Authentaction
        // require_once(APPPATH . "libraries/vendor/autoload.php");

        // $google_client = new \Google_Client();
        // $google_client->setClientId('458928824518-36hauh2el1708dbfvadupb7qt6ln5h93.apps.googleusercontent.com');
        // $google_client->setClientSecret('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');
        // $google_client->setRedirectUri(base_url() . 'login');
        // $google_client->addScope('email');
        // $google_client->addScope('profile');

        // if ($this->request->getVar('code')) {
        //     $token = $google_client->fetchAccessTokenWithAuthCode($this->request->getVar('code'));
        //     if (!isset($token['error'])) {
        //         $google_client->setAccessToken($token['access_token']);
        //         $this->session->set('access_token', $token['access_token']);
        //         // To Get the profile data
        //         $google_service = new \Google_Service_Oauth2($google_client);
        //         $data = $google_service->userinfo->get();
        //         print_r($data);
        //         // exit;
        //     }
        // }

        // if (!$this->session->get('access_token')) {
        //     $data['loginButton'] = $google_client->createAuthUrl();
        // }

        return view('user_management/login_view', $data);
    }

    public function getUserAgentInfo()
    {
        $agent = $this->request->getUserAgent();
        if ($agent->isBrowser()) {
            $currentAgent = $agent->getBrowser() . ' ' . $agent->getVersion();
        } elseif ($agent->isRobot()) {
            $currentAgent = $agent->getRobot();
        } elseif ($agent->isMobile()) {
            $currentAgent = $agent->getMobile();
        } else {
            $currentAgent = 'Unidentified User Agent';
        }
        return $currentAgent;
    }
}
