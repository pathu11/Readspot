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
    private $chatModel;
  
    private $db;
    public function __construct(){
        if (!isLoggedIn()) {
            // redirect('landing/login');
        }
        $this->customerModel=$this->model('Customers');
        $this->deliveryModel=$this->model('Deliver');
        $this->userModel=$this->model('User');
        $this->ordersModel=$this->model('Orders');
        $this->publisherModel=$this->model('Publishers')  ;
        $this->adminModel=$this->model('Admins')  ;
        $this->chatModel=$this->model('Chat')  ;
        $this->db = new Database();
    }
   
    
    // public function comment() {
    //     if (!isLoggedInCustomer()) {
    //         redirect('landing/login');
    //     }

    //     $user_id = $_SESSION['user_id'];
    //     $customerDetails = $this->customerModel->findCustomerById($user_id);

    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

    //         $data = [
    //             'name' => $customerDetails[0]->name,
    //             'comment' => trim($_POST['comment']),
    //             'parentComment' => trim($_POST['parentComment']),
    //             'comment_err' => '',
    //         ];

    //         if (empty($data['comment'])) {
    //             $data['comment_err'] = 'Please enter a comment';
    //         }

    //         if (empty($data['comment_err'])) {
    //             if ($this->customerModel->addComment($data)) {
    //                 flash('Successfully Added');
    //                 redirect('customer/comment');
    //             } else {
    //                 die('Something went wrong');
    //             }
    //         } else {
    //             $this->view('customer/comment', $data);
    //         }
    //     } else {
    //         $data = [
    //             'comment' => '',
    //             'parentComment' => '',
    //             'comment_err' => '',
    //         ];

    //         $this->view('customer/comment', $data);
    //     }
    // }

    // public function getComments() {
    //     header('Content-Type: application/json');
    //     $comments = $this->customerModel->getComments();
    //     echo json_encode($comments);
    // }

    public function index(){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            $data = [
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'unreadNotification' => $unreadNotification
            ];
            $this->view('customer/index', $data);
        }
    }
    public function AboutUs(){
        if (!isLoggedInCustomer()) {
            $this->view('customer/AboutUs');
        } else {
            $user_id = $_SESSION['user_id'];
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            $data = [
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'unreadNotification' => $unreadNotification
            ];
            $this->view('customer/AboutUs', $data);
        }
    } 

    public function AddCont(){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } else {
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
                $customerid = null;
    
                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];
                    
                    $customerDetails = $this->customerModel->findCustomerById($user_id);
                    $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
                    // $bookCategoryDetails = $this->adminModel->getBookCategories();
                    if ($customerDetails) {
                        $customerName = $customerDetails[0]->first_name;
                        $customerid = $customerDetails[0]->customer_id;                 
                    } else {
                        echo "Not found";
                    }
                }
                $data=[
                    'topic' => trim($_POST['topic']),
                    'text' => trim($_POST['description']),
                    'picture' => '',
                    'pdf' => '',
                    'user_id' => $user_id,// Replace this with the actual customer ID
                    'customer_id'=>$customerDetails[0]->customer_id,
                    'customerImage' => $customerDetails[0]->profile_img,
                    'customerName' => $customerName,
                    'unreadNotification' => $unreadNotification
                ];
    
               
    
                if (isset($_FILES['picture']['name']) AND !empty($_FILES['picture']['name'])) {
                    $img_name = $_FILES['picture']['name'];
                    $tmp_name = $_FILES['picture']['tmp_name'];
                    $error = $_FILES['picture']['error'];
                    
                    if ($error === 0) {
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_to_lc = strtolower($img_ex);
                
                        $allowed_exs = array('jpg', 'jpeg', 'png');
                        if (in_array($img_ex_to_lc, $allowed_exs)) {
                            // Generate a unique identifier (e.g., timestamp)
                            $unique_id = time(); 
                            $new_img_name = $data['topic'] . '-' . $unique_id . 'img.' . $img_ex_to_lc;
                            $img_upload_path = "../public/assets/images/landing/addcontents/" . $new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path);
                
                            $data['picture'] = $new_img_name;
                        }
                    }
                }
    
                if (isset($_FILES['pdf']['name']) AND !empty($_FILES['pdf']['name'])) {
                    $img_name = $_FILES['pdf']['name'];
                    $tmp_name = $_FILES['pdf']['tmp_name'];
                    $error = $_FILES['pdf']['error'];
                    
                    if ($error === 0) {
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_to_lc = strtolower($img_ex);
                
                        $allowed_exs = array('pdf');
                        if (in_array($img_ex_to_lc, $allowed_exs)) {
                            // Generate a unique identifier (e.g., timestamp)
                            $unique_id = time(); 
                            $new_img_name = $data['topic'] . '-' . $unique_id . 'pdf.' . $img_ex_to_lc;
                            $img_upload_path = "../public/assets/images/landing/addcontents/" . $new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path);
                
                            $data['pdf'] = $new_img_name;
                        }
                    }
                }
                if($this->customerModel->AddCont($data)){
                    // echo '<script>alert("Your content is successfully added!,Waiting for moderator\'s approval");</script>';
                    // flash('add_success','You are added the book  successfully');
                    $_SESSION['showModal'] = true;
                    redirect('customer/AddCont');
                }else{
                    die('Something went wrong');
                }
            }
            else {
                $user_id = $_SESSION['user_id'];
               
                $customerDetails = $this->customerModel->findCustomerById($user_id);  
                $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
                $data = [
                    'customerDetails' => $customerDetails,
                    'customerImage' => $customerDetails[0]->profile_img,
                    'customerName' => $customerDetails[0]->first_name,
                    'unreadNotification' => $unreadNotification
                ];
                $this->view('customer/AddCont', $data);
            }
    } 
}
    public function Addevnt(){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } 
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            $customerid = null;

            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                
                $customerDetails = $this->customerModel->findCustomerById($user_id);
                // $bookCategoryDetails = $this->adminModel->getBookCategories();
                $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
                if ($customerDetails) {
                    $customerName = $customerDetails[0]->first_name;
                    $customerid = $customerDetails[0]->customer_id;                 
                } else {
                    echo "Not found";
                }
            }
            $data=[
                'title' => trim($_POST['eventName']),
                'category_name' => trim($_POST['category']),
                'description' => trim($_POST['descriptions']),
                'location' => trim($_POST['location']),
                'start_date' => trim($_POST['startDate']),
                'end_date' => trim($_POST['endDate']),
                'start_time' => trim($_POST['startTime']),
                'end_time' => trim($_POST['endTime']),
                'poster' => '',
                'img1' => '',
                'img2' => '',
                'img3' => '',
                'img4' => '',
                'img5' => '',
                'user_id' => trim($user_id),// Replace this with the actual customer ID
                'status' => trim('pending'),
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerName,
                'unreadNotification' => $unreadNotification
            ];

            if (isset($_FILES['imgMain']['name']) AND !empty($_FILES['imgMain']['name'])) {
                $img_name = $_FILES['imgMain']['name'];
                $tmp_name = $_FILES['imgMain']['tmp_name'];
                $error = $_FILES['imgMain']['error'];
                
                if ($error === 0) {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
            
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if (in_array($img_ex_to_lc, $allowed_exs)) {
                        // Generate a unique identifier (e.g., timestamp)
                        $unique_id = time(); 
                        $new_img_name = $data['title'] . '-' . $unique_id . '-imgMain.' . $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addevents/" . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
            
                        $data['poster'] = $new_img_name;
                    }
                }
            }

            if (isset($_FILES['1stImg']['name']) AND !empty($_FILES['1stImg']['name'])) {
                $img_name = $_FILES['1stImg']['name'];
                $tmp_name = $_FILES['1stImg']['tmp_name'];
                $error = $_FILES['1stImg']['error'];
                
                if ($error === 0) {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
            
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if (in_array($img_ex_to_lc, $allowed_exs)) {
                        // Generate a unique identifier (e.g., timestamp)
                        $unique_id = time(); 
                        $new_img_name = $data['title'] . '-' . $unique_id . '-1stImg.' . $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addevents/" . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
            
                        $data['img1'] = $new_img_name;
                    }
                }
            }

            if (isset($_FILES['2ndImg']['name']) AND !empty($_FILES['2ndImg']['name'])) {
                $img_name = $_FILES['2ndImg']['name'];
                $tmp_name = $_FILES['2ndImg']['tmp_name'];
                $error = $_FILES['2ndImg']['error'];
                
                if ($error === 0) {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
            
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if (in_array($img_ex_to_lc, $allowed_exs)) {
                        // Generate a unique identifier (e.g., timestamp)
                        $unique_id = time(); 
                        $new_img_name = $data['title'] . '-' . $unique_id . '-2ndImg.' . $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addevents/" . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
            
                        $data['img2'] = $new_img_name;
                    }
                }
            }

            if (isset($_FILES['3rdImg']['name']) AND !empty($_FILES['3rdImg']['name'])) {
                $img_name = $_FILES['3rdImg']['name'];
                $tmp_name = $_FILES['3rdImg']['tmp_name'];
                $error = $_FILES['3rdImg']['error'];
                
                if ($error === 0) {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
            
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if (in_array($img_ex_to_lc, $allowed_exs)) {
                        // Generate a unique identifier (e.g., timestamp)
                        $unique_id = time(); 
                        $new_img_name = $data['title'] . '-' . $unique_id . '-3rdImg.' . $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addevents/" . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
            
                        $data['img3'] = $new_img_name;
                    }
                }
            }

            if (isset($_FILES['4thImg']['name']) AND !empty($_FILES['4thImg']['name'])) {
                $img_name = $_FILES['4thImg']['name'];
                $tmp_name = $_FILES['4thImg']['tmp_name'];
                $error = $_FILES['4thImg']['error'];
                
                if ($error === 0) {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
            
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if (in_array($img_ex_to_lc, $allowed_exs)) {
                        // Generate a unique identifier (e.g., timestamp)
                        $unique_id = time(); 
                        $new_img_name = $data['title'] . '-' . $unique_id . '-4thImg.' . $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addevents/" . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
            
                        $data['img4'] = $new_img_name;
                    }
                }
            }

            if (isset($_FILES['5thImg']['name']) AND !empty($_FILES['5thImg']['name'])) {
                $img_name = $_FILES['5thImg']['name'];
                $tmp_name = $_FILES['5thImg']['tmp_name'];
                $error = $_FILES['5thImg']['error'];
                
                if ($error === 0) {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
            
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if (in_array($img_ex_to_lc, $allowed_exs)) {
                        // Generate a unique identifier (e.g., timestamp)
                        $unique_id = time(); 
                        $new_img_name = $data['title'] . '-' . $unique_id . '-5thImg.' . $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addevents/" . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
            
                        $data['img5'] = $new_img_name;
                    }
                }
            }
            if($this->customerModel->AddEvent($data)){
                // flash('add_success','You are added the book  successfully');
                // $_SESSION['$no_err'] = 'error';
                // echo "<script>alert('Your record has been recorded. Wait for admin approval'); window.location.href = '".URLROOT."/customer/Event';</script>";
                // redirect('customer/Event');
                // echo "<script>showModal();</script>";
                $_SESSION['showModal'] = true; // Set session variable to true
                redirect('customer/addevnt');

            }else{
                die('Something went wrong');
            }
        }
        else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $eventCategoryDetails = $this->adminModel->getEventCategories();
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);

            $data = [
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'eventCategoryDetails'=>$eventCategoryDetails,
                'unreadNotification' => $unreadNotification
            ];
            $this->view('customer/Addevnt', $data);
        }
    } 

    public function AddExchangeBook(){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } 
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            $customerid = null;
    
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                
                $customerDetails = $this->customerModel->findCustomerById($user_id);
                $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
                // $bookCategoryDetails = $this->adminModel->getBookCategories();
                $bookCategoryDetails = $this->adminModel->getBookCategories();
                if ($customerDetails) {
                    $customerName = $customerDetails[0]->first_name;
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
                // 'booksIWant' => trim($_POST['description2']),
                'booksIWant' => isset($_POST['input']) ? implode(', ', array_map('trim', $_POST['input'])) : '', // Trim the values from the dynamically created input fields
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
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerName,
                'unreadNotification' => $unreadNotification
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
                    // redirect('customer/ExchangeBooks');
                    $_SESSION['showModal'] = true;
                    redirect('customer/AddExchangeBook');
                }else{
                    die('Something went wrong');
                }
            }else{
                $this->view('customer/AddExchangeBook',$data);
            }


        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $bookCategoryDetails = $this->adminModel->getBookCategories();
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);

            if ($customerDetails) {
                $town = $customerDetails[0]->town; 
                $district = $customerDetails[0]->district;
                $postalCode = $customerDetails[0]->postal_code;
                $customerid = $customerDetails[0]->customer_id;
                $customerName = $customerDetails[0]->first_name;
            } else {
                echo "Not found";
            }

            $data = [
                'town' => trim($town),
                'district' => trim($district),
                'postal_code' => trim($postalCode),
                'customer_id' => trim($customerid),
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'bookCategoryDetails'=>$bookCategoryDetails,
                'unreadNotification' => $unreadNotification
            ];
            $this->view('customer/AddExchangeBook', $data);
        }
    } 
    
    public function AddUsedBook(){
        if (!isLoggedInCustomer()) {
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
                $bookCategoryDetails = $this->adminModel->getBookCategories();
                $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
                if ($customerDetails) {
                    $customerName = $customerDetails[0]->first_name;
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
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerName,
                'unreadNotification' => $unreadNotification
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
                    $_SESSION['showModal'] = true;
                    redirect('customer/AddUsedBook');
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
                $bookCategoryDetails = $this->adminModel->getBookCategories();
                // $bookCategoryDetails = $this->adminModel->getBookCategories();
                $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
                
                if ($customerDetails) {
                    $accName = $customerDetails[0]->account_name;
                    $accNumber = $customerDetails[0]->account_no; 
                    $bankName = $customerDetails[0]->bank_name; 
                    $branchName = $customerDetails[0]->branch_name;
                    $town = $customerDetails[0]->town; 
                    $district = $customerDetails[0]->district;
                    $postalCode = $customerDetails[0]->postal_code;
                    $customerid = $customerDetails[0]->customer_id;
                    $customerName = $customerDetails[0]->first_name;

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
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerName,
                'bookCategoryDetails'=>$bookCategoryDetails,
                'unreadNotification' => $unreadNotification
            ];

            $this->view('customer/AddUsedBook',$data);

        }
    } 
    
    public function BookContents(){
        if (!isLoggedInCustomer()) {
             // Calculate the start and end date of the current week
            $startOfWeek = date('Y-m-d', strtotime('monday this week'));
            $endOfWeek = date('Y-m-d', strtotime('sunday this week'));
            
            // Query to find the content with the highest rating within the current week
            $topRatedContent = $this->customerModel->getTopRatedContentOfWeek($startOfWeek, $endOfWeek);
            $content_Details=$this->customerModel->findContent();
            $data = [
                'contentDetails'=>$content_Details,
                'topRatedContent'=>$topRatedContent,
                'user_id' => 0000
            ];
            $this->view('customer/BookContents', $data);
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  

            $content_Details=$this->customerModel->findContent();
             
             $startOfWeek = date('Y-m-d', strtotime('monday this week'));
             $endOfWeek = date('Y-m-d', strtotime('sunday this week'));
             
             $topRatedContent = $this->customerModel->getTopRatedContentOfWeek($startOfWeek, $endOfWeek);
             $customer_id = $customerDetails[0]->customer_id;
             $favoriteDetails = $this->customerModel->findContentFavoriteByCustomerId($customer_id);
             $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            //  print_r($topRatedContent);

//             $customerid = $customerDetails[0]->customer_id;
//             $content_Details=$this->customerModel->findContentByNotCusId($customerid);

            $data = [
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'contentDetails'=>$content_Details,
                'topRatedContent'=>$topRatedContent,
                'favoriteDetails' => $favoriteDetails,
                'unreadNotification' => $unreadNotification
            ];
            // print_r($data['topRatedContent']);
            $this->view('customer/BookContents', $data);
        }
    } 
 
public function updateReviewHelpful() {
    if (!isLoggedInCustomer()) {
        redirect('landing/login');
    } 
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['reviewId']) && isset($_GET['isHelpful']) && isset($_SESSION['user_id'])) {
        $reviewId = $_GET['reviewId'];
        $isHelpful = $_GET['isHelpful'] === 'true' ? 1 : 0; 
        $userId = $_SESSION['user_id'];

        if (!isset($_SESSION['review_clicks'][$reviewId][$userId])) {
            $_SESSION['review_clicks'][$reviewId][$userId] = true; 
            if ($isHelpful == 1) {
                if ($this->customerModel->updateReviewHelpful($reviewId)) {
                    http_response_code(200); // OK
                    echo json_encode(['success' => true]);
                }
            }
        } else {
            http_response_code(403); 
            echo json_encode(['error' => 'Review already clicked']);
        }
    } else {
        // Invalid request method or missing parameters
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'Invalid request']);
    }
}
 
public function updateReviewHelpfulBooks() {
    if (!isLoggedInCustomer()) {
        redirect('landing/login');
    } 
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['reviewId']) && isset($_GET['isHelpful']) && isset($_SESSION['user_id'])) {
        $reviewId = $_GET['reviewId'];
        $isHelpful = $_GET['isHelpful'] === 'true' ? 1 : 0; 
        $userId = $_SESSION['user_id'];

        if (!isset($_SESSION['review_clicksBooks'][$reviewId][$userId])) {
            $_SESSION['review_clicksBooks'][$reviewId][$userId] = true; 
            if ($isHelpful == 1) {
                if ($this->customerModel->updateReviewHelpfulBooks($reviewId)) {
                    http_response_code(200); // OK
                    echo json_encode(['success' => true]);
                }
            }
        } else {
            http_response_code(403); 
            echo json_encode(['error' => 'Review already clicked']);
        }
    } else {
        // Invalid request method or missing parameters
        http_response_code(400); // Bad Request
        echo json_encode(['error' => 'Invalid request']);
    }
}

    public function BookDetails($book_id){
        if (!isLoggedInCustomer()) {
            $bookDetails=$this->customerModel->findBookById($book_id);
            $reviewDetails=$this->customerModel->findReviewsByBookId($book_id)  ;
            $averageRatingCount=$this->customerModel->getAverageRatingByBookId($book_id);
            $countStar_1 = $this->customerModel->countStar_1($book_id);
            $countStar_2 = $this->customerModel->countStar_2($book_id);
            $countStar_3 = $this->customerModel->countStar_3($book_id);
            $countStar_4 = $this->customerModel->countStar_4($book_id);
            $countStar_5 = $this->customerModel->countStar_5($book_id);

            $data = [
                'bookDetails'=>$bookDetails,
                'reviewDetails'=>$reviewDetails,
                'countStar_1'=>$countStar_1,
                'countStar_2'=>$countStar_2,
                'countStar_3'=>$countStar_3,
                'countStar_4'=>$countStar_4,
                'countStar_5'=>$countStar_5,
                'averageRatingCount'=>$averageRatingCount,
                'user_id' => 0000
            ];
            // print_r($data['countStar_1']);
            $this->view('customer/BookDetails', $data);
        } else {
            $user_id = $_SESSION['user_id'];
            $bookDetails=$this->customerModel->findBookById($book_id);
            $customerDetails = $this->customerModel->findCustomerById($user_id);
            $reviewDetails=$this->customerModel->findReviewsByBookId($book_id)  ;
            $averageRatingCount=$this->customerModel->getAverageRatingByBookId($book_id);
            $countStar_1 = $this->customerModel->countStar_1($book_id);
            $countStar_2 = $this->customerModel->countStar_2($book_id);
            $countStar_3 = $this->customerModel->countStar_3($book_id);
            $countStar_4 = $this->customerModel->countStar_4($book_id);
            $countStar_5 = $this->customerModel->countStar_5($book_id);
            $customer_id = $customerDetails[0]->customer_id;
            $favoriteDetails = $this->customerModel->findNewBooksFavoriteByCustomerId($customer_id);
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            

            $data = [
                'user_id'=>$user_id,
                'customerDetails' => $customerDetails,
                'customer_id' => $customerDetails[0]->customer_id,
                'customerName' => $customerDetails[0]->first_name,
                'customerImage' => $customerDetails[0]->profile_img,
                'bookDetails'=>$bookDetails,
                'reviewDetails'=>$reviewDetails,
                'countStar_1'=>$countStar_1,
                'countStar_2'=>$countStar_2,
                'countStar_3'=>$countStar_3,
                'countStar_4'=>$countStar_4,
                'countStar_5'=>$countStar_5,
                'averageRatingCount'=>$averageRatingCount,
                'favoriteDetails' => $favoriteDetails,
                'unreadNotification' => $unreadNotification
            ];
            // print_r($data['countStar_1']);
            $this->view('customer/BookDetails', $data);
        }
    }
    public function addReview() {
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } else {
            // Assuming user_id is stored in the session as 'user_id'
            $user_id = $_SESSION['user_id'];
    
            $customerDetails = $this->customerModel->findCustomerById($user_id);
            $customer_id = $customerDetails[0]->customer_id;
    
            // Initialize $data array outside the POST condition
            $data = [];
    
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'user_id' => $user_id,
                    'customer_id' => $customer_id,
                    'book_id' => trim($_POST['book_id']),
                    'review' => isset($_POST['descriptions']) ? trim($_POST['descriptions']) : '',
                    'rate' => isset($_POST['rate']) ? trim($_POST['rate']) : ''
                ];
            }
    
            // Check if review or rate is provided
            if (!empty($data['review']) || !empty($data['rate'])) {
                if ($this->customerModel->addReview($data)) {
                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                             
                    echo '<script>';
                    echo 'setTimeout(function() { sweet(); }, 100);';
                    echo 'function sweet() {';
                    echo '    Swal.fire({';
                    echo '        title: "Correct",';
                    echo '        text: "Your review is added successfully!",';
                    echo '        icon: "success",';

                    echo '        confirmButtonText: "Ok",';
                    echo '        confirmButtonColor: "#70BFBA",';
                    
                    echo '    }).then((result) => {';
                    echo '        if (result.isConfirmed) {';
                    echo '           window.location.href = "' . URLROOT . '/customer/BookDetails/' .$data['book_id']. '";';
                    echo '        }';
                    echo '    });';
                    echo '    return false;'; // Return false to prevent form submission
                    echo '}';
                    echo '</script>';
                    // echo '<script>alert("added a review successfully");</script>';
                    // header("Location: " . URLROOT . "/customer/BookDetails/" . $data['book_id']);
                    // exit();
                }
            } else {
                echo "no any reviews";
                header("Location: " . URLROOT . "/customer/BookDetails/" . $data['book_id']);
                exit();
            }
        }
    }

    public function addContentReview() {
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } else {
            // Assuming user_id is stored in the session as 'user_id'
            $user_id = $_SESSION['user_id'];
    
            $customerDetails = $this->customerModel->findCustomerById($user_id);
            $customer_id = $customerDetails[0]->customer_id;
    
            // Initialize $data array outside the POST condition
            $data = [];
    
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
                $data = [
                    'user_id' => $user_id,
                    'customer_id' => $customer_id,
                    'content_id' => trim($_POST['content_id']),
                    'review' => isset($_POST['descriptions']) ? trim($_POST['descriptions']) : '',
                    'rate' => isset($_POST['rate']) ? trim($_POST['rate']) : ''
                ];
            }
    
            // Check if review or rate is provided
            if (!empty($data['review']) || !empty($data['rate'])) {
                if ($this->customerModel->addContentReview($data)) {
                    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                             
                    echo '<script>';
                    echo 'setTimeout(function() { sweet(); }, 100);';
                    echo 'function sweet() {';
                    echo '    Swal.fire({';
                    echo '        title: "Correct",';
                    echo '        text: "Your review is added successfully!",';
                    echo '        icon: "success",';
                    echo '        confirmButtonText: "Ok",';
                    echo '        confirmButtonColor: "#70BFBA",';
                    
                    echo '    }).then((result) => {';
                    echo '        if (result.isConfirmed) {';
                    echo '           window.location.href = "' . URLROOT . '/customer/viewcontent/' .$data['content_id']. '";';
                    echo '        }';
                    echo '    });';
                    echo '    return false;'; // Return false to prevent form submission
                    echo '}';
                    echo '</script>';
                    // echo '<script>';
                    // echo 'alert("added a review successfully");';
                    // echo '</script>';
                    // header("Location: " . URLROOT . "/customer/viewcontent/" . $data['content_id']);
                    exit();
                }
            } else {
                echo "no any reviews";
                header("Location: " . URLROOT . "/customer/viewcontent/" . $data['content_id']);
                exit();
            }
        }
    }
    
    
    public function BookEvents(){
        if (!isLoggedInCustomer()) {
            $eventDetails = $this->customerModel->findAllEvents();
            $data = [
                'eventDetails' => $eventDetails
            ];
            $this->view('customer/BookEvents', $data);
        } else {
            $customerid = null;

            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
           
                $customerDetails = $this->customerModel->findCustomerById($user_id);  
                $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
               
                if ($customerDetails) {
                    $customerid = $customerDetails[0]->customer_id;
                    $eventDetails = $this->customerModel->findEventByNotUserId($user_id);
                    // $bookDetails = $this->customerModel->findUsedBookByNotCusId($customerid);
                } else {
                    echo "Not found";
                }
            } else {
                echo "Not a customer";
            }
            $data = [
                'customerid' => $customerid,
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'eventDetails' => $eventDetails,
                'unreadNotification' => $unreadNotification
            ];
            $this->view('customer/BookEvents', $data);
        }
    } 
    
    public function Bookshelf(){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } else {
            $customerid = null;
        
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
            
                $customerDetails = $this->customerModel->findCustomerById($user_id);  
                $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
                
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
                'customerImage' => $customerDetails[0]->profile_img,
                'customerDetails' => $customerDetails,
                'bookDetails1' => $bookDetails1,
                'bookDetails2' => $bookDetails2,
                'customerName' => $customerDetails[0]->first_name,
                'unreadNotification' => $unreadNotification
            ];
            $this->view('customer/Bookshelf', $data);
        }
    } 
    
public function BuyNewBooks()
{
    if (!isLoggedInCustomer()) {
        // redirect('landing/login');
        $recommendedBooks = $this->customerModel->topSelling();
        $NewbookDetailsByTime = $this->customerModel->findNewBooksByTime();
        $bookCategoryDetails = $this->adminModel->getBookCategories();
        $data = [  
            'bookDetails' => $NewbookDetailsByTime,
            'recommendedBooks' => $recommendedBooks,
            'bookCategoryDetails'=>$bookCategoryDetails,
            'user_id' => 0000
        ];
        $this->view('customer/BuyNewBooks', $data);

    } else {
        $user_id = $_SESSION['user_id'];
        $customerDetails = $this->customerModel->findCustomerById($user_id); 
        $customer_id = $customerDetails[0]->customer_id;
        $NewbookDetailsByTime = $this->customerModel->findNewBooksByTime();
        $recommendedBooks = $this->customerModel->recommendBooks($customer_id); 
        $favoriteDetails = $this->customerModel->findNewBooksFavoriteByCustomerId($customer_id);
        $bookCategoryDetails = $this->adminModel->getBookCategories();
        $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);

        $data = [
            'customerDetails' => $customerDetails,
            'user_id'=>$user_id,
            'customerImage' => $customerDetails[0]->profile_img,
            'customerName' => $customerDetails[0]->first_name,
            'bookDetails' => $NewbookDetailsByTime,
            'recommendedBooks' => $recommendedBooks,
            'favoriteDetails' => $favoriteDetails,
            'bookCategoryDetails'=>$bookCategoryDetails,
            'unreadNotification' => $unreadNotification
        ];

        $this->view('customer/BuyNewBooks', $data);
    }
}   
    public function BuyUsedBook(){
        if (!isLoggedInCustomer()) {
            $UsedbookDetails = $this->customerModel->findAllUsedBooks();
            $data = [
                'bookDetails' => $UsedbookDetails,
                'user_id' => 0000
            ];
            $this->view('customer/BuyUsedBook', $data);
        } else {
            $customerid = null;

            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
            
                $customerDetails = $this->customerModel->findCustomerById($user_id);
                $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
              
                if ($customerDetails) {
                    $customerid = $customerDetails[0]->customer_id;
                    $UsedbookDetailsByTime = $this->customerModel->findUsedBooksByTime($customerid);
                    // $bookDetails = $this->customerModel->findUsedBookByNotCusId($customerid);
                    $favoriteDetails = $this->customerModel->findUsedBooksFavoriteByCustomerId($customerid);
                } else {
                    echo "Not found";
                }
            } else {
                echo "Not a customer";
            }
                $data = [
                    'customerid' => $customerid,
                    'user_id'=>$user_id,
                    'customerImage' => $customerDetails[0]->profile_img,
                    'customerDetails' => $customerDetails,
                    'bookDetails' => $UsedbookDetailsByTime,
                    'customerName' => $customerDetails[0]->first_name,
                    'favoriteDetails' => $favoriteDetails,
                    'unreadNotification' => $unreadNotification
                ];
                $this->view('customer/BuyUsedBook', $data);
        }
    } 
    public function addToCart($bookId) {
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        }
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
    
    public function addToCartByEachBook($bookId) {
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        }
        
        $user_id = $_SESSION['user_id'];
        $customerDetails = $this->customerModel->findCustomerById($user_id);
        $customer_id=$customerDetails[0]->customer_id;
        $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : 1;
        
        if ($bookId && $quantity && $customer_id) {
            if ($this->customerModel->addToCart($bookId, $customer_id, $quantity)) {
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                             
                echo '<script>';
                echo 'setTimeout(function() { sweet(); }, 100);';
                echo 'function sweet() {';
                echo '    Swal.fire({';
                echo '        title: "Correct",';
                echo '        text: "Your book is added to cart !",';
                echo '        icon: "success",';

                echo '        confirmButtonText: "Ok",';
                echo '        confirmButtonColor: "#70BFBA",';
                
                echo '    }).then((result) => {';
                echo '        if (result.isConfirmed) {';
                echo '           window.location.href = "' . URLROOT . '/customer/Cart' .'";';
                echo '        }';
                echo '    });';
                echo '    return false;'; // Return false to prevent form submission
                echo '}';
                echo '</script>';
                exit; 
            //    redirect('customer/Cart');
            }
        }else{
            echo '<script>alert("eroor");</script>';
            redirect('customer/BuyNewBooks');
        }
    
       

    }

    public function addToFavoriteNewBooks($bookId) {
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
            $customerDetails = $this->customerModel->findCustomerById($user_id);
            $customerName = $customerDetails[0]->first_name;
            $customer_id = $customerDetails[0]->customer_id;
            $bookDetails=$this->customerModel->findBookById($bookId);
            $topic = $bookDetails[0]->book_name;
            $category = 'New Book';
            $item_id = $bookId;
            // $data=[
            //     'item_id' => trim($bookId),
            //     'topic' => trim($bookDetails[0]->book_name),
            //     'category' => trim('New Book'),
            //     'customer_id' => trim($customerid),// Replace this with the actual customer ID
            //     'customerImage' => $customerDetails[0]->profile_img,
            //     'customerName' => $customerName
            // ];

            if ($item_id && $customer_id && $topic && $category) {
                if($this->customerModel->Addtofavorite($item_id, $customer_id, $topic, $category)){
                    // flash('add_success','You are added the book  successfully');
                    redirect('customer/Favorite');
                }
            }else{
                echo '<script>alert("eroor");</script>';
                redirect('customer/BuyNewBooks');
            }

            // if($this->customerModel->Addtofavorite($item_id, $customer_id, $topic, $category)){
            //     // flash('add_success','You are added the book  successfully');
            //     redirect('customer/Favorite');
            // }else{
            //     die('Something went wrong');
            // }
        }

    }

    public function addToFavoriteUsedBooks($bookId) {
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
            $customerDetails = $this->customerModel->findCustomerById($user_id);
            $customerName = $customerDetails[0]->first_name;
            $customer_id = $customerDetails[0]->customer_id;
            $bookDetails=$this->customerModel->findBookById($bookId);
            $topic = $bookDetails[0]->book_name;
            $category = 'Used Book';
            $item_id = $bookId;

            if ($item_id && $customer_id && $topic && $category) {
                if($this->customerModel->Addtofavorite($item_id, $customer_id, $topic, $category)){
                    // flash('add_success','You are added the book  successfully');
                    redirect('customer/Favorite');
                }
            }else{
                echo '<script>alert("eroor");</script>';
                redirect('customer/BuyUsedBook');
            }
        }

    }

    public function addToFavoriteExchangeBooks($bookId) {
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
            $customerDetails = $this->customerModel->findCustomerById($user_id);
            $customerName = $customerDetails[0]->first_name;
            $customer_id = $customerDetails[0]->customer_id;
            $bookDetails=$this->customerModel->findBookById($bookId);
            $topic = $bookDetails[0]->book_name;
            $category = 'Exchange Book';
            $item_id = $bookId;

            if ($item_id && $customer_id && $topic && $category) {
                if($this->customerModel->Addtofavorite($item_id, $customer_id, $topic, $category)){
                    // flash('add_success','You are added the book  successfully');
                    redirect('customer/Favorite');
                }
            }else{
                echo '<script>alert("eroor");</script>';
                redirect('customer/ExchangeBook');
            }
        }

    }

    public function addToFavoriteContent($ContentId) {
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
            $customerDetails = $this->customerModel->findCustomerById($user_id);
            $customerName = $customerDetails[0]->first_name;
            $customer_id = $customerDetails[0]->customer_id;
            $contentDetails=$this->customerModel->findContentById($ContentId);
            $topic = $contentDetails[0]->topic;
            $category = 'Content';
            $item_id = $ContentId;

            if ($item_id && $customer_id && $topic && $category) {
                if($this->customerModel->Addtofavorite($item_id, $customer_id, $topic, $category)){
                    // flash('add_success','You are added the book  successfully');
                    redirect('customer/Favorite');
                }
            }else{
                echo '<script>alert("eroor");</script>';
                redirect('customer/BookContents');
            }
        }
    }
    public function Cart(){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
            $customerDetails = $this->customerModel->findCustomerById($user_id); 
            $customer_id=$customerDetails[0] ->customer_id;
            $cartDetails=$this->customerModel->findCartById($customer_id);
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
           
            $data = [
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'cartDetails'=>$cartDetails,
                'unreadNotification' => $unreadNotification
            ];
            
            $this->view('customer/Cart', $data);
        }
    } 
    public function deleteCart($cart_id){
        $user_id = $_SESSION['user_id'];
        if($this->customerModel->deleteFromCart($cart_id)){
            echo '<script>alert("Successfully deleted");</script>';
            redirect('customer/Cart');
        }

    }
    
    public function ContactUs(){
        if (!isLoggedInCustomer()) {
            $this->view('customer/ContactUs');
        } else {
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
                $customerid = null;
    
                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];
                    
                    $customerDetails = $this->customerModel->findCustomerById($user_id);
                    // $bookCategoryDetails = $this->adminModel->getBookCategories();
                    $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
                    if ($customerDetails) {
                        $customerName = $customerDetails[0]->first_name;
                        $customerid = $customerDetails[0]->customer_id;                 
                    } else {
                        echo "Not found";
                    }
                }
                $data=[
                    'first_name' => trim($_POST['Fname']),
                    'last_name' => trim($_POST['Lname']),
                    'email' => trim($_POST['Email']),
                    'contact_number' => trim($_POST['PhoneNumber']),
                    'reason' => trim($_POST['Reason']),
                    'other' => trim($_POST['OtherReason']),
                    'descript' => trim($_POST['description']),
                    'err_img' => '',
                    'customer_id' => trim($customerid),
                    'user_id'=>$user_id,// Replace this with the actual customer ID
                    'customerImage' => $customerDetails[0]->profile_img,
                    'customerName' => $customerName,
                    'unreadNotification' => $unreadNotification
                ];
    
                if (isset($_FILES['imgComplaint']['name']) AND !empty($_FILES['imgComplaint']['name'])) {
                    $img_name = $_FILES['imgComplaint']['name'];
                    $tmp_name = $_FILES['imgComplaint']['tmp_name'];
                    $error = $_FILES['imgComplaint']['error'];
                    
                    if ($error === 0) {
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_to_lc = strtolower($img_ex);
                
                        $allowed_exs = array('jpg', 'jpeg', 'png');
                        if (in_array($img_ex_to_lc, $allowed_exs)) {
                            // Generate a unique identifier (e.g., timestamp)
                            $unique_id = time(); 
                            $new_img_name = $data['reason'] . '-' . $unique_id . '-imgComplaint.' . $img_ex_to_lc;
                            $img_upload_path = "../public/assets/images/customer/Complaint/" . $new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path);
                
                            $data['err_img'] = $new_img_name;
                        }
                    }
                }
                
                if($this->customerModel->complaint($data)){
                    // flash('add_success','You are added the book  successfully');
                    redirect('customer/ContactUs');
                }else{
                    die('Something went wrong');
                }
            } 
            else {
                $user_id = $_SESSION['user_id'];
            
                $customerDetails = $this->customerModel->findCustomerById($user_id);  
                $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
                $data = [
                    'customerDetails' => $customerDetails,
                    'customerImage' => $customerDetails[0]->profile_img,
                    'customerName' => $customerDetails[0]->first_name,
                    'unreadNotification' => $unreadNotification
                ];
                $this->view('customer/ContactUs', $data);
            }
        }
    } 
    
    public function Content(){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id); 
            $customer_id=$customerDetails[0]->customer_id;
            $contentDetails = $this->customerModel->findContentByCusId( $customer_id); 
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            // print_r($content_Details);
            $data = [
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'contentDetails'=>$contentDetails,
                'customer_id'=> $customer_id,
                'unreadNotification' => $unreadNotification
            ];
           
            $this->view('customer/Content', $data);
        }
    } 
    
    public function Dashboard(){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $customer_id=$customerDetails[0]->customer_id;

            $AddUsedBooks = $this->customerModel->findNoOfUsedBooksById($customer_id);
            $AddExchangeBooks = $this->customerModel->findNoOfExchangeBooksById($customer_id);
            $AddContents = $this->customerModel->findNoOfContentsById($customer_id);
            $AddEvents = $this->customerModel->findNoOfEventsById($user_id);
            $paymentCount = $this->ordersModel->countPayment($user_id);
            $currentPoints = $this->customerModel->FindRedeemPoints($customer_id);
            $saveEvents = $this->customerModel->findNoOfSaveEvent($user_id);
            $BuyNewBooks = $this->customerModel->findNoOfBuyNewBooksById($customer_id);
            $BuyUsedBooks = $this->customerModel->findNoOfBuyUsedBooksById($customer_id);
            $BoughtCategories = $this->customerModel->findBoughtCategories($customer_id);
            $AddedCategories = $this->customerModel->findAddedCategories($customer_id);
            $contentPoints = $this->customerModel->findContentPoints($customer_id);
            $challengePoints = $this->customerModel->findChallengePoints($customer_id);
            $donateDetails = $this->customerModel->findDonateBooks($customer_id);

            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);

            $data = [
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'customer' => $customerDetails[0]->name,
                'used' => $AddUsedBooks,
                'exchange' => $AddExchangeBooks,
                'content' => $AddContents,
                'event' => $AddEvents,
                'paymentCount' => $paymentCount,
                'currentPoint' => $currentPoints,
                'saveEvents' => $saveEvents,
                'BuyNewBooks' => $BuyNewBooks,
                'BuyUsedBooks' => $BuyUsedBooks,
                'BoughtCategories' => $BoughtCategories,
                'AddedCategories' => $AddedCategories,
                'contentPoints' => intval($contentPoints),
                'challengePoints' => intval($challengePoints),
                'totalPoints' => intval($challengePoints) + intval($contentPoints),
                'donateDetails' => intval($donateDetails),
                'unreadNotification' => $unreadNotification
            ];
            $this->view('customer/Dashboard', $data);
        }
    } 
    
    public function DonateBooks(){
        if (!isLoggedInCustomer()) {
            $donateDetails = $this->customerModel->findCharityEvents();
            $data = [
                'donateDetails' => $donateDetails
            ];
            $this->view('customer/DonateBooks', $data);
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            $donateDetails = $this->customerModel->findCharityEvents();
            $data = [
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'unreadNotification' => $unreadNotification,
                'donateDetails' => $donateDetails
            ];
            $this->view('customer/DonateBooks', $data);
        }
    } 

    public function Donatedetails($charity_id){
        if (!isLoggedInCustomer()) {
            $charityEvent = $this->customerModel->findCharityEventById($charity_id);
            $data = [
                'charityEvent' => $charityEvent,
                'booksIWant' => $charityEvent[0]->book_category
            ];
            $this->view('customer/Donatedetails', $data);
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            $charityEvent = $this->customerModel->findCharityEventById($charity_id);
            $data = [
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'unreadNotification' => $unreadNotification,
                'charityEvent' => $charityEvent,
                'booksIWant' => $charityEvent[0]->book_category
            ];
            $this->view('customer/Donatedetails', $data);
        }
    } 

    public function Donateform($charity_id = null){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } 
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            $customerid = null;

            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                
                $customerDetails = $this->customerModel->findCustomerById($user_id);
                // $bookCategoryDetails = $this->adminModel->getBookCategories();  
                $bookCategoryDetails = $this->adminModel->getBookCategories();
                $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
                if ($customerDetails) {
                    $customerName = $customerDetails[0]->first_name;
                    $customerid = $customerDetails[0]->customer_id;                 
                } else {
                    echo "Not found";
                }
            }

                    // Initialize arrays to store book types and quantities
            $bookTypes = [];
            $quantities = [];

            // Loop through each POST variable to find checked checkboxes and their quantities
            foreach ($_POST as $key => $value) {
                if (strpos($key, 'book') !== false && $value === 'on') {
                    $bookType = str_replace('Quantity', '', $key);
                    $bookTypes[] = $bookType;
                    // Extract quantity from corresponding input field
                    $quantityKey = $bookType . 'Quantity';
                    $quantity = isset($_POST[$quantityKey]) ? intval($_POST[$quantityKey]) : 0;
                    $quantities[] = $quantity;
                }
            }

            // Combine book types with commas
            $bookTypeString = implode(', ', $bookTypes);
            // Sum up quantities
            $totalQuantity = array_sum($quantities);
            $data=[
                'first_name' => trim($_POST['Fname']),
                'last_name' => trim($_POST['Lname']),
                'email' => trim($_POST['Email']),
                'contact_number' => trim($_POST['PhoneNumber']),
                'description' => trim($_POST['description']),
                'book_types' => $bookTypeString,
                'quantity' => $totalQuantity, 
                'charity_event_id' => $charity_id,
                'customer_id' => trim($customerid),// Replace this with the actual customer ID
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerName,
                'unreadNotification' => $unreadNotification
            ];

            if($this->customerModel->AddDonateBooks($data)){
                // flash('add_success','You are added the book  successfully');
                // redirect('customer/UsedBooks');
                $_SESSION['showModal'] = true; // Set session variable to true
                redirect('customer/Donateform');
            }else{
                die('Something went wrong');
            }
        }
        else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            $charityEvent = $this->customerModel->findCharityEventById($charity_id);
            $data = [
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'unreadNotification' => $unreadNotification,
                'charity_event_id' => $charity_id,
                'booksIWant' => isset($charityEvent[0]->book_category) ? $charityEvent[0]->book_category : ''
            ];
            $this->view('customer/Donateform', $data);
        }
    } 

    // public function dropdownmenu(){

    //     $this->view('customer/dropdownmenu');
    // }

    public function Event(){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } 
        $customerid = null;

        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            // if (isset($_SESSION['$no_err'])) {
            //     $_SESSION['$no_err'] = '';
            //     $this->view('customer/Event', $data);
            // }
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            
            if ($customerDetails) {
                $customerid = $customerDetails[0]->customer_id;
                $eventDetails = $this->customerModel->findEventByUserId($user_id);
            } else {
                echo "Not found";
            }
        } else {
            echo "Not a customer";
        }
           
        $data = [
            'customerid' => $customerid,
            'customerDetails' => $customerDetails,
            'eventDetails' => $eventDetails,
            'customerImage' => $customerDetails[0]->profile_img,
            'customerName' => $customerDetails[0]->first_name,
            'unreadNotification' => $unreadNotification
        ];
        $this->view('customer/Event', $data);
    } 

    public function ExchangeBook(){
        if (!isLoggedInCustomer()) {
            $bookDetails = $this->customerModel->findAllExchangedBook();
            $data = [
                'bookDetails' => $bookDetails,
                'user_id' => 0000
            ];
                $this->view('customer/ExchangeBook', $data);
        } else {
        $customerid = null;
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            if ($customerDetails) {
                $customerid = $customerDetails[0]->customer_id;
                $bookDetails = $this->customerModel->findExchangedBookByNotCusId($customerid);
                $favoriteDetails = $this->customerModel->findExchangeBooksFavoriteByCustomerId($customerid);
            } else {
                echo "Not found";
            }
        } else {
            echo "Not a customer";
        }
        $data = [
            'customerid' => $customerid,
            'user_id'=>$user_id,
            'customerDetails' => $customerDetails,
            'customerImage' => $customerDetails[0]->profile_img,
            'bookDetails' => $bookDetails,
            'customerName' => $customerDetails[0]->first_name,
            'favoriteDetails' => $favoriteDetails,
            'unreadNotification' => $unreadNotification
        ];
            $this->view('customer/ExchangeBook', $data);
        } 
    }

    public function ExchangeBookDetails($bookId){
        if (!isLoggedInCustomer()) {
            $ExchangeBookId = $this->customerModel->findUsedBookById($bookId);
            $data = [
                'customer_user_id'=>$ExchangeBookId->customer_user_id,
                'ExchangeBookId' => $ExchangeBookId,
    
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
                'user_id' => 0000
            ];
            $this->view('customer/ExchangeBookDetails', $data);
        } else {
        $customerid = null;
        
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            
            if ($customerDetails) {
                
                $customerid = $customerDetails[0]->customer_id;
                
                $bookDetails = $this->customerModel->findExchangedBookByCusId($customerid);
                $ExchangeBookId = $this->customerModel->findUsedBookById($bookId);
                $favoriteDetails = $this->customerModel->findExchangeBooksFavoriteByCustomerId($customerid);

            } else {
                echo "Not found";
            }
        } else {
            echo "Not a customer";
        }

        $data = [
            'customer_user_id'=>$ExchangeBookId->customer_user_id,
            'customerid' => $customerid,
            'customerDetails' => $customerDetails,
            'bookDetails' => $bookDetails,
            'ExchangeBookId' => $ExchangeBookId,
            'customerName' => $customerDetails[0]->first_name,
            'customerImage' => $customerDetails[0]->profile_img,
            'unreadNotification' => $unreadNotification,
            'user_id'=>$user_id,

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
            'favoriteDetails' => $favoriteDetails
        ];
        $this->view('customer/ExchangeBookDetails', $data);
        }
    } 

    public function ExchangeBooks(){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        }
        $customerid = null;
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
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
            'customerImage' => $customerDetails[0]->profile_img,
            'customerName' => $customerDetails[0]->first_name,
            'unreadNotification' => $unreadNotification
        ];
            $this->view('customer/ExchangeBooks', $data);
    } 

    // public function index(){
        
    //     $this->view('customer/index');
    // } 

    public function Notification(){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id); 
            $messageDetails = $this->publisherModel->findMessageByUserId($user_id); 
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            $data = [
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'messageDetails'=>$messageDetails,
                'unreadNotification' => $unreadNotification,
            ];
            $this->view('customer/Notification', $data);
        }
    } 

    public function ViewNotification($msg_id){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id); 
            $messageDetails = $this->publisherModel->findMessageByUserId($user_id);
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);

            $data = [
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'messageDetails'=>$messageDetails,
                'unreadNotification' => $unreadNotification
            ];

            if ($this->customerModel->makeAsRead($msg_id)) {   
                // flash('post_message', 'book is Removed');
                redirect('customer/Notification', $data);
                
                
            } else {
                die('Something went wrong');
            }
            // $this->view('customer/Notification', $data);
        }
    } 

    public function Messages(){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id); 
            $messageDetails = $this->publisherModel->getChatDetailsById($user_id); 
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            $data = [
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'messageDetails'=>$messageDetails,
                'unreadNotification' => $unreadNotification,
            ];
            $this->view('customer/Messages', $data);
        }
    } 

    public function ChangeProfImage(){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        }
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            $customerid = null;

            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                $customerDetails = $this->customerModel->findCustomerById($user_id);
                $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
                // $bookCategoryDetails = $this->adminModel->getBookCategories();
                if ($customerDetails) {
                    $customerName = $customerDetails[0]->first_name;
                    $customerid = $customerDetails[0]->customer_id;                 
                } else {
                    echo "Not found";
                }
            }
            $data=[
                'customerName' => $customerName,
                'customer_id' => $customerid,
                'profile_img' => '',
                'unreadNotification' => $unreadNotification
            ];

            if (isset($_FILES['newImage']['name']) AND !empty($_FILES['newImage']['name'])) {
                $img_name = $_FILES['newImage']['name'];
                $tmp_name = $_FILES['newImage']['tmp_name'];
                $error = $_FILES['newImage']['error'];
                
                if ($error === 0) {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
            
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if (in_array($img_ex_to_lc, $allowed_exs)) {
                        // Generate a unique identifier (e.g., timestamp)
                        $unique_id = time(); 
                        $new_img_name = $customerName . '-' . $unique_id . '-newImage.' . $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/customer/ProfileImages/" . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
            
                        $data['profile_img'] = $new_img_name;
                    }
                }
            }

            if($this->customerModel->ChangeProfImage($data)){
                // flash('add_success','You are added the book  successfully');
                redirect('customer/Profile',$data);
            }else{
                die('Something went wrong');
            }
        }
    }

    public function Profile(){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        }
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            $customerid = null;
    
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                $customerDetails = $this->customerModel->findCustomerById($user_id);
                // $bookCategoryDetails = $this->adminModel->getBookCategories();
                $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
                if ($customerDetails) {
                    $customerName = $customerDetails[0]->first_name;
                    $FullName = $customerDetails[0]->name;
                    $customerid = $customerDetails[0]->customer_id;                 
                } else {
                    echo "Not found";
                }
            }            
            $data=[
                'customerName' => $customerName,
                'FullName' => $FullName,
                'customer_id' => $customerid,
                'profile_img' => $customerDetails[0]->profile_img,
                'unreadNotification' => $unreadNotification,
                'first_name' => trim($_POST['FName']),
                'last_name' => trim($_POST['LName']),
                'email' => trim($_POST['email']),
                'contact_number' => trim($_POST['ContactNo']),
                'postal_name' => trim($_POST['Address']),
                'street_name' => trim($_POST['Province']),
                'town' => trim($_POST['city']),
                'district' => trim($_POST['District']),
                'postal_code' => trim($_POST['PostalCode']),
                'account_name' => trim($_POST['AccName']),
                'account_no' => trim($_POST['AccNo']),
                'bank_name' => trim($_POST['BankName']),
                'branch_name' => trim($_POST['BranchName']),
            ];
            
            if (isset($_FILES['newImage']['name']) AND !empty($_FILES['newImage']['name'])) {
                $img_name = $_FILES['newImage']['name'];
                $tmp_name = $_FILES['newImage']['tmp_name'];
                $error = $_FILES['newImage']['error'];
                
                if ($error === 0) {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
            
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if (in_array($img_ex_to_lc, $allowed_exs)) {
                        // Generate a unique identifier (e.g., timestamp)
                        $unique_id = time(); 
                        $new_img_name = $customerName . '-' . $unique_id . '-newImage.' . $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/customer/ProfileImages/" . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
            
                        $data['profile_img'] = $new_img_name;
                    }
                }
            }

            if($this->customerModel->Profile($data)){
                // flash('add_success','You are added the book  successfully');
                redirect('customer/Profile');
            }else{
                die('Something went wrong');
            }
        } else {
            $user_id = $_SESSION['user_id'];
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->first_name,
                'FullName' => $customerDetails[0]->name,
                'customerImage' => $customerDetails[0]->profile_img,
                'FName' => $customerDetails[0]->first_name,
                'LName' => $customerDetails[0]->last_name,
                'customerEmail' => $customerDetails[0]->email,
                'ContactNumber' => $customerDetails[0]->contact_number,
                'Address' => $customerDetails[0]->postal_name,
                'Province' => $customerDetails[0]->street_name,
                'District' => $customerDetails[0]->	district,
                'City' => $customerDetails[0]->town,
                'PostalCode' => $customerDetails[0]->postal_code,
                'AccName' => $customerDetails[0]->account_name,
                'AccNumber' => $customerDetails[0]->account_no,
                'BankName' => $customerDetails[0]->bank_name,
                'BranchName' => $customerDetails[0]->branch_name,
                'unreadNotification' => $unreadNotification
            ];
            $this->view('customer/Profile', $data);
        }
    } 

    public function Services(){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            $data = [
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'unreadNotification' => $unreadNotification
            ];
            $this->view('customer/Services', $data);
        }
    } 

    // public function sidebar(){

    //     $this->view('customer/sidebar');
    // }

    public function updateusedbook($bookId = null){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        }
        $user_id = $_SESSION['user_id'];
       
        $customerDetails = $this->customerModel->findCustomerById($user_id);
        $bookCategoryDetails = $this->adminModel->getBookCategories();
        $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
        
        $customer_id=$customerDetails[0]->customer_id;

       
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
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'unreadNotification' => $unreadNotification
            ];

           
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
                    // redirect('customer/UsedBooks');
                    $_SESSION['showModal'] = true; // Set session variable to true
                    redirect('customer/updateusedbook');
                }else{
                    die('Something went wrong');
                }
                }else{
                    $this->view('customer/updateusedbook', $data);
                }


        }else{
            $UsedBookId = $this->customerModel->findUsedBookById($bookId);
            // $books = $this->publisherModel->findBookById($book_id);
            $bookCategoryDetails = $this->adminModel->getBookCategories();
            // if($UsedBookId->customer_id != $customer_id && $bookId != null){
            //     redirect('customer/UsedBooks');
            //   }
            $data = [
                // 'customerName'=>$customerName,
                'book_id' => $bookId,
                'bookCategoryDetails'=>$bookCategoryDetails,
                'book_name' => isset($UsedBookId->book_name) ? $UsedBookId->book_name : '',
                'ISBN_no' => isset($UsedBookId->ISBN_no) ? $UsedBookId->ISBN_no : '',
                'author' => isset($UsedBookId->author) ? $UsedBookId->author : '',
                'price' => isset($UsedBookId->price) ? $UsedBookId->price : '',
                'category' => isset($UsedBookId->category) ? $UsedBookId->category : '',
                'weight' => isset($UsedBookId->weight) ? $UsedBookId->weight : '',
                'descript' => isset($UsedBookId->descript) ? $UsedBookId->descript : '',
                'img1' => isset($UsedBookId->img1) ? $UsedBookId->img1 : '',
                'img2' => isset($UsedBookId->img2) ? $UsedBookId->img2 : '',
                'img3' => isset($UsedBookId->img3) ? $UsedBookId->img3 : '',
                'condition' => isset($UsedBookId->condition) ? $UsedBookId->condition : '',
                'published_year' => isset($UsedBookId->published_year) ? $UsedBookId->published_year : '',
                'price_type' => isset($UsedBookId->price_type) ? $UsedBookId->price_type : '',
                'account_name' => isset($UsedBookId->account_name) ? $UsedBookId->account_name : '',
                'account_no' => isset($UsedBookId->account_no) ? $UsedBookId->account_no : '',
                'bank_name' => isset($UsedBookId->bank_name) ? $UsedBookId->bank_name : '',
                'branch_name' => isset($UsedBookId->branch_name) ? $UsedBookId->branch_name : '',
                'town' => isset($UsedBookId->town) ? $UsedBookId->town : '',
                'district' => isset($UsedBookId->district) ? $UsedBookId->district : '',
                'postal_code' => isset($UsedBookId->postal_code) ? $UsedBookId->postal_code : '',
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'unreadNotification' => $unreadNotification
            ];


            $this->view('customer/updateusedbook', $data);

        }
    } 

    public function updateexchangebook($bookId = null){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        }
        $user_id = $_SESSION['user_id'];
       
        $customerDetails = $this->customerModel->findCustomerById($user_id);
        $customer_id=$customerDetails[0]->customer_id;

        $bookCategoryDetails = $this->adminModel->getBookCategories();
        $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
        // $data = [
        //     'customerDetails' => $customerDetails,
        //     'customerName' => $customerDetails[0]->first_name
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
                'booksIWant' => isset($_POST['input']) ? implode(', ', array_map('trim', $_POST['input'])) : '',
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
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'unreadNotification' => $unreadNotification
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
                    $_SESSION['showModal'] = true; // Set session variable to true
                    redirect('customer/updateexchangebook');
                }else{
                    die('Something went wrong');
                }
            }else{
                $this->view('customer/updateexchangebook', $data);
            }


        }else{
            $ExchangeBookId = $this->customerModel->findUsedBookById($bookId);
            // $books = $this->publisherModel->findBookById($book_id);
            $bookCategoryDetails = $this->adminModel->getBookCategories();
            // if($ExchangeBookId->customer_id != $customer_id && $bookId != null){
            //     redirect('customer/ExchangeBooks');
            // }
            $data = [
                // 'customerName'=>$customerName,
                'book_id' => $bookId,
                'bookCategoryDetails'=>$bookCategoryDetails,
                'book_name' => isset($ExchangeBookId->book_name) ? $ExchangeBookId->book_name : '',
                'ISBN_no' => isset($ExchangeBookId->ISBN_no) ? $ExchangeBookId->ISBN_no : '',
                'author' => isset($ExchangeBookId->author) ? $ExchangeBookId->author : '',
                'category' => isset($ExchangeBookId->category) ? $ExchangeBookId->category : '',
                'weight' => isset($ExchangeBookId->weight) ? $ExchangeBookId->weight : '',
                'descript' => isset($ExchangeBookId->descript) ? $ExchangeBookId->descript : '',
                'booksIWant' => isset($ExchangeBookId->booksIWant) ? $ExchangeBookId->booksIWant : '',
                'img1' => isset($ExchangeBookId->img1) ? $ExchangeBookId->img1 : '',
                'img2' => isset($ExchangeBookId->img2) ? $ExchangeBookId->img2 : '',
                'img3' => isset($ExchangeBookId->img3) ? $ExchangeBookId->img3 : '',
                'condition' => isset($ExchangeBookId->condition) ? $ExchangeBookId->condition : '',
                'published_year' => isset($ExchangeBookId->published_year) ? $ExchangeBookId->published_year : '',
                'town' => isset($ExchangeBookId->town) ? $ExchangeBookId->town : '',
                'district' => isset($ExchangeBookId->district) ? $ExchangeBookId->district : '',
                'postal_code' =>isset( $ExchangeBookId->postal_code) ? $ExchangeBookId->postal_code : '',
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'unreadNotification' => $unreadNotification
            ];


            $this->view('customer/updateexchangebook', $data);

        }
    }

    public function UpdateEvent($eventId = null){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } 
        $user_id = $_SESSION['user_id'];
        $customerDetails = $this->customerModel->findCustomerById($user_id);  
        $customer_id=$customerDetails[0]->customer_id;
        $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);


        if($_SERVER['REQUEST_METHOD']=='POST'){
            $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            $data=[
                'title' => trim($_POST['eventName']),
                'category_name' => trim($_POST['category']),
                'description' => trim($_POST['descriptions']),
                'location' => trim($_POST['location']),
                'start_date' => trim($_POST['startDate']),
                'end_date' => trim($_POST['endDate']),
                'start_time' => trim($_POST['startTime']),
                'end_time' => trim($_POST['endTime']),
                'poster' => '',
                'img1' => '',
                'img2' => '',
                'img3' => '',
                'img4' => '',
                'img5' => '',
                'user_id' => trim($user_id),// Replace this with the actual customer ID
                'status' => trim('pending'),
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'id' => $eventId,
                'unreadNotification' => $unreadNotification
            ];

            if (isset($_FILES['imgMain']['name']) AND !empty($_FILES['imgMain']['name'])) {
                $img_name = $_FILES['imgMain']['name'];
                $tmp_name = $_FILES['imgMain']['tmp_name'];
                $error = $_FILES['imgMain']['error'];
                
                if ($error === 0) {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
            
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if (in_array($img_ex_to_lc, $allowed_exs)) {
                        // Generate a unique identifier (e.g., timestamp)
                        $unique_id = time(); 
                        $new_img_name = $data['title'] . '-' . $unique_id . '-imgMain.' . $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addevents/" . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
            
                        $data['poster'] = $new_img_name;
                    }
                }
            }

            if (isset($_FILES['1stImg']['name']) AND !empty($_FILES['1stImg']['name'])) {
                $img_name = $_FILES['1stImg']['name'];
                $tmp_name = $_FILES['1stImg']['tmp_name'];
                $error = $_FILES['1stImg']['error'];
                
                if ($error === 0) {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
            
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if (in_array($img_ex_to_lc, $allowed_exs)) {
                        // Generate a unique identifier (e.g., timestamp)
                        $unique_id = time(); 
                        $new_img_name = $data['title'] . '-' . $unique_id . '-1stImg.' . $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addevents/" . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
            
                        $data['img1'] = $new_img_name;
                    }
                }
            }

            if (isset($_FILES['2ndImg']['name']) AND !empty($_FILES['2ndImg']['name'])) {
                $img_name = $_FILES['2ndImg']['name'];
                $tmp_name = $_FILES['2ndImg']['tmp_name'];
                $error = $_FILES['2ndImg']['error'];
                
                if ($error === 0) {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
            
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if (in_array($img_ex_to_lc, $allowed_exs)) {
                        // Generate a unique identifier (e.g., timestamp)
                        $unique_id = time(); 
                        $new_img_name = $data['title'] . '-' . $unique_id . '-2ndImg.' . $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addevents/" . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
            
                        $data['img2'] = $new_img_name;
                    }
                }
            }

            if (isset($_FILES['3rdImg']['name']) AND !empty($_FILES['3rdImg']['name'])) {
                $img_name = $_FILES['3rdImg']['name'];
                $tmp_name = $_FILES['3rdImg']['tmp_name'];
                $error = $_FILES['3rdImg']['error'];
                
                if ($error === 0) {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
            
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if (in_array($img_ex_to_lc, $allowed_exs)) {
                        // Generate a unique identifier (e.g., timestamp)
                        $unique_id = time(); 
                        $new_img_name = $data['title'] . '-' . $unique_id . '-3rdImg.' . $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addevents/" . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
            
                        $data['img3'] = $new_img_name;
                    }
                }
            }

            if (isset($_FILES['4thImg']['name']) AND !empty($_FILES['4thImg']['name'])) {
                $img_name = $_FILES['4thImg']['name'];
                $tmp_name = $_FILES['4thImg']['tmp_name'];
                $error = $_FILES['4thImg']['error'];
                
                if ($error === 0) {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
            
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if (in_array($img_ex_to_lc, $allowed_exs)) {
                        // Generate a unique identifier (e.g., timestamp)
                        $unique_id = time(); 
                        $new_img_name = $data['title'] . '-' . $unique_id . '-4thImg.' . $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addevents/" . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
            
                        $data['img4'] = $new_img_name;
                    }
                }
            }

            if (isset($_FILES['5thImg']['name']) AND !empty($_FILES['5thImg']['name'])) {
                $img_name = $_FILES['5thImg']['name'];
                $tmp_name = $_FILES['5thImg']['tmp_name'];
                $error = $_FILES['5thImg']['error'];
                
                if ($error === 0) {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
            
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if (in_array($img_ex_to_lc, $allowed_exs)) {
                        // Generate a unique identifier (e.g., timestamp)
                        $unique_id = time(); 
                        $new_img_name = $data['title'] . '-' . $unique_id . '-5thImg.' . $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addevents/" . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
            
                        $data['img5'] = $new_img_name;
                    }
                }
            }
            if($this->customerModel->UpdateEvent($data)){
                // flash('add_success','You are added the book  successfully');
                $_SESSION['showModal'] = true; // Set session variable to true
                redirect('customer/updateEvent');
            }else{
                die('Something went wrong');
            }

        } else {
            $Event = $this->customerModel->findEventById($eventId);
            // $books = $this->publisherModel->findBookById($book_id);
            // if($Event[0]->customer_id != $customer_id){
            //     redirect('customer/Event');
            // }
            $eventCategoryDetails = $this->adminModel->getEventCategories();
            $data = [
                'customerid' => $customer_id,
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,

                'id' => $eventId,
                'Name' => isset($Event[0]->title) ? $Event[0]->title : '',
                'Category' => isset($Event[0]->category_name) ? $Event[0]->category_name : '',
                'Description' => isset($Event[0]->description) ? $Event[0]->description : '',
                'Start_date' => isset($Event[0]->start_date) ? $Event[0]->start_date : '',
                'End_date' => isset($Event[0]->end_date) ? $Event[0]->end_date : '',
                'Start_time' => isset($Event[0]->start_time) ? $Event[0]->start_time : '',
                'End_time' => isset($Event[0]->end_time) ? $Event[0]->end_time : '',
                'Venue' => isset($Event[0]->location) ? $Event[0]->location : '',
                'mainImg' => isset($Event[0]->poster) ? $Event[0]->poster : '',
                'img1' => isset($Event[0]->img1) ? $Event[0]->img1 : '',
                'img2' => isset($Event[0]->img2) ? $Event[0]->img2 : '',
                'img3' => isset($Event[0]->img3) ? $Event[0]->img3 : '',
                'img4' => isset($Event[0]->img4) ? $Event[0]->img4 : '',
                'img5' => isset($Event[0]->img5) ? $Event[0]->img5 : '',
                'eventCategoryDetails'=>$eventCategoryDetails,
                'unreadNotification' => $unreadNotification
            ];
            $this->view('customer/UpdateEvent', $data);
        }
    }

    public function updateContent($contentId = null){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        }
        $user_id = $_SESSION['user_id'];
        $customerDetails = $this->customerModel->findCustomerById($user_id);
        $customer_id=$customerDetails[0]->customer_id;
        $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);

       
        if($_SERVER['REQUEST_METHOD']=='POST'){
            // process form
            // sanitize post data
            $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

            if ($customerDetails) {
                $customerName = $customerDetails[0]->first_name;
                $customerid = $customerDetails[0]->customer_id;                 
            } else {
                echo "Not found";
            }
                      
            $data=[
                'topic' => trim($_POST['topic']),
                'text' => trim($_POST['description']),
                'picture' => '',
                'pdf' => '',
                'user_id' => $user_id,// Replace this with the actual customer ID
                'customer_id'=>$customerDetails[0]->customer_id,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerName,
                'status' => "pending",
                'content_id' => $contentId,
                'unreadNotification' => $unreadNotification
            ];
                
            if (isset($_FILES['picture']['name']) AND !empty($_FILES['picture']['name'])) {
                $img_name = $_FILES['picture']['name'];
                $tmp_name = $_FILES['picture']['tmp_name'];
                $error = $_FILES['picture']['error'];
                
                if ($error === 0) {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
            
                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if (in_array($img_ex_to_lc, $allowed_exs)) {
                        // Generate a unique identifier (e.g., timestamp)
                        $unique_id = time(); 
                        $new_img_name = $data['topic'] . '-' . $unique_id . 'img.' . $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addcontents/" . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
            
                        $data['picture'] = $new_img_name;
                    }
                }
            }

            if (isset($_FILES['pdf']['name']) AND !empty($_FILES['pdf']['name'])) {
                $img_name = $_FILES['pdf']['name'];
                $tmp_name = $_FILES['pdf']['tmp_name'];
                $error = $_FILES['pdf']['error'];
                
                if ($error === 0) {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);
            
                    $allowed_exs = array('pdf');
                    if (in_array($img_ex_to_lc, $allowed_exs)) {
                        // Generate a unique identifier (e.g., timestamp)
                        $unique_id = time(); 
                        $new_img_name = $data['topic'] . '-' . $unique_id . 'pdf.' . $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/landing/addcontents/" . $new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
            
                        $data['pdf'] = $new_img_name;
                    }
                }
            }

            if($this->customerModel->updateContent($data)){
                // flash('update_success','You are added the book  successfully');
                $_SESSION['showModal'] = true; // Set session variable to true
                redirect('customer/updateContent');
            }else{
                die('Something went wrong');
            }

        }else{
            $Content = $this->customerModel->findContentById($contentId);

            $data = [
                'customerid' => $customer_id,
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'unreadNotification' => $unreadNotification,

                'id' => $contentId,
                'Name' => isset($Content[0]->topic) ? $Content[0]->topic : '', // Check if topic exists
                'Description' => isset($Content[0]->text) ? $Content[0]->text : '' // Check if text exists
            ];

            $this->view('customer/updateContent', $data);
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

    public function deleteEvent($eventId)
    {
        if ($this->customerModel->deleteEvent($eventId)) {   
            // flash('post_message', 'book is Removed');
            redirect('customer/Event');
            
            
        } else {
            die('Something went wrong');
        }
    }

    public function deleteFavorite($fav_id)
    {
        if ($this->customerModel->deleteFavorite($fav_id)) {   
            // flash('post_message', 'book is Removed');
            redirect('customer/Favorite');
            
            
        } else {
            die('Something went wrong');
        }
    }

    public function deleteContent($contentId)
    {
        if ($this->customerModel->deleteContent($contentId)) {   
            // flash('post_message', 'book is Removed');
            redirect('customer/Content');
            
            
        } else {
            die('Something went wrong');
        }
    }

    // public function removeFromFavoriteNewBooks($fav_id)
    // {
    //     if ($this->customerModel->deleteFavorite($fav_id)) {   
    //         // flash('post_message', 'book is Removed');
    //         redirect('customer/BuyNewBooks');
            
            
    //     } else {
    //         die('Something went wrong');
    //     }
    // }

    public function RemoveEventFromCalender($eventId)
    {
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        }
        $customerid = null;
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $customerDetails = $this->customerModel->findCustomerById($user_id);
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            if ($customerDetails) {
                $customerid = $customerDetails[0]->customer_id;
            } else {
                echo "Not found";
            }
        } else {
            echo "Not a customer";
        }
        $data = [
            'customerid' => $customerid,
            'customerDetails' => $customerDetails,
            'customerImage' => $customerDetails[0]->profile_img,
            'customerName' => $customerDetails[0]->first_name,
            'unreadNotification' => $unreadNotification,
    
            'user_id' => trim($user_id),
            'event_id' => trim($eventId),
        ];
        if ($this->customerModel->RemoveEventFromCalender($data)) {   
            // flash('post_message', 'book is Removed');
            redirect('customer/BookEvents');
            
            
        } else {
            die('Something went wrong');
        }
    }

    public function AddEventToCalender($eventId){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        }
        $customerid = null;
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $customerDetails = $this->customerModel->findCustomerById($user_id);
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            if ($customerDetails) {
                $customerid = $customerDetails[0]->customer_id;
                $eventIDdetails = $this->customerModel->findEventById($eventId);
            } else {
                echo "Not found";
            }
        } else {
            echo "Not a customer";
        }
        $data = [
            'customerid' => $customerid,
            'customerDetails' => $customerDetails,
            'eventIDdetails' => $eventIDdetails,
            'customerImage' => $customerDetails[0]->profile_img,
            'customerName' => $customerDetails[0]->first_name,
            'unreadNotification' => $unreadNotification,
    
            'user_id' => trim($user_id),
            'event_id' => trim($eventId),
            'title' => trim($eventIDdetails[0]->title),
            'start_date' => trim($eventIDdetails[0]->start_date),
            'end_date' => trim($eventIDdetails[0]->end_date),
            'start_time' => trim($eventIDdetails[0]->start_time),
            'end_time' => trim($eventIDdetails[0]->end_time),
        ];
        // $this->view('customer/viewevents', $data);

        if ($this->customerModel->AddEventToCalender($data)) {   
            // flash('post_message', 'book is Removed');
            redirect('customer/BookEvents');
            
            
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
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        }
        $customerid = null;
        
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
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
            'customerImage' => $customerDetails[0]->profile_img,
            'customerName' => $customerDetails[0]->first_name,
            'unreadNotification' => $unreadNotification
        ];

        $this->view('customer/UsedBooks', $data);
    } 

    public function ViewBook($bookId){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } 
        $customerid = null;
        
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            
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

        if(!$UsedBookId){
            redirect('customer/UsedBooks');
        }

        $data = [
            'customerid' => $customerid,
            'customerDetails' => $customerDetails,
            'bookDetails' => $bookDetails,
            'UsedBookId' => $UsedBookId,
            'customerName' => $customerDetails[0]->first_name,
            'customerImage' => $customerDetails[0]->profile_img,
            'unreadNotification' => $unreadNotification,
            

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
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        }
        $customerid = null;
        
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            
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

        if(!$ExchangeBookId){
            redirect('customer/ExchangeBooks');
        }

        $data = [
            'customerid' => $customerid,
            'customerDetails' => $customerDetails,
            'bookDetails' => $bookDetails,
            'ExchangeBookId' => $ExchangeBookId,
            'customerName' => $customerDetails[0]->first_name,
            'customerImage' => $customerDetails[0]->profile_img,
            'unreadNotification' => $unreadNotification,

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

    public function viewcontent($content_id){
        if (!isLoggedInCustomer()) {
            
            $contentDetails=$this->customerModel->findContentById($content_id);
            // $reviewDetails=$this->customerModel->findReviewsByContentId($content_id)  ;
            $averageRatingCount=$this->customerModel->getAverageRatingByContentId($content_id);
            $countStar_1 = $this->customerModel->countStar_1c($content_id);
            $countStar_2 = $this->customerModel->countStar_2c($content_id);
            $countStar_3 = $this->customerModel->countStar_3c($content_id);
            $countStar_4 = $this->customerModel->countStar_4c($content_id);
            $countStar_5 = $this->customerModel->countStar_5c($content_id);

            $category = isset($_POST['category']) ? $_POST['category'] : 'recent';
            $reviewDetails = $this->customerModel->findReviewsByContentId($content_id, $category);

            
            $data = [
                'contentDetails'=>$contentDetails,
                'reviewDetails'=>$reviewDetails,
                'countStar_1'=>$countStar_1,
                'countStar_2'=>$countStar_2,
                'countStar_3'=>$countStar_3,
                'countStar_4'=>$countStar_4,
                'countStar_5'=>$countStar_5,
                // 'ratingCount'=>$ratingCount,
                'averageRatingCount'=>$averageRatingCount
                // 'ratingDistribution'=>$ratingDistribution
            ];
            $this->view('customer/viewcontent', $data);
        } else {
            $user_id = $_SESSION['user_id'];
            $contentDetails=$this->customerModel->findContentById($content_id);
            $customerDetails = $this->customerModel->findCustomerById($user_id);
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id); 
           
            $averageRatingCount=$this->customerModel->getAverageRatingByContentId($content_id);
            $countStar_1 = $this->customerModel->countStar_1c($content_id);
            $countStar_2 = $this->customerModel->countStar_2c($content_id);
            $countStar_3 = $this->customerModel->countStar_3c($content_id);
            $countStar_4 = $this->customerModel->countStar_4c($content_id);
            $countStar_5 = $this->customerModel->countStar_5c($content_id);

            $category = isset($_POST['category']) ? $_POST['category'] : 'recent';
            $reviewDetails = $this->customerModel->findReviewsByContentId($content_id, $category);
           
            $data = [
                'customer_id'=>$customerDetails[0]->customer_id,
                'user_id'=> $user_id,
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->first_name,
                'customerImage' => $customerDetails[0]->profile_img,
                'unreadNotification' => $unreadNotification,
                'contentDetails'=>$contentDetails,
                'reviewDetails'=>$reviewDetails,
                'countStar_1'=>$countStar_1,
                'countStar_2'=>$countStar_2,
                'countStar_3'=>$countStar_3,
                'countStar_4'=>$countStar_4,
                'countStar_5'=>$countStar_5,
                // 'ratingCount'=>$ratingCount,
                'averageRatingCount'=>$averageRatingCount
                // 'ratingDistribution'=>$ratingDistribution
            ];
            $this->view('customer/viewcontent', $data);
        }
    } 
    public function deleteReview($content_id,$review_id){
        if($this->customerModel->deleteReview($review_id)){
            echo '<script>';
            echo 'alert("Successfully deleted  your review");';
            echo '</script>';
            header("Location: " . URLROOT . "/customer/viewcontent/".$content_id);
            // header("Location: " . URLROOT . "/customer/viewcontent/4" . $data['content_id']);
            exit();
        }
    }
    public function deleteReviewBook($content_id,$review_id){
        if($this->customerModel->deleteReviewBook($review_id)){
            echo '<script>';
            echo 'alert("Successfully deleted  your review");';
            echo '</script>';
            header("Location: " . URLROOT . "/customer/bookDetails/".$content_id);
            // header("Location: " . URLROOT . "/customer/viewcontent/4" . $data['content_id']);
            exit();
        }
    }
    public function updateReview($content_id, $review_id) {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $description = $_POST['description'];
            $rating = $_POST['rate'];
            if($this->customerModel->updateReview($review_id,$rating,$description)){
                 header("Location: " . URLROOT . "/customer/viewcontent/".$content_id);
                 exit;
            }
        } else {
           
            header("Location: " . URLROOT . "/customer/viewcontent/".$content_id);
            exit;
        }
    }
public function markReview()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      
        $data = json_decode(file_get_contents("php://input"));
        $reviewId = $data->reviewId;
        $action = $data->action;
        if($action=='yes'){
            if($this->$customerModel->markReview($reviewId)){
                echo json_encode(['success' => true]);
            } else {
                // Return an error response for non-POST requests
                http_response_code(405); // Method Not Allowed
                echo json_encode(['error' => 'Method Not Allowed']);
            }
        }
        
    }     
       
    
}



    public function viewevents($eventId){
        if (!isLoggedInCustomer()) {
            $eventIDdetails = $this->customerModel->findEventById($eventId);
            $eventInCalendar = $this->customerModel->checkEventInCalendar(-100000, $eventId);
            $data = [
                'eventIDdetails' => $eventIDdetails,
                
                'eventId' => $eventId,
                'Name' => $eventIDdetails[0]->title,
                'Category' => $eventIDdetails[0]->category_name,
                'Description' => $eventIDdetails[0]->description,
                'Start_date' => $eventIDdetails[0]->start_date,
                'End_date' => $eventIDdetails[0]->end_date,
                'Start_time' => $eventIDdetails[0]->start_time,
                'End_time' => $eventIDdetails[0]->end_time,
                'Venue' => $eventIDdetails[0]->location,
                'mainImg' => $eventIDdetails[0]->poster,
                'img1' => $eventIDdetails[0]->img1,
                'img2' => $eventIDdetails[0]->img2,
                'img3' => $eventIDdetails[0]->img3,
                'img4' => $eventIDdetails[0]->img4,
                'img5' => $eventIDdetails[0]->img5,
                'eventInCalendar' => $eventInCalendar
            ];
            $this->view('customer/viewevents', $data);
        } else {
        $customerid = null;
        
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            if ($customerDetails) {
                
                $customerid = $customerDetails[0]->customer_id;
                
                // $bookDetails = $this->customerModel->findUsedBookByCusId($customerid);
                $eventIDdetails = $this->customerModel->findEventById($eventId);
                $eventInCalendar = $this->customerModel->checkEventInCalendar($user_id, $eventId);
            } else {
                echo "Not found";
            }
        } else {
            echo "Not a customer";
        }
        $data = [
            'customerid' => $customerid,
            'customerDetails' => $customerDetails,
            'eventIDdetails' => $eventIDdetails,
            'customerImage' => $customerDetails[0]->profile_img,
            'customerName' => $customerDetails[0]->first_name,
            'unreadNotification' => $unreadNotification,
            
            'eventId' => $eventId,
            'Name' => $eventIDdetails[0]->title,
            'Category' => $eventIDdetails[0]->category_name,
            'Description' => $eventIDdetails[0]->description,
            'Start_date' => $eventIDdetails[0]->start_date,
            'End_date' => $eventIDdetails[0]->end_date,
            'Start_time' => $eventIDdetails[0]->start_time,
            'End_time' => $eventIDdetails[0]->end_time,
            'Venue' => $eventIDdetails[0]->location,
            'mainImg' => $eventIDdetails[0]->poster,
            'img1' => $eventIDdetails[0]->img1,
            'img2' => $eventIDdetails[0]->img2,
            'img3' => $eventIDdetails[0]->img3,
            'img4' => $eventIDdetails[0]->img4,
            'img5' => $eventIDdetails[0]->img5,
            'eventInCalendar' => $eventInCalendar
        ];
        $this->view('customer/viewevents', $data);
        }
    } 

    public function ViewMyEvent($eventId){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } 
        $customerid = null;
        
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            if ($customerDetails) {
                
                $customerid = $customerDetails[0]->customer_id;
                
                // $bookDetails = $this->customerModel->findUsedBookByCusId($customerid);
                $eventIDdetails = $this->customerModel->findEventById($eventId);
                // $eventInCalendar = $this->customerModel->checkEventInCalendar($user_id, $eventId);
            } else {
                echo "Not found";
            }
        } else {
            echo "Not a customer";
        }
        $data = [
            'customerid' => $customerid,
            'customerDetails' => $customerDetails,
            'eventIDdetails' => $eventIDdetails,
            'customerImage' => $customerDetails[0]->profile_img,
            'customerName' => $customerDetails[0]->first_name,
            'unreadNotification' => $unreadNotification,
            
            'eventId' => $eventId,
            'Name' => $eventIDdetails[0]->title,
            'Category' => $eventIDdetails[0]->category_name,
            'Description' => $eventIDdetails[0]->description,
            'Start_date' => $eventIDdetails[0]->start_date,
            'End_date' => $eventIDdetails[0]->end_date,
            'Start_time' => $eventIDdetails[0]->start_time,
            'End_time' => $eventIDdetails[0]->end_time,
            'Venue' => $eventIDdetails[0]->location,
            'mainImg' => $eventIDdetails[0]->poster,
            'img1' => $eventIDdetails[0]->img1,
            'img2' => $eventIDdetails[0]->img2,
            'img3' => $eventIDdetails[0]->img3,
            'img4' => $eventIDdetails[0]->img4,
            'img5' => $eventIDdetails[0]->img5
        ];
        $this->view('customer/ViewMyEvent', $data);
    }

    public function ViewFavorite($fav_id){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } 
        $customerid = null;
        
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            if ($customerDetails) {
                
                $customerid = $customerDetails[0]->customer_id;
                $favDetails = $this->customerModel->findFavoriteById($fav_id);
                $category = $favDetails[0]->category;
                $item_id = $favDetails[0]->item_id;
            } else {
                echo "Not found";
            }
        } else {
            echo "Not a customer";
        }
        
        if ($category == "New Book") {
            redirect('customer/BookDetails/'.$item_id);
            // $this->view('customer/BookDetails',$item_id);
        } elseif ($category == "Used Book") {
            redirect('customer/UsedBookDetails/'.$item_id);
        } elseif ($category == "Exchange Book") {
            redirect('customer/ExchangeBookDetails/'.$item_id);
        } elseif ($category == "Content") {
            redirect('customer/viewcontent/'.$item_id);
        }
        else {
            $this->view('customer/Favorite');
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
        if (!isLoggedInCustomer()) {
            $NewbookDetailsByTime = $this->customerModel->findNewBooksByTime();
            $bookCategoryDetails = $this->adminModel->getBookCategories();

            $data = [
                'bookDetails' => $NewbookDetailsByTime,
                'bookCategoryDetails'=>$bookCategoryDetails,
                'user_id' => 0000
            ];

            $this->view('customer/TopCategory', $data);
        } else {
            $user_id = $_SESSION['user_id'];

            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            $customer_id = $customerDetails[0]->customer_id;
            $NewbookDetailsByTime = $this->customerModel->findNewBooksByTime();
            $bookCategoryDetails = $this->adminModel->getBookCategories();
            $favoriteDetails = $this->customerModel->findNewBooksFavoriteByCustomerId($customer_id);
            $data = [
                'customerDetails' => $customerDetails,
                'user_id'=>$user_id,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'bookDetails' => $NewbookDetailsByTime,
                'bookCategoryDetails'=>$bookCategoryDetails,
                'favoriteDetails' => $favoriteDetails,
                'unreadNotification' => $unreadNotification
            ];
            $this->view('customer/TopCategory', $data);
        }
    }

    public function TopAuthor(){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];

            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            $data = [
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'unreadNotification' => $unreadNotification
            ];
            $this->view('customer/TopAuthor', $data);
        }
    }

    public function Recommended(){
        if (!isLoggedInCustomer()) {
            $recommendedBooks = $this->customerModel->topSelling();
            // $NewbookDetailsByTime = $this->customerModel->findNewBooksByTime();
            $data = [  
                // 'bookDetails' => $NewbookDetailsByTime,
                'recommendedBooks' => $recommendedBooks,
                'user_id' => 0000
            ];
            $this->view('customer/Recommended', $data);

        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id); 
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            $customer_id = $customerDetails[0]->customer_id;
            $favoriteDetails = $this->customerModel->findNewBooksFavoriteByCustomerId($customer_id);
            $recommendedBooks = $this->customerModel->recommendBooks($customer_id); 
            $data = [
                'user_id'=>$user_id,
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'recommendedBooks'=>$recommendedBooks,
                'favoriteDetails' => $favoriteDetails,
                'unreadNotification' => $unreadNotification
            ];
            $this->view('customer/Recommended', $data);
        }
    }


    public function Category($category){
        if (!isLoggedInCustomer()) {
            $NewbookDetailsByCategory = $this->customerModel->findBooksByCategory($category);
            $data = [
                'bookDetails' => $NewbookDetailsByCategory,
                'category' => $category,
                'user_id' => 0000
            ];

            $this->view('customer/Category', $data);
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            $customer_id = $customerDetails[0]->customer_id;
            $NewbookDetailsByCategory = $this->customerModel->findBooksByCategory($category);
            $favoriteDetails = $this->customerModel->findNewBooksFavoriteByCustomerId($customer_id);

            $data = [
                'customerDetails' => $customerDetails,
                'user_id'=>$user_id,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'bookDetails' => $NewbookDetailsByCategory,
                'category' => $category,
                'favoriteDetails' => $favoriteDetails,
                'unreadNotification' => $unreadNotification
            ];
            $this->view('customer/Category', $data);
        }
    }


    public function NewArrival(){
        if (!isLoggedInCustomer()) {
            $NewbookDetailsByTime = $this->customerModel->findNewBooksByTime();
            $data = [
                'bookDetails' => $NewbookDetailsByTime,
                'user_id' => 0000
            ];
            $this->view('customer/NewArrival', $data);
        } else {
            $user_id = $_SESSION['user_id'];

            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            $customer_id = $customerDetails[0]->customer_id;
            $NewbookDetailsByTime = $this->customerModel->findNewBooksByTime();
            $favoriteDetails = $this->customerModel->findNewBooksFavoriteByCustomerId($customer_id);
            $data = [
                'customerDetails' => $customerDetails,
                'user_id'=>$user_id,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'bookDetails' => $NewbookDetailsByTime,
                'favoriteDetails' => $favoriteDetails,
                'unreadNotification' => $unreadNotification
            ];
            $this->view('customer/NewArrival', $data);
        }
    }

    public function UsedBookDetails($bookId){
        if (!isLoggedInCustomer()) {
            $UsedBookId = $this->customerModel->findUsedBookById($bookId);
            $data = [
                'UsedBookId' => $UsedBookId,
                'user_id' => 0000,
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
        } else {
        $customerid = null;
        
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            
            if ($customerDetails) {
                
                $customerid = $customerDetails[0]->customer_id;
                
                $bookDetails = $this->customerModel->findUsedBookByCusId($customerid);
                $UsedBookId = $this->customerModel->findUsedBookById($bookId);
                $favoriteDetails = $this->customerModel->findUsedBooksFavoriteByCustomerId($customerid);

                
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
            'customer_user_id'=>$UsedBookId->customer_user_id,
            'customerid' => $customerid,
            'customerDetails' => $customerDetails,
            'bookDetails' => $bookDetails,
            'UsedBookId' => $UsedBookId,
            'customerName' => $customerDetails[0]->first_name,
            'customerImage' => $customerDetails[0]->profile_img,
            'user_id'=>$user_id,
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
            'favoriteDetails' => $favoriteDetails,
            'unreadNotification' => $unreadNotification
        ];
        $this->view('customer/UsedBookDetails', $data);
        }
    }

    public function Favorite(){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } 
        $customerid = null;

        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            
            if ($customerDetails) {
                $customerid = $customerDetails[0]->customer_id;
                $favoriteDetails = $this->customerModel->findFavoriteByCustomerId($customerid);
            } else {
                echo "Not found";
            }
        } else {
            echo "Not a customer";
        }
           
        $data = [
            'customerid' => $customerid,
            'customerDetails' => $customerDetails,
            'favoriteDetails' => $favoriteDetails,
            'customerImage' => $customerDetails[0]->profile_img,
            'customerName' => $customerDetails[0]->first_name,
            'unreadNotification' => $unreadNotification
        ];
        $this->view('customer/Favorite', $data);
    }



    public function Calender(){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');

        } else {
            $customerid = null;

            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
            
                $customerDetails = $this->customerModel->findCustomerById($user_id);
                $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
              
                if ($customerDetails) {
                    $customerid = $customerDetails[0]->customer_id;
                    $mysaveevent = $this->customerModel->findsaveevent($user_id);
                    // $bookDetails = $this->customerModel->findUsedBookByNotCusId($customerid);
                } else {
                    echo "Not found";
                }
            } else {
                echo "Not a customer";
            }

           
            $data = [
                'customerid' => $customerid,
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'eventDetails' => $mysaveevent,
                'unreadNotification' => $unreadNotification
            ];
            $this->view('customer/Calender', $data);
        }
    }

    
    public function BookChallenge(){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id); 
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            $challengeDetails = $this->customerModel->getOngoingChallenges($user_id);
            $quizDetails = $this->customerModel->getQuizDetails();
            $data = [
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'challengeDetails'=>$challengeDetails,
                'quizDetails'=>$quizDetails,
                'unreadNotification' => $unreadNotification
            ];
            $this->view('customer/BookChallenge', $data);
        }
    }

    public function quiz($quiz_id){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            $quizDetails = $this->customerModel->getQuiz($quiz_id);
            $data = [
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'quizDetails'=>$quizDetails,
                'unreadNotification' => $unreadNotification
            ];
            $this->view('customer/quiz', $data);
        }   
    }

    public function quizQuestion($quiz_id,$question_id){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
            $question = $this->customerModel->getQuizQuestion($quiz_id,$question_id);
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $selectedOption = $_POST['option'];
                if($selectedOption == $question[0]->correctAnswer){
                    $this->customerModel->incrementScore($user_id);
                }
                $question_id = $question_id + 1;
                if($question_id<6) redirect('customer/quizQuestion/'.$quiz_id.'/'.$question_id);
                else redirect('customer/result/'.$quiz_id);

            }
            else{
                $customerDetails = $this->customerModel->findCustomerById($user_id);

                $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
                if($question_id==1) $this->customerModel->addQuizAttempt($quiz_id,$user_id);

                // if($question_id==1){
                //     if(!($this->customerModel->addQuizAttempt($quiz_id,$user_id))){
                //         redirect('customer/BookChallenge');
                //     }
                // }

            
                $data = [
                    'customerDetails' => $customerDetails,
                    'customerImage' => $customerDetails[0]->profile_img,
                    'customerName' => $customerDetails[0]->first_name,
                    'question'=>$question[0]->question,
                    'option1'=>$question[0]->option1,
                    'option2'=>$question[0]->option2,
                    'option3'=>$question[0]->option3,
                    'quiz_id'=>$quiz_id,
                    'unreadNotification' => $unreadNotification
                ];
                $this->view('customer/quizQuestion'.$question_id, $data);
            }
        }
    }

    public function result($quiz_id){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
            $score = $this->customerModel->getQuizScore($quiz_id,$user_id);
            $answers = $this->customerModel->getAllQuizQuestions($quiz_id);
            $scoreObject = $score[0];
            $score = $scoreObject->score;
            $numberOfRightAnswers = $score/2;
            $numberOfWrongAnswers = 5- $numberOfRightAnswers;
            $percentage = $score*10;
            $data = [
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'score'=>$score,
                'numberOfRightAnswers'=>$numberOfRightAnswers,
                'numberOfWrongAnswers'=>$numberOfWrongAnswers,
                'percentage'=>$percentage,
                'answers'=>$answers,
                'unreadNotification' => $unreadNotification
            ];
            $this->view('customer/result', $data);
        }
    }

    public function Order(){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);
            $orderDetails=$this->ordersModel->findOrdersByCustomerId( $customerDetails[0]->customer_id);
            // $orderDetails01 = $this->ordersModel->findOrdersByCustomerId($$orderDetails->order_id);
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);

            $orderDetailsArray = [];
            foreach ($orderDetails as $order) {
                $orderDetailsArray[$order->order_id] = $this->ordersModel->findOrdersByOrderId($order->order_id);
            }

            $data = [
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'orderDetails' => $orderDetails,
                'orderDetailsArray' => $orderDetailsArray,
                'unreadNotification' => $unreadNotification
            ];
           
            $this->view('customer/Order', $data);
        }
    }
    public function confirmOrderStatus() {
        $data = json_decode(file_get_contents("php://input"), true); // Get raw POST data
        $orderId = $data['orderId'];
        $orderDetails=$this->ordersModel->getOrderById($orderId);
        $reason = $data['reason'];
        $rating= $data['rating'];
        $status=$orderDetails[0]->status;
        $customerId=$orderDetails[0]->customer_id;
        if($status!='cancel'){
            if ($this->ordersModel->confirmOrderStatus($orderId, $reason,$status) ) {

                if($reason){
                    $this->ordersModel->addDeliveryReview($orderId, $customerId,$reason,$rating);
                 
                }
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false]);
            }
        }else{
            echo json_encode(['success' => false]);
        }
        
    }
    

    // public function getOrderDetails($order_id){
    //     if (!isLoggedInCustomer()) {
    //         redirect('landing/login');
    //     } else {
    //         $user_id = $_SESSION['user_id'];
           
    //         $customerDetails = $this->customerModel->findCustomerById($user_id);
    //         $orderDetails = $this->ordersModel->findOrdersByOrderId($order_id);
    
    //         if (!empty($orderDetails)) { // Check if order details are not empty
    //             $data = [
    //                 'customerDetails' => $customerDetails,
    //                 'customerImage' => $customerDetails[0]->profile_img,
    //                 'customerName' => $customerDetails[0]->first_name,
    //                 'orderDetails1'=>$orderDetails1
    //             ];
    //             $_SESSION['showModal1'] = true; // Set session variable to true
    //             $this->Order($data);
    //         } else {
    //             // Handle the case when no order details are found
    //             // For example, display an error message or redirect to another page
    //         }
    //     }
    // }
    
    

    public function cancelOrder() {
        
        $data = json_decode(file_get_contents('php://input'), true);
        $user_id = $_SESSION['user_id'];
        $userDetails=$this->userModel->getUserDetails($user_id);
        $userEmail=$userDetails[0]->email;

        $userName=$userDetails[0]->name;
        $topic="Order Cancellation Confirmation and Refund Information";
        $message="

        Dear .$userName.,
        
        We hope this email finds you well.
        
        We wanted to inform you that your recent order with us has been successfully canceled. We understand that circumstances can change, and we appreciate your prompt action in canceling the order.
        
        As per our cancellation policy, we have initiated the refund process for your canceled order. You can expect to receive your refund within the next 5 days. Please note that it may take some time for the refund to reflect in your account, depending on your bank or payment provider.
        
        If for any reason you do not receive your refund within the specified timeframe, please don't hesitate to contact our support team at [support email] or reach out to us directly at [Readspot27@gmail.com]. We are here to assist you and ensure that any issues are promptly resolved.
        
        Once again, thank you for choosing us, and we apologize for any inconvenience caused. We appreciate your understanding and cooperation.
        
        Best regards,
        
        Readspot Team
        readspot@gmail.com
        (+94112222345)";
       
        $orderId = $data['orderId'];
        $reason = $data['reason'];

        if($orderId && $reason){
            if($this->ordersModel->cancelOrder($orderId,$reason)){
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->isSMTP();
                    $mail->Host       = MAIL_HOST;  
                    $mail->SMTPAuth   = true;
                    $mail->Username   = MAIL_USER; // SMTP username
                    $mail->Password   = MAIL_PASS;   // SMTP password
                    $mail->SMTPSecure = MAIL_SECURITY;
                    $mail->Port       = MAIL_PORT;
        
                    //Recipients
                    $mail->setFrom('readspot27@gmail.com', 'READSPOT');
                    $mail->addAddress($userEmail);  // Add a recipient
        
                    // Content
                    $mail->isHTML(true);  // Set email format to HTML
                    $mail->Subject = $topic;
                    $mail->Body    = $message;
        
                    $mail->send();
                    $response = [
                        'success' => true 
                    ];
                } catch (Exception $e) {
                    die('Something went wrong: ' . $mail->ErrorInfo);
                }
                
            }
        }
       
        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function filterbook(){
        if(!isLoggedInCustomer()){
            if(isset($_POST['query']) && isset($_POST['bookType'])){
                $inputText = $_POST['query'];
                $bookType = $_POST['bookType'];
                $searchResults ='';
                
                // $user_id = $_SESSION['user_id'];
                // $customerDetails = $this->customerModel->findCustomerById($user_id);
                // $customer_id = $customerDetails[0]->customer_id;
    
                if($bookType=='N'){
                    $searchResults = $this->customerModel->searchNewBooks($inputText);
                }
                else if($bookType=='U'){
                    $searchResults = $this->customerModel->searchUsedBooksWithoutLoggedIn($inputText);
                }
                else if($bookType=='E'){
                    $searchResults = $this->customerModel->searchExchangeBooksWithoutLoggedIn($inputText);
                }
                
                $data = [
                    'searchResults' => $searchResults,
                    'inputText' => $inputText,
                    'bookType'=>$bookType,
                ];
                $this->view('customer/filterbook', $data);
            } 
        }
        else{
            if(isset($_POST['query']) && isset($_POST['bookType'])){
                $inputText = $_POST['query'];
                $bookType = $_POST['bookType'];
                $searchResults ='';
                
                $user_id = $_SESSION['user_id'];
                $customerDetails = $this->customerModel->findCustomerById($user_id);
                $customer_id = $customerDetails[0]->customer_id;

                if($bookType=='N'){
                    $searchResults = $this->customerModel->searchNewBooks($inputText);
                }
                else if($bookType=='U'){
                    $searchResults = $this->customerModel->searchUsedBooks($inputText, $customer_id);
                }
                else if($bookType=='E'){
                    $searchResults = $this->customerModel->searchExchangeBooks($inputText, $customer_id);
                }
                
                $data = [
                    'searchResults' => $searchResults,
                    'inputText' => $inputText,
                    'bookType'=>$bookType,
                ];
                $this->view('customer/filterbook', $data);
            }
        }
    }

    public function filtercontent(){
        if(isset($_POST['query']) && isset($_POST['bookType'])){
            $inputText = $_POST['query'];
            $bookType = $_POST['bookType'];
            $searchResults ='';
            
            $user_id = $_SESSION['user_id'];
            $customerDetails = $this->customerModel->findCustomerById($user_id);
            $customer_id = $customerDetails[0]->customer_id;
            
            if($bookType=='C'){
                $searchResults = $this->customerModel->searchContent($inputText, $customer_id);
            }
            
            $data = [
                'searchResults' => $searchResults,
                'inputText' => $inputText,
                'bookType'=>$bookType,
            ];
            $this->view('customer/filtercontent', $data);
        }
    }
    

    public function weightCalculator(){
        if (!isLoggedInCustomer()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];

           
            $customerDetails = $this->customerModel->findCustomerById($user_id); 
            $customer_id=$customerDetails[0] ->customer_id;
            $unreadNotification = $this->publisherModel->getUnreadMessagesCount($user_id);
           
            $data = [
                'customerDetails' => $customerDetails,
                'customerImage' => $customerDetails[0]->profile_img,
                'customerName' => $customerDetails[0]->first_name,
                'unreadNotification' => $unreadNotification
            ];
            
            $this->view('customer/weightCalculator', $data);
        }
    }
}