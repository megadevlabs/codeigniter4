<?php

namespace App\Models;

use \CodeIgniter\Model;

class RegistrationModel extends Model
{
  public function saveData($data)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('users');

    $res = $builder->insert($data);

    if ($db->affectedRows($res)) {
      return true;
    } else {
      return false;
    }
  }
}
