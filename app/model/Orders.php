<?php 
  class Orders{
    private $db;
    public function __construct(){
        $this->db = new Database;
    }


   
    public function findNewBookOrdersByOrderId($order_id) {
        $this->db->query('SELECT od.status AS status,od.quantity AS quantity, b.*, o.*
                          FROM order_details od
                          JOIN books b ON od.book_id = b.book_id
                          JOIN orders o ON od.order_id = o.order_id
                          WHERE od.order_id = :order_id AND b.type = "new" GROUP BY od.order_id, od.book_id');
        $this->db->bind(':order_id', $order_id);
    
        return $this->db->resultSet();
    }
    
    
    public function findNewBookProOrdersBypubId($publisher_id) {
        $this->db->query('SELECT od.*, b.*,o.*, p.name AS publisher_name, c.name AS customer_name,od.quantity as quantity
                          FROM order_details od
                          JOIN orders o ON od.order_id = o.order_id
                          JOIN books b ON od.book_id = b.book_id
                          LEFT JOIN publishers p ON b.publisher_id = p.publisher_id
                          LEFT JOIN customers c ON o.customer_id = c.customer_id
                          WHERE b.publisher_id = :publisher_id AND od.status = "processing" AND b.type = "new" GROUP BY od.order_id, od.book_id');
        $this->db->bind(':publisher_id', $publisher_id);
    
        return $this->db->resultSet();
    }
    
    public function findNewBookShippingOrdersBypubId($publisher_id) {
        $this->db->query('SELECT od.*, b.*,o.*, p.name AS publisher_name, c.name AS customer_name,od.quantity as quantity
                          FROM order_details od
                          JOIN orders o ON od.order_id = o.order_id
                          JOIN books b ON od.book_id = b.book_id
                          LEFT JOIN publishers p ON b.publisher_id = p.publisher_id
                          LEFT JOIN customers c ON o.customer_id = c.customer_id
                          WHERE b.publisher_id = :publisher_id AND od.status = "shipping" AND b.type = "new" GROUP BY od.order_id, od.book_id');
        $this->db->bind(':publisher_id', $publisher_id);
    
        return $this->db->resultSet();
    }
    
    public function findNewBookDeliveredOrdersBypubId($publisher_id) {
        $this->db->query('SELECT od.*, b.*,o.*, p.name AS publisher_name, c.name AS customer_name,od.quantity as quantity
                          FROM order_details od
                          JOIN orders o ON od.order_id = o.order_id
                          JOIN books b ON od.book_id = b.book_id
                          LEFT JOIN publishers p ON b.publisher_id = p.publisher_id
                          LEFT JOIN customers c ON o.customer_id = c.customer_id
                          WHERE b.publisher_id = :publisher_id AND od.status = "delivered" AND b.type = "new" GROUP BY od.order_id, od.book_id');
        $this->db->bind(':publisher_id', $publisher_id);
    
        return $this->db->resultSet();
    }
    
    public function findNewBookReturnedOrdersBypubId($publisher_id) {
        $this->db->query('SELECT od.*, b.*,o.*, p.name AS publisher_name, c.name AS customer_name,od.quantity as quantity
                          FROM order_details od
                          JOIN orders o ON od.order_id = o.order_id
                          JOIN books b ON od.book_id = b.book_id
                          LEFT JOIN publishers p ON b.publisher_id = p.publisher_id
                          LEFT JOIN customers c ON o.customer_id = c.customer_id
                          WHERE b.publisher_id = :publisher_id AND od.status = "returned" AND b.type = "new" GROUP BY od.order_id, od.book_id');
        $this->db->bind(':publisher_id', $publisher_id);
    
        return $this->db->resultSet();
    }
    
     
    
    public function findBookProOrders() {
        $this->db->query('SELECT 
                od.order_id, 
                od.status,
                od.quantity,
                o.total_weight, 
                od.book_id, 
                b.type AS book_type,
                CASE 
                    WHEN b.type = "new" THEN p.user_id
                    WHEN b.type IN ("exchanged", "used") THEN c_sender.user_id
                END AS sender_user_id,  
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
                o.c_postal_name AS receiver_postal_name, 
                o.c_street_name AS receiver_street_name,
                o.c_town AS receiver_town,
                o.c_district AS receiver_district,
                o.c_postal_code AS receiver_postal_code  
            FROM 
                order_details od 
            JOIN 
                orders o ON od.order_id = o.order_id
            JOIN 
                books b ON od.book_id = b.book_id 
            LEFT JOIN 
                publishers p ON b.publisher_id = p.publisher_id 
            LEFT JOIN 
                customers c_sender ON b.customer_id = c_sender.customer_id
            LEFT JOIN 
                customers c_receiver ON o.customer_id = c_receiver.customer_id 
            WHERE 
                od.status = "processing"
            GROUP BY 
                od.order_id, od.book_id');
    
        return $this->db->resultSet();
    }
    
    public function findBookShippingOrders() {
        $this->db->query('SELECT 
        od.order_id, 
        od.status,
        od.quantity,
        o.total_weight, 
        od.book_id, 
        b.type AS book_type, 
        CASE 
                    WHEN b.type = "new" THEN p.user_id
                    WHEN b.type IN ("exchanged", "used") THEN c_sender.user_id
                END AS sender_user_id,  
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
        o.c_postal_name AS receiver_postal_name, 
        o.c_street_name AS receiver_street_name,
        o.c_town AS receiver_town,
        o.c_district AS receiver_district,
        o.c_postal_code AS receiver_postal_code  
    FROM 
        order_details od 
    JOIN 
        orders o ON od.order_id = o.order_id
    JOIN 
        books b ON od.book_id = b.book_id 
    LEFT JOIN 
        publishers p ON b.publisher_id = p.publisher_id 
    LEFT JOIN 
        customers c_sender ON b.customer_id = c_sender.customer_id
    LEFT JOIN 
        customers c_receiver ON o.customer_id = c_receiver.customer_id 
    WHERE 
        od.status = "shipping"
    GROUP BY 
        od.order_id, od.book_id');
        return $this->db->resultSet();
    }
    
    
    public function findBookDeliveredOrders() {
       
        $this->db->query('SELECT 
                od.order_id, 
                od.status,
                od.quantity,
                o.total_weight, 
                od.book_id, 
                b.type AS book_type, 
                CASE 
                    WHEN b.type = "new" THEN p.user_id
                    WHEN b.type IN ("exchanged", "used") THEN c_sender.user_id
                END AS sender_user_id,  
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
                o.c_postal_name AS receiver_postal_name, 
                o.c_street_name AS receiver_street_name,
                o.c_town AS receiver_town,
                o.c_district AS receiver_district,
                o.c_postal_code AS receiver_postal_code  
            FROM 
                order_details od 
            JOIN 
                orders o ON od.order_id = o.order_id
            JOIN 
                books b ON od.book_id = b.book_id 
            LEFT JOIN 
                publishers p ON b.publisher_id = p.publisher_id 
            LEFT JOIN 
                customers c_sender ON b.customer_id = c_sender.customer_id
            LEFT JOIN 
                customers c_receiver ON o.customer_id = c_receiver.customer_id 
            WHERE 
                od.status = "delivered"
            GROUP BY 
                od.order_id, od.book_id');
        return $this->db->resultSet();
    }
    
    public function findBookReturnedOrders() {
       
        $this->db->query('SELECT 
                od.order_id, 
                od.status,
                od.quantity,
                o.total_weight, 
                od.book_id, 
                b.type AS book_type, 
                CASE 
                    WHEN b.type = "new" THEN p.user_id
                    WHEN b.type IN ("exchanged", "used") THEN c_sender.user_id
                END AS sender_user_id,  
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
                o.c_postal_name AS receiver_postal_name, 
                o.c_street_name AS receiver_street_name,
                o.c_town AS receiver_town,
                o.c_district AS receiver_district,
                o.c_postal_code AS receiver_postal_code  
            FROM 
                order_details od 
            JOIN 
                orders o ON od.order_id = o.order_id
            JOIN 
                books b ON od.book_id = b.book_id 
            LEFT JOIN 
                publishers p ON b.publisher_id = p.publisher_id 
            LEFT JOIN 
                customers c_sender ON b.customer_id = c_sender.customer_id
            LEFT JOIN 
                customers c_receiver ON o.customer_id = c_receiver.customer_id 
            WHERE 
                od.status = "returned"
            GROUP BY 
                od.order_id, od.book_id');
    
        return $this->db->resultSet();
    }

    public function countOrders($publisher_id){    
        $this->db->query('SELECT COUNT(*) as orderCount FROM order_details 
                          INNER JOIN books ON order_details.book_id = books.book_id
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
        $this->db->query('SELECT COUNT(*) as orderCount  FROM order_details 
        INNER JOIN books ON order_details.book_id = books.book_id
                          WHERE books.publisher_id = :publisher_id AND order_details.status="returned"');
        $this->db->bind(':publisher_id', $publisher_id);
        $result = $this->db->single();
        
        if ($result) {
            return $result->orderCount;
        } else {
            return 0; 
        }
    }
    public function countProOrders($publisher_id){    
        $this->db->query('SELECT COUNT(*) as orderCount  FROM order_details 
        INNER JOIN books ON order_details.book_id = books.book_id
                          WHERE books.publisher_id = :publisher_id AND order_details.status="processing"');
        $this->db->bind(':publisher_id', $publisher_id);
        $result = $this->db->single();
        
        if ($result) {
            return $result->orderCount;
        } else {
            return 0; 
        }
    }
    public function countDelOrders($publisher_id){    
        $this->db->query('SELECT COUNT(*) as orderCount FROM order_details 
                        INNER JOIN books ON order_details.book_id = books.book_id
                        WHERE books.publisher_id = :publisher_id AND order_details.status="delivered"');
        $this->db->bind(':publisher_id', $publisher_id);
        $result = $this->db->single();
        
        if ($result) {
            return $result->orderCount;
        } else {
            return 0; 
        }
    }
    
    public function countShipOrders($publisher_id){    
        $this->db->query('SELECT COUNT(*) as orderCount FROM order_details 
                            INNER JOIN books ON order_details.book_id = books.book_id
                          WHERE books.publisher_id = :publisher_id AND order_details.status="shipping"');
        $this->db->bind(':publisher_id', $publisher_id);
        $result = $this->db->single();
        
        if ($result) {
            return $result->orderCount;
        } else {
            return 0; 
        }
    }

    public function findOrdersByTracking($trackingNumber) {
        $this->db->query('SELECT 
            od.order_id, 
            od.status,
            od.quantity,
            o.total_weight,
            o.payment_type, 
            b.book_id,
            b.book_name,
            b.img1,
            b.img2, 
            o.c_postal_name AS receiver_postal_name, 
            o.c_street_name AS receiver_street_name,
            o.c_town AS receiver_town,
            o.c_district AS receiver_district ,
            o.c_postal_code AS receiver_postal_code  
        FROM order_details od 
        JOIN orders o ON od.order_id = o.order_id
        JOIN books b ON od.book_id = b.book_id 
        WHERE o.tracking_no = :tracking_no');
        $this->db->bind(':tracking_no', $trackingNumber);
    
        return $this->db->resultSet();
    }
    
    public function trackingNumberExists($trackingNumber) {
        $this->db->query('SELECT tracking_no FROM orders WHERE tracking_no = :tracking_no');
        $this->db->bind(':tracking_no', $trackingNumber);
        $this->db->execute();
    
        return $this->db->rowCount() > 0;
    }

    public function findOrdersByCustomerId($customer_id) {
        $this->db->query('SELECT * FROM orders 
                          
                          WHERE customer_id=:customer_id ');
        $this->db->bind(':customer_id', $customer_id);
    
        return $this->db->resultSet();
    }


public function getUserOrderHistoryWithBooks($customer_id)
{
    // Check orders table
    $this->db->query('SELECT books.category, COUNT(*) as order_count
                      FROM orders
                      INNER JOIN books ON orders.book_id = books.book_id
                      WHERE orders.customer_id = :customer_id
                      GROUP BY books.category
                      ORDER BY order_count DESC');
    $this->db->bind(':customer_id', $customer_id);
    $categoriesFromOrders = $this->db->resultSet();
    
    // If no orders, retrieve books from any category in the orders table
    if (empty($categoriesFromOrders)) {
        $this->db->query('SELECT books.category, COUNT(*) as order_count
                          FROM cart
                          INNER JOIN books ON cart.book_id = books.book_id
                          GROUP BY books.category
                          ORDER BY order_count DESC
                          LIMIT 1');
        $categoriesFromOrders = $this->db->resultSet();
    }

    // Retrieve books for each category from orders
    $booksResult = array();

    foreach ($categoriesFromOrders as $categoryInfo) {
        $category = $categoryInfo->category;
        $this->db->query('SELECT *
                          FROM books
                          WHERE category = :category');
        $this->db->bind(':category', $category);
        $booksInCategory = $this->db->resultSet();

        if ($booksInCategory) {
            $booksResult[$category] = $booksInCategory;
        }
    }

    return $booksResult;
}


public function getOrderById($order_id) {
    $this->db->query('SELECT o.*, 
        b.book_name AS book_name, 
        cu.first_name AS first_name, 
        cu.last_name AS last_name, 
        cu.email AS email, 
        b.type AS type, 
        b.img1 AS img1,
        cu.*
    FROM order_details od
    INNER JOIN orders o ON od.order_id = o.order_id
    INNER JOIN books b ON od.book_id = b.book_id
    INNER JOIN customers cu ON o.customer_id = cu.customer_id
    WHERE o.order_id = :order_id');

    $this->db->bind(':order_id', $order_id);

    return $this->db->resultSet();
}

public function addOrderDetails($order_id, $book_id, $quantity) {
    $sql = 'INSERT INTO order_details (order_id, book_id, quantity,status) VALUES (:order_id, :book_id, :quantity, :status)';
   
    $this->db->query($sql);
    $this->db->bind(':order_id', $order_id);
    $this->db->bind(':book_id', $book_id);
    $this->db->bind(':quantity', $quantity);
    $this->db->bind(':status',"pending");

    // Execute the query
    if($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}

public function getOrderDetailsFromOrderDetailsById($order_id){
    $this->db->query('SELECT book_id FROM order_details WHERE order_id = :order_id;
    ');
    $this->db->bind(':order_id', $order_id);
    return $this->db->resultSet();

}



    
  }