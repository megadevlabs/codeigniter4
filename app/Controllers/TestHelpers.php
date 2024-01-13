<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TestHelpers extends BaseController
{
    public function index()
    {
        // helper('form');
        // helper('html');
        // helper('cookie');

        helper(['form', 'html', 'cookie', 'array', 'string']);

        echo form_open();
        echo form_input();

        echo '<hr/>';

        echo getRandom([50, 25, 10, 90, 100]);
        echo '<hr/>';
        echo strRandom();
    }
}
