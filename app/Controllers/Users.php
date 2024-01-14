<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsersModel;
use App\Models\RegistrationModel;
use App\Libraries\TestLibrary;

class Users extends BaseController
{
    public $registrationModel;
    public $tl;
    public $session;
    public $email;
    public function __construct()
    {
        $this->tl = new TestLibrary();
        helper('form');
        helper('date');
        $this->registrationModel = new RegistrationModel();
        $this->session = \Config\Services::session();
        $this->email = \Config\Services::email();
    }

    public function index()
    {
        $data = [
            "pageTitle" => "Codeigniter 4 Practice - " . $this->tl->getData(),
            "pageHeading" => "Users Page | Codeigniter 4 website Heading",
        ];

        $userModel = new UsersModel();
        $data['users'] = $userModel->getData();
        //print_r($data);
        return view('users', $data);
    }

    public function usersList()
    {
        $data = [
            "pageTitle" => "Codeigniter 4 Practice",
            "pageHeading" => "Users Page | Codeigniter 4 website Heading",
        ];

        $userModel = new UsersModel();
        //$data['users'] = $userModel->getUsersList(); // Data Get From Model
        $data['users'] = $this->tl->getUsersList(); // Data Get fromCustom Library
        $data['hosst'] = $this->tl->getData(); // Data Get fromCustom Library
        return view("users", $data);
    }

    public function registration()
    {
        $data = [
            "pageTitle" => "Codeigniter 4 Practice",
            "pageHeading" => "Users Registration Page",
        ];
        $data['validation'] = null;
        // $rules = [
        //     "username" => 'required|min_length[4]',
        //     "email" => 'required|valid_email',
        //     "mobile" => 'required|numeric|exact_length[11]',
        //     "password" => 'required'
        // ];

        $rules = [
            "username" => [
                'rules' => 'required|min_length[4]|max_length[20]',
                'errors' => [
                    'required' => 'Username is Required!',
                    'min_length' => 'Username Minimum length 4',
                    'max_length' => 'Username Maximum length 20',
                ]
            ],
            "email" => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'Email is Required!',
                    'valid_email' => 'Must be enter valid email!',
                    'is_unique' => 'Must be enter unique email!',
                ]
            ],
            "password" => [
                'rules' => 'required|min_length[4]|max_length[20]',
                'errors' => [
                    'required' => 'Password is Required!',
                    'min_length' => 'Username Minimum length 4',
                    'max_length' => 'Username Maximum length 20',
                ]
            ],
            "cpassword" => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Confirm Password is Required!',
                    'matches' => 'Confirm Password didn\'t match with Password!',
                ]
            ],
            "mobile" => [
                'rules' => 'required|numeric|exact_length[11]',
                'errors' => [
                    'required' => 'Mobile Number is Required!',
                    'numeric' => 'Mobile {value} Number should be numeric only!',
                    'exact_length' => 'Mobile Number {value} is must be exact {param} digits!',
                ]
            ]
        ];

        if ($this->request->getMethod() == 'post') {
            if ($this->validate($rules)) {
                // Ready to save data
                $uniid = md5(str_shuffle('abcdefghijklmnopqrstuvwxyz' . time()));
                $cdata = [
                    'username' => $this->request->getVar('username', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                    'email' => $this->request->getVar('email', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                    'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                    'mobile' => $this->request->getVar('mobile', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                    'uniid' => $uniid,
                    'activation_date' => date('Y-m-d h:i:s')
                ];

                $status = $this->registrationModel->creteUser($cdata);

                if ($status) {
                    $to = $this->request->getVar('email');
                    $subject = "Account Activation Link.";
                    $message = 'Hi ' . $this->request->getVar('username', FILTER_SANITIZE_FULL_SPECIAL_CHARS) . ",<br/><br/> Your account has been created successfully, Please click the below link to activate your account <br/><br/><a href='" . base_url() . "/register/activate/" . $uniid . "' target='_blank'>Active Now</a><br/><br/>Thanks<br/>Team";

                    $this->email->setTo($to);
                    $this->email->setFrom('info@megadevlabs.com', 'Info');
                    $this->email->setSubject($subject);
                    $this->email->setMessage($message);
                    $filepath = 'public/favicon.ico';
                    $this->email->attach($filepath);
                    if ($this->email->send()) {
                        $this->session->setTempdata('success', 'Account Created Successfully. Please activate your account within 1 hour.', 3);
                        return redirect()->to(current_url());
                    } else {
                        $this->session->setTempdata('error', 'Account Created Successfully. Sorry! unable to send activation link. Contact with Admin.', 3);
                        return redirect()->to(current_url());

                        //$data = $this->email->printDebugger(['header']);
                        //print_r($data);
                        //exit;
                    }
                } else {
                    $this->session->setTempdata('error', 'Account Created Successfully. Sorry! unable to send activation link. Contact with Admin.', 3);
                    return redirect()->to(current_url());
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('user_management/registration', $data);
    }

    public function activate($uniid = null)
    {
        $data = [
            "pageTitle" => "Codeigniter 4 Practice",
            "pageHeading" => "Users Registration Page",
        ];

        if (!empty($uniid)) {
            $userData = $this->registrationModel->verifyUniid($uniid);
            if ($userData) {
                if ($this->verifyExpiryTime($userData->activation_date)) {
                    if ($userData->status == 'Inactive') {
                        $status = $this->registrationModel->updateStatus($uniid);
                        if ($status == true) {
                            $data['success'] = 'Your account activated successfully.';
                        }
                    } else {
                        $data['success'] = 'Your account is already activated.';
                    }
                } else {
                    $data['error'] = 'Sorry! Activation Link has been expired.';
                }
            } else {
                $data['error'] = 'Sorry! Unable to find your account.';
            }
        } else {
            $data['error'] = 'Sorry! Unable to process your request.';
        }

        return view('user_management/activate_view', $data);
    }

    public function verifyExpiryTime($regTime)
    {
        $currentTime = now();
        $regtime = strtotime($regTime);
        $diffTime = (int)$currentTime - (int)$regtime;
        if (3600 > $diffTime) { // 3600 second = 1 hours
            return true;
        } else {
            return false;
        }
    }

    public function login()
    {
        $data = [
            "pageTitle" => "Codeigniter 4 Practice",
            "pageHeading" => "Users Login Page",
        ];

        return view('user_management/login', $data);
    }
}
