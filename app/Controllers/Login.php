<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\LoginModel;

class Login extends BaseController
{
    public $loginModel;
    public $session;
    public $email;
    public function __construct()
    {
        helper('form');
        $this->loginModel = new LoginModel();
        $this->session = session();
        $this->email = \Config\Services::email();
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

                // $throttler = \Config\Services::throttler();
                // $allow = $throttler->check('login', 4, MINUTE);

                // IP Address Check Hit Mins
                // $allowIP = $throttler->check($this->request->getIPAddress(),4,MINUTE);
                // if ($allowIP === false) {
                //     $this->session->setTempdata('error', 'Too Many Hit to server!');
                //     return redirect()->to(current_url());
                // }

                // if ($allow) {
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
                // } else {
                //     $this->session->setTempdata('error', 'Max no. of login attempts. Try again after a minute', 3);
                // }
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

    public function forgot_password()
    {
        $data['pageinfo'] = (object)[
            "pageTitle" => "Codeigniter 4 Practice",
            "pageHeading" => "Forgot Password",
        ];

        $data['validation'] = null;

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => 'required|valid_email',
            ];
            if ($this->validate($rules)) {
                $email = $this->request->getVar('email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $userdata = $this->loginModel->verifyEmail($email);
                if (!empty($userdata)) {
                    if ($this->loginModel->updatedAt($userdata['uniid'])) {
                        $to = $email;
                        $subject = "Reset Password Link";
                        $token = $userdata['uniid'];
                        $message = 'Hi ' . $userdata['username'] . ",<br/><br/> Your reset password request has been received. Please click the below reset link to reset your password. <br/><br/><a href='" . base_url() . "/login/reset_password/" . $token . "' target='_blank'>Click here to reset password</a><br/><br/>Thanks<br/>Team";

                        $this->email->setTo($to);
                        $this->email->setFrom('info@megadevlabs.com', 'Info');
                        $this->email->setSubject($subject);
                        $this->email->setMessage($message);

                        if ($this->email->send()) {
                            $this->session->setTempdata('success', 'Reset password link sent to your registered email. Please verify within 15 mins', 3);
                            return redirect()->to(current_url());
                        } else {
                            $data = $this->email->printDebugger(['headers']);
                            print_r($data);
                        }
                    } else {
                        $this->session->setTempdata('error', 'Sorry! Unable to update, Tray again.', 3);
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
        return view('forgot_password', $data);
    }

    public function reset_password($token = null)
    {
        $data['pageinfo'] = (object)[
            "pageTitle" => "Codeigniter 4 Practice",
            "pageHeading" => "Reset Password",
        ];

        if (!empty($token)) {
            $userdata = $this->loginModel->verifyToken($token);
            // print_r($userdata);
            // exit;
            if (!empty($userdata)) {
                if ($this->checkExpiryDate($userdata->updated_at)) {
                    if ($this->request->getMethod() == 'post') {
                        $rules = [
                            "password" => 'required|min_length[4]|max_length[20]',
                            "cpassword" => 'required|matches[password]'
                        ];
                        if ($this->validate($rules)) {
                            $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);

                            if ($this->loginModel->updatePassword($password, $token)) {
                                $this->session->setTempdata('success', 'Password reset successfully!', 3);
                                return redirect()->to(base_url() . 'login');
                            } else {
                                $this->session->setTempdata('error', 'Sorry, Unable to reset your password! Try again.', 3);
                                return redirect()->to(current_url());
                            }
                        } else {
                            $data['validation'] = $this->validator;
                        }
                    }
                } else {
                    $this->session->setTempdata('error', 'Reset Password Link has been expired!', 3);
                    //return redirect()->to(current_url());
                }
            } else {
                $this->session->setTempdata('error', 'Unable to find user account', 3);
                //return redirect()->to(current_url());
            }
        } else {
            $this->session->setTempdata('error', 'Sorry! Unauthorized access', 3);
            //return redirect()->to(current_url());
        }

        return view('reset_password', $data);
    }

    public function checkExpiryDate($updatedTime)
    {
        //$date = new DateTime('now', new DateTimeZone('Asia/Dhaka'));
        $updated_time = strtotime($updatedTime);
        $current_time = date('Y-m-d h:i:s');

        $diffTime = (int)strtotime($current_time) - (int)$updated_time;
        // Debugging below code
        // echo $current_time . ' - ' . strtotime($updated_time) . '-';
        // echo $updated_time . ' = ';
        // echo $diffTime;
        // exit;
        if ($diffTime < 900) { // 900 second = 15 mins
            return true;
        } else {
            return false;
        }
    }
}
