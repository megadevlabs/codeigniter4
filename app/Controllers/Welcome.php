<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class Welcome extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function myInfo($name, $mobile)
    {
        echo "Your Name is " . $name . " and Mobile Number is " . $mobile;
    }

    public function _remap($method, $param1 = null, $param2 = null)
    {
        if (method_exists($this, $method)) {
            return $this->$method($param1, $param2);
        }
        throw PageNotFoundException::forPageNotFound();
    }
}
