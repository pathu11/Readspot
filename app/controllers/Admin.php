<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require APPROOT . '\vendor\autoload.php';
//Create an instance; passing `true` enables exceptions
// $mail = new PHPMailer(true);
 class Admin extends Controller{
  private $adminModel;
  private $userModel;
  private $ordersModel;
  
  private $db;
  public function __construct() {
    $this->adminModel = $this->model('Admins');
    $this->userModel = $this->model('User'); // Instantiate User model directly
    $this->ordersModel = $this->model('Orders');
    $this->db = new Database();

    // if(isset($_SESSION['user_id'])) {
    //     $user_id = $_SESSION['user_id'];
    //     // Use $this->userModel to access getUserDetails method
    //     $user = $this->userModel->getUserDetails($user_id);
    //     if(!$user[0]->user_role == 'admin') {
    //         redirect('landing/login');
    //     }
    // } else {
    //     redirect('landing/login');
    // }
}
 

  public function index(){
    if (!isLoggedInAdmin()) {
        redirect('landing/login');
    } else {

        //checking filter get request and load the table
        if (isset($_GET['user_role'])) {
            $user_id = $_SESSION['user_id'];
            $adminDetails = $this->adminModel->findAdminById($user_id);
            $messageDetails = $this->adminModel->getMessageDetails($user_id);
            $userRoleFilter = $_GET['user_role'];
        
            $getPendingUserDetailsFilteredByUserRole = $this->adminModel->getPendingUserDetailsFilteredByUserRole($userRoleFilter);

            $countModerators = $this->adminModel->countModerators(); 
            $countDelivery = $this->adminModel->countDelivery(); 
            $countCustomers = $this->adminModel->countCustomers (); 
            $countPublishers = $this->adminModel->countPublishers(); 
            $countCharity = $this->adminModel->countCharity();
            
            $data = [
                'adminDetails' => $adminDetails,
                'adminName'=>$adminDetails[0]->name,
                'pendingUserDetails'=>$getPendingUserDetailsFilteredByUserRole,
                'countModerators'=>$countModerators,
                'countCustomers'=>$countCustomers,
                'countPublishers'=>$countPublishers,
                'countCharity'=>$countCharity,
                'countDelivery'=>$countDelivery,
                'messageDetails'=>$messageDetails,
  
            ];
            $this->view('admin/index', $data);
        
        } else {
            $user_id = $_SESSION['user_id'];
         

            $adminDetails = $this->adminModel->findAdminById($user_id);
            $messageDetails = $this->adminModel->getMessageDetails($user_id); 
            $getPendingUserDetails = $this->adminModel->getPendingUsers();

            
            $countModerators = $this->adminModel->countModerators(); 
            $countDelivery = $this->adminModel->countDelivery(); 
            $countCustomers = $this->adminModel->countCustomers (); 
            $countPublishers = $this->adminModel->countPublishers(); 
            $countCharity = $this->adminModel->countCharity();
            
            $data = [
                'adminDetails' => $adminDetails,
                'adminName'=>$adminDetails[0]->name,
                'pendingUserDetails'=>$getPendingUserDetails,
                'countModerators'=>$countModerators,
                'countCustomers'=>$countCustomers,
                'countPublishers'=>$countPublishers,
                'countCharity'=>$countCharity,
                'countDelivery'=>$countDelivery,
                'messageDetails' =>$messageDetails,
            ];
            $this->view('admin/index', $data);
        }
      }
  }
  


  public function categories(){
    $user_id = $_SESSION['user_id'];
         
    $adminDetails = $this->adminModel->findAdminById($user_id);
    $bookCategoryDetails = $this->adminModel->getBookCategories();
    $eventCategoryDetails = $this->adminModel->getEventCategories();  
    $data = [
        'adminDetails' => $adminDetails,
        'adminName'=>$adminDetails[0]->name,
        'bookCategoryDetails'=>$bookCategoryDetails,
        'eventCategoryDetails'=>$eventCategoryDetails,
    ];
    $this->view('admin/categories',$data);
  }


  public function addBookCategories(){
    $user_id = $_SESSION['user_id'];
         
    $adminDetails = $this->adminModel->findAdminById($user_id);
    
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
        $data = [
            'adminDetails' => $adminDetails,
            'adminName'=>$adminDetails[0]->name,
            'book_category'=>trim($_POST['book_category']),
            'description'=>trim($_POST['description']),
            'book_category_err'=>'',
            'description_err'=>''
        ];
        if(empty($data['book_category'])){
            $data['book_category_err']='Please enter the category name';      
        }

        if(empty($data['description'])){
            $data['description_err']='Please enter the category description';      
        }

        if(empty($data['book_category_err']) && empty($data['description_err'])){
            if($this->adminModel->addBookCategory($data)){
                flash('add_success','You are added the book category successfully');
                redirect('admin/categories');
            }else{
                die('Something went wrong');
            }
        }

        else{
            $this->view('admin/addBookCategories',$data);
        }  
    }
    else{
        $data=[
            'adminDetails' => $adminDetails,
            'adminName'=>$adminDetails[0]->name,
            'book_category'=>'',
            'description'=>'',
            'book_category_err'=>'',
            'description_err'=>''
        ];

        $this->view('admin/addBookCategories',$data);
    } 
  }
  public function updateBookCategory($id)
{
    $user_id = $_SESSION['user_id'];
    $adminDetails = $this->adminModel->findAdminById($user_id);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'adminDetails' => $adminDetails,
            'adminName' => $adminDetails[0]->name,
            'id' => $id,
            'book_category' => trim($_POST['book_category']),
            'description' => trim($_POST['description']),
            'book_category_err' => '',
            'description_err' => ''
        ];

        if (empty($data['book_category'])) {
            $data['book_category_err'] = 'Please enter the category name';
        }

        if (empty($data['description'])) {
            $data['description_err'] = 'Please enter the category description';
        }

        if (empty($data['book_category_err']) && empty($data['description_err'])) {
            if ($this->adminModel->updateBookCategory($data)) {
                flash('update_success', 'You are updated the book category successfully');
                redirect('admin/categories');
            } else {
                die('Something went wrong');
            }
        } else {
            // Load view with errors
            $this->view('admin/updateBookCategory', $data);
        }
    } else {
        $bookCategory = $this->adminModel->findBookCategoryById($id);

        $data = [
            'adminDetails' => $adminDetails,
            'adminName' => $adminDetails[0]->name,
            'id' => $id,
            'book_category' => $bookCategory->category,
            'description' => $bookCategory->description,
            'book_category_err' => '',
            'description_err' => ''
        ];

        $this->view('admin/updateBookCategory', $data);
    }
}
  public function deleteBookCategory($id){
    if($this->adminModel->deleteBookCategory($id)){
        flash('delete_success','You deleted the book category successfully');
        redirect('admin/categories');
    }
    else{
        die('Something went wrong');
    }
  }

  public function addEventCategory(){
    $user_id = $_SESSION['user_id'];
         
    $adminDetails = $this->adminModel->findAdminById($user_id);
    
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

        $data = [
            'adminDetails' => $adminDetails,
            'adminName'=>$adminDetails[0]->name,
            'event_category'=>trim($_POST['event_category']),
            'description'=>trim($_POST['description']),

            'event_category_err'=>'',
            'description_err'=>''
        ];

        if(empty($data['event_category'])){
            $data['event_category_err']='Please enter the category name';      
        }

        if(empty($data['description'])){
            $data['description_err']='Please enter the category description';      
        }

        if(empty($data['event_category_err']) && empty($data['description_err'])){
            if($this->adminModel->addEventCategory($data)){
                flash('add_success','You are added the event category successfully');
                redirect('admin/categories');
            }else{
                die('Something went wrong');
            }
        }

        else{
            $this->view('admin/addEventCategory',$data);
        }
        
    }

    else{
        $data=[
            'adminDetails' => $adminDetails,
            'adminName'=>$adminDetails[0]->name,
            'event_category'=>'',
            'description'=>'',
            'event_category_err'=>'',
            'description_err'=>''
        ];

        $this->view('admin/addEventCategory',$data);
    }
  }

  public function updateEventCategory($id){
    $user_id = $_SESSION['user_id'];
    $adminDetails = $this->adminModel->findAdminById($user_id);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
            'adminDetails' => $adminDetails,
            'adminName' => $adminDetails[0]->name,
            'id' => $id,
            'event_category' => trim($_POST['event_category']),
            'description' => trim($_POST['description']),
            'event_category_err' => '',
            'description_err' => ''
        ];

        if (empty($data['event_category'])) {
            $data['event_category_err'] = 'Please enter the category name';
        }

        if (empty($data['description'])) {
            $data['description_err'] = 'Please enter the category description';
        }

        if (empty($data['event_category_err']) && empty($data['description_err'])) {
            if ($this->adminModel->updateEventCategory($data)) {
                flash('update_success', 'You are updated the event category successfully');
                redirect('admin/categories');
            } else {
                die('Something went wrong');
            }
        } else {
            // Load view with errors
            $this->view('admin/updateEventCategory', $data);
        }
    } else {
        $eventCategory = $this->adminModel->findEventCategoryById($id);

        $data = [
            'adminDetails' => $adminDetails,
            'adminName' => $adminDetails[0]->name,
            'id' => $id,
            'event_category' => $eventCategory->event,
            'description' => $eventCategory->description,
            'event_category_err' => '',
            'description_err' => ''
        ];

        $this->view('admin/updateEventCategory', $data);
    }
  }

  public function deleteEventCategory($id){
    if($this->adminModel->deleteEventCategory($id)){
        flash('delete_success','You deleted the event category successfully');
        redirect('admin/categories');
    }
    else{
        die('Something went wrong');
    }
  }

  public function pendingRequestsPub(){
    if (!isLoggedIn()) {
        redirect('landing/login');
    } else {
        $user_id = $_SESSION['user_id'];
       
        $getpublishersDetails = $this->adminModel->getPendingPublishers(); 
        $adminDetails = $this->adminModel->findadminById($user_id);
        $data = [
            'adminDetails' => $adminDetails,
            'adminName'=>$adminDetails[0]->name,
            'getpublishersDetails'=>$getpublishersDetails
        ];
        $this->view('admin/pendingRequestsPub', $data);
    }

  }

  public function pendingRequestsCharity(){
    if (!isLoggedIn()) {
        redirect('landing/login');
    } else {
        $user_id = $_SESSION['user_id'];
       
        $getcharityDetails = $this->adminModel->getPendingCharity(); 
        $adminDetails = $this->adminModel->findadminById($user_id);
        $data = [
            'adminDetails' => $adminDetails,
            'adminName'=>$adminDetails[0]->name,
            'getcharityDetails'=>$getcharityDetails
        ];
        $this->view('admin/pendingRequestsCharity', $data);
    }
  }
  
  
  
  public function approvePub($user_id){
    // Assuming your approval logic here...

    if ($this->adminModel->approveusers($user_id) && $this->adminModel->approvePub($user_id)) {
        // Approval successful

        // Retrieve the email from the database
        $userEmail = $this->adminModel->getUserEmail($user_id);

        // Send email using PHPMailer
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
            $mail->Subject = 'Approved the registration by administration';
            $mail->Body    = 'Congratulations! Your registration has been approved. You can now log in to the system.';

            $mail->send();

            // Redirect or perform other actions as needed
            redirect('admin/pendingRequestsPub');
        } catch (Exception $e) {
            die('Something went wrong: ' . $mail->ErrorInfo);
        }
    } else {
        die('Something went wrong');
    }
}

public function approveCharity($user_id){
    // Assuming your approval logic here...

    if ($this->adminModel->approveusers($user_id) && $this->adminModel->approveCharity($user_id)) {
        // Approval successful

        // Retrieve the email from the database
        $userEmail = $this->adminModel->getUserEmail($user_id);

        // Send email using PHPMailer
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = MAIL_HOST;  
            $mail->SMTPAuth   = true;
            $mail->Username   = MAIL_USER;
            $mail->Password   = MAIL_PASS; 
            $mail->SMTPSecure = MAIL_SECURITY;
            $mail->Port       = MAIL_PORT;
            $mail->setFrom('readspot27@gmail.com', 'READSPOT');
            $mail->addAddress($userEmail);  
            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = 'Approved the registration by administration';
            $mail->Body    = 'Congratulations! Your registration has been approved. You can now log in to the system.';

            $mail->send();

            // Redirect or perform other actions as needed
            redirect('admin/pendingRequestsCharity');
        } catch (Exception $e) {
            die('Something went wrong: ' . $mail->ErrorInfo);
        }
    } else {
        die('Something went wrong');
    }
}

public function customers(){
    $user_id = $_SESSION['user_id'];
         
    $adminDetails = $this->adminModel->findAdminById($user_id);
    $customerDetails = $this->adminModel->getCustomerDetails();
    $data = [
        'adminDetails' => $adminDetails,
        'adminName'=>$adminDetails[0]->name,
        'customerDetails'=>$customerDetails,
    ];
    $this->view('admin/customers',$data);
}

public function publishers(){
    $user_id = $_SESSION['user_id'];
         
    $adminDetails = $this->adminModel->findAdminById($user_id);
    $publisherDetails = $this->adminModel->getPublisherDetails();
    $data = [
        'adminDetails' => $adminDetails,
        'adminName'=>$adminDetails[0]->name,
        'publisherDetails'=>$publisherDetails,
    ];
    $this->view('admin/publishers',$data);
}

public function charity(){
    $user_id = $_SESSION['user_id'];
         
    $adminDetails = $this->adminModel->findAdminById($user_id);
    $charityDetails = $this->adminModel->getCharityDetails();
    $data = [
        'adminDetails' => $adminDetails,
        'adminName'=>$adminDetails[0]->name,
        'charityDetails'=>$charityDetails,
    ];
    $this->view('admin/charity',$data);
}

public function livesearch(){
    if(isset($_POST['input'])){
        $input = $_POST['input'];
        $customerSearchDetails = $this->adminModel->getCustomerSearchDetails($input);
        $publisherSearchDetails = $this->adminModel->getPublisherSearchDetails($input);
        $charitySearchDetails = $this->adminModel->getCharitySearchDetails($input);
        $orderSearchDetailsByID = $this->adminModel->getOrderSearchDetailsByID($input);
        $orderSearchDetailsByDate = $this->adminModel->getOrderSearchDetailsByDate($input);
    }

    $data = [
        'customerSearchDetails'=>$customerSearchDetails,
        'publisherSearchDetails'=>$publisherSearchDetails,
        'charitySearchDetails'=>$charitySearchDetails,
        'orderSearchDetailsByID'=>$orderSearchDetailsByID,
        'orderSearchDetailsByDate'=>$orderSearchDetailsByDate,
    ];
    
    $this->view('admin/livesearch',$data);
}

public function orders(){
    $user_id = $_SESSION['user_id'];
         
    $adminDetails = $this->adminModel->findAdminById($user_id);
    $orderDetails = $this->adminModel->getOrderDetails();
    $data = [
        'adminDetails' => $adminDetails,
        'adminName'=>$adminDetails[0]->name,
        'orderDetails'=>$orderDetails,
    ];
    $this->view('admin/orders',$data);
}

public function reports(){
    $user_id = $_SESSION['user_id'];
         
    $adminDetails = $this->adminModel->findAdminById($user_id);
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
        //report type is registration report
        if($_POST['report-type']=='registration'){
            $data = [
                'adminDetails' => $adminDetails,
                'adminName'=>$adminDetails[0]->name,
                'registration'=>trim($_POST['report-type']),
                'start-date'=>trim($_POST['start-date']),
                'end-date'=>trim($_POST['end-date']),
                
    
                'registration_err'=>'',
                'start-date_err'=>'',
                'end-date_err'=>''
            ];
            
            // Separate start-date components
            list($startYear, $startMonth, $startDay) = explode('-', $data['start-date']);
            
            // Separate end-date components
            list($endYear, $endMonth, $endDay) = explode('-', $data['end-date']);
            
            // Add the separated components to the data array
            $data['startYear'] = $startYear;
            $data['startMonth'] = $startMonth;
            $data['startDay'] = $startDay;
            
            $data['endYear'] = $endYear;
            $data['endMonth'] = $endMonth;
            $data['endDay'] = $endDay;
            
    
            if(empty($data['registration'])){
                $data['event_category_err']='Please select the report type';      
            }
    
            if(empty($data['start-date'])){
                $data['start-date_err']='Please enter the start date';      
            }
    
            if(empty($data['registration_err']) && empty($data['start-date_err']) && empty($data['end-date_err'])){
                if($this->adminModel->generateRegistrationReport($data)){
                    $registrationDetails = $this->adminModel->generateRegistrationReport($data);
                    $data=[
                        'adminDetails' => $adminDetails,
                        'adminName'=>$adminDetails[0]->name,
                        'registrationDetails'=>$registrationDetails,
                        'title'=>trim($_POST['title'])
                    ];
                    $this->view('admin/reports',$data);
                }else{
                    die('Something went wrong');
                }
            }
    
            else{
                $this->view('admin/reports',$data);
            }

        }
        //report type is book inventory report
        elseif($_POST['report-type']=='book-inventory'){
            if(isset($_POST['total_books'])){
                $totalBooks = $this->adminModel->countTotalBooks();
            }
            else $totalBooks = '';
            
            if(isset($_POST['book_category'])){
                $bookCategories = $this->adminModel->getBookCategories();
            }
            else $bookCategories = '';
            
            if(isset($_POST['top_books'])){
                $topBooks = $this->adminModel->getTopBooks();
            }
            else $topBooks = '';
            
            if(isset($_POST['book_available'])){
                $availableBooks = $this->adminModel->getAvailableBooks();
            }
            else $availableBooks = '';

            $data=[
                'adminDetails' => $adminDetails,
                'adminName'=>$adminDetails[0]->name,
                'totalBooks' => $totalBooks,
                'bookCategories'=>$bookCategories,
                'topBooks'=>$topBooks,
                'availableBooks'=>$availableBooks,
                'title'=>trim($_POST['title'])
            ];
            $this->view('admin/reports',$data);

        }
        
    }

    else{
        $data=[
            'adminDetails' => $adminDetails,
            'adminName'=>$adminDetails[0]->name,
        ];

        $this->view('admin/reports',$data);
    }

}
public function pending_payments(){
    if (!isLoggedIn()) {
        redirect('landing/login');
    } else{

        $user_id = $_SESSION['user_id']; 
        $adminDetails = $this->adminModel->findAdminById($user_id);
        $orderDetails = $this->adminModel->getPendingOrderDetails();
        $data = [
            'adminDetails' => $adminDetails,
            'adminName'=>$adminDetails[0]->name,
            'orderDetails'=>$orderDetails,
        ];
        $this->view('admin/pending_payments',$data);

    }
    
}
public function payments(){
    if (!isLoggedIn()) {
        redirect('landing/login');
    } else{

        $user_id = $_SESSION['user_id'];
        $adminDetails = $this->adminModel->findAdminById($user_id);
        $paymentDetails = $this->adminModel->getPaymentsDetails();
        $data = [
            'adminDetails' => $adminDetails,
            'adminName'=>$adminDetails[0]->name,
            'paymentsDetails'=>$paymentDetails,
        ];
        // print_r($paymentDetails);
        $this->view('admin/payments',$data);
    }  
}

public function sendPayment() {
    $user_id=$_SESSION['user_id'];
    $paymentDetails = $_POST['paymentDetails'];

    $order_id=$paymentDetails['order_id'];
    $book_id=$paymentDetails['book_id'];
    $paid_price=$paymentDetails['paid_price'];
    $user_id_from_users_table=$paymentDetails['user_id_from_users_table'];
    $quantity=$paymentDetails['quantity'];
    $sender_name="System_Administration";
    $topic="Payment Confirmation: Books Delivered to Buyers";
    $msg="We are pleased to inform you that the payment for the books you supplied has been successfully processed. These books have been delivered to their respective buyers, marking the completion of another successful transaction:

        Order ID: .$order_id
        Book ID: .$book_id
        Total Payment: .$paid_price
        
        We appreciate your valuable contribution to our platform and the quality literature you provide. Your continued partnership is integral to our success.
        
        Thank you for your dedication and support. ";
    
        if($this->adminModel->insertPayment($order_id,$book_id,$paid_price,$user_id_from_users_table,$quantity)){
            if($this->adminModel->sendMessage($user_id_from_users_table,$user_id,$sender_name,$topic,$msg)){
                $userEmail = $this->adminModel->getUserEmail($user_id_from_users_table);

                // Send email using PHPMailer
                $mail = new PHPMailer(true);
        
                try {
                    $mail->isSMTP();
                    $mail->Host       = MAIL_HOST;  
                    $mail->SMTPAuth   = true;
                    $mail->Username   = MAIL_USER;
                    $mail->Password   = MAIL_PASS; 
                    $mail->SMTPSecure = MAIL_SECURITY;
                    $mail->Port       = MAIL_PORT;
                    $mail->setFrom('readspot27@gmail.com', 'READSPOT');
                    $mail->addAddress($userEmail);  
                    $mail->isHTML(true);  // Set email format to HTML
                    $mail->Subject = $topic;
                    $mail->Body    = $msg;
        
                    $mail->send();
                    echo json_encode(['success' => true]);
                   
                   
                } catch (Exception $e) {
                    die('Something went wrong: ' . $mail->ErrorInfo);
                }
                
            }
          
          
        }else {
        //     // echo '<script>alert("Failed to send your payment. Please try again later.")</script>';
             echo json_encode(['success' => false]);
         }
   
   
}

public function approveOrder($order_id) {
    $user_id = $_SESSION['user_id'];
    $adminDetails = $this->adminModel->findAdminById($user_id);

    $orderDetails = $this->adminModel->getOrderDetailsById($order_id);
    $customer_id = $orderDetails[0]->customer_id;
    $customerDetails = $this->adminModel->getCustomerDetailsById($customer_id);
    $customerEmail = $customerDetails[0]->email;
    $topic = "Approved the Order by administration";
    $message ="Congratulations! Your order has been approved. Your order will be received at home as soon as possible.";
    $messageToPublisher = "Congratulations! You have a new order. Login to the site and visit your order status by this tracking number " . $orderDetails[0]->tracking_no;

    $bookIds = $this->ordersModel->getOrderDetailsFromOrderDetailsById($order_id);
    $ownerEmails = array();
    foreach ($bookIds as $bookIdObj) {
        $bookId = $bookIdObj->book_id;
        // Fetch book details using book ID
        $bookDetails = $this->adminModel->getBookDetailsById($bookId); 
        
        
        if ($bookDetails[0]->type == 'new') {
            $user_idPub = $bookDetails[0]->publisher_id;
            $ownerDetails = $this->adminModel->getPublisherDetailsById($user_idPub);
        } else if ($bookDetails[0]->type == 'used' || $bookDetails[0]->type == 'exchanged') {
            $user_idPub = $bookDetails[0]->customer_id;
            $ownerDetails = $this->adminModel->getCustomerDetailsById($user_idPub);
        }
        // Store owner email in the array
        $ownerEmails[] = $ownerDetails[0]->email;
    }
    

    $data = [
        'adminDetails' => $adminDetails,
        'adminName'=>$adminDetails[0]->name,
        'topic' => $topic,
        'messageToPublisher' => $messageToPublisher,
        'message' => $message,
        'user_id' => $customerDetails[0]->user_id,
        // 'user_idPub' => $ownerDetails[0]->user_id,
        'sender_id' => $user_id,
        'sender_name' => $adminDetails[0]->name,
        
    ];

    // Assuming your approval logic here...
    if ($this->adminModel->approveOrder($order_id)) {

        $this->sendEmails($customerEmail, $ownerEmails, $data);

        // Redirect or perform other actions as needed
        redirect('admin/payments');
    } else {
        die('Something went wrong');
    }
}

private function sendEmails($customerEmail, $ownerEmails, $data) {
    foreach ($ownerEmails as $ownerEmail) {
        $this->sendEmail($ownerEmail, $data['topic'], $data['messageToPublisher']);
    }
    $this->sendEmail($customerEmail, $data['topic'], $data['message']);
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

public function pendingRequestsBooks(){
    if (!isLoggedIn()) {
        redirect('landing/login');
    } else{
        $user_id = $_SESSION['user_id'];
         
        $adminDetails = $this->adminModel->findAdminById($user_id);
        $pendingBookDetails = $this->adminModel->getPendingBookDetails();
        $data = [
            'adminDetails' => $adminDetails,
            'adminName'=>$adminDetails[0]->name,
            'pendingBookDetails'=>$pendingBookDetails
        ];
        $this->view('admin/pendingRequestsBooks',$data);
    }

}

public function approveBook($book_id){
        // Retrieve the email from the database
        $pendingBook = $this->adminModel->getPendingBookByID($book_id);
        $customerEmail = $pendingBook[0]->email;

        if($this->adminModel->approveBook($book_id)){
            // Send email using PHPMailer
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->isSMTP();
                $mail->Host       = MAIL_HOST;  // Specify your SMTP server
                $mail->SMTPAuth   = true;
                $mail->Username   = MAIL_USER; // SMTP username
                $mail->Password   = MAIL_PASS;   // SMTP password
                $mail->SMTPSecure = MAIL_SECURITY;
                $mail->Port       = MAIL_PORT;

                //Recipients
                $mail->setFrom('readspot27@gmail.com', 'READSPOT');
                $mail->addAddress($customerEmail);  // Add a recipient

                // Content
                $mail->isHTML(true);  // Set email format to HTML
                $mail->Subject = 'Your Book '.$pendingBook[0]->book_name.' Has Been Accepted';
                $mail->Body    = "Dear ".$pendingBook[0]->name. ",.\n\n" .
                                "We are pleased to inform you that your book " .$pendingBook[0]->book_name.", authored by " .$pendingBook[0]->author. ", has been accepted by our admin for sale.\n\n".
                                "Thank you for contributing to our platform.\n\n".
                                "Sincerely,\n".
                                "The Admin Team";

                $mail->send();

                // Redirect or perform other actions as needed
                redirect('admin/pendingRequestsBooks');
            } catch (Exception $e) {
                die('Something went wrong: ' . $mail->ErrorInfo);
            }
        }
        else{
            echo 'Something Went Wrong';
        }
        
    
}

public function rejectBook(){

        $rejectReason = $_POST['rejectReason'];
        $customer_id = $_POST['customer_id'];
        $pendingBook = $this->adminModel->getPendingBookByID($customer_id);
        $customerEmail = $pendingBook[0]->email;

        // Send email using PHPMailer
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host       = MAIL_HOST;  // Specify your SMTP server
            $mail->SMTPAuth   = true;
            $mail->Username   = MAIL_USER; // SMTP username
            $mail->Password   = MAIL_PASS;   // SMTP password
            $mail->SMTPSecure = MAIL_SECURITY;
            $mail->Port       = MAIL_PORT;

            //Recipients
            $mail->setFrom('readspot27@gmail.com', 'READSPOT');
            $mail->addAddress($customerEmail);  // Add a recipient

            // Content
            $mail->isHTML(true);  // Set email format to HTML
            $mail->Subject = 'Your Book '.$pendingBook[0]->book_name.' Has Been Rejected';
            $mail->Body    = "Dear ".$pendingBook[0]->name. ",.<br><br>" .
                            "Unfortunaltely your book " .$pendingBook[0]->book_name.", authored by " .$pendingBook[0]->author. ", has been has been rejected for the following reason:<br><br>".
                            $rejectReason."Thank you for your submission.<br><br>".
                            "Sincerely,<br>".
                            "The Admin Team";
                
            // Redirect or perform other actions as needed

            redirect('admin/pendingRequestsBooks');
            
        } catch (Exception $e) {
            die('Something went wrong: ' . $mail->ErrorInfo);
        }
}



}

