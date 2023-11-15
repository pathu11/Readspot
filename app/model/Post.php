<<<<<<< HEAD
<?php
class Post {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    // public function getPosts($user_id){
    //     $this->db->query("SELECT * FROM publishers WHERE user_id = :user_id");
    //     $this->db->bind(':user_id', $user_id);

    //     return $this->db->resultSet();
    // }
    public function getPosts($user_id){
        $this->db->query('SELECT *,publishers.publisher_id as publisher_id,users.user_id as user_id from publishers INNER JOIN users ON publishers.user_id =users.user_id  WHERE users.user_id=:user_id');

        $this->db->bind(':user_id',$user_id);
       

        return $this->db->resultSet();
    }

}
=======
<?php
class Post {
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    // public function getPosts($user_id){
    //     $this->db->query("SELECT * FROM publishers WHERE user_id = :user_id");
    //     $this->db->bind(':user_id', $user_id);

    //     return $this->db->resultSet();
    // }
    public function getPosts($user_id){
        $this->db->query('SELECT *,publishers.publisher_id as publisher_id,users.user_id as user_id from publishers INNER JOIN users ON publishers.user_id =users.user_id  WHERE users.user_id=:user_id');

        $this->db->bind(':user_id',$user_id);
       

        return $this->db->resultSet();
    }

}
>>>>>>> 46ef4d2bb18a2134244a28ff29e0efe622c4dc2b
