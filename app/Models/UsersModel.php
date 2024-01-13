<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    public function getData(){
        $address  = [
            ['username' => 'salahuddin', 'password' => '123456'],
            ['username' => 'rony', 'password' => '123456'],
            ['username' => 'rahim', 'password' => '123456'],
            ['username' => 'karim', 'password' => '123456'],
            ['username' => 'Jashim', 'password' => '123456'],
        ];
        return $address;
    }

    public function getUsersList(){
        $db = \Config\Database::connect();
        $query = $db->query("select * from users");
        $result = $query->getResult();
        if(count($result) > 0){
            return $result;
        }else{
            return false;
        }
    }
}
