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

    public function addBookCategory($data){
      $this->db->query('INSERT INTO book_category (category, description) VALUES (:book_category, :description)');

      $this->db->bind(':book_category',$data['book_category']);
      $this->db->bind(':description',$data['description']);

      if($this->db->execute()){
        return true;
      }else{
        return false;
      }
    }

    public function findBookCategoryById($id){
      $this->db->query('SELECT * FROM book_category WHERE id=:id');
      $this->db->bind(':id',$id);

      //return $this->db->resultSet();
      $row = $this->db->single();
      return $row;
    }

    public function updateBookCategory($data){
      $this->db->query('UPDATE book_category SET category = :book_category, description = :description WHERE id = :id');

      $this->db->bind(':book_category',$data['book_category']);
      $this->db->bind(':description',$data['description']);
      $this->db->bind(':id',$data['id']);

      if($this->db->execute()){
        return true;
      }else{
        return false;
      }
    }

    public function deleteBookCategory($id){
      $this->db->query('DELETE FROM book_category WHERE id = :id');

      $this->db->bind(':id',$id);

      if($this->db->execute()){
        return true;
      }else{
        return false;
      }
    }
  
  }
