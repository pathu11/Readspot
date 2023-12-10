<?php 
  class Orders{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }


   
    public function findNewBookOrdersByOrderId($order_id) {
        $this->db->query('SELECT * FROM orders o JOIN books b ON o.book_id = b.book_id WHERE o.order_id = :order_id AND b.type = "new"');
        $this->db->bind(':order_id', $order_id);
    
        return $this->db->resultSet();
    }
    
    public function findNewBookProOrdersBypubId($publisher_id) {
        $this->db->query('SELECT o.*, b.*, p.name AS publisher_name, c.name AS customer_name
                          FROM orders o
                          JOIN books b ON o.book_id = b.book_id
                          LEFT JOIN publishers p ON b.publisher_id = p.publisher_id
                          LEFT JOIN customers c ON o.customer_id = c.customer_id
                          WHERE b.publisher_id = :publisher_id AND o.status = "processing" AND b.type = "new"');
        $this->db->bind(':publisher_id', $publisher_id);
    
        return $this->db->resultSet();
    }
    
    
    public function findNewBookShippingOrdersBypubId($publisher_id) {
        $this->db->query('SELECT o.*, b.*, p.name AS publisher_name, c.name AS customer_name
                          FROM orders o
                          JOIN books b ON o.book_id = b.book_id
                          LEFT JOIN publishers p ON b.publisher_id = p.publisher_id
                          LEFT JOIN customers c ON o.customer_id = c.customer_id
                          WHERE b.publisher_id = :publisher_id AND o.status = "shipping" AND b.type = "new"');
        $this->db->bind(':publisher_id', $publisher_id);
    
        return $this->db->resultSet();
    }
    
    
    public function findNewBookDeliveredOrdersBypubId($publisher_id) {
        $this->db->query('SELECT o.*, b.*, p.name AS publisher_name, c.name AS customer_name
                          FROM orders o
                          JOIN books b ON o.book_id = b.book_id
                          LEFT JOIN publishers p ON b.publisher_id = p.publisher_id
                          LEFT JOIN customers c ON o.customer_id = c.customer_id
                          WHERE b.publisher_id = :publisher_id AND o.status = "delivered" AND b.type = "new"');
        $this->db->bind(':publisher_id', $publisher_id);
    
        return $this->db->resultSet();
    }
    

    
  }