<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require APPROOT . '\vendor\autoload.php';
class Customer extends Controller {
    private $customerModel;
    private $deliveryModel;
    private $publisherModel;
    private $ordersModel;
    private $userModel;
    private $adminModel;
  
    private $db;
    public function __construct(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        }
        $this->customerModel=$this->model('Customers');
        $this->deliveryModel=$this->model('Deliver');
        $this->userModel=$this->model('User');
        $this->ordersModel=$this->model('Orders');
        $this->publisherModel=$this->model('Publishers')  ;
        $this->adminModel=$this->model('Admins')  ;
        $this->db = new Database();
    }
    public function comment() {
        if (!isLoggedIn()) {
            redirect('landing/login');
        }

        $user_id = $_SESSION['user_id'];
        $customerDetails = $this->customerModel->findCustomerById($user_id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => $customerDetails[0]->name,
                'comment' => trim($_POST['comment']),
                'parentComment' => trim($_POST['parentComment']),
                'comment_err' => '',
            ];

            if (empty($data['comment'])) {
                $data['comment_err'] = 'Please enter a comment';
            }

            if (empty($data['comment_err'])) {
                if ($this->customerModel->addComment($data)) {
                    flash('Successfully Added');
                    redirect('customer/comment');
                } else {
                    die('Something went wrong');
                }
            } else {
                $this->view('customer/comment', $data);
            }
        } else {
            $data = [
                'comment' => '',
                'parentComment' => '',
                'comment_err' => '',
            ];

            $this->view('customer/comment', $data);
        }
    }

    public function getComments() {
        header('Content-Type: application/json');
        $comments = $this->customerModel->getComments();
        echo json_encode($comments);
    }
    
    public function purchase($book_id) {
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            
            $user_id = $_SESSION['user_id'];
            $bookDetails=$this->customerModel->findBookById($book_id);
            $customerDetails = $this->customerModel->findCustomerById($user_id); 
            $deliveryDetails=$this->deliveryModel->finddeliveryCharge(); 
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    // sanitize post data
                $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
                $data=[
                    'book_id'=>$book_id,
                    'customer_id' => $customerDetails[0]->customer_id,
                    'postal_name' => trim($_POST['postal_name']),
                    'street_name' => trim($_POST['street_name']),
                    'town' => trim($_POST['town']),
                    'district' => trim($_POST['district']),
                    'postal_code' => trim($_POST['postal_code']),
                    'contact_no'=>trim($_POST['contact_no']),
                    'total_cost' => trim($_POST['totalCost']),
                    'total_weight'=>trim($_POST['totalWeight']),
 
                    'quantity' => trim($_POST['quantity']), 
                    'postal_name_err' => '',
                    'street_name_err' => '',
                    'town_err' => '',
                    'district_err' => '',
                    'postal_code_err' => '',
                    'contact_no_err'=>''

                ];
                // var_dump($data);
                 
                if(empty($data['postal_name'])){
                    $data['postal_name_err']='Please enter the  name';      
                }
                
                if(empty($data['street_name'])){
                    $data['street_name_err']='Please enter street name';      

                }
                
                if(empty($data['town'])){
                    $data['town_err']='Please enter the town';      
                }
                if(empty($data['contact_no'])){
                    $data['contact_no_err']='Please enter the contact number';      
                }else if(strlen($data['contact_no'])<10){
                    $data['contact_no_err']='Please enter a valid contact number';
                }
                if(empty($data['district'])){
                    $data['district_err']='Please select the district';      
                }
                if(empty($data['postal_code'])){
                    $data['postal_code_err']='Please enter the postal code';      
                }

                if( empty($data['postal_name_err']) && empty($data['street_name_err']) && empty($data['town_err']) &&empty($data['district_err']) && empty($data['postal_code_err'])  && empty($data['contact_no_err'])   ){  
                    // print_r($data);
                    if($this->customerModel->addOrder($data)){
                        $orderId = $this->customerModel-> getLastInsertedOrderId();
                        redirect('customer/checkout2/'.$orderId);
                    }else{
                      echo  '<script>alert("Error")</script>';
                    }

                }else{
                    
                    echo  '<script>alert("Error")</script>';
                    }
        
              
            } else {
                // Your existing code for displaying the form
                $customerDetails = $this->customerModel->findCustomerById($user_id);
               
                 if($customerDetails)   {
                    $data = [
                        'deliveryDetails'=>$deliveryDetails,
                        'bookDetails'=>$bookDetails,
                        'book_id'=>$book_id,
                        'postal_name' => $customerDetails[0]->postal_name,
                        'street_name' => $customerDetails[0]->street_name,
                        'town' => $customerDetails[0]->town,
                        'district' => $customerDetails[0]->district,
                        'postal_code' => $customerDetails[0]->postal_code,
                        'contact_no'=>'',
                        'contact_no_err'=>'',
                        'postal_name_err'=>'',
                        'street_name_err'=>'',
                        'town_err'=>'',
                        'district_err'=>'',
                        'postal_code_err'=>'',
                        'customerDetails' => $customerDetails,
                        'customerName' => $customerDetails[0]->name
                    ];
                 }  else{
                    echo "Not found data";
                 }  
                
                // print_r($data);
            $this->view('customer/purchase',$data);
        }
    }
}

   
    public function index(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/index', $data);
        }
    }
    public function AboutUs(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/AboutUs', $data);
        }
    } 
    public function AddCont(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/AddCont', $data);
        }
    } 
    
    public function Addevnt(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/Addevnt', $data);
        }
    } 

    public function AddExchangeBook(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } 
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            $customerid = null;
    
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                
                $customerDetails = $this->customerModel->findCustomerById($user_id);
                // $bookCategoryDetails = $this->adminModel->getBookCategories();
                if ($customerDetails) {
                    $customerName = $customerDetails[0]->name;
                    $customerid = $customerDetails[0]->customer_id;                 
                } else {
                    echo "Not found";
                }
            }            
            $data=[
                'book_name' => trim($_POST['bookName']),
                'ISBN_no' => trim($_POST['isbnNumber']),
                'author' => trim($_POST['author']),
                'category' => trim($_POST['category']),
                'weight' => trim($_POST['weights']),
                'descript' => trim($_POST['description1']),
                'booksIWant' => trim($_POST['description2']),
                'img1' => '',
                'img2' => '',
                'img3' => '',
                'condition' => trim($_POST['bookCondition']),
                'published_year' => trim($_POST['publishedYear']),
                'type' => trim('exchanged'),
                'town' => trim($_POST['town']),
                'district' => trim($_POST['district']),
                'postal_code' => trim($_POST['postalCode']),
                'customer_id' => trim($customerid),// Replace this with the actual customer ID
                'status' => trim('pending'),

                'bookName_err' => '',
                'publishedYear_err'=>'',
                'weights_err'=>'',
                'ISBN_err'=>'',
                'customerName' => $customerName
            ];

            if(empty($data['published_year'])){
                $data['publishedYear_err']='Please enter published year';      
            }
            if(empty($data['weight'])){
                $data['weights_err']='Please enter the weight';      
            }else if($data['weight']<0 ){
                $data['weights_err']='Please enter a valid weight'; 
            }

            if(empty($data['bookName_err']) && empty($data['publishedYear_err']) && empty($data['price_err']) && empty($data['weights_err']) && empty($data['ISBN_err'])){

                //image
                if (isset($_FILES['imgFront']['name']) AND !empty($_FILES['imgFront']['name'])) {
                    $img_name = $_FILES['imgFront']['name'];
                    $tmp_name = $_FILES['imgFront']['tmp_name'];
                    $error = $_FILES['imgFront']['error'];
                    
                    if ($error === 0) {
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_to_lc = strtolower($img_ex);
                
                        $allowed_exs = array('jpg', 'jpeg', 'png');
                        if (in_array($img_ex_to_lc, $allowed_exs)) {
                            // Generate a unique identifier (e.g., timestamp)
                            $unique_id = time(); 
                            $new_img_name = $data['book_name'] . '-' . $unique_id . '-imgFront.' . $img_ex_to_lc;
                            $img_upload_path = "../public/assets/images/customer/AddExchangeBook/" . $new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path);
                
                            $data['img1'] = $new_img_name;
                        }
                    }
                }
                

                if (isset($_FILES['imgBack']['name']) AND !empty($_FILES['imgBack']['name'])) {
                    $img_name = $_FILES['imgBack']['name'];
                    $tmp_name = $_FILES['imgBack']['tmp_name'];
                    $error = $_FILES['imgBack']['error'];
                    
                    if($error === 0){
                       $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                       $img_ex_to_lc = strtolower($img_ex);
           
                       $allowed_exs = array('jpg', 'jpeg', 'png');
                       if(in_array($img_ex_to_lc, $allowed_exs)){
                          // Generate a unique identifier (e.g., timestamp)
                          $unique_id = time(); 
                          $new_img_name = $data['book_name'] . '-' . $unique_id . '-imgBack.' . $img_ex_to_lc;
                          $img_upload_path = "../public/assets/images/customer/AddExchangeBook/".$new_img_name;
                          move_uploaded_file($tmp_name, $img_upload_path);

                          $data['img2']=$new_img_name;
                       }
                    }
                }
                if (isset($_FILES['imgInside']['name']) AND !empty($_FILES['imgInside']['name'])) {
                    $img_name = $_FILES['imgInside']['name'];
                    $tmp_name = $_FILES['imgInside']['tmp_name'];
                    $error = $_FILES['imgInside']['error'];
                    
                    if($error === 0){
                       $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                       $img_ex_to_lc = strtolower($img_ex);
           
                       $allowed_exs = array('jpg', 'jpeg', 'png');
                       if(in_array($img_ex_to_lc, $allowed_exs)){
                          // Generate a unique identifier (e.g., timestamp)
                          $unique_id = time(); 
                          $new_img_name = $data['book_name'] . '-' . $unique_id . '-imgInside.' . $img_ex_to_lc;
                          $img_upload_path = "../public/assets/images/customer/AddExchangeBook/".$new_img_name;
                          move_uploaded_file($tmp_name, $img_upload_path);

                          $data['img3']=$new_img_name;
                       }
                    }
                }
                
                if($this->customerModel->AddExchangeBook($data)){
                    // flash('add_success','You are added the book  successfully');
                    redirect('customer/ExchangeBooks');
                }else{
                    die('Something went wrong');
                }
            }else{
                $this->view('customer/AddExchangeBook',$data);
            }


        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/AddExchangeBook', $data);
        }
    } 
    
    public function AddUsedBook(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } 
        if($_SERVER['REQUEST_METHOD']=='POST'){
            // process form
            // sanitize post data
            $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            $customerid = null;
    
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                
                $customerDetails = $this->customerModel->findCustomerById($user_id);
                // $bookCategoryDetails = $this->adminModel->getBookCategories();
                if ($customerDetails) {
                    $customerName = $customerDetails[0]->name;
                    $customerid = $customerDetails[0]->customer_id;                 
                } else {
                    echo "Not found";
                }
            }            
            $data=[
                'book_name' => trim($_POST['bookName']),
                'ISBN_no' => trim($_POST['isbnNumber']),
                // 'ISSN_no' => trim($_POST['issnNumber']),
                // 'ISMN_no' => trim($_POST['issmNumber']),
                'author' => trim($_POST['author']),
                'price' => trim($_POST['price']),
                'category' => trim($_POST['category']),
                'weight' => trim($_POST['weights']),
                'descript' => trim($_POST['descriptions']),
                'img1' => '',
                'img2' => '',
                'img3' => '',
                'condition' => trim($_POST['bookCondition']),
                'published_year' => trim($_POST['publishedYear']),
                'price_type' => trim($_POST['priceType']),
                'type' => trim('used'),
                'account_name' => trim($_POST['accName']),
                'account_no' => trim($_POST['accNumber']),
                'bank_name' => trim($_POST['bankName']),
                'branch_name' => trim($_POST['branchName']),
                'town' => trim($_POST['town']),
                'district' => trim($_POST['district']),
                'postal_code' => trim($_POST['postalCode']),
                'customer_id' => trim($customerid),// Replace this with the actual customer ID
                'status' => trim('pending'),

                'bookName_err' => '',
                'publishedYear_err'=>'',
                'price_err'=>'',
                'weights_err'=>'',
                'ISBN_err'=>'',
                'customerName' => $customerName
            ];

           
            //validate book name
            // if(empty($data['bookName'])){
            //     $data['bookName_err']='Please enter the Book name';      
            // // }else{
            // //     if($this->publisherModel->findbookByName($data['book_name'])){
            // //         $data['book_name_err']='Book name is already taken'; 
            // //     }
            // }
            
            if(empty($data['published_year'])){
                $data['publishedYear_err']='Please enter published year';      
            }

            if(empty($data['price'])){
                $data['price_err']='Please enter the price';      
            }else if($data['price']<0 ){
                $data['price_err']='Please enter a valid price'; 
            }
            
            if(empty($data['weight'])){
                $data['weights_err']='Please enter the weight';      
            }else if($data['weight']<0 ){
                $data['weights_err']='Please enter a valid weight'; 
            }

            //validate ISBN
            // if(empty($data['ISBN_no']) && empty($data['ISSN_no']) && empty($data['ISMN_no'])){
            //     $data['ISBN_err']='Please enter ISBN _NO or ISSN_NO or ISSM_NO';      
            // }
           
            
            //make sure errors are empty
            if(empty($data['bookName_err']) && empty($data['publishedYear_err']) && empty($data['price_err']) && empty($data['weights_err']) && empty($data['ISBN_err'])){

                //image
                if (isset($_FILES['imgFront']['name']) AND !empty($_FILES['imgFront']['name'])) {
                    $img_name = $_FILES['imgFront']['name'];
                    $tmp_name = $_FILES['imgFront']['tmp_name'];
                    $error = $_FILES['imgFront']['error'];
                    
                    if ($error === 0) {
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_to_lc = strtolower($img_ex);
                
                        $allowed_exs = array('jpg', 'jpeg', 'png');
                        if (in_array($img_ex_to_lc, $allowed_exs)) {
                            // Generate a unique identifier (e.g., timestamp)
                            $unique_id = time(); 
                            $new_img_name = $data['book_name'] . '-' . $unique_id . '-imgFront.' . $img_ex_to_lc;
                            $img_upload_path = "../public/assets/images/customer/AddUsedBook/" . $new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path);
                
                            $data['img1'] = $new_img_name;
                        }
                    }
                }
                

                if (isset($_FILES['imgBack']['name']) AND !empty($_FILES['imgBack']['name'])) {
                    $img_name = $_FILES['imgBack']['name'];
                    $tmp_name = $_FILES['imgBack']['tmp_name'];
                    $error = $_FILES['imgBack']['error'];
                    
                    if($error === 0){
                       $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                       $img_ex_to_lc = strtolower($img_ex);
           
                       $allowed_exs = array('jpg', 'jpeg', 'png');
                       if(in_array($img_ex_to_lc, $allowed_exs)){
                          // Generate a unique identifier (e.g., timestamp)
                          $unique_id = time(); 
                          $new_img_name = $data['book_name'] . '-' . $unique_id . '-imgBack.' . $img_ex_to_lc;
                          $img_upload_path = "../public/assets/images/customer/AddUsedBook/".$new_img_name;
                          move_uploaded_file($tmp_name, $img_upload_path);

                          $data['img2']=$new_img_name;
                       }
                    }
                }
                if (isset($_FILES['imgInside']['name']) AND !empty($_FILES['imgInside']['name'])) {
                    $img_name = $_FILES['imgInside']['name'];
                    $tmp_name = $_FILES['imgInside']['tmp_name'];
                    $error = $_FILES['imgInside']['error'];
                    
                    if($error === 0){
                       $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                       $img_ex_to_lc = strtolower($img_ex);
           
                       $allowed_exs = array('jpg', 'jpeg', 'png');
                       if(in_array($img_ex_to_lc, $allowed_exs)){
                          // Generate a unique identifier (e.g., timestamp)
                          $unique_id = time(); 
                          $new_img_name = $data['book_name'] . '-' . $unique_id . '-imgInside.' . $img_ex_to_lc;
                          $img_upload_path = "../public/assets/images/customer/AddUsedBook/".$new_img_name;
                          move_uploaded_file($tmp_name, $img_upload_path);

                          $data['img3']=$new_img_name;
                       }
                    }
                }
                
                if($this->customerModel->AddUsedBook($data)){
                    // flash('add_success','You are added the book  successfully');
                    redirect('customer/UsedBooks');
                }else{
                    die('Something went wrong');
                }
            }else{
                $this->view('customer/AddUsedBook',$data);
            }


        }else{
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                
                $customerDetails = $this->customerModel->findCustomerById($user_id);
                // $bookCategoryDetails = $this->adminModel->getBookCategories();
                if ($customerDetails) {
                    $accName = $customerDetails[0]->account_name;
                    $accNumber = $customerDetails[0]->account_no; 
                    $bankName = $customerDetails[0]->bank_name; 
                    $branchName = $customerDetails[0]->branch_name;
                    $town = $customerDetails[0]->town; 
                    $district = $customerDetails[0]->district;
                    $postalCode = $customerDetails[0]->postal_code;
                    $customerid = $customerDetails[0]->customer_id;
                    $customerName = $customerDetails[0]->name;

                } else {
                    echo "Not found";
                }
            }     
            $data=[
                'account_name' => trim($accName),
                'account_no' => trim($accNumber),
                'bank_name' => trim($bankName),
                'branch_name' => trim($branchName),
                'town' => trim($town),
                'district' => trim($district),
                'postal_code' => trim($postalCode),
                'customer_id' => trim($customerid),// Replace this with the actual customer ID
                'customerName' => $customerName
            ];

            $this->view('customer/AddUsedBook',$data);

        }
    } 
    
    public function BookContents(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/BookContents', $data);
        }
    } 
    
    public function BookDetails($book_id){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
            $bookDetails=$this->customerModel->findBookById($book_id);
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name,
                'bookDetails'=>$bookDetails
            ];
            $this->view('customer/BookDetails', $data);
        }
    } 
    
    public function BookEvents(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/BookEvents', $data);
        }
    } 
    
    public function Bookshelf(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $customerid = null;
        
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
            
                $customerDetails = $this->customerModel->findCustomerById($user_id);  
                
                if ($customerDetails) {
                    $customerid = $customerDetails[0]->customer_id;
                    $bookDetails1 = $this->customerModel->findUsedBookByCusId($customerid);
                    $bookDetails2 = $this->customerModel->findExchangedBookByCusId($customerid);
                } else {
                    echo "Not found";
                }
            } else {
                echo "Not a customer";
            }

            $data = [
                'customerid' => $customerid,
                'customerDetails' => $customerDetails,
                'bookDetails1' => $bookDetails1,
                'bookDetails2' => $bookDetails2,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/Bookshelf', $data);
        }
    } 
    
    public function BuyNewBooks(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id); 
            $bookDetails=$this->publisherModel->findNewBooks() ;
            // $bookCategoryDetails=$this->adminModel->getBookCategories();
            
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name,
                'bookDetails'=>$bookDetails,
                // 'bookCategoryDetails'=>$bookCategoryDetails
            ];
            $this->view('customer/BuyNewBooks', $data);
        }
    } 
    
    public function BuyUsedBook(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $customerid = null;

            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
            
                $customerDetails = $this->customerModel->findCustomerById($user_id);  
                if ($customerDetails) {
                    $customerid = $customerDetails[0]->customer_id;
                    $bookDetails = $this->customerModel->findUsedBookByNotCusId($customerid);
                } else {
                    echo "Not found";
                }
            } else {
                echo "Not a customer";
            }
                $data = [
                    'customerid' => $customerid,
                    'customerDetails' => $customerDetails,
                    'bookDetails' => $bookDetails,
                    'customerName' => $customerDetails[0]->name
                ];
                $this->view('customer/BuyUsedBook', $data);
        }
    } 
    public function addToCart($bookId) {
        $user_id = $_SESSION['user_id'];
        $customerDetails = $this->customerModel->findCustomerById($user_id);
        $customer_id=$customerDetails[0]->customer_id;
        $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;
        
        if ($bookId) {
            if ($this->customerModel->addToCart($bookId, $customer_id, $quantity)) {
                echo json_encode(['status' => 'success']);
                return;
            }
        }
    
        echo json_encode(['status' => 'error', 'message' => 'SQL Error: ' . $e->getMessage()]);

    }
    
    public function Cart(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];

           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $cartDetails=$this->customerModel->findCartById($customerDetails[0]->customer_id);
           
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name,
                'cartDetails'=>$cartDetails,
                
            ];
            
            $this->view('customer/Cart', $data);
        }
    } 
    
    public function ContactUs(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/ContactUs', $data);
        }
    } 
    
    public function Content(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/Content', $data);
        }
    } 
    
    public function Dashboard(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/Dashboard', $data);
        }
    } 
    
    public function DonateBooks(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/DonateBooks', $data);
        }
    } 

    public function Donatedetails(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/Donatedetails', $data);
        }
    } 

    public function Donateform(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/Donateform', $data);
        }
    } 

    // public function dropdownmenu(){

    //     $this->view('customer/dropdownmenu');
    // }

    public function Event(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/Event', $data);
        }
    } 

    public function ExchangeBook(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } 
        $customerid = null;
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            
            if ($customerDetails) {
                $customerid = $customerDetails[0]->customer_id;
                $bookDetails = $this->customerModel->findExchangedBookByNotCusId($customerid);
            } else {
                echo "Not found";
            }
        } else {
            echo "Not a customer";
        }
        $data = [
            'customerid' => $customerid,
            'customerDetails' => $customerDetails,
            'bookDetails' => $bookDetails,
            'customerName' => $customerDetails[0]->name
        ];
            $this->view('customer/ExchangeBook', $data);
    } 

    public function ExchangeBookDetails($bookId){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } 
        $customerid = null;
        
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            
            if ($customerDetails) {
                
                $customerid = $customerDetails[0]->customer_id;
                
                $bookDetails = $this->customerModel->findExchangedBookByCusId($customerid);
                $ExchangeBookId = $this->customerModel->findUsedBookById($bookId);

            } else {
                echo "Not found";
            }
        } else {
            echo "Not a customer";
        }

        $data = [
            'customerid' => $customerid,
            'customerDetails' => $customerDetails,
            'bookDetails' => $bookDetails,
            'ExchangeBookId' => $ExchangeBookId,
            'customerName' => $customerDetails[0]->name,

            'book_id' => $bookId,
            'book_name' => $ExchangeBookId->book_name,
            'ISBN_no' => $ExchangeBookId->ISBN_no,
            'author' => $ExchangeBookId->author,
            'category' => $ExchangeBookId->category,
            'weight' => $ExchangeBookId->weight,
            'descript' => $ExchangeBookId->descript,
            'booksIWant' => $ExchangeBookId->booksIWant,
            'img1' => $ExchangeBookId->img1,
            'img2' => $ExchangeBookId->img2,
            'img3' => $ExchangeBookId->img3,
            'condition' => $ExchangeBookId->condition,
            'published_year' => $ExchangeBookId->published_year,
            'town' => $ExchangeBookId->town,
            'district' => $ExchangeBookId->district,
            'postal_code' => $ExchangeBookId->postal_code
        ];
        $this->view('customer/ExchangeBookDetails', $data);
    } 

    public function ExchangeBooks(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } 
        $customerid = null;
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            
            if ($customerDetails) {
                $customerid = $customerDetails[0]->customer_id;
                $bookDetails = $this->customerModel->findExchangedBookByCusId($customerid);
            } else {
                echo "Not found";
            }
        } else {
            echo "Not a customer";
        }
        $data = [
            'customerid' => $customerid,
            'customerDetails' => $customerDetails,
            'bookDetails' => $bookDetails,
            'customerName' => $customerDetails[0]->name
        ];
            $this->view('customer/ExchangeBooks', $data);
    } 

    // public function index(){
        
    //     $this->view('customer/index');
    // } 

    public function Notification(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id); 
            $messageDetails = $this->publisherModel->findMessageByUserId($user_id); 
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name,
                'messageDetails'=>$messageDetails
            ];
            $this->view('customer/Notification', $data);
        }
    } 

    public function Profile(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name,
                'customerEmail' => $customerDetails[0]->email
            ];
            $this->view('customer/Profile', $data);
        }
    } 

    public function Services(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/Services', $data);
        }
    } 

    // public function sidebar(){

    //     $this->view('customer/sidebar');
    // }

    public function updateusedbook($bookId){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } 
        $user_id = $_SESSION['user_id'];
       
        $customerDetails = $this->customerModel->findCustomerById($user_id);
        $customer_id=$customerDetails[0]->customer_id;

        // $data = [
        //     'customerDetails' => $customerDetails,
        //     'customerName' => $customerDetails[0]->name
        // ];
        //     $this->view('customer/updateusedbook', $data);

        if($_SERVER['REQUEST_METHOD']=='POST'){
            // process form
            // sanitize post data
            $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);


                      
            $data=[
                'book_id'=>$bookId,
                'book_name' => trim($_POST['bookName']),
                'ISBN_no' => trim($_POST['isbnNumber']),
                // 'ISSN_no' => trim($_POST['issnNumber']),
                // 'ISMN_no' => trim($_POST['issmNumber']),
                'author' => trim($_POST['author']),
                'price' => trim($_POST['price']),
                'category' => trim($_POST['category']),
                'weight' => trim($_POST['weights']),
                'descript' => trim($_POST['descriptions']),
                'img1' => '',
                'img2' => '',
                'img3' => '',
                'condition' => trim($_POST['bookCondition']),
                'published_year' => trim($_POST['publishedYear']),
                'price_type' => trim($_POST['priceType']),
                'type' => trim('used'),
                'account_name' => trim($_POST['accName']),
                'account_no' => trim($_POST['accNumber']),
                'bank_name' => trim($_POST['bankName']),
                'branch_name' => trim($_POST['branchName']),
                'town' => trim($_POST['town']),
                'district' => trim($_POST['district']),
                'postal_code' => trim($_POST['postalCode']),
                'customer_id' => trim($customer_id),// Replace this with the actual customer ID
                'status' => trim('pending'),

                'bookName_err' => '',
                'publishedYear_err'=>'',
                'price_err'=>'',
                'weights_err'=>'',
                'ISBN_err'=>'',
                'customerName' => $customerDetails[0]->name
            ];

           
            //validate book name
            // if(empty($data['bookName'])){
            //     $data['bookName_err']='Please enter the Book name';      
            // // }else{
            // //     if($this->publisherModel->findbookByName($data['book_name'])){
            // //         $data['book_name_err']='Book name is already taken'; 
            // //     }
            // }
            
            if(empty($data['published_year'])){
                $data['publishedYear_err']='Please enter published year';      
            }

            if(empty($data['price'])){
                $data['price_err']='Please enter the price';      
            }else if($data['price']<0 ){
                $data['price_err']='Please enter a valid price'; 
            }
            
            if(empty($data['weight'])){
                $data['weights_err']='Please enter the weight';      
            }else if($data['weight']<0 ){
                $data['weights_err']='Please enter a valid weight'; 
            }

            //validate ISBN
            // if(empty($data['ISBN_no']) && empty($data['ISSN_no']) && empty($data['ISMN_no'])){
            //     $data['ISBN_err']='Please enter ISBN _NO or ISSN_NO or ISSM_NO';      
            // }
           
            
            //make sure errors are empty
            if(empty($data['bookName_err']) && empty($data['publishedYear_err']) && empty($data['price_err']) && empty($data['weights_err']) && empty($data['ISBN_err'])){

                //image
                if (isset($_FILES['imgFront']['name']) AND !empty($_FILES['imgFront']['name'])) {
                    $img_name = $_FILES['imgFront']['name'];
                    $tmp_name = $_FILES['imgFront']['tmp_name'];
                    $error = $_FILES['imgFront']['error'];
                    
                    if ($error === 0) {
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_to_lc = strtolower($img_ex);
                
                        $allowed_exs = array('jpg', 'jpeg', 'png');
                        if (in_array($img_ex_to_lc, $allowed_exs)) {
                            // Generate a unique identifier (e.g., timestamp)
                            $unique_id = time(); 
                            $new_img_name = $data['book_name'] . '-' . $unique_id . '-imgFront.' . $img_ex_to_lc;
                            $img_upload_path = "../public/assets/images/customer/AddUsedBook/" . $new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path);
                
                            $data['img1'] = $new_img_name;
                        }
                    }
                }
                
                

                if (isset($_FILES['imgBack']['name']) AND !empty($_FILES['imgBack']['name'])) {
                    $img_name = $_FILES['imgBack']['name'];
                    $tmp_name = $_FILES['imgBack']['tmp_name'];
                    $error = $_FILES['imgBack']['error'];
                    
                    if($error === 0){
                       $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                       $img_ex_to_lc = strtolower($img_ex);
           
                       $allowed_exs = array('jpg', 'jpeg', 'png');
                       if(in_array($img_ex_to_lc, $allowed_exs)){
                          // Generate a unique identifier (e.g., timestamp)
                          $unique_id = time(); 
                          $new_img_name = $data['book_name'] . '-' . $unique_id . '-imgBack.' . $img_ex_to_lc;
                          $img_upload_path = "../public/assets/images/customer/AddUsedBook/".$new_img_name;
                          move_uploaded_file($tmp_name, $img_upload_path);

                          $data['img2']=$new_img_name;
                       }
                    }
                }
                if (isset($_FILES['imgInside']['name']) AND !empty($_FILES['imgInside']['name'])) {
                    $img_name = $_FILES['imgInside']['name'];
                    $tmp_name = $_FILES['imgInside']['tmp_name'];
                    $error = $_FILES['imgInside']['error'];
                    
                    if($error === 0){
                       $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                       $img_ex_to_lc = strtolower($img_ex);
           
                       $allowed_exs = array('jpg', 'jpeg', 'png');
                       if(in_array($img_ex_to_lc, $allowed_exs)){
                          // Generate a unique identifier (e.g., timestamp)
                          $unique_id = time(); 
                          $new_img_name = $data['book_name'] . '-' . $unique_id . '-imgInside.' . $img_ex_to_lc;
                          $img_upload_path = "../public/assets/images/customer/AddUsedBook/".$new_img_name;
                          move_uploaded_file($tmp_name, $img_upload_path);

                          $data['img3']=$new_img_name;
                       }
                    }
                }
                
                if($this->customerModel->updateusedbook($data)){
                    // flash('update_success','You are added the book  successfully');
                    redirect('customer/UsedBooks');
                }else{
                    die('Something went wrong');
                }
                }else{
                    $this->view('customer/updateusedbook', $data);
                }


        }else{
            $UsedBookId = $this->customerModel->findUsedBookById($bookId);
            // $books = $this->publisherModel->findBookById($book_id);
            if($UsedBookId->customer_id != $customer_id){
                redirect('customer/UsedBooks');
              }
            $data = [
                // 'customerName'=>$customerName,
                'book_id' => $bookId,
                'book_name' => $UsedBookId->book_name,
                'ISBN_no' => $UsedBookId->ISBN_no,
                'author' => $UsedBookId->author,
                'price' => $UsedBookId->price,
                'category' => $UsedBookId->category,
                'weight' => $UsedBookId->weight,
                'descript' => $UsedBookId->descript,
                'img1' => $UsedBookId->img1,
                'img2' => $UsedBookId->img2,
                'img3' => $UsedBookId->img3,
                'condition' => $UsedBookId->condition,
                'published_year' => $UsedBookId->published_year,
                'price_type' => $UsedBookId->price_type,
                'account_name' => $UsedBookId->account_name,
                'account_no' => $UsedBookId->account_no,
                'bank_name' => $UsedBookId->bank_name,
                'branch_name' => $UsedBookId->branch_name,
                'town' => $UsedBookId->town,
                'district' => $UsedBookId->district,
                'postal_code' => $UsedBookId->postal_code,
                'customerName' => $customerDetails[0]->name
            ];


            $this->view('customer/updateusedbook', $data);

        }
    } 

    public function updateexchangebook($bookId){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } 
        $user_id = $_SESSION['user_id'];
       
        $customerDetails = $this->customerModel->findCustomerById($user_id);
        $customer_id=$customerDetails[0]->customer_id;

        // $data = [
        //     'customerDetails' => $customerDetails,
        //     'customerName' => $customerDetails[0]->name
        // ];
        //     $this->view('customer/updateusedbook', $data);

        if($_SERVER['REQUEST_METHOD']=='POST'){
            // process form
            // sanitize post data
            $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);


                      
            $data=[
                'book_id'=>$bookId,
                'book_name' => trim($_POST['bookName']),
                'ISBN_no' => trim($_POST['isbnNumber']),
                'author' => trim($_POST['author']),
                'category' => trim($_POST['category']),
                'weight' => trim($_POST['weights']),
                'descript' => trim($_POST['description1']),
                'booksIWant' => trim($_POST['description2']),
                'img1' => '',
                'img2' => '',
                'img3' => '',
                'condition' => trim($_POST['bookCondition']),
                'published_year' => trim($_POST['publishedYear']),
                'type' => trim('exchanged'),
                'town' => trim($_POST['town']),
                'district' => trim($_POST['district']),
                'postal_code' => trim($_POST['postalCode']),
                'customer_id' => trim($customer_id),// Replace this with the actual customer ID
                'status' => trim('pending'),

                'bookName_err' => '',
                'publishedYear_err'=>'',
                'price_err'=>'',
                'weights_err'=>'',
                'ISBN_err'=>'',
                'customerName' => $customerDetails[0]->name
            ];
            
            if(empty($data['published_year'])){
                $data['publishedYear_err']='Please enter published year';      
            }
            
            if(empty($data['weight'])){
                $data['weights_err']='Please enter the weight';      
            }else if($data['weight']<0 ){
                $data['weights_err']='Please enter a valid weight'; 
            }

            if(empty($data['bookName_err']) && empty($data['publishedYear_err']) && empty($data['price_err']) && empty($data['weights_err']) && empty($data['ISBN_err'])){

                //image
                if (isset($_FILES['imgFront']['name']) AND !empty($_FILES['imgFront']['name'])) {
                    $img_name = $_FILES['imgFront']['name'];
                    $tmp_name = $_FILES['imgFront']['tmp_name'];
                    $error = $_FILES['imgFront']['error'];
                    
                    if ($error === 0) {
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_to_lc = strtolower($img_ex);
                
                        $allowed_exs = array('jpg', 'jpeg', 'png');
                        if (in_array($img_ex_to_lc, $allowed_exs)) {
                            // Generate a unique identifier (e.g., timestamp)
                            $unique_id = time(); 
                            $new_img_name = $data['book_name'] . '-' . $unique_id . '-imgFront.' . $img_ex_to_lc;
                            $img_upload_path = "../public/assets/images/customer/AddExchangeBook/" . $new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path);
                
                            $data['img1'] = $new_img_name;
                        }
                    }
                }
                
                

                if (isset($_FILES['imgBack']['name']) AND !empty($_FILES['imgBack']['name'])) {
                    $img_name = $_FILES['imgBack']['name'];
                    $tmp_name = $_FILES['imgBack']['tmp_name'];
                    $error = $_FILES['imgBack']['error'];
                    
                    if($error === 0){
                       $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                       $img_ex_to_lc = strtolower($img_ex);
           
                       $allowed_exs = array('jpg', 'jpeg', 'png');
                       if(in_array($img_ex_to_lc, $allowed_exs)){
                          // Generate a unique identifier (e.g., timestamp)
                          $unique_id = time(); 
                          $new_img_name = $data['book_name'] . '-' . $unique_id . '-imgBack.' . $img_ex_to_lc;
                          $img_upload_path = "../public/assets/images/customer/AddExchangeBook/".$new_img_name;
                          move_uploaded_file($tmp_name, $img_upload_path);

                          $data['img2']=$new_img_name;
                       }
                    }
                }
                if (isset($_FILES['imgInside']['name']) AND !empty($_FILES['imgInside']['name'])) {
                    $img_name = $_FILES['imgInside']['name'];
                    $tmp_name = $_FILES['imgInside']['tmp_name'];
                    $error = $_FILES['imgInside']['error'];
                    
                    if($error === 0){
                       $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                       $img_ex_to_lc = strtolower($img_ex);
           
                       $allowed_exs = array('jpg', 'jpeg', 'png');
                       if(in_array($img_ex_to_lc, $allowed_exs)){
                          // Generate a unique identifier (e.g., timestamp)
                          $unique_id = time(); 
                          $new_img_name = $data['book_name'] . '-' . $unique_id . '-imgInside.' . $img_ex_to_lc;
                          $img_upload_path = "../public/assets/images/customer/AddExchangeBook/".$new_img_name;
                          move_uploaded_file($tmp_name, $img_upload_path);

                          $data['img3']=$new_img_name;
                       }
                    }
                }
                
                if($this->customerModel->updateexchangebook($data)){
                    // flash('update_success','You are added the book  successfully');
                    redirect('customer/ExchangeBooks');
                }else{
                    die('Something went wrong');
                }
                }else{
                    $this->view('customer/updateexchangebook', $data);
                }


        }else{
            $ExchangeBookId = $this->customerModel->findUsedBookById($bookId);
            // $books = $this->publisherModel->findBookById($book_id);
            if($ExchangeBookId->customer_id != $customer_id){
                redirect('customer/ExchangeBooks');
              }
            $data = [
                // 'customerName'=>$customerName,
                'book_id' => $bookId,
                'book_name' => $ExchangeBookId->book_name,
                'ISBN_no' => $ExchangeBookId->ISBN_no,
                'author' => $ExchangeBookId->author,
                'category' => $ExchangeBookId->category,
                'weight' => $ExchangeBookId->weight,
                'descript' => $ExchangeBookId->descript,
                'booksIWant' => $ExchangeBookId->booksIWant,
                'img1' => $ExchangeBookId->img1,
                'img2' => $ExchangeBookId->img2,
                'img3' => $ExchangeBookId->img3,
                'condition' => $ExchangeBookId->condition,
                'published_year' => $ExchangeBookId->published_year,
                'town' => $ExchangeBookId->town,
                'district' => $ExchangeBookId->district,
                'postal_code' => $ExchangeBookId->postal_code,
                'customerName' => $customerDetails[0]->name
            ];


            $this->view('customer/updateexchangebook', $data);

        }
    }

    public function deleteusedbook($bookId)
    {
        if ($this->customerModel->deleteusedbook($bookId)) {   
            // flash('post_message', 'book is Removed');
            redirect('customer/UsedBooks');
            
            
        } else {
            die('Something went wrong');
        }
    }

    public function deleteexchangebook($bookId)
    {
        if ($this->customerModel->deleteusedbook($bookId)) {   
            // flash('post_message', 'book is Removed');
            redirect('customer/ExchangeBooks');
            
            
        } else {
            die('Something went wrong');
        }
    }

    public function UsedBooks(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } 
        $customerid = null;
        
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            
            if ($customerDetails) {
                $customerid = $customerDetails[0]->customer_id;
                $bookDetails = $this->customerModel->findUsedBookByCusId($customerid);
            } else {
                echo "Not found";
            }
        } else {
            echo "Not a customer";
        }

        $data = [
            'customerid' => $customerid,
            'customerDetails' => $customerDetails,
            'bookDetails' => $bookDetails,
            'customerName' => $customerDetails[0]->name
        ];

        $this->view('customer/UsedBooks', $data);
    } 

    public function ViewBook($bookId){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } 
        $customerid = null;
        
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            
            if ($customerDetails) {
                
                $customerid = $customerDetails[0]->customer_id;
                
                $bookDetails = $this->customerModel->findUsedBookByCusId($customerid);
                $UsedBookId = $this->customerModel->findUsedBookById($bookId);
                
                // if($bookDetails && $UsedBookId ){
                //     if($this->customerModel->changeStatus($bookId)){
                //         flash('post_message', 'change status');
                //     }else {
                //         echo "Not found";
                //     }
                // }

            } else {
                echo "Not found";
            }
        } else {
            echo "Not a customer";
        }

        $data = [
            'customerid' => $customerid,
            'customerDetails' => $customerDetails,
            'bookDetails' => $bookDetails,
            'UsedBookId' => $UsedBookId,
            'customerName' => $customerDetails[0]->name,

            'book_id' => $bookId,
            'book_name' => $UsedBookId->book_name,
            'ISBN_no' => $UsedBookId->ISBN_no,
            'author' => $UsedBookId->author,
            'price' => $UsedBookId->price,
            'category' => $UsedBookId->category,
            'weight' => $UsedBookId->weight,
            'descript' => $UsedBookId->descript,
            'img1' => $UsedBookId->img1,
            'img2' => $UsedBookId->img2,
            'img3' => $UsedBookId->img3,
            'condition' => $UsedBookId->condition,
            'published_year' => $UsedBookId->published_year,
            'price_type' => $UsedBookId->price_type,
            'account_name' => $UsedBookId->account_name,
            'account_no' => $UsedBookId->account_no,
            'bank_name' => $UsedBookId->bank_name,
            'branch_name' => $UsedBookId->branch_name,
            'town' => $UsedBookId->town,
            'district' => $UsedBookId->district,
            'postal_code' => $UsedBookId->postal_code
        ];
        $this->view('customer/ViewBook', $data);
    } 

    public function ViewBookExchange($bookId){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } 
        $customerid = null;
        
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            
            if ($customerDetails) {
                
                $customerid = $customerDetails[0]->customer_id;
                
                $bookDetails = $this->customerModel->findExchangedBookByCusId($customerid);
                $ExchangeBookId = $this->customerModel->findUsedBookById($bookId);

            } else {
                echo "Not found";
            }
        } else {
            echo "Not a customer";
        }

        $data = [
            'customerid' => $customerid,
            'customerDetails' => $customerDetails,
            'bookDetails' => $bookDetails,
            'ExchangeBookId' => $ExchangeBookId,
            'customerName' => $customerDetails[0]->name,

            'book_id' => $bookId,
            'book_name' => $ExchangeBookId->book_name,
            'ISBN_no' => $ExchangeBookId->ISBN_no,
            'author' => $ExchangeBookId->author,
            'category' => $ExchangeBookId->category,
            'weight' => $ExchangeBookId->weight,
            'descript' => $ExchangeBookId->descript,
            'booksIWant' => $ExchangeBookId->booksIWant,
            'img1' => $ExchangeBookId->img1,
            'img2' => $ExchangeBookId->img2,
            'img3' => $ExchangeBookId->img3,
            'condition' => $ExchangeBookId->condition,
            'published_year' => $ExchangeBookId->published_year,
            'town' => $ExchangeBookId->town,
            'district' => $ExchangeBookId->district,
            'postal_code' => $ExchangeBookId->postal_code
        ];
        $this->view('customer/ViewBookExchange', $data);
    }

    public function viewcontent(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/viewcontent', $data);
        }
    } 

    public function viewevents(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/viewevents', $data);
        }
    } 

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
       
        unset($_SESSION['user_pass']);
        session_destroy();
        redirect('landing/index');
    }

    public function TopCategory(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/TopCategory', $data);
        }
    }

    public function TopAuthor(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/TopAuthor', $data);
        }
    }

    public function Recommended(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/Recommended', $data);
        }
    }

    public function UsedBookDetails($bookId){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } 
        $customerid = null;
        
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            
            if ($customerDetails) {
                
                $customerid = $customerDetails[0]->customer_id;
                
                $bookDetails = $this->customerModel->findUsedBookByCusId($customerid);
                $UsedBookId = $this->customerModel->findUsedBookById($bookId);
                
                // if($bookDetails && $UsedBookId ){
                //     if($this->customerModel->changeStatus($bookId)){
                //         flash('post_message', 'change status');
                //     }else {
                //         echo "Not found";
                //     }
                // }

            } else {
                echo "Not found";
            }
        } else {
            echo "Not a customer";
        }

        $data = [
            'customerid' => $customerid,
            'customerDetails' => $customerDetails,
            'bookDetails' => $bookDetails,
            'UsedBookId' => $UsedBookId,
            'customerName' => $customerDetails[0]->name,

            'book_id' => $bookId,
            'book_name' => $UsedBookId->book_name,
            'ISBN_no' => $UsedBookId->ISBN_no,
            'author' => $UsedBookId->author,
            'price' => $UsedBookId->price,
            'category' => $UsedBookId->category,
            'weight' => $UsedBookId->weight,
            'descript' => $UsedBookId->descript,
            'img1' => $UsedBookId->img1,
            'img2' => $UsedBookId->img2,
            'img3' => $UsedBookId->img3,
            'condition' => $UsedBookId->condition,
            'published_year' => $UsedBookId->published_year,
            'price_type' => $UsedBookId->price_type,
            'account_name' => $UsedBookId->account_name,
            'account_no' => $UsedBookId->account_no,
            'bank_name' => $UsedBookId->bank_name,
            'branch_name' => $UsedBookId->branch_name,
            'town' => $UsedBookId->town,
            'district' => $UsedBookId->district,
            'postal_code' => $UsedBookId->postal_code
        ];
        $this->view('customer/UsedBookDetails', $data);
    }

    public function Favorite(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/Favorite', $data);
        }
    }

    public function checkout2($order_id)
{
    if (!isLoggedIn()) {
        redirect('landing/login');
    } else {
        $user_id = $_SESSION['user_id'];
        $customerDetails = $this->customerModel->findCustomerById($user_id);       
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           
            $formType = $_POST['form_type'];
            if ($formType === 'cardPayment') {
                
                $this->handleCardPaymentForm($order_id,$formType);
            } elseif ($formType === 'onlineDeposit') {
               
                $this->handleOnlineDepositForm($order_id,$formType);
            }elseif ($formType === 'COD') {
                
                $this->handleCODForm($order_id,$formType);
            }
        } else {
            
            $data = [
                'order_id'=>$order_id,
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
                
            ];
    
            $this->view('customer/checkout2', $data);
        }     
    }
}
private function handleCardPaymentForm($order_id, $formType)
{
    // Set up payment details
    $amount = 3000; // You may need to adjust this value
    $merchant_id = "1225428"; // Your merchant ID
    $order_id = uniqid(); // Generate a unique order ID
    $merchant_secret = "MTkwMTI0MDQyOTMwOTk0MDQwNjAxNzA1NDIyNTgzMTIwOTk5MTc1MA=="; // Your merchant secret
    $currency = "LKR"; // Currency code

    // Calculate hash for payment
    $hash = strtoupper(
        md5(
            $merchant_id .
            $order_id .
            number_format($amount, 2, '.', '') .
            $currency .
            strtoupper(md5($merchant_secret))
        )
    );

    // Prepare payment details for JSON response
    $paymentDetails = [
        "items" => "Door bell wireless", // Adjust based on your products
        "first_name" => "Hasintha", // Customer's first name
        "last_name" => "Nirmanie", // Customer's last name
        "email" => "easyfarm123@mail.com", // Customer's email
        "phone" => "0715797461", // Customer's phone number
        "address" => "No 20, Headaketiya, Angunukolapalassa", // Customer's address
        "city" => "Hambanthota", // Customer's city
        "amount" => $amount, // Total payment amount
        "merchant_id" => $merchant_id, // Merchant ID
        "order_id" => $order_id, // Order ID
        "merchant_secret" => $merchant_secret, // Merchant secret
        "currency" => $currency, // Currency code
        "hash" => $hash, // Payment hash
    ];

    // Convert payment details to JSON
    $jsonObj = json_encode($paymentDetails);

    // Send JSON response
    // echo $jsonObj;
}

private function handleCODForm($order_id,$formType){
    $user_id = $_SESSION['user_id'];
    $customerDetails = $this->customerModel->findCustomerById($user_id);

    $customer_id=$customerDetails[0]->customer_id;

    $trackingNumber=$this->generateUniqueTrackingNumber($order_id);
    $orderDetails = $this->adminModel->getOrderDetailsById($order_id);
    $orderedCustomerDetails=$this->adminModel->getCustomerDetailsById($orderDetails[0]->customer_id);
    $customerEmail=$orderedCustomerDetails[0]->email;
    echo $customerEmail;
    $topic = "New Order Details";
    $message ="Congratulations! Your order has been processing now. Order will be received at home as soon as possible.";
    $messageToPublisher = "Congratulations! You have a new order. Login to the site and visit your order status by this tracking number " . $orderDetails[0]->tracking_no;

    $book_id = $orderDetails[0]->book_id;
    $bookDetails = $this->adminModel->getBookDetailsById($book_id);

    if ($bookDetails[0]->type == 'new') {
        $user_idPub = $bookDetails[0]->publisher_id;
        $ownerDetails = $this->adminModel->getPublisherDetailsById($user_idPub);
        $ownerEmail = $ownerDetails[0]->email;
    } else if ($bookDetails[0]->type == 'used' || $bookDetails[0]->type == 'exchanged') {
        $user_idPub = $bookDetails[0]->customer_id;
        $ownerDetails = $this->adminModel->getPublisherDetailsById($user_idPub);
        $ownerEmail = $ownerDetails[0]->email;
    }

    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $data = [
        'customer_id' => $customer_id,
        'order_id'=>$order_id,
        'formType'=>$formType,
        'trackingNumber'=>$trackingNumber,
        'topic' => $topic,
        'messageToPublisher' => $messageToPublisher,
        'message'=>$message,
        'user_id'=>$orderedCustomerDetails[0]->user_id,
        'user_idPub' => $ownerDetails[0]->user_id,
        'sender_name'=>'system administration',
        'sender_id'=>130,   
    ];
        //make sure errors are empty
        if( $data['trackingNumber']  ){
            if($this->customerModel->editOrderCOD($data) &&
            $this->adminModel->addMessage($data) &&
            $this->adminModel->addMessageToPublisher($data)){

                $this->sendEmails($customerEmail, $ownerEmail, $data);
                echo '<script>alert("You are placed an order successfully")</script>';
                flash('update_success','You are placed an order successfully');
                redirect('customer/Order');
               
            }else{
                die('Something went wrong');
            }
        }else{
                $this->view('customer/checkout2',$data);
            }
}
private function handleOnlineDepositForm($order_id,$formType){
    $user_id = $_SESSION['user_id'];
    $customerDetails = $this->customerModel->findCustomerById($user_id);
    $customer_id=$customerDetails[0]->customer_id;
    $trackingNumber=$this->generateUniqueTrackingNumber($order_id);
    print_r($trackingNumber);
    $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    $data = [
        'customer_id' => $customer_id,
        'order_id'=>$order_id,
        'recipt' => '',
        'formType'=>$formType,
        'trackingNumber'=>$trackingNumber
        
    ];
    if (isset($_FILES['recipt']['name']) AND !empty($_FILES['recipt']['name'])) {
        
        
        $recipt_name = $_FILES['recipt']['name'];
        $tmp_name = $_FILES['recipt']['tmp_name'];
        $error = $_FILES['recipt']['error'];
        
        if($error === 0){
        $recipt_ex = pathinfo($recipt_name, PATHINFO_EXTENSION);
        $recipt_ex_to_lc = strtolower($recipt_ex);

        $allowed_exs = array('jpg', 'jpeg', 'png','pdf');
        if(in_array($recipt_ex_to_lc, $allowed_exs)){
            $new_recipt_name = uniqid() . '-' . $recipt_name;
            $recipt_upload_path = "../public/assets/images/customer/orderRecipt/".$new_recipt_name;
            move_uploaded_file($tmp_name, $recipt_upload_path);

            $data['recipt']=$new_recipt_name;
        }
        }
    }
    
        //make sure errors are empty
        if($data['recipt'] && $data['trackingNumber']  ){
            if($this->customerModel->editOrder($data) ){
                flash('update_success','You are placed an order successfully');
                redirect('customer/Order');
            }else{
                die('Something went wrong');
            }
        }else{
                $this->view('customer/checkout2',$data);
            }
}
private function generateUniqueTrackingNumber($orderId) {
    do {
        $timestamp = time(); // Current timestamp
        $randomNumber = mt_rand(10000, 99999); // Use a range suitable for your application
        $trackingNumber = $orderId . $timestamp . $randomNumber;
    } while ($this->ordersModel->trackingNumberExists($trackingNumber));

    return $trackingNumber;
}
private function sendEmails($customerEmail, $ownerEmail, $data) {
    $this->sendEmail($customerEmail, $data['topic'], $data['message']);
    $this->sendEmail($ownerEmail, $data['topic'], $data['messageToPublisher']);
}

private function sendEmail($recipientEmail, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = MAIL_HOST;  // Specify your SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = MAIL_USER; // SMTP username
        $mail->Password = MAIL_PASS; // SMTP password
        $mail->SMTPSecure = MAIL_SECURITY;
        $mail->Port = MAIL_PORT;

        // Recipients
        $mail->setFrom('readspot27@gmail.com', 'READSPOT');
        $mail->addAddress($recipientEmail);  // Add a recipient

        // Content
        $mail->isHTML(true);  // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
    } catch (Exception $e) {
        die('Something went wrong: ' . $mail->ErrorInfo);
    }
}



    public function Calender(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/Calender', $data);
        }
    }

    
    public function BookChallenge(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/BookChallenge', $data);
        }
    }

    public function Order(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);
            $orderDetails=$this->ordersModel->findOrdersByCustomerId( $customerDetails[0]->customer_id);

            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name,
                'orderDetails'=>$orderDetails
            ];
            $this->view('customer/Order', $data);
        }
    }
}