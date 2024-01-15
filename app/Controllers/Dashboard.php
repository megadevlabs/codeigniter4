<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DashboardModel;
use PhpParser\Node\Expr\Print_;

class Dashboard extends BaseController
{
    public $dModel;
    public function __construct()
    {
        $this->dModel = new DashboardModel();
    }
    public function index()
    {
        $data['pageinfo'] = (object)[
            "pageTitle" => "Codeigniter 4 Practice",
            "pageHeading" => "Users Dashboard",
        ];

        if (!session()->has('logged_user')) {
            return redirect()->to(base_url() . "/login");
        }
        $uniid = session()->get("logged_user");
        $data['userdata'] = $this->dModel->getLoggedInUserData($uniid);

        return view('user_management/dashboard_view', $data);
    }

    public function logout()
    {
        if (session()->has('logged_info')) {
            $last_id = session()->get('logged_info');
            $this->dModel->updateLogoutTime($last_id);
        }
        session()->remove('logged_user');
        session()->destroy();
        return redirect()->to(base_url() . "/login");
    }

    public function login_activity()
    {
        $data['pageinfo'] = (object)[
            "pageTitle" => "Codeigniter 4 Practice",
            "pageHeading" => "Login Activity",
        ];

        $uniid = session()->get("logged_user");
        $data['userdata'] = $this->dModel->getLoggedInUserData($uniid);

        $data['login_info'] = $this->dModel->getLoginUserInfo($uniid);

        return view('user_management/login_activity', $data);
    }
}
