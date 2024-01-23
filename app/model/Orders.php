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
            o.c_postal_name AS receiver_postal_name, 
            o.c_street_name AS receiver_street_name,
            o.c_town AS receiver_town,
            o.c_district AS receiver_district ,
            o.c_postal_code AS receiver_postal_code 
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
            c_receiver.user_id AS receiver_user_id, 
            o.c_postal_name AS receiver_postal_name, 
            o.c_street_name AS receiver_street_name,
            o.c_town AS receiver_town,
            o.c_district AS receiver_district ,
            o.c_postal_code AS receiver_postal_code  
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
            c_receiver.user_id AS receiver_user_id, 
            o.c_postal_name AS receiver_postal_name, 
            o.c_street_name AS receiver_street_name,
            o.c_town AS receiver_town,
            o.c_district AS receiver_district ,
            o.c_postal_code AS receiver_postal_code 
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
            c_receiver.user_id AS receiver_user_id, 
            o.c_postal_name AS receiver_postal_name, 
            o.c_street_name AS receiver_street_name,
            o.c_town AS receiver_town,
            o.c_district AS receiver_district ,
            o.c_postal_code AS receiver_postal_code  
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

    public function FindOrdersByTracking($trackingNumber){
        $this->db->query('SELECT 
            o.order_id, 
            o.status,
            o.quantity,
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
        FROM orders o 
        JOIN books b ON o.book_id = b.book_id 
       
        WHERE o.tracking_no = :tracking_no'); // corrected the WHERE clause
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


    // recommend books
   
    // }
//     public function getUserOrderHistoryWithBooks($customer_id)
// {
//     $this->db->query('SELECT books.category, COUNT(*) as order_count
//                       FROM orders
//                       INNER JOIN books ON orders.book_id = books.book_id
//                       WHERE orders.customer_id = :customer_id
//                       GROUP BY books.category
//                       ORDER BY order_count DESC');
//     $this->db->bind(':customer_id', $customer_id);
//     $categories = $this->db->resultSet();

//     $result = array();

//     foreach ($categories as $category) {
//         $this->db->query('SELECT *
//                           FROM books
//                           WHERE category = :category');
//         $this->db->bind(':category', $category->category); // Use -> instead of ['category']
//         $booksInCategory = $this->db->resultSet();
        
//         if ($booksInCategory) {
//             $result[$category->category] = $booksInCategory; // Use -> instead of ['category']
//         }
//     }
    

//     return $result;
// }

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
    $categoriesFromCart = array();
    // If no orders, check cart table
    if (empty($categoriesFromOrders)) {
        $this->db->query('SELECT books.category, COUNT(*) as order_count
                          FROM cart
                          INNER JOIN books ON cart.book_id = books.book_id
                          WHERE cart.customer_id = :customer_id
                          GROUP BY books.category
                          ORDER BY order_count DESC');
        $this->db->bind(':customer_id', $customer_id);
        $categoriesFromCart = $this->db->resultSet();

        // If no cart items, retrieve books from any category in the orders table
        if (empty($categoriesFromCart)) {
            $this->db->query('SELECT books.category, COUNT(*) as order_count
                              FROM orders
                              INNER JOIN books ON orders.book_id = books.book_id
                              GROUP BY books.category
                              ORDER BY order_count DESC
                              LIMIT 1');
            $categoriesFromOrders = $this->db->resultSet();
        }
    }

    // Combine categories from both sources
    $categories = array_merge($categoriesFromOrders, $categoriesFromCart);

    // Group and count categories across both tables
    $result = array();

    foreach ($categories as $category) {
        $result[$category->category]['order_count'] = 
            isset($result[$category->category]['order_count']) ? 
            $result[$category->category]['order_count'] + $category->order_count :
            $category->order_count;
    }

    // Sort categories based on the total order count
    usort($result, function($a, $b) {
        return $b['order_count'] - $a['order_count'];
    });

    // Retrieve books for each category
    $booksResult = array();

    foreach ($result as $category => $orderCount) {
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


    
//     public function getUserOrderHistory($customer_id)
// {
//     $this->db->query('SELECT books.category, COUNT(*) as order_count
//                       FROM orders
//                       INNER JOIN books ON orders.book_id = books.book_id
//                       WHERE orders.customer_id = :customer_id
//                       GROUP BY books.category
//                       ORDER BY order_count DESC');
//     $this->db->bind(':customer_id', $customer_id);

//     return $this->db->resultSet();
// }
// public function getUserCartContents($customer_id)
// {
//     $this->db->query('SELECT books.category, COUNT(*) as cart_count
//                       FROM cart
//                       INNER JOIN books ON cart.book_id = books.book_id
//                       WHERE cart.customer_id = :customer_id
//                       GROUP BY books.category
//                       ORDER BY cart_count DESC');
//     $this->db->bind(':customer_id', $customer_id);

//     return $this->db->resultSet();
// }
// public function getRecommendedCategories($customer_id)
// {
//     $orderHistory = $this->getUserOrderHistory($customer_id);
//     $cartContents = $this->getUserCartContents($customer_id);

//     $combinedData = [];

//     // Merge order and cart data
//     foreach ($orderHistory as $order) {
//         $combinedData[$order->category]['order_count'] = $order->order_count;
//         $combinedData[$order->category]['cart_count'] = 0;
//     }

//     foreach ($cartContents as $cart) {
//         if (!isset($combinedData[$cart->category])) {
//             $combinedData[$cart->category]['order_count'] = 0;
//         }
//         $combinedData[$cart->category]['cart_count'] = $cart->cart_count;
//     }

//     // Sort categories by the total count (order_count + cart_count)
//     usort($combinedData, function ($a, $b) {
//         $countA = $a['order_count'] + $a['cart_count'];
//         $countB = $b['order_count'] + $b['cart_count'];
//         return $countB - $countA;
//     });

//     // Extract category names
//     $recommendedCategories = array_keys($combinedData);

//     return $recommendedCategories;
// }

// public function getRecommendedBooks($recommendedCategories)
// {
//     // Generate placeholders for binding
//     $placeholders = rtrim(str_repeat('?, ', count($recommendedCategories)), ', ');

//     // SQL query with placeholders
//     $query = "SELECT * FROM books
//               WHERE category IN ($placeholders)
//               ORDER BY FIELD(category, $placeholders), created_at DESC
//               LIMIT 5";

//     // Set the query in the Database class
//     $this->db->query($query);

//     // Bind parameters
//     foreach ($recommendedCategories as $index => $category) {
//         // Index starts from 1
//         $paramName = ":category$index";
//         $this->db->bind($paramName, $category);
//     }

//     // Execute and return the result set
//     return $this->db->resultSet();
// }

    
// public function getRecommendedBooks($recommendedCategories)
// {
//     // Retrieve books from recommended categories
//     $placeholders = rtrim(str_repeat(':category, ', count($recommendedCategories)), ', ');
//     $query = "SELECT * FROM books
//               WHERE category IN ($placeholders)
//               ORDER BY FIELD(category, $placeholders), created_at DESC
//               LIMIT 5";

//     $this->db->query($query);

//     // Bind parameters
//     foreach ($recommendedCategories as $index => $category) {
//         $paramName = ":category{$index}";
//         $this->db->bind($paramName, $category);
//     }

//     return $this->db->resultSet();
// }



     

    
  }