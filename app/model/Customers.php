<?php 
  class Customers{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }


    public function findCustomerById($user_id){
        $this->db->query('SELECT * from customers WHERE user_id=:user_id');
        $this->db->bind(':user_id',$user_id);
       

        return $this->db->resultSet();
    }

  //   public function addComment($data) {
  //     $this->db->query('INSERT INTO discussion (parent_comment, student, post) VALUES (:parent_comment, :student, :post)');

  //     $this->db->bind(':parent_comment', $data['id']);
  //     $this->db->bind(':student', $data['name']);
  //     $this->db->bind(':post', $data['msg']);

  //     return $this->db->execute();
  // }

  // public function getComment() {
  //     $this->db->query('SELECT * FROM discussion ORDER BY id DESC');
  //     return $this->db->resultSet();
  // }
  public function addComment($data) {
    // Assuming $this->db is an instance of your database class
    $this->db->query('INSERT INTO comments (name, comment, parent_comment) VALUES (:name, :comment, :parent_comment)');
    $this->db->bind(':name', $data['name']);
    $this->db->bind(':comment', $data['comment']);
    $this->db->bind(':parent_comment', $data['parentComment']);
    return $this->db->execute();
}

public function getComments() {
    $this->db->query('SELECT * FROM comments ORDER BY timestamp DESC');
    return $this->db->resultSet();
}




  }