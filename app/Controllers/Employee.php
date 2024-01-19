<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\DashboardModel;
use App\Models\EmployeeModel;

class Employee extends Controller
{
    private $dModel;
    private $empModel;
    public function __construct()
    {
        helper('form');
        $this->dModel = new DashboardModel();
        $this->empModel = new EmployeeModel();
    }

    public function addEmp()
    {
        $data['pageinfo'] = (object)[
            "pageTitle" => "Codeigniter 4 Practice",
            "pageHeading" => "Add New Employee",
        ];
        $uniid = session()->get("logged_user");
        $data['userdata'] = $this->dModel->getLoggedInUserData($uniid);
        if ($this->request->getMethod() == 'post') {
            $empData = [
                'name' => $this->request->getVar('name', FILTER_SANITIZE_STRING),
                'email' => $this->request->getVar('email', FILTER_SANITIZE_STRING),
                'mobile' => $this->request->getVar('mobile'),
                'salary' => $this->request->getVar('salary', FILTER_SANITIZE_STRING),
                'designation' => $this->request->getVar('designation', FILTER_SANITIZE_STRING),
                'city' => $this->request->getVar('city', FILTER_SANITIZE_STRING),
            ];
            if ($this->empModel->save($empData) == true) {
                session()->setTempdata('success', 'Employee addedd successfully', 3);
                return redirect()->to(current_url());
            }
        }
        $data['errors'] = $this->empModel->errors();
        return view('employees/empadd_view', $data);
    }

    public function viewEmp()
    {
        $data['pageinfo'] = (object)[
            "pageTitle" => "Codeigniter 4 Practice",
            "pageHeading" => "View All Employee",
        ];
        $uniid = session()->get("logged_user");
        $data['userdata'] = $this->dModel->getLoggedInUserData($uniid);

        $data['employees'] = $this->empModel->findAll();
        return view('employees/employee_view', $data);
    }

    public function editEmp($id = null)
    {
        $data['pageinfo'] = (object)[
            "pageTitle" => "Codeigniter 4 Practice",
            "pageHeading" => "Edit Employee",
        ];
        $uniid = session()->get("logged_user");
        $data['userdata'] = $this->dModel->getLoggedInUserData($uniid);
        if ($this->request->getMethod() == 'post') {
            $empData = [
                'name' => $this->request->getVar('name', FILTER_SANITIZE_STRING),
                'mobile' => $this->request->getVar('mobile'),
                'salary' => $this->request->getVar('salary', FILTER_SANITIZE_STRING),
                'designation' => $this->request->getVar('designation', FILTER_SANITIZE_STRING),
                'city' => $this->request->getVar('city', FILTER_SANITIZE_STRING),
            ];
            if ($this->empModel->update($id, $empData) == true) {
                session()->setTempdata('success', 'Employee updated successfully', 3);
                return redirect()->to(current_url());
            }
        }

        //Method-1
        // $data['emp'] = $this->empModel->find($id);
        // $data['errors'] = $this->empModel->errors();
        // return view('employees/empedit_view', ['emp' => $this->empModel->find($id), 'errors' => $this->empModel->errors()]);

        //Method-2
        $data['emp'] = $this->empModel->find($id);
        $data['errors'] = $this->empModel->errors();
        return view('employees/empedit_view', $data);
    }

    public function deleteEmp($id = null)
    {
        if ($this->empModel->where('id', $id)->delete()) {
            session()->setTempdata('success', 'Employee deleted successfully', 3);
            return redirect()->to(base_url() . '/employee/viewemp');
        }
    }
}
