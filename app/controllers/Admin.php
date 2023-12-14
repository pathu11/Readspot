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

  private $db;
  public function __construct(){
      $this->adminModel=$this->model('Admins');
      $this->userModel=$this->model('User');
     
     
      $this->db = new Database();

  }
  /*public function index(){
      
      if (!isLoggedIn()) {
          redirect('landing/login');
      } else {
          $user_id = $_SESSION['user_id'];
         

          $adminDetails = $this->adminModel->findAdminById($user_id); 
          $getPendingUserDetails = $this->adminModel->getPendingUsers();
          
          $data = [
              'adminDetails' => $adminDetails,
              'adminName'=>$adminDetails[0]->name,
              'pendingUserDetails'=>$getPendingUserDetails

          ];
          $this->view('admin/index', $data);
      }
  }*/

  public function index(){
    if (!isLoggedIn()) {
        redirect('landing/login');
    } else {

        //checking filter get request and load the table
        if (isset($_GET['user_role'])) {
            $user_id = $_SESSION['user_id'];
            $adminDetails = $this->adminModel->findAdminById($user_id);
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
                'countDelivery'=>$countDelivery
  
            ];
            $this->view('admin/index', $data);
        
        } else {
            $user_id = $_SESSION['user_id'];
         

            $adminDetails = $this->adminModel->findAdminById($user_id); 
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
                'countDelivery'=>$countDelivery
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
            $mail->Host       = MAIL_HOST;  // Specify your SMTP server
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
            $mail->addAddress($userEmail);  // Add a recipient

            // Content
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
    }
    $data = [
        'customerSearchDetails'=>$customerSearchDetails
    ];
    
    $this->view('admin/livesearch',$data);
}

}

