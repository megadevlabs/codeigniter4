<?php
  namespace App\Libraries;
  use App\Models\AutoModel;
use CodeIgniter\HTTP\URI;

  class TestLibrary {
    // Database Use in Library
    public $db;
    public $am;
    public $email;
    public $uri;

    public function __construct()
    {
      $this->db = \Config\Database::connect();
      //$this->am = new AutoModel();
      $this->email = \Config\Services::email();
      $this->uri = new URI(current_url());
      helper('form');
    }

    public function getUsersList(){
        $query = $this->db->query("select * from users");
        $result = $query->getResult();
        if(count($result) > 0){
            return $result;
        }else{
            return false;
        }
    }

    public function getData(){
      return "I am come from Test Libraries! - " . $this->uri->getHost();
    }
  }
?>