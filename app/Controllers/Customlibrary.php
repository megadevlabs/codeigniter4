<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\TestLibrary;

class Customlibrary extends BaseController
{
    public $tl;

    public function __construct()
    {
        $this->tl = new TestLibrary();
    }

    public function index()
    {
        return $this->tl->getData();
    }
}
