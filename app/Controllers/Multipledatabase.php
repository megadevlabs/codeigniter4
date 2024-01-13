<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Multipledatabase extends BaseController
{
    public function index()
    {
        //Multiple Database Connection
        $db1 = \Config\Database::connect();
        $db2 = \Config\Database::connect('secondDb');
        
        echo "<pre>";
        print_r($db1);exit;
        echo "</pre>";

        // DB 1
        $query1 = $db1->query();
        $result1 = $query1->getResult();
        // DB 2
        $query2 = $db2->query();
        $result2 = $query2->getResult();
    }
}
