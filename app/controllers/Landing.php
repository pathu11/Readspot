<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require APPROOT . '\vendor\autoload.php';

class Landing extends Controller{
    private $userModel;
    private $publisherModel;
    private $adminModel;
    private $deliveryModel;
    private $superadminModel;

    private $db;
    public function  __construct(){
        $this->userModel=$this->model('User');
        $this->deliveryModel=$this->model('Deliver');
        $this->publisherModel=$this->model('Publishers');
        // $this->charityModel=$this->model('Charity');
        $this->adminModel=$this->model('Admins');
        $this->superadminModel=$this->model('Super_admin');
        $this->db = new Database();
       
    }
    
    public function index(){ 
        $title="Hi";
        $data=[
            'title'=>$title
        ];
        $this->view('landing/index',$data);       
    }
    public function error(){
       
        $this->view('landing/error');
    }
    
    public function selectuser(){
       
        $this->view('landing/selectuser');
    }
    public function signupCustomer(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            // process form
            // sanitize post data
            $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            // init data
            $data=[
                'name'=>trim($_POST['name']),
                'email'=>trim($_POST['email']),
                'pass'=>trim($_POST['pass']),
                'confirm_pass'=>trim($_POST['confirm_pass']),
                'name_err'=>'',
                'email_err'=>'',
                'pass_err'=>'',
                'confirm_pass_err'=>'',
            ];

            // validate email
            //validate lname
            if(empty($data['name'])){
                $data['name_err']='Please enter the name';      
            }
            //validate email
            if(empty($data['email'])){
                $data['email_err']='Please enter email';      
            }else{
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err']='Email is already taken'; 
                }
            }
            //validate password
            if(empty($data['pass'])){
                $data['pass_err']='Please enter password';      
            }elseif(strlen($data['pass'])<6){
                $data['pass_err']='Password must be atleast 6 characters'; 
            }

             //validate confirm password
             if(empty($data['confirm_pass'])){
                $data['confirm_pass_err']='Please confirm password';      
            }else{
                if($data['pass']!=$data['confirm_pass']){
                    $data['confirm_pass_err']='password not matching';
                }
            }

            

            //make sure errors are empty
            if( empty($data['name_err']) && empty($data['email_err']) && empty($data['pass_err']) && empty($data['confirm_pass_err'])  ){
                //validate

                //hash password
                $data['pass']=password_hash($data['pass'],PASSWORD_DEFAULT);

                //regsiter user
                if($this->userModel->signupCustomer($data)){
                    flash('register_success','You are registered and can login');
                    redirect('landing/login');
                }else{
                    die('Something went wrong');
                }
            }else{
                $this->view('landing/signupCustomer',$data);
            }


        }else{
            $data=[
                'name'=>'',
                'email'=>'',
                'pass'=>'',
                'confirm_pass'=>'',
                'name_err'=>'',
                'email_err'=>'',
                'pass_err'=>'',
                'confirm_pass_err'=>'',
            ];

            $this->view('landing/signupCustomer',$data);

        }
       
       
        
    }
    public function signupPub(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            // process form
            // sanitize post data
            $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            // init data
            $data=[
                'name'=>trim($_POST['name']),
                'company_name'=>trim($_POST['company_name']),
                'reg_no'=>trim($_POST['reg_no']),
                'email'=>trim($_POST['email']),
                'contact_no'=>trim($_POST['contact_no']),
                'pass'=>trim($_POST['pass']),

                'confirm_pass'=>trim($_POST['confirm_pass']),
                'name_err'=>'',
                'company_name_err'=>'',
                'reg_no_err'=>'',
                'email_err'=>'',
                'contact_no_err'=>'',
                'pass_err'=>'',
                'confirm_pass_err'=>'',
            ];

            // validate email
            //validate lname
            if(empty($data['name'])){
                $data['name_err']='Please enter the name';      
            }
            if(empty($data['company_name'])){
                $data['company_name_err']='Please enter the company  name';      
            }
            if(empty($data['reg_no'])){
                $data['reg_no_err']='Please enter the registration  number';      
            }
            //validate email
            if(empty($data['email'])){
                $data['email_err']='Please enter email';      
            }else{
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err']='Email is already taken'; 
                }
            }
            // validate phone number
             
             if(empty($data['contact_no'])){
                $data['contact_no_err']='Please enter the contact number';      
            }elseif(strlen($data['contact_no'])<10){
                $data['contact_no_err']='Invalid phone number'; 
            }



            //validate password
            if(empty($data['pass'])){
                $data['pass_err']='Please enter password';      
            }elseif(strlen($data['pass'])<6){
                $data['pass_err']='Password must be atleast 6 characters'; 
            }

             //validate confirm password
             if(empty($data['confirm_pass'])){
                $data['confirm_pass_err']='Please confirm password';      
            }else{
                if($data['pass']!=$data['confirm_pass']){
                    $data['confirm_pass_err']='password not matching';
                }
            }

            

            //make sure errors are empty
            if( empty($data['name_err']) && empty($data['company_name_err']) && empty($data['reg_no_err']) &&empty($data['email_err']) && empty($data['contact_no_err']) &&empty($data['pass_err']) && empty($data['confirm_pass_err'])  ){
                //validate

                //hash password
                $data['pass']=password_hash($data['pass'],PASSWORD_DEFAULT);
                
                // regsiter user
                if($this->userModel->signupPubPending($data)){
                    flash('Pending for admin approvel');
                    redirect('landing/index');
                }else{
                    die('Something went wrong');
                }
            }else{
                $this->view('landing/signupPub',$data);
            }


        }else{
           
                $data=[
                    'name'=>'',
                    'company_name'=>'',
                    'reg_no'=>'',
                    'email'=>'',
                    'contact_no'=>'',
                    'pass'=>'',
    
                    'confirm_pass'=>'',
                    'name_err'=>'',
                    'company_name_err'=>'',
                    'reg_no_err'=>'',
                    'email_err'=>'',
                    'contact_no_err'=>'',
                    'pass_err'=>'',
                    'confirm_pass_err'=>'',
                ];
            

            $this->view('landing/signupPub',$data);

        }
       

       
       
    }

    public function signupCharity(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            // process form
            // sanitize post data
            $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            // init data
            $data=[
                'name'=>trim($_POST['name']),
                'org_name'=>trim($_POST['org_name']),

                'reg_no'=>trim($_POST['reg_no']),
                
                'email'=>trim($_POST['email']),
                'contact_no'=>trim($_POST['contact_no']),
                'pass'=>trim($_POST['pass']),

                'confirm_pass'=>trim($_POST['confirm_pass']),
                'name_err'=>'',
                'org_name_err'=>'',
                'reg_no_err'=>'',
                'email_err'=>'',
                'contact_no_err'=>'',
                'pass_err'=>'',
                'confirm_pass_err'=>'',
            ];

            // validate email
            //validate lname
            if(empty($data['name'])){
                $data['name_err']='Please enter the name';      
            }
            if(empty($data['org_name'])){
                $data['company_name_err']='Please enter the company  name';      
            }
            if(empty($data['reg_no'])){
                $data['reg_no_err']='Please enter the registration  number';      
            }
            //validate email
            if(empty($data['email'])){
                $data['email_err']='Please enter email';      
            }else{
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err']='Email is already taken'; 
                }
            }
            // validate phone number
             
             if(empty($data['contact_no'])){
                $data['contact_no_err']='Please enter the contact number';      
            }elseif(strlen($data['contact_no'])<10){
                $data['contact_no_err']='Invalid phone number'; 
            }



            //validate password
            if(empty($data['pass'])){
                $data['pass_err']='Please enter password';      
            }elseif(strlen($data['pass'])<6){
                $data['pass_err']='Password must be atleast 6 characters'; 
            }

             //validate confirm password
             if(empty($data['confirm_pass'])){
                $data['confirm_pass_err']='Please confirm password';      
            }else{
                if($data['pass']!=$data['confirm_pass']){
                    $data['confirm_pass_err']='password not matching';
                }
            }

            

            //make sure errors are empty
            if( empty($data['name_err']) && empty($data['org_name_err']) && empty($data['reg_no_err']) && empty($data['email_err']) && empty($data['contact_no_err']) &&empty($data['pass_err']) && empty($data['confirm_pass_err'])  ){
                //validate

                //hash password
                $data['pass']=password_hash($data['pass'],PASSWORD_DEFAULT);

                //regsiter user
                if($this->userModel->signupCharityPending($data)){
                    flash('register_success','Pending for the approval');
                    
                    redirect('landing/index');
                }else{
                    die('Something went wrong');
                }
            }else{
                $this->view('landing/signupCharity',$data);
            }


        }else{
           
                $data=[
                    'name'=>'',
                    'org_name'=>'',
                    'reg_no'=>'',
                    
                    'email'=>'',
                    'contact_no'=>'',
                    'pass'=>'',
    
                    'confirm_pass'=>'',
                    'name_err'=>'',
                    'org_name_err'=>'',
                    'reg_no_err'=>'',
                    'email_err'=>'',
                    'contact_no_err'=>'',
                    'pass_err'=>'',
                    'confirm_pass_err'=>'',
                ];
            

            $this->view('landing/signupCharity',$data);

        }
       

       
       
    }


    public function login(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            // process form
            $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            //init data
            $data=[
                
                'email'=>trim($_POST['email']),
                'pass'=>trim($_POST['pass']),
                'email_err'=>'',
                'pass_err'=>'',

            ];
             //validate email
             if(empty($data['email'])){
                $data['email_err']='Please enter email';      
            }
             //validate password
            if(empty($data['pass'])){
                $data['pass_err']='Please enter password';      
            }

            //check for user/email
            if($this->userModel->findUserByEmail($data['email'])){
                //user found
            }else{
                $data['email_err']='No user found';
            }
            
            //make sure errors are empty
            if(empty($data['email_err']) && empty($data['pass_err'])){
                //validate
                //chek and set logged in user
                $loggedInUser=$this->userModel->login($data['email'],$data['pass']);

                if($loggedInUser){
                    
                    $this->createUserSession($loggedInUser);
                }else{
                    $data['pass_err']='Password incorrect';
                    $this->view('landing/login',$data);
                }
            }else{
                $this->view('landing/login',$data);
            }

        }else{
            $data=[
                'email'=>'',
                'pass'=>'',
                'email_err'=>'',
                'pass_err'=>'',
            ];

            $this->view('landing/login',$data);

        }
       
        
    }
    public function enteremail(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //init data
            $data = [
                'email' => trim($_POST['email']),
                'email_err' => '',
            ];
            //validate email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }
    
            //check for user/email
            if ($this->userModel->findUserByEmail($data['email'])) {
                //user found
            } else {
                $data['email_err'] = 'Email Not found,Please enter a valid email address';
            }
    
            //make sure errors are empty
            if (empty($data['email_err'])) {
                $userEmail = $data['email'];
                
                $mail = new PHPMailer(true);
                $otp = mt_rand(100000, 999999);
    
                // Save OTP in session
                $_SESSION['otp'] = $otp;
                $_SESSION['user_email'] = $userEmail;
    
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
                    $mail->Subject = 'Reset Your password';
                    $mail->Body = "Enter this OTP for reset your password: $otp";
    
                    $mail->send();
    
                    // Redirect or perform other actions as needed
                    redirect('landing/enterotp');
                } catch (Exception $e) {
                    die('Something went wrong: ' . $mail->ErrorInfo);
                }
            } else {
                die('Something went wrong');
            }
        } else {
            $data = [
                'email' => '',
                'email_err' => '',
            ];
    
            $this->view('landing/enteremail', $data);
        }
    }
    
    
    public function enterotp(){  
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $oldOtp=$_SESSION['otp'];
            $userEmail=$_SESSION['user_email'] ;
            // process form
            // sanitize post data
            $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            // init data
            $data=[
                
                'otp'=>trim($_POST['otp']),
                'otp_err'=>'',
            ];
             //validate otp
             if(empty($data['otp'])){
                $data['otp_err']='Please enter the otp';      
            }else{
                if($data['otp']!=$oldOtp){
                    $data['otp_err']='incorrect otp';
                }
            }
            //make sure errors are empty
            if( empty($data['otp_err'])  ){
                //validate
                if($data['otp']==$oldOtp){
                    
                    
                    redirect('landing/updatepass/');
                }
                //hash password
                
            }else{
                $this->view('landing/enterotp',$data);
            }


        }else{
           
                $data=[
                   
    
                    'otp'=>'',
                    'otp_err'=>'',
                ];
            

            $this->view('landing/enterotp',$data);

        }       
    }
    public function updatepass() {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // var_dump($_SESSION);
            // process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $userEmail=$_SESSION['user_email'] ;
            $data = [
                'user_email' => $userEmail,
                'pass' => trim($_POST['pass']),
                'confirm_pass' => trim($_POST['confirm_pass']),
                'pass_err' => '',
                'confirm_pass_err' => '',
            ];
    
            // Validate password
            if (empty($data['pass'])) {
                $data['pass_err'] = 'Please enter a password';
            } elseif (strlen($data['pass']) < 6) {
                $data['pass_err'] = 'Password must be at least 6 characters';
            }
    
            // Validate confirm password
            if (empty($data['confirm_pass'])) {
                $data['confirm_pass_err'] = 'Please confirm the password';
            } elseif ($data['pass'] != $data['confirm_pass']) {
                $data['confirm_pass_err'] = 'Passwords do not match';
            }
    
            // If no errors, proceed with updating the password
            if (empty($data['pass_err']) && empty($data['confirm_pass_err'])) {
                // Get user ID based on the email
                $user = $this->userModel->findUserByEmail($data['user_email']);
                
                if ($user) {
                    // Hash the password
                    $hashed_password = password_hash($data['pass'], PASSWORD_DEFAULT);
    
                    // Update the user's password
                    if ($this->userModel->updatePassword($user->user_id, $hashed_password)) {
                        // Password updated successfully, you can redirect or perform other actions
                        redirect('landing/login');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    // User not found
                    die('User not found');
                }
            } else {
                // There were errors, reload the view with error messages
                $this->view('landing/updatepass', $data);
            }
        } else {
            $userEmail=$_SESSION['user_email'] ;
            // GET request, load the view
            $data = [
                'user_email' => $userEmail,
                'pass' => '',
                'confirm_pass' => '',
                'pass_err' => '',
                'confirm_pass_err' => '',
            ];
    
            $this->view('landing/updatepass', $data);
        }
    }
    
    
    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['user_email'] = $user->email;
    
        if ($user->user_role == 'publisher') {
            $publisherDetails = $this->publisherModel->findPublisherById($user->user_id);
            $_SESSION['publisher_id'] = $publisherDetails->publisher_id;
            // $publisher=$this->userModel->findUserByPubId(user_id);           
            redirect('publisher/index');


        } elseif ($user->user_role == 'admin') {
            $adminDetails = $this->adminModel->findAdminById($user->user_id);
            $_SESSION['admin_id'] = $adminDetails->admin_id;
            // $publisher=$this->userModel->findUserByPubId(user_id);           
            redirect('admin/index');
         
        }elseif ($user->user_role == 'deliver') {
            $deliverDetails = $this->deliveryModel->findDeliveryById($user->user_id);

            $_SESSION['delivery_id'] = $deliveryDetails->delivery_id;
            redirect('delivery/index');
         
        }elseif ($user->user_role == 'charity') {
            
            redirect('charity/index');
        
        }elseif ($user->user_role == 'super_admin') {
            $superadminDetails = $this->superadminModel->findSuperAdminById($user->user_id);
            $_SESSION['superadmin_id'] = $superadminDetails->superadmin_id;
            // $publisher=$this->userModel->findUserByPubId(user_id);           
            redirect('superadmin/index');
        
        }
        // For other roles, redirect accordingly
    }
    
        
    

    

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
       
        unset($_SESSION['user_pass']);
        session_destroy();
        redirect('landing/index');
    }

    

    


}