<?php 
  class Customers{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }
    
    public function findBookById($book_id){
      $this->db->query('SELECT * from books WHERE book_id=:book_id ');
      $this->db->bind(':book_id',$book_id);
      return $this->db->resultSet();
      // $row = $this->db->single();
      // return $row;
    }


    public function findCustomerById($user_id){
        $this->db->query('SELECT * from customers WHERE user_id=:user_id');
        $this->db->bind(':user_id',$user_id);
       

        return $this->db->resultSet();
    }

  
    public function findUsedBookByCusId($customer_id){
      $this->db->query('SELECT * from usedbooks WHERE customer_id=:customer_id');
      $this->db->bind(':customer_id',$customer_id);
     

      return $this->db->resultSet();
    }

    public function getUsedBookById($bookId){
      $this->db->query('SELECT * from usedbooks WHERE bookId=:bookId ');
      $this->db->bind(':bookId',$bookId);
      return $this->db->resultSet();
      // $row = $this->db->single();
      // return $row;
    }

    public function findUsedBookById($bookId) {
      $this->db->query('SELECT * from usedbooks WHERE bookId=:bookId ');
      $this->db->bind(':bookId',$bookId);
      $row = $this->db->single();
      return $row;
    }




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






  public function AddUsedBook($data){
    $this->db->query('INSERT INTO usedbooks (bookName, author, category, bookCondition, publishedYear, price, priceType, weights, isbnNumber, issnNumber, issmNumber, descriptions, imgFront, imgBack, imgInside, accName, accNumber, bankName, branchName, town, district, postalCode, customer_id) VALUES(:bookName, :author, :category, :bookCondition, :publishedYear, :price, :priceType, :weights, :isbnNumber, :issnNumber, :issmNumber, :descriptions, :imgFront, :imgBack, :imgInside, :accName, :accNumber, :bankName, :branchName, :town, :district, :postalCode, :customer_id)');
    
    $this->db->bind(':bookName',$data['bookName']);
    $this->db->bind(':author',$data['author']);
    $this->db->bind(':category',$data['category']);
    $this->db->bind(':bookCondition',$data['bookCondition']);
    $this->db->bind(':publishedYear',$data['publishedYear']);
    $this->db->bind(':price',$data['price']);
    $this->db->bind(':priceType',$data['priceType']);
    $this->db->bind(':weights',$data['weights']);
    $this->db->bind(':isbnNumber',$data['isbnNumber']);
    $this->db->bind(':issnNumber',$data['issnNumber']);
    $this->db->bind(':issmNumber',$data['issmNumber']);
    $this->db->bind(':descriptions',$data['descriptions']);
    $this->db->bind(':imgFront',$data['imgFront']);
    $this->db->bind(':imgBack',$data['imgBack']);
    $this->db->bind(':imgInside',$data['imgInside']);
    $this->db->bind(':accName',$data['accName']);
    $this->db->bind(':accNumber',$data['accNumber']);
    $this->db->bind(':bankName',$data['bankName']);
    $this->db->bind(':branchName',$data['branchName']);
    $this->db->bind(':town',$data['town']);
    $this->db->bind(':district',$data['district']);
    $this->db->bind(':postalCode',$data['postalCode']);
    $this->db->bind(':customer_id',$data['customer_id']);
    // execute
    if($this->db->execute()){
        return true;
    }else{
        return false;
    }        
  }

  public function updateusedbook($data) {
    $this->db->query('UPDATE usedbooks 
              SET bookName = :bookName, 
              author = :author, 
              category = :category,  
              bookCondition = :bookCondition, 
              publishedYear = :publishedYear,
              price = :price,
              priceType = :priceType,
              weights = :weights,
              isbnNumber = :isbnNumber,
              issnNumber = :issnNumber,
              issmNumber = :issmNumber, 
              descriptions = :descriptions,  
              imgFront = :imgFront, 
              imgBack = :imgBack,
              imgInside = :imgInside,
              accName = :accName,
              accNumber = :accNumber,
              bankName = :bankName,
              branchName = :branchName,
              town = :town, 
              district = :district,  
              postalCode = :postalCode, 
              customer_id = :customer_id
              WHERE bookId = :bookId');

    // Bind values
    $this->db->bind(':bookId', $data['bookId']);
    $this->db->bind(':bookName',$data['bookName']);
    $this->db->bind(':author',$data['author']);
    $this->db->bind(':category',$data['category']);
    $this->db->bind(':bookCondition',$data['bookCondition']);
    $this->db->bind(':publishedYear',$data['publishedYear']);
    $this->db->bind(':price',$data['price']);
    $this->db->bind(':priceType',$data['priceType']);
    $this->db->bind(':weights',$data['weights']);
    $this->db->bind(':isbnNumber',$data['isbnNumber']);
    $this->db->bind(':issnNumber',$data['issnNumber']);
    $this->db->bind(':issmNumber',$data['issmNumber']);
    $this->db->bind(':descriptions',$data['descriptions']);
    $this->db->bind(':imgFront',$data['imgFront']);
    $this->db->bind(':imgBack',$data['imgBack']);
    $this->db->bind(':imgInside',$data['imgInside']);
    $this->db->bind(':accName',$data['accName']);
    $this->db->bind(':accNumber',$data['accNumber']);
    $this->db->bind(':bankName',$data['bankName']);
    $this->db->bind(':branchName',$data['branchName']);
    $this->db->bind(':town',$data['town']);
    $this->db->bind(':district',$data['district']);
    $this->db->bind(':postalCode',$data['postalCode']);
    $this->db->bind(':customer_id',$data['customer_id']);

    // Execute
    if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }
  }

  public function deleteusedbook($bookId) {
    $this->db->query('DELETE FROM usedbooks WHERE bookId = :bookId');
    // Bind values
    $this->db->bind(':bookId', $bookId);

    // Execute after binding
    $this->db->execute();

    // Check for row count affected
    if ($this->db->rowCount() > 0) {
        return true;
    } else {
        return false;
    }
  }

  }