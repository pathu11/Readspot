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
    public function findcustomerBycusId($customer_id){
        $this->db->query('SELECT * from customers WHERE customer_id=:customer_id');
        $this->db->bind(':customer_id',$customer_id);
       
        $row = $this->db->single();
        return $row;
    }
    public function findPublisherBypubId($publisher_id){
        $this->db->query('SELECT * from publishers WHERE publisher_id=:publisher_id ');
        $this->db->bind(':publisher_id',$publisher_id);
        $row = $this->db->single();
        return $row;
    }
    
    public function findBookById($book_id){
        $this->db->query('SELECT * FROM books WHERE book_id = :book_id AND type="new"');
        $this->db->bind(':book_id', $book_id);
        $row = $this->db->single();
        return $row;
    }

    public function findBookByPubId($publisher_id){
        $this->db->query('SELECT * from books WHERE publisher_id=:publisher_id AND type="new"');
        $this->db->bind(':publisher_id',$publisher_id);
       

        return $this->db->resultSet();
    }

    public function editpostal($data) {
        $this->db->query('UPDATE publishers 
                  SET postal_name = :postal_name, 
                  street_name = :street_name, 
                  town = :town,  
                  district = :district, 
                  postal_code = :postal_code
                  WHERE publisher_id = :publisher_id');

        // Bind values
        $this->db->bind(':publisher_id', $data['publisher_id']);
        $this->db->bind(':postal_name', $data['postal_name']);
        $this->db->bind(':street_name', $data['street_name']);
        
        $this->db->bind(':town', $data['town']);
        $this->db->bind(':district', $data['district']);
        $this->db->bind(':postal_code', $data['postal_code']);
       
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function editProfile($data) {
        $this->db->query('UPDATE publishers 
                          SET name = :name, 
                              contact_no = :contact_no, 
                              profile_img = :profile_img
                          WHERE publisher_id = :publisher_id');
    
        // Bind values
        $this->db->bind(':publisher_id', $data['publisher_id']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':contact_no', $data['contact_no']);
        $this->db->bind(':profile_img', $data['profile_img']);
       
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function editAccount($data) {
        $this->db->query('UPDATE publishers 
                  SET account_name = :account_name, 
                  account_no = :account_no, 
                  bank_name = :bank_name,  
                  branch_name = :branch_name 
                 
                  WHERE publisher_id = :publisher_id');

        // Bind values
        $this->db->bind(':publisher_id', $data['publisher_id']);
        $this->db->bind(':account_name', $data['account_name']);
        $this->db->bind(':account_no', $data['account_no']);
        
        $this->db->bind(':bank_name', $data['bank_name']);
        $this->db->bind(':branch_name', $data['branch_name']);
       
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function addBooks($data){
        $this->db->query('INSERT INTO books (book_name, ISBN_no, author, price, category, weight, descript, quantity, img1, img2, publisher_id,status) VALUES(:book_name, :ISBN_no, :author, :price, :category, :weight, :descript, :quantity, :img1, :img2, :publisher_id,:status)');
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
        $this->db->bind(':status','approval');
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
                  author = :author,  
                  price = :price, 
                  category = :category,
                  weight = :weight,
                  descript = :descript,
                  quantity = :quantity,
                  img1 = :img1,
                  img2 = :img2
                  WHERE book_id = :book_id');

        // Bind values
        $this->db->bind(':book_id', $data['book_id']);
        $this->db->bind(':book_name', $data['book_name']);
        $this->db->bind(':ISBN_no', $data['ISBN_no']);
        $this->db->bind(':author', $data['author']);
        $this->db->bind(':price', $data['price']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':weight', $data['weight']);
        $this->db->bind(':descript', $data['descript']);
        $this->db->bind(':quantity', $data['quantity']);
        $this->db->bind(':img1', $data['img1']);
        $this->db->bind(':img2', $data['img2']);
        // $this->db->bind(':publisher_id', $data['publisher_id']);
    
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function deletebooks($book_id) {
        $this->db->query('DELETE FROM books WHERE book_id = :book_id');
        // Bind values
        $this->db->bind(':book_id', $book_id);

        // Execute after binding
        $this->db->execute();

        // Check for row count affected
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }   
    public function findbookByName($book_name){
        $this->db->query('SELECT * from books WHERE book_name=:book_name AND type="new"  ');
        $this->db->bind(':book_name',$book_name);
        $row=$this->db->single();
        if($this->db->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }
    public function countBooks($publisher_id){    
        $this->db->query('SELECT COUNT(*) as bookCount FROM books WHERE publisher_id = :publisher_id AND type="new"');
        $this->db->bind(':publisher_id', $publisher_id);
        $result = $this->db->single();
        if ($result) {
            return $result->bookCount;
        } else {
            return 0; 
        }
    }

    public function getPublisherEventDetails($user_id){
        $this->db->query('SELECT * FROM events WHERE user_id=:user_id');
        $this->db->bind(':user_id',$user_id);

        return $this->db->resultSet();
    }

    public function addEvent($data){
        $this->db->query('INSERT INTO events (user_id,user_type,title, description, location,start_date , end_date, category_name) VALUES(:user_id,:user_type,:title, :description, :location, :start_date , :end_date, :category)');
        $this->db->bind(':user_type',$data['user_type']);
        $this->db->bind(':user_id',$data['user_id']);
        $this->db->bind(':title',$data['title']);
        $this->db->bind(':description',$data['description']);
        $this->db->bind(':location',$data['location']);
        $this->db->bind(':start_date',$data['start_date']);
        $this->db->bind(':end_date',$data['end_date']);
        $this->db->bind(':category',$data['category']);
        // execute
        if($this->db->execute()){
            return true;
        }else{
            return false;
        } 
    }
}