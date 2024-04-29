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

    public function getCustomerEmail($customer_id) {
      $this->db->query('SELECT email FROM customers WHERE user_id = :user_id');
      $this->db->bind(':user_id', $customer_id);
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
  public function getPaymentsDetails(){
    $this->db->query("
            SELECT 
            o.order_id,
            od.book_id,
            o.tracking_no,
            od.quantity,
            b.price AS book_price,
            CASE 
                WHEN b.type = 'new' THEN ROUND(b.price * 0.05, 2)
                WHEN b.type = 'used' THEN ROUND(b.price * 0.03, 2)
            END AS tax,
            CASE 
                WHEN b.type = 'new' THEN b.publisher_id
                WHEN b.type = 'used' THEN b.customer_id
            END AS user_id,
            u.user_id AS user_id_from_users_table,
            ROUND((b.price - (CASE WHEN b.type = 'new' THEN ROUND(b.price * 0.05, 2) WHEN b.type = 'used' THEN ROUND(b.price * 0.03, 2) END)) * od.quantity, 2) AS paid_price,
            CASE 
                WHEN b.type = 'new' THEN pu.name
                WHEN b.type = 'used' THEN cu.name
            END AS user_name
        FROM 
            orders o 
        JOIN 
            order_details od ON o.order_id = od.order_id 
        JOIN 
            books b ON od.book_id = b.book_id 
        LEFT JOIN 
            publishers p ON b.publisher_id = p.publisher_id AND b.type = 'new'
        LEFT JOIN 
            customers c ON b.customer_id = c.customer_id AND b.type = 'used'
        LEFT JOIN 
            users u ON u.user_id = CASE 
                                    WHEN b.type = 'new' THEN p.user_id
                                    WHEN b.type = 'used' THEN c.user_id
                                END
        LEFT JOIN 
            publishers pu ON b.publisher_id = pu.publisher_id AND b.type = 'new'
        LEFT JOIN 
            customers cu ON b.customer_id = cu.customer_id AND b.type = 'used'
        WHERE 
            od.status = 'delivered' AND od.sent_payment='0'

    ");
   
    return $this->db->resultSet();
}

public function insertPayment($order_id,$book_id,$paid_price,$user_id_from_users_table,$quantity) {
  
  $this->db->query('UPDATE order_details SET sent_payment=1 WHERE order_id=:order_id AND book_id=:book_id');
  $this->db->bind(':order_id', $order_id);
  $this->db->bind(':book_id', $book_id);

  if (!$this->db->execute()) {
      return false; 
  }
  
  $this->db->query('INSERT INTO payments (order_id, book_id, payment, user_id, quantity) 
                    VALUES (:order_id, :book_id, :payment, :user_id, :quantity)');
  $this->db->bind(':order_id', $order_id);
  $this->db->bind(':book_id', $book_id);
  $this->db->bind(':payment', $paid_price);
  $this->db->bind(':user_id', $user_id_from_users_table); 
  $this->db->bind(':quantity', $quantity);

  if ($this->db->execute()) {
      return true;
  } else {
      return false; 
  }
}

public function sendMessage($user_id_from_users_table,$user_id,$sender_name,$topic,$msg){
  $this->db->query('INSERT INTO messages (sender_id, user_id, topic,message,sender_name) VALUES (:sender_id, :user_id, :topic, :message, :sender_name)');
  $this->db->bind(':sender_id', $user_id);
  $this->db->bind(':user_id', $user_id_from_users_table);
  $this->db->bind(':topic', $topic);
  $this->db->bind(':message', $msg);
  $this->db->bind(':sender_name', $sender_name);
  if($this->db->execute()){
      return true;
    }else{
      return false;
    }
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
      $this->db->query('INSERT INTO book_category (category, description,category_img) VALUES (:book_category, :description,:img)');

      $this->db->bind(':book_category',$data['book_category']);
      $this->db->bind(':description',$data['description']);
      $this->db->bind(':img',$data['img']);

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
      $this->db->query('UPDATE book_category SET category = :book_category, description = :description,category_img=:img WHERE id = :id');

      $this->db->bind(':book_category',$data['book_category']);
      $this->db->bind(':description',$data['description']);
      $this->db->bind(':img',$data['img']);
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
      $this->db->query('SELECT * FROM users WHERE  status = "pending"');
      $results=$this->db->resultSet();

      return $results;
  }

  public function getPendingCharity() {
    $this->db->query('SELECT * FROM users WHERE  status = "pending"');
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

public function approveBook($book_id){
  $this->db->query("UPDATE books SET status = 'approval' WHERE book_id = :book_id");
  $this->db->bind(':book_id', $book_id);

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

public function getOrderSearchDetailsByID($input){
  $this->db->query("SELECT o.*, od.book_id, od.quantity ,od.status
                    FROM orders o
                    INNER JOIN order_details od ON o.order_id = od.order_id
                    WHERE o.order_id LIKE '{$input}%' ");

  $results=$this->db->resultSet();

  return $results;
}

public function getOrderSearchDetailsByDate($input){
  $this->db->query("SELECT o.*, od.book_id, od.quantity ,od.status
                    FROM orders o
                    INNER JOIN order_details od ON o.order_id = od.order_id
                    WHERE o.order_date LIKE '{$input}%'");
  

  $results=$this->db->resultSet();

  return $results;
}

public function getComplainSearchDetails($input){
  $this->db->query("SELECT CONCAT(first_name,' ',last_name) AS name,email,contact_number,other,descript,err_img,complaint_id,resolved_or_not FROM complaint WHERE resolved_or_not = :input AND (reason='Other' OR reason='Comments')");
  $this->db->bind(":input",$input);
  $results=$this->db->resultSet();
  return $results;

}

public function getOrderDetails(){
  $this->db->query("SELECT o.*, od.book_id, od.quantity ,od.status
                    FROM orders o
                    INNER JOIN order_details od ON o.order_id = od.order_id");
  $results = $this->db->resultSet();

  return $results;
}
public function getPendingOrderDetails() {
  $this->db->query("SELECT orders.*, 
        customers.name AS customer_name,
        order_details.order_id,
        order_details.book_id,
        order_details.status,
        orders.tracking_no
      FROM orders 
      INNER JOIN customers ON orders.customer_id = customers.customer_id 
      INNER JOIN order_details ON orders.order_id = order_details.order_id
      WHERE orders.payment_type='OnlineDeposit' AND order_details.status='pending'
");

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
  $this->db->query("UPDATE order_details SET status = 'processing' WHERE order_id = :order_id");
  $this->db->bind(':order_id', $order_id);
  if ($this->db->execute()) {
    return true;
  } else {
      return false;
  }
}

public function rejectOrder($order_id) {
  $this->db->query("UPDATE order_details SET status = 'cancel' WHERE order_id = :order_id");
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
public function countTotalBooks(){
  $this->db->query('SELECT COUNT(*) AS totalBooks FROM books');
  
  $result = $this->db->single();
  if ($result) {
      return $result->totalBooks;
  } else {
      return 0; 
    }
}

public function getTopBooks(){
  $this->db->query("SELECT b.book_name, b.author, COUNT(o.book_id) AS order_count
  FROM books b
  JOIN orders o ON b.book_id = o.book_id
  GROUP BY b.book_name
  ORDER BY order_count DESC
  LIMIT 3;
  ");

  $results=$this->db->resultSet();
  return $results;
}

public function getAvailableBooks(){
  $this->db->query('SELECT * FROM books WHERE quantity>0');

  $results=$this->db->resultSet();
  return $results;

}

public function getPendingBookDetails(){
  $this->db->query("SELECT b.book_id, b.customer_id, b.book_name, b.author, b.price, b.price_type, b.condition, b.img1, b.img2, b.img3, b.type,
                    s.name, s.email
                    FROM books b
                    INNER JOIN customers s ON b.customer_id = s.customer_id
                    WHERE b.type = 'used' OR b.type='exchanged' AND b.status='pending'");

  $results=$this->db->resultSet();
  return $results;
}

public function getPendingBookByID($book_id){
  $this->db->query("SELECT b.book_id,b.book_name, b.author, b.price, b.price_type, b.condition, b.img1, b.img2, b.img3, 
                    s.name, s.email
                    FROM books b
                    INNER JOIN customers s ON b.customer_id = s.customer_id
                    WHERE b.book_id=:book_id ");
  
  $this->db->bind(':book_id', $book_id);
  $results=$this->db->single();
  return $results;
}

public function rejectBook($book_id){
  $this->db->query("UPDATE books SET status='rejected' WHERE book_id = :book_id");
  $this->db->bind(":book_id",$book_id);

  if($this->db->execute()){
    return true;
  }else{
    return false;
  }
}

public function getMessageDetails($user_id){
  $this->db->query('
      SELECT 
          u.name AS incoming_user_name,
          u2.name AS outgoing_user_name,
          m.msg,
          m.incoming_msg_id,
          m.outgoing_msg_id
      FROM 
          message AS m 
      JOIN 
          users AS u ON u.user_id = m.incoming_msg_id 
      JOIN 
          users AS u2 ON u2.user_id = m.outgoing_msg_id 
      WHERE 
          m.incoming_msg_id = :user_id
      ORDER BY 
          m.msg_id DESC
      LIMIT 5'
  );
  $this->db->bind(':user_id', $user_id);

  return $this->db->resultSet();
}

public function getComplains(){
  $this->db->query('SELECT CONCAT(first_name," ",last_name) AS name,email,contact_number,other,descript,err_img,complaint_id,resolved_or_not FROM complaint WHERE reason ="Comments" OR reason ="Other"');
  $results=$this->db->resultSet();
  return $results;
}

public function respondComplain($complaint_id,$adminComment){
  $this->db->query('UPDATE complaint SET moderatorAdmin_comment = :adminComment, resolved_or_not=1, update_time_on_comment = NOW() WHERE complaint_id = :complaint_id');

  $this->db->bind(":adminComment",$adminComment);
  $this->db->bind(":complaint_id",$complaint_id);

  if($this->db->execute()){
    return true;
  }else{
    return false;
  }
}

public function getMonthlyRegisteredUserCount(){
  $this->db->query('SELECT DATE(created_at) AS registration_day, COUNT(*) AS num_users_registered
                  FROM 
                    users
                  WHERE 
                    created_at >= DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH)
                  GROUP BY 
                    DATE(created_at)');
  $results=$this->db->resultSet();
  return $results;
}

public function getMonthlyOrderCount(){
  $this->db->query('SELECT DATE(order_date) AS order_day, COUNT(*) AS num_orders
                  FROM 
                    orders
                  WHERE 
                    order_date >= DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH)
                  GROUP BY 
                    DATE(order_date)');
  $results=$this->db->resultSet();
  return $results;
}

public function getOrderStatusCount(){
  $this->db->query('SELECT status, COUNT(status) AS count FROM order_details GROUP BY status');
  $results=$this->db->resultSet();
  return $results;
}

public function getNewBookCount(){
  $this->db->query('SELECT DATE(created_at) AS newBook_day, COUNT(*) AS num_newBook
                    FROM 
                      books
                    WHERE 
                      created_at >= DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH) AND type = "new"
                    GROUP BY 
                      DATE(created_at)');
  $results=$this->db->resultSet();
  return $results;
}

public function getUsedBookCount(){
  $this->db->query('SELECT DATE(created_at) AS usedBook_day, COUNT(*) AS num_usedBook
                    FROM 
                      books
                    WHERE 
                      created_at >= DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH) AND type = "used"
                    GROUP BY 
                      DATE(created_at)');
  $results=$this->db->resultSet();
  return $results;
}

public function getExchangeBookCount(){
  $this->db->query('SELECT DATE(created_at) AS exchangeBook_day, COUNT(*) AS num_exchangeBook
                    FROM 
                      books
                    WHERE 
                      created_at >= DATE_SUB(CURRENT_DATE, INTERVAL 1 MONTH) AND type = "exchanged"
                    GROUP BY 
                      DATE(created_at)');
  $results=$this->db->resultSet();
  return $results;
}

public function getBookCategoryCount(){
  $this->db->query('SELECT category, COUNT(status) AS count FROM books GROUP BY category');
  $results=$this->db->resultSet();
  return $results;
}

public function sendToSuperAdmin($complaint_id) {
  $this->db->query('UPDATE complaint SET sent_to_superadmin = 1 WHERE complaint_id = :complaint_id');
  $this->db->bind(":complaint_id",$complaint_id);

  if($this->db->execute()){
    return true;
  }else{
    return false;
  }

}

public function rejectUser($user_id){
  $this->db->query("UPDATE users SET status = 'reject' WHERE user_id = :user_id");
  $this->db->bind(":user_id",$user_id);

  if($this->db->execute()){
    return true;
  }else{
    return false;
  }
}


}