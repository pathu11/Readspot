<?php 
class Publishers{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }


    public function findPublisherById($user_id){
        $this->db->query('SELECT * from publishers WHERE user_id=:user_id');
        $this->db->bind(':user_id',$user_id);
       

        return $this->db->resultSet();
    }
    public function findBookById($book_id){
        $this->db->query('SELECT * from books WHERE book_id=:book_id');
        $this->db->bind(':book_id',$book_id);
       

        return $this->db->resultSet();
    }
    public function findBookByPubId($publisher_id){
        $this->db->query('SELECT * from books WHERE publisher_id=:publisher_id');
        $this->db->bind(':publisher_id',$publisher_id);
       

        return $this->db->resultSet();
    }

    // public function getBooks($publisher_id){
    //     $this->db->query('SELECT *,books.book_id as book_id,publishers.publisher_id as publisher_id from books INNER JOIN publishers ON books.publisher_id =publishers.publisher_id  WHERE publishers.publisher_id=:publisher_id');

    //     $this->db->bind(':publisher_id',$publisher_id);
       

    //     return $this->db->resultSet();
    // }

    public function addBooks($data){
        $this->db->query('INSERT INTO books (book_name, ISBN_no, author, price, category, weight, descript, quantity, img1, img2, publisher_id) VALUES(:book_name, :ISBN_no, :author, :price, :category, :weight, :descript, :quantity, :img1, :img2, :publisher_id)');
        $this->db->bind(':book_name',$data['book_name']);
        $this->db->bind(':ISBN_no',$data['ISBN_no']);
        $this->db->bind(':author',$data['author']);
        $this->db->bind(':price',$data['price']);
        $this->db->bind(':category',$data['category']);
        $this->db->bind(':weight',$data['weight']);
        $this->db->bind(':descript',$data['descript']);
        $this->db->bind(':quantity',$data['quantity']);
        $this->db->bind(':img1',$data['img1']);
        $this->db->bind(':img2',$data['img2']);
        $this->db->bind(':publisher_id',$data['publisher_id']);
        // execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }        
    }

    public function update($data) {
        $this->db->query('UPDATE books 
                      SET book_name = :book_name, 
                      ISBN_no = :ISBN_no, 
                      author= :author,  
                          price= :price, 
                          category = :category,
                          weight= :weight,
                          descript = :descript,
                          quantity = :quantity,
                          img1 = :img1,
                          img2 = :img2,
                          publisher_id = :publisher_id,
                          

                      WHERE book_id = :book_id');

        // Bind values
        $this->db->bind(':book_id', $data['book_id']);
        $this->db->bind(':book_name ', $data['book_name ']);
        $this->db->bind(':ISBN_no', $data['ISBN_no']);
        $this->db->bind(':author', $data['author']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':weight', $data['weight']);
        $this->db->bind(':descript ', $data['descript ']);
        $this->db->bind(':quantity ', $data['quantity ']);
        $this->db->bind(':img1 ', $data['img1 ']);
        $this->db->bind(':img2  ', $data[' img2  ']);
        $this->db->bind(':publisher_id  ', $data['publisher_id  ']);

       


        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }



}