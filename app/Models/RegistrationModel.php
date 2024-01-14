<?php

namespace App\Models;

use \CodeIgniter\Model;

class RegistrationModel extends Model
{
  public function creteUser($data)
  {
    //$db = \Config\Database::connect();
    $builder = $this->db->table('users');

    $res = $builder->insert($data);

    if ($this->db->affectedRows($res)) {
      return true;
    } else {
      return false;
    }
  }

  public function verifyUniid($uniid)
  {
    $builder = $this->db->table('users');
    $builder->select('activation_date,uniid,status');
    $builder->where('uniid', $uniid);
    $result = $builder->get();

    if ($builder->countAll() == 1) {
      return $result->getRow();
    } else {
      return false;
    }
  }

  public function updateStatus($uniid)
  {
    $builder = $this->db->table('users');
    $builder->where('uniid', $uniid);
    $builder->update(['status' => 'active']);
    if ($this->db->affectedRows() == 1) {
      return true;
    } else {
      return false;
    }
  }
}
