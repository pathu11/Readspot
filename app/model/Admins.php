<?php 
  class Admins {
    private $db;
    public function __construct(){
        $this->db = new Database;
    }
    public function getUserEmail($user_id) {
      $this->db->query('SELECT email FROM users WHERE user_id = :user_id');
      $this->db->bind(':user_id', $user_id);
      $row = $this->db->single();
      return ($row) ? $row->email : null;
    }
    public function findAdminById($user_id){
        $this->db->query('SELECT * from admin WHERE user_id=:user_id');
        $this->db->bind(':user_id',$user_id);
        return $this->db->resultSet();
    }
    
    public function getCustomerDetailsById($customer_id){
      $this->db->query('SELECT * from customers WHERE customer_id=:customer_id');
      $this->db->bind(':customer_id',$customer_id);
      return $this->db->resultSet();
  }
  public function getPublisherDetailsById($publisher_id){
    $this->db->query('SELECT * from publishers WHERE publisher_id=:publisher_id');
    $this->db->bind(':publisher_id',$publisher_id);
    return $this->db->resultSet();
}
    public function getOrderDetailsById($order_id){
      $this->db->query('SELECT * from orders WHERE order_id=:order_id');
      $this->db->bind(':order_id',$order_id);
     

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

    public function addEventCategory($data){
      $this->db->query('INSERT INTO event_category(event,description) VALUES (:event_category,:description)');

      $this->db->bind(':event_category',$data['event_category']);
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

    public function findEventCategoryById($id){
      $this->db->query('SELECT * FROM event_category WHERE id=:id');
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

    public function updateEventCategory($data){
      $this->db->query('UPDATE event_category SET event = :event_category, description = :description WHERE id = :id');

      $this->db->bind(':event_category',$data['event_category']);
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

    public function deleteEventCategory($id){
      $this->db->query('DELETE FROM event_category WHERE id = :id');

      $this->db->bind(':id',$id);

      if($this->db->execute()){
        return true;
      }else{
        return false;
      }
    }
  
  

  public function getPendingPublishers() {
      $this->db->query('SELECT * FROM publishers WHERE  status = "pending"');
      $results=$this->db->resultSet();

      return $results;
  }

  public function getPendingCharity() {
    $this->db->query('SELECT * FROM charity WHERE  status = "pending"');
    $results=$this->db->resultSet();

    return $results;
}

  public function getPendingUsers(){
    $this->db->query('SELECT * FROM users WHERE  status = "pending"');
    $results=$this->db->resultSet();

    return $results;
  }

  public function getPendingUserDetailsFilteredByUserRole($userRoleFilter){
    if($userRoleFilter=='publisher'){
      $this->db->query('SELECT * FROM users WHERE  status = "pending" AND user_role="publisher"');
      $results=$this->db->resultSet();

      return $results;
    }
    if($userRoleFilter=='charity'){
      $this->db->query('SELECT * FROM users WHERE  status = "pending" AND user_role="charity"');
      $results=$this->db->resultSet();

      return $results;
    }
  }

  public function approvePub($user_id) {
    $this->db->query("UPDATE publishers SET status = 'approval' WHERE user_id = :user_id");
    $this->db->bind(':user_id', $user_id);
    if ($this->db->execute()) {
      return true;
  } else {
      return false;
  }
}

public function approveCharity($user_id) {
  $this->db->query("UPDATE charity SET status = 'approval' WHERE user_id = :user_id");
  $this->db->bind(':user_id', $user_id);
  if ($this->db->execute()) {
    return true;
} else {
    return false;
}
}

public function approveusers($user_id){
  $this->db->query("UPDATE users SET status = 'approval' WHERE user_id = :user_id");
  $this->db->bind(':user_id', $user_id);

  // Execute the query
  if ($this->db->execute()) {
      return true;
  } else {
      return false;
  }
}

public function getCustomerDetails(){
  $this->db->query('SELECT * FROM customers');
  $results=$this->db->resultSet();

  return $results;
}

public function getPublisherDetails(){
  $this->db->query("SELECT * FROM publishers WHERE status='approval'");
  $results=$this->db->resultSet();

  return $results;
}

public function getCharityDetails(){
  $this->db->query("SELECT * FROM charity WHERE status='approval'");
  $results=$this->db->resultSet();

  return $results;
}

public function countAdmins(){    
  $this->db->query('SELECT COUNT(*) as adminCount FROM admin ');
 
  $result = $this->db->single();
  if ($result) {
      return $result->adminCount;
  } else {
      return 0; 
  }
}
public function countModerators(){    
  $this->db->query('SELECT COUNT(*) as moderatorCount FROM moderator ');
 
  $result = $this->db->single();
  if ($result) {
      return $result->moderatorCount;
  } else {
      return 0; 
  }
}
  public function countDelivery(){    
      $this->db->query('SELECT COUNT(*) as deliveryCount FROM delivery ');
     
      $result = $this->db->single();
      if ($result) {
          return $result->deliveryCount;
      } else {
          return 0; 
        }
  }
  public function countCustomers(){    
      $this->db->query('SELECT COUNT(*) as customerCount FROM customers');
  
      $result = $this->db->single();
      if ($result) {
          return $result->customerCount;
      } else {
          return 0; 
        }
  }
  public function countPublishers(){    
      $this->db->query('SELECT COUNT(*) as PublishersCount FROM publishers WHERE status="approval" ');
      
      $result = $this->db->single();
      if ($result) {
          return $result->PublishersCount;
      } else {
          return 0; 
        }
}
public function countCharity(){    
  $this->db->query('SELECT COUNT(*) as CharityCount FROM charity WHERE status="approval" ');
  
  $result = $this->db->single();
  if ($result) {
      return $result->CharityCount;
  } else {
      return 0; 
    }
}

public function getCustomerSearchDetails($input){
  $this->db->query("SELECT * FROM customers WHERE name LIKE '{$input}%'");

  $results=$this->db->resultSet();

  return $results;
}

public function getPublisherSearchDetails($input){
  $this->db->query("SELECT * FROM publishers WHERE name LIKE '{$input}%' AND status='approval'");

  $results=$this->db->resultSet();

  return $results;
}

public function getCharitySearchDetails($input){
  $this->db->query("SELECT * FROM charity WHERE name LIKE '{$input}%' AND status='approval'");

  $results=$this->db->resultSet();

  return $results;
}

public function getOrderDetails(){
  $this->db->query("SELECT * FROM orders ");

  $results=$this->db->resultSet();

  return $results;
}

public function getPendingOrderDetails() {
  $this->db->query("SELECT orders.*, customers.name AS customer_name 
                    FROM orders 
                    INNER JOIN customers ON orders.customer_id = customers.customer_id 
                    WHERE orders.payment_type='OnlineDeposit' AND orders.status='pending'");

  return $this->db->resultSet();
}


public function generateRegistrationReport($data){
  $this->db->query('SELECT
  DATE(created_at) AS registration_date,
  COUNT(*) AS new_registrations
  FROM users
  WHERE MONTH(created_at) = :startMonth AND YEAR(created_at) = :startYear
  GROUP BY DATE(created_at)
  ORDER BY DATE(created_at)');

  $this->db->bind(':startMonth',$data['startMonth']);
  $this->db->bind(':startYear',$data['startYear']);

  $results=$this->db->resultSet();

  return $results;
}
public function approveOrder($order_id) {
  $this->db->query("UPDATE orders SET status = 'processing' WHERE order_id = :order_id");
  $this->db->bind(':order_id', $order_id);
  if ($this->db->execute()) {
    return true;
} else {
    return false;
}
}

public function addMessage($data) {
  $this->db->query('INSERT INTO messages (sender_id, user_id, topic,message,sender_name) VALUES (:sender_id, :user_id, :topic, :message, :sender_name)');
  $this->db->bind(':sender_id', $data['sender_id']);
  $this->db->bind(':user_id', $data['user_id']);
  $this->db->bind(':topic', $data['topic']);
  $this->db->bind(':message', $data['message']);
  $this->db->bind(':sender_name', $data['sender_name']);
  if($this->db->execute()){
      return true;
    }else{
      return false;
    }
}

public function getBookDetailsById($book_id){
  $this->db->query("SELECT * FROM books WHERE book_id=:book_id");
  $this->db->bind(':book_id', $book_id); // Use the parameter $book_id here
  $results = $this->db->resultSet();
  return $results;
}
public function addMessageToPublisher($data) {
  $this->db->query('INSERT INTO messages (sender_id, user_id, topic,message,sender_name) VALUES (:sender_id, :user_id, :topic, :message, :sender_name)');
  $this->db->bind(':sender_id', $data['sender_id']);
  $this->db->bind(':user_id', $data['user_idPub']);
  $this->db->bind(':topic', $data['topic']);
  $this->db->bind(':message', $data['messageToPublisher']);
  $this->db->bind(':sender_name', $data['sender_name']);
  if($this->db->execute()){
      return true;
    }else{
      return false;
    }
}
  
}