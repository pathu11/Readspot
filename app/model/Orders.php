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
    public function findNewBookReturnedOrdersBypubId($publisher_id) {
        $this->db->query('SELECT o.*, b.*, p.name AS publisher_name, c.name AS customer_name
                          FROM orders o
                          JOIN books b ON o.book_id = b.book_id
                          LEFT JOIN publishers p ON b.publisher_id = p.publisher_id
                          LEFT JOIN customers c ON o.customer_id = c.customer_id
                          WHERE b.publisher_id = :publisher_id AND o.status = "returned" AND b.type = "new"');
        $this->db->bind(':publisher_id', $publisher_id);
    
        return $this->db->resultSet();
    }

    

    public function findBookProOrders() {
        $this->db->query('SELECT 
            o.order_id, 
            o.status,
            o.quantity,
            o.total_weight, 
            b.book_id, 
            b.type AS book_type, 
            CASE 
                WHEN b.type = "new" THEN p.user_id
                WHEN b.type IN ("exchanged", "used") THEN c_sender.user_id
            END AS sender_id, 
            CASE 
                WHEN b.type = "new" THEN p.postal_name
                WHEN b.type IN ("exchanged", "used") THEN c_sender.postal_name
            END AS sender_postal_name, 
            CASE 
                WHEN b.type = "new" THEN p.street_name
                WHEN b.type IN ("exchanged", "used") THEN c_sender.street_name
            END AS sender_street_name,
            CASE 
                WHEN b.type = "new" THEN p.town
                WHEN b.type IN ("exchanged", "used") THEN c_sender.town
            END AS sender_town, 
            CASE 
                WHEN b.type = "new" THEN p.district
                WHEN b.type IN ("exchanged", "used") THEN c_sender.district
            END AS sender_district, 
            CASE 
                WHEN b.type = "new" THEN p.postal_code
                WHEN b.type IN ("exchanged", "used") THEN c_sender.postal_code
            END AS sender_postal_code,
            c_receiver.user_id AS receiver_user_id, 
            c_receiver.postal_name AS receiver_postal_name, 
            c_receiver.street_name AS receiver_street_name,
            c_receiver.town AS receiver_town,
            c_receiver.district AS receiver_district ,
            c_receiver.postal_code AS receiver_postal_code 
        FROM orders o 
        JOIN books b ON o.book_id = b.book_id 
        LEFT JOIN publishers p ON b.publisher_id = p.publisher_id 
        LEFT JOIN customers c_sender ON b.customer_id = c_sender.customer_id
        LEFT JOIN customers c_receiver ON o.customer_id = c_receiver.customer_id 
        WHERE o.status = "processing"');
    
        return $this->db->resultSet();
    }
    
    public function findBookShippingOrders() {
        $this->db->query('SELECT 
            o.order_id, 
            o.status,
            o.quantity,
            o.total_weight, 
            b.book_id, 
            b.type AS book_type, 
            CASE 
                WHEN b.type = "new" THEN p.postal_name
                WHEN b.type IN ("exchanged", "used") THEN c_sender.postal_name
            END AS sender_postal_name, 
            CASE 
                WHEN b.type = "new" THEN p.street_name
                WHEN b.type IN ("exchanged", "used") THEN c_sender.street_name
            END AS sender_street_name,
            CASE 
                WHEN b.type = "new" THEN p.town
                WHEN b.type IN ("exchanged", "used") THEN c_sender.town
            END AS sender_town, 
            CASE 
                WHEN b.type = "new" THEN p.district
                WHEN b.type IN ("exchanged", "used") THEN c_sender.district
            END AS sender_district, 
            CASE 
                WHEN b.type = "new" THEN p.postal_code
                WHEN b.type IN ("exchanged", "used") THEN c_sender.postal_code
            END AS sender_postal_code, 
            c_receiver.postal_name AS receiver_postal_name, 
            c_receiver.street_name AS receiver_street_name,
            c_receiver.town AS receiver_town,
            c_receiver.district AS receiver_district ,
            c_receiver.postal_code AS receiver_postal_code 
        FROM orders o 
        JOIN books b ON o.book_id = b.book_id 
        LEFT JOIN publishers p ON b.publisher_id = p.publisher_id 
        LEFT JOIN customers c_sender ON b.customer_id = c_sender.customer_id
        LEFT JOIN customers c_receiver ON o.customer_id = c_receiver.customer_id 
        WHERE o.status = "shipping"');
    
        return $this->db->resultSet();
    }
    
    public function findBookDeliveredOrders() {
        $this->db->query('SELECT 
            o.order_id, 
            o.status,
            o.quantity,
            o.total_weight, 
            b.book_id, 
            b.type AS book_type, 
            CASE 
                WHEN b.type = "new" THEN p.postal_name
                WHEN b.type IN ("exchanged", "used") THEN c_sender.postal_name
            END AS sender_postal_name, 
            CASE 
                WHEN b.type = "new" THEN p.street_name
                WHEN b.type IN ("exchanged", "used") THEN c_sender.street_name
            END AS sender_street_name,
            CASE 
                WHEN b.type = "new" THEN p.town
                WHEN b.type IN ("exchanged", "used") THEN c_sender.town
            END AS sender_town, 
            CASE 
                WHEN b.type = "new" THEN p.district
                WHEN b.type IN ("exchanged", "used") THEN c_sender.district
            END AS sender_district, 
            CASE 
                WHEN b.type = "new" THEN p.postal_code
                WHEN b.type IN ("exchanged", "used") THEN c_sender.postal_code
            END AS sender_postal_code, 
            c_receiver.postal_name AS receiver_postal_name, 
            c_receiver.street_name AS receiver_street_name,
            c_receiver.town AS receiver_town,
            c_receiver.district AS receiver_district ,
            c_receiver.postal_code AS receiver_postal_code 
        FROM orders o 
        JOIN books b ON o.book_id = b.book_id 
        LEFT JOIN publishers p ON b.publisher_id = p.publisher_id 
        LEFT JOIN customers c_sender ON b.customer_id = c_sender.customer_id
        LEFT JOIN customers c_receiver ON o.customer_id = c_receiver.customer_id 
        WHERE o.status = "delivered"');
    
        return $this->db->resultSet();
    }
    
    public function findBookReturnedOrders() {
        $this->db->query('SELECT 
            o.order_id, 
            o.status,
            o.quantity,
            o.total_weight, 
            b.book_id, 
            b.type AS book_type, 
            CASE 
                WHEN b.type = "new" THEN p.postal_name
                WHEN b.type IN ("exchanged", "used") THEN c_sender.postal_name
            END AS sender_postal_name, 
            CASE 
                WHEN b.type = "new" THEN p.street_name
                WHEN b.type IN ("exchanged", "used") THEN c_sender.street_name
            END AS sender_street_name,
            CASE 
                WHEN b.type = "new" THEN p.town
                WHEN b.type IN ("exchanged", "used") THEN c_sender.town
            END AS sender_town, 
            CASE 
                WHEN b.type = "new" THEN p.district
                WHEN b.type IN ("exchanged", "used") THEN c_sender.district
            END AS sender_district, 
            CASE 
                WHEN b.type = "new" THEN p.postal_code
                WHEN b.type IN ("exchanged", "used") THEN c_sender.postal_code
            END AS sender_postal_code, 
            c_receiver.postal_name AS receiver_postal_name, 
            c_receiver.street_name AS receiver_street_name,
            c_receiver.town AS receiver_town,
            c_receiver.district AS receiver_district ,
            c_receiver.postal_code AS receiver_postal_code 
        FROM orders o 
        JOIN books b ON o.book_id = b.book_id 
        LEFT JOIN publishers p ON b.publisher_id = p.publisher_id 
        LEFT JOIN customers c_sender ON b.customer_id = c_sender.customer_id
        LEFT JOIN customers c_receiver ON o.customer_id = c_receiver.customer_id 
        WHERE o.status = "returned"');
    
        return $this->db->resultSet();
    }

    public function countOrders($publisher_id){    
        $this->db->query('SELECT COUNT(*) as orderCount FROM orders 
                          INNER JOIN books ON orders.book_id = books.book_id
                          WHERE books.publisher_id = :publisher_id ');
        $this->db->bind(':publisher_id', $publisher_id);
        $result = $this->db->single();
        
        if ($result) {
            return $result->orderCount;
        } else {
            return 0; 
        }
    }
    public function countReturnedOrders($publisher_id){    
        $this->db->query('SELECT COUNT(*) as orderCount FROM orders 
                          INNER JOIN books ON orders.book_id = books.book_id
                          WHERE books.publisher_id = :publisher_id AND orders.status="returned"');
        $this->db->bind(':publisher_id', $publisher_id);
        $result = $this->db->single();
        
        if ($result) {
            return $result->orderCount;
        } else {
            return 0; 
        }
    }
    public function countProOrders($publisher_id){    
        $this->db->query('SELECT COUNT(*) as orderCount FROM orders 
                          INNER JOIN books ON orders.book_id = books.book_id
                          WHERE books.publisher_id = :publisher_id AND orders.status="processing"');
        $this->db->bind(':publisher_id', $publisher_id);
        $result = $this->db->single();
        
        if ($result) {
            return $result->orderCount;
        } else {
            return 0; 
        }
    }
    public function countDelOrders($publisher_id){    
        $this->db->query('SELECT COUNT(*) as orderCount FROM orders 
                          INNER JOIN books ON orders.book_id = books.book_id
                          WHERE books.publisher_id = :publisher_id AND orders.status="delivered"');
        $this->db->bind(':publisher_id', $publisher_id);
        $result = $this->db->single();
        
        if ($result) {
            return $result->orderCount;
        } else {
            return 0; 
        }
    }
    public function countShipOrders($publisher_id){    
        $this->db->query('SELECT COUNT(*) as orderCount FROM orders 
                          INNER JOIN books ON orders.book_id = books.book_id
                          WHERE books.publisher_id = :publisher_id AND orders.status="shipping"');
        $this->db->bind(':publisher_id', $publisher_id);
        $result = $this->db->single();
        
        if ($result) {
            return $result->orderCount;
        } else {
            return 0; 
        }
    }
    

    
  }