<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\View\Table;

class Blog extends BaseController
{
    public function index()
    {
        $table = new Table();
        // Method 1
        $address  = [
            ['Name', 'City', 'State'],
            ['Dhaka', 'Dhaka', 'Tejgoan'],
            ['Dhaka', 'Dhaka', 'Tejgoan'],
            ['Dhaka', 'Dhaka', 'Tejgoan'],
            ['Dhaka', 'Dhaka', 'Tejgoan'],
        ];
        // Method 2
        // $table->setHeading(['Name', 'City', 'State']);
        // $table->addRow(['Dhaka', 'Dhaka', 'Tejgoan']);
        // $table->addRow(['Dhaka', 'Dhaka', 'Tejgoan']);
        // $table->addRow(['Dhaka', 'Dhaka', 'Tejgoan']);

        // $data['address'] = $table->generate();

        $data = [
            "pageTitle" => "Codeigniter 4 Practice",
            "pageHeading" => "Blog Page | Codeigniter 4 website Heading",
            "languges" => ["HTML","CSS","JavaScript","PHP","ReactJS","NodeJS","MongoDB","ExpressJS"]
        ];
        $data['address'] = $table->generate($address);

        echo view('layouts/header', $data);
        echo view('blog');
        echo view('layouts/footer');
    }

    public function blogDetails(){
        $data = [
            "pageTitle" => "Blog Details -> Codeigniter 4 Practice",
            "pageHeading" => "Blog Details | Codeigniter 4 website Heading",
            "languges" => ["HTML","CSS","JavaScript","PHP","ReactJS","NodeJS","MongoDB","ExpressJS"]
        ];
        echo view('blogdetails', $data);
    }
}