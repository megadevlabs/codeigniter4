<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsersModel;
use App\Libraries\TestLibrary;

class Users extends BaseController
{
    public $tl;
    public function __construct()
    {
        $this->tl = new TestLibrary();
        helper('form');
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
        // $rules = [
        //     "username" => 'required|min_length[4]',
        //     "email" => 'required|valid_email',
        //     "mobile" => 'required|numeric|exact_length[11]',
        //     "password" => 'required'
        // ];

        $rules = [
            "username" => [
                'rules' => 'required|min_length[4]',
                'errors' => [
                    'required' => 'Username is Required!',
                    'min_length' => 'Username Minimum length 4',
                ]
            ],
            "email" => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Email is Required!',
                    'valid_email' => 'Must be enter valid email!'
                ]
            ],
            "mobile" => [
                'rules' => 'required|numeric|exact_length[11]',
                'errors' => [
                    'required' => 'Mobile Number is Required!',
                    'numeric' => 'Mobile {value} Number should be numeric only!',
                    'exact_length' => 'Mobile Number {value} is must be exact {param} digits!',
                ]
            ],
            "password" => 'required'
        ];

        if ($this->request->getMethod() == 'post') {
            if ($this->validate($rules)) {
                // Ready to save data
                echo "Ready to save data.";
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('registration', $data);
    }
}
