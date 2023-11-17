<?php 
  class Admins{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }


    public function findAdminById($user_id){
        $this->db->query('SELECT * from admin WHERE user_id=:user_id');
        $this->db->bind(':user_id',$user_id);
       

        return $this->db->resultSet();
    }

    public function getBookCategories(){
      $this->db->query('SELECT * FROM book_category');

      return $this->db->resultSet();
    }

    public function getEventCategories(){
      $this->db->query('SELECT * FROM event_category');

      return $this->db->resultSet();
    }
  }