<?php

namespace App\Controllers;

use App\Models\DashboardModel;

class Home extends BaseController
{
    public $dModel;
    public function __construct()
    {
        $this->dModel = new DashboardModel();
    }

    public function index(): string
    {
        $data['pageinfo'] = (object)[
            "pageTitle" => "Codeigniter 4 Practice",
            "pageHeading" => "Home Page",
        ];
        $uniid = session()->get("logged_user");
        $data['userdata'] = $this->dModel->getLoggedInUserData($uniid);

        return view('main', $data);
    }
}
