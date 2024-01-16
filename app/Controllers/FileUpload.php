<?php

namespace App\Controllers;

use \CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DashboardModel;

class FileUpload extends Controller
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
            "pageHeading" => "File Upload",
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
                    $newName = $file->getRandomName();
                    if ($file->move(WRITEPATH . 'uploads/', $newName)) {
                        echo "File uploaded successfully!";
                    } else {
                        echo $file->getErrorString() . " " . $file->getError();
                    }
                }
                // echo "<pre>";
                // print_r($file);
                // echo "</pre>";
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('user_management/upload_view', $data);
    }

    public function multiupload()
    {
        $data['pageinfo'] = (object)[
            "pageTitle" => "Codeigniter 4 Practice",
            "pageHeading" => "Multiple File Upload",
        ];

        $uniid = session()->get("logged_user");
        $data['userdata'] = $this->dModel->getLoggedInUserData($uniid);

        if ($this->request->getMethod() == 'post') {
            $rules = [
                'avatar' => 'uploaded[avatar.0]|max_size[avatar,1024]|is_image[avatar]',
            ];

            if ($this->validate($rules)) {
                $files = $this->request->getFiles();

                foreach ($files['avatar'] as $img) {
                    if ($img->isValid() && !$img->hasMoved()) {
                        $newName = $img->getRandomName();
                        if ($img->move(FCPATH . 'public\uploads', $newName)) {
                            echo "<p>" . $img->getClientName() . "File uploaded successfully!</p>";
                        } else {
                            echo $img->getErrorString() . " " . $img->getError();
                        }
                    }
                }
                // echo "<pre>";
                // print_r($file);
                // echo "</pre>";
            } else {
                $data['validation'] = $this->validator;
            }
        }
        return view('user_management/multiupload_view', $data);
    }
}
