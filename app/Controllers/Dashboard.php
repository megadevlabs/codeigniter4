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
        helper('form');
        $this->dModel = new DashboardModel();
    }
    public function index()
    {
        $data['pageinfo'] = (object)[
            "pageTitle" => "Codeigniter 4 Practice",
            "pageHeading" => "Users Dashboard",
        ];

        // if (!session()->has('logged_user')) {
        //     return redirect()->to(base_url() . "/login");
        // }
        $uniid = session()->get("logged_user");
        $data['userdata'] = $this->dModel->getLoggedInUserData($uniid);

        return view('user_management/dashboard_view', $data);
    }

    public function avatar()
    {
        $data['pageinfo'] = (object)[
            "pageTitle" => "Codeigniter 4 Practice",
            "pageHeading" => "My Avatar Upload",
        ];

        $uniid = session()->get("logged_user");
        $data['userdata'] = $this->dModel->getLoggedInUserData($uniid);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'avatar' => 'uploaded[avatar]|max_size[avatar,1024]|ext_in[avatar,png,jpg,gif]',
            ];

            if ($this->validate($rules)) {
                $file = $this->request->getFile('avatar');
                if ($file->isValid() && !$file->hasMoved()) {
                    //$newName = $file->getName();
                    $newName = $uniid . '.' . $file->getExtension(); // Custom Image Name Created
                    if ($file->move(FCPATH . 'public\profile', $newName, true)) {
                        $path = base_url() . 'public/profile/' . $file->getName();
                        $status = $this->dModel->updateAvatar($path, session()->get('logged_user'));
                        if ($status == true) {
                            session()->setTempdata('success', 'Profile avatar is uploaded successfully.', 3);
                            return redirect()->to(current_url());
                        } else {
                            session()->setTempdata('error', "Sorry! Unable to upload avatar!", 3);
                            return redirect()->to(current_url());
                        }
                    } else {
                        session()->setTempdata('error', $file->getErrorString(), 3);
                        return redirect()->to(current_url());
                    }
                }
                // echo "<pre>";
                // print_r($file);
                // echo "</pre>";
            } else {
                session()->setTempdata('error', 'You have Tryed to upload invalid file!', 3);
                return redirect()->to(current_url());
            }
        } else {
            $data['validation'] = $this->validator;
        }
        return view('user_management/avatar_view', $data);
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

    public function change_password()
    {
        $data['pageinfo'] = (object)[
            "pageTitle" => "Codeigniter 4 Practice",
            "pageHeading" => "Change Password",
        ];

        $uniid = session()->get("logged_user");
        $data['userdata'] = $this->dModel->getLoggedInUserData($uniid);
        if ($this->request->getMethod() == 'post') {
            $rules = [
                "oldpassword" => 'required',
                "newpassword" => 'required|min_length[4]|max_length[20]',
                "cnewpassword" => 'required|matches[newpassword]'
            ];
            if ($this->validate($rules)) {
                $opwd = $this->request->getVar('oldpassword');
                $npwd = password_hash($this->request->getVar('newpassword'), PASSWORD_DEFAULT);

                if (password_verify($opwd, $data['userdata']->password)) {
                    if ($this->dModel->updatePassword($npwd, $uniid)) {
                        session()->setTempdata('success', "Password updated successfully.", 3);
                        return redirect()->to(current_url());
                    } else {
                        session()->setTempdata('error', "Sorry! Unable to chnge password try again", 3);
                        return redirect()->to(current_url());
                    }
                } else {
                    session()->setTempdata('error', "Sorry! Old password does not match with db password.", 3);
                    return redirect()->to(current_url());
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('user_management/change_password', $data);
    }

    public function edit_profile()
    {
        $data['validation'] = null;
        $data['pageinfo'] = (object)[
            "pageTitle" => "Codeigniter 4 Practice",
            "pageHeading" => "Edit Profile",
        ];

        $uniid = session()->get("logged_user");
        $data['userdata'] = $this->dModel->getLoggedInUserData($uniid);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                "username" => 'required|min_length[4]|max_length[20]',
                "mobile" => 'required|numeric|exact_length[10]'
            ];
            if ($this->validate($rules)) {
                $userdata = [
                    'username' => $this->request->getVar('username', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                    'mobile' => $this->request->getVar('mobile', FILTER_SANITIZE_FULL_SPECIAL_CHARS),
                ];

                if ($this->dModel->updateUserInfo($userdata, $uniid)) {
                    session()->setTempdata('success', "Profile updated successfully.", 3);
                    return redirect()->to(current_url());
                } else {
                    session()->setTempdata('error', "Sorry! Unable to updated user profile info try again", 3);
                    return redirect()->to(current_url());
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('user_management/edit_profile', $data);
    }
}
