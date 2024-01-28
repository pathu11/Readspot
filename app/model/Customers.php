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
    public function addToCart($book_id, $customer_id, $quantity) {
      try {
          $this->db->query('INSERT INTO cart (book_id, customer_id, quantity) VALUES (:book_id, :customer_id, :quantity)');
          $this->db->bind(':book_id', $book_id);
          $this->db->bind(':customer_id', $customer_id);
          $this->db->bind(':quantity', $quantity);
  
          return $this->db->execute();
      } catch (\Exception $e) {
          // Handle the exception (e.g., log it, display an error message)
          echo 'Error: ' . $e->getMessage();
          return false;
      }
  }

 
  public function findCartById($customer_id) {
    $this->db->query('SELECT c.*, b.book_name, b.price FROM cart c
                      JOIN books b ON c.book_id = b.book_id
                      WHERE c.customer_id = :customer_id');
    $this->db->bind(':customer_id', $customer_id);

    return $this->db->resultSet();
}

  
  

    public function findCustomerById($user_id){
        $this->db->query('SELECT * from customers WHERE user_id=:user_id');
        $this->db->bind(':user_id',$user_id);
       

        return $this->db->resultSet();
    }

  
    public function findUsedBookByCusId($customer_id){
      $this->db->query('SELECT * from books WHERE customer_id=:customer_id AND type="used" AND status="approval"');
      $this->db->bind(':customer_id',$customer_id);
     

      return $this->db->resultSet();
    }

    public function findUsedBookByNotCusId($customer_id) {
      $this->db->query('SELECT * FROM books WHERE customer_id != :customer_id AND type="used" AND status="approval"');
      $this->db->bind(':customer_id', $customer_id);
  
      return $this->db->resultSet();
  }
  

    public function findExchangedBookByCusId($customer_id){
      $this->db->query('SELECT * from books WHERE customer_id=:customer_id AND type="exchanged" AND status="approval"');
      $this->db->bind(':customer_id',$customer_id);
     

      return $this->db->resultSet();
    }

    public function findExchangedBookByNotCusId($customer_id){
      $this->db->query('SELECT * from books WHERE customer_id!=:customer_id AND type="exchanged" AND status="approval"');
      $this->db->bind(':customer_id',$customer_id);
     

      return $this->db->resultSet();
    }
    // public function getUsedBookById($book_id){
    //   $this->db->query('SELECT * from books WHERE book_id=:book_id ');
    //   $this->db->bind(':book_id',$book_id);
    //   return $this->db->resultSet();
    //   // $row = $this->db->single();
    //   // return $row;
    // }

    public function findUsedBookById($book_id) {
      $this->db->query('SELECT * from books WHERE book_id=:book_id');
      $this->db->bind(':book_id',$book_id);
      $row = $this->db->single();
      return $row;
    }

    // public function findExchangeBookById($book_id) {
    //   $this->db->query('SELECT * from books WHERE book_id=:book_id');
    //   $this->db->bind(':book_id',$book_id);
    //   $row = $this->db->single();
    //   return $row;
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

  public function AddExchangeBook($data){
    $this->db->query('INSERT INTO books (book_name, ISBN_no, author, category, weight, descript, booksIWant, img1, img2, img3, `condition`, published_year, type, town, district, postal_code, customer_id, status) 
                                VALUES(:book_name, :ISBN_no, :author, :category, :weight, :descript, :booksIWant, :img1, :img2, :img3, :condition, :published_year, :type, :town, :district, :postal_code, :customer_id, :status)');
    
    $this->db->bind(':book_name',$data['book_name']);
    $this->db->bind(':ISBN_no',$data['ISBN_no']);
    $this->db->bind(':author',$data['author']);
    $this->db->bind(':category',$data['category']);
    $this->db->bind(':weight',$data['weight']);
    $this->db->bind(':descript',$data['descript']);
    $this->db->bind(':booksIWant',$data['booksIWant']);
    $this->db->bind(':img1',$data['img1']);
    $this->db->bind(':img2',$data['img2']);
    $this->db->bind(':img3',$data['img3']);
    $this->db->bind(':condition',$data['condition']);
    $this->db->bind(':published_year',$data['published_year']);
    $this->db->bind(':type',$data['type']);
    $this->db->bind(':town',$data['town']);
    $this->db->bind(':district',$data['district']);
    $this->db->bind(':postal_code',$data['postal_code']);
    $this->db->bind(':customer_id', $data['customer_id']);
    $this->db->bind(':status', $data['status']);
    // execute
    if($this->db->execute()){
        return true;
    }else{
        return false;
    }
  }




  public function AddUsedBook($data){
    $this->db->query('INSERT INTO books (book_name, ISBN_no, author, price, category, weight, descript, img1, img2, img3, `condition`, published_year, price_type, type, account_name, account_no, bank_name, branch_name, town, district, postal_code, customer_id, status) 
                                VALUES(:book_name, :ISBN_no, :author, :price, :category, :weight, :descript, :img1, :img2, :img3, :condition, :published_year, :price_type, :type, :account_name, :account_no, :bank_name, :branch_name, :town, :district, :postal_code, :customer_id, :status)');
    
    $this->db->bind(':book_name',$data['book_name']);
    $this->db->bind(':ISBN_no',$data['ISBN_no']);
    // $this->db->bind(':ISSN_no',$data['ISSN_no']);
    // $this->db->bind(':ISMN_no',$data['ISMN_no']);
    $this->db->bind(':author',$data['author']);
    $this->db->bind(':price',$data['price']);
    $this->db->bind(':category',$data['category']);
    $this->db->bind(':weight',$data['weight']);
    $this->db->bind(':descript',$data['descript']);
    $this->db->bind(':img1',$data['img1']);
    $this->db->bind(':img2',$data['img2']);
    $this->db->bind(':img3',$data['img3']);
    $this->db->bind(':condition',$data['condition']);
    $this->db->bind(':published_year',$data['published_year']);
    $this->db->bind(':price_type',$data['price_type']);
    $this->db->bind(':type',$data['type']);
    $this->db->bind(':account_name',$data['account_name']);
    $this->db->bind(':account_no',$data['account_no']);
    $this->db->bind(':bank_name',$data['bank_name']);
    $this->db->bind(':branch_name',$data['branch_name']);
    $this->db->bind(':town',$data['town']);
    $this->db->bind(':district',$data['district']);
    $this->db->bind(':postal_code',$data['postal_code']);
    $this->db->bind(':customer_id', $data['customer_id']);
    $this->db->bind(':status', $data['status']);
    // execute
    if($this->db->execute()){
        return true;
    }else{
        return false;
    }        
  }

  public function updateusedbook($data) {
    $this->db->query('UPDATE books 
              SET book_name = :book_name, 
              ISBN_no = :ISBN_no, 
              author = :author,  
              price = :price, 
              category = :category,
              weight = :weight,
              descript = :descript,
              img1 = :img1,
              img2 = :img2,
              img3 = :img3,
              `condition` = :condition, 
              published_year = :published_year,  
              price_type = :price_type, 
              type = :type,
              account_name = :account_name,
              account_no = :account_no,
              bank_name = :bank_name,
              branch_name = :branch_name,
              town = :town, 
              district = :district,  
              postal_code = :postal_code, 
              customer_id = :customer_id,
              status = :status
              WHERE book_id = :book_id');

    // Bind values
    $this->db->bind(':book_id',$data['book_id']);
    $this->db->bind(':book_name',$data['book_name']);
    $this->db->bind(':ISBN_no',$data['ISBN_no']);
    // $this->db->bind(':ISSN_no',$data['ISSN_no']);
    // $this->db->bind(':ISMN_no',$data['ISMN_no']);
    $this->db->bind(':author',$data['author']);
    $this->db->bind(':price',$data['price']);
    $this->db->bind(':category',$data['category']);
    $this->db->bind(':weight',$data['weight']);
    $this->db->bind(':descript',$data['descript']);
    $this->db->bind(':img1',$data['img1']);
    $this->db->bind(':img2',$data['img2']);
    $this->db->bind(':img3',$data['img3']);
    $this->db->bind(':condition',$data['condition']);
    $this->db->bind(':published_year',$data['published_year']);
    $this->db->bind(':price_type',$data['price_type']);
    $this->db->bind(':type',$data['type']);
    $this->db->bind(':account_name',$data['account_name']);
    $this->db->bind(':account_no',$data['account_no']);
    $this->db->bind(':bank_name',$data['bank_name']);
    $this->db->bind(':branch_name',$data['branch_name']);
    $this->db->bind(':town',$data['town']);
    $this->db->bind(':district',$data['district']);
    $this->db->bind(':postal_code',$data['postal_code']);
    $this->db->bind(':customer_id', $data['customer_id']);
    $this->db->bind(':status', $data['status']);

    // Execute
    if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }
  }

  public function updateexchangebook($data){
    $this->db->query('UPDATE books 
              SET book_name = :book_name, 
              ISBN_no = :ISBN_no, 
              author = :author, 
              category = :category,
              weight = :weight,
              descript = :descript,
              booksIWant = :booksIWant,
              img1 = :img1,
              img2 = :img2,
              img3 = :img3,
              `condition` = :condition, 
              published_year = :published_year,  
              type = :type,
              town = :town, 
              district = :district,  
              postal_code = :postal_code, 
              customer_id = :customer_id,
              status = :status
              WHERE book_id = :book_id');

    // Bind values
    $this->db->bind(':book_id',$data['book_id']);
    $this->db->bind(':book_name',$data['book_name']);
    $this->db->bind(':ISBN_no',$data['ISBN_no']);
    $this->db->bind(':author',$data['author']);
    $this->db->bind(':category',$data['category']);
    $this->db->bind(':weight',$data['weight']);
    $this->db->bind(':descript',$data['descript']);
    $this->db->bind(':booksIWant',$data['booksIWant']);
    $this->db->bind(':img1',$data['img1']);
    $this->db->bind(':img2',$data['img2']);
    $this->db->bind(':img3',$data['img3']);
    $this->db->bind(':condition',$data['condition']);
    $this->db->bind(':published_year',$data['published_year']);
    $this->db->bind(':type',$data['type']);
    $this->db->bind(':town',$data['town']);
    $this->db->bind(':district',$data['district']);
    $this->db->bind(':postal_code',$data['postal_code']);
    $this->db->bind(':customer_id', $data['customer_id']);
    $this->db->bind(':status', $data['status']);

    // Execute
    if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }
  }

  public function deleteusedbook($book_id) {
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

  public function addOrder($data){
    $this->db->query('INSERT INTO orders (book_id, customer_id, c_postal_name, c_street_name, c_town, c_district, c_postal_code,contact_no,total_price,total_weight,quantity,status) VALUES(:book_id, :customer_id,  :c_postal_name, :c_street_name,  :c_town, :c_district, :c_postal_code, :contact_no, :total_price, :total_weight, :quantity, :status)');
    
    $this->db->bind(':book_id',$data['book_id']);
    $this->db->bind(':customer_id',$data['customer_id']);
   
    $this->db->bind(':c_postal_name',$data['postal_name']);
    $this->db->bind(':c_street_name',$data['street_name']);
    $this->db->bind(':c_town',$data['town']);
    $this->db->bind(':c_district',$data['district']);
    $this->db->bind(':c_postal_code',$data['postal_code']);
    $this->db->bind(':contact_no', $data['contact_no']);
    $this->db->bind(':total_price', $data['total_cost']);
    $this->db->bind(':total_weight', $data['total_weight']);
    $this->db->bind(':quantity',$data['quantity']);
    $this->db->bind(':status',"pending");
   
   
   
    // execute
    if($this->db->execute()){
        return true;
    }else{
        return false;
    }        
  }

  public function getLastInsertedOrderId() {
    $this->db->query('SELECT LAST_INSERT_ID() as order_id');
    $row = $this->db->single();
    return $row->order_id;
}
public function editOrder($data)
{
    $this->db->query('UPDATE orders
              SET recipt = :recipt,
              payment_type = :payment_type ,
              tracking_no = :tracking_no
              WHERE order_id = :order_id');

    // Bind values
    $this->db->bind(':order_id', $data['order_id']);
    $this->db->bind(':recipt', $data['recipt']);
    $this->db->bind(':payment_type', $data['formType']);  // Use 'formType' instead of 'payment_type'
    $this->db->bind(':tracking_no', $data['trackingNumber']);
    // Execute
    if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}
public function editOrderCOD($data)
{
    $this->db->query('UPDATE orders
              SET 
              payment_type = :payment_type ,
              tracking_no = :tracking_no,
              status= :status
              WHERE order_id = :order_id');
    // Bind values
    $this->db->bind(':order_id', $data['order_id']);
    $this->db->bind(':payment_type', $data['formType']);  // Use 'formType' instead of 'payment_type'
    $this->db->bind(':tracking_no', $data['trackingNumber']);
    $this->db->bind(':status', "processing");
    // Execute
    if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}
// public function displayOrder(){
//   $this->db->query('SELECT * FROM orders WHERE payment_type="onlineDeposit"');
//     return $this->db->resultSet();
// }

public function findNewBooksByTime(){
  $this->db->query('SELECT * FROM books ORDER BY created_at DESC');
  return $this->db->resultSet();
}

public function searchNewBooks($inputText){
  $this->db->query("SELECT book_id, book_name, ISBN_no, author, img1
  FROM books 
  WHERE (book_name LIKE '%$inputText%' OR ISBN_no LIKE '%$inputText%' OR author LIKE '%$inputText%') 
  AND type = 'new' ");
  
  $results = $this->db->resultSet();
  return $results;
}



  }