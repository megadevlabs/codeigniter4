<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TestMail extends BaseController
{
    public function index()
    {
        $to = "cisrony@gmail.com";
        $subject = "Account Activation Verification.";
        $message = 'Thanks for signing up! <br/><br/>
            Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.<br/><br/><a href="' . base_url() . '/testmail/verify" target="_blank">Account Activation</a><br/><br/>Thanks<br/>Team';

        $email = \Config\Services::email();

        $email->setTo($to);
        $email->setFrom('info@megadevlabs.com', 'Info');
        $email->setSubject($subject);
        $email->setMessage($message);
        $filepath = 'public/favicon.ico';
        $email->attach($filepath);
        if ($email->send()) {
            echo "Account Created Successfully. Please active your account.";
        } else {
            $data = $email->printDebugger(['header']);
            print_r($data);
        }
    }
}
