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

    private $customerModel;

    private $deliveryModel;
    private $superadminModel;
    private $moderatorModel;


    private $db;
    public function  __construct(){
        $this->userModel=$this->model('User');
        $this->deliveryModel=$this->model('Deliver');
        $this->publisherModel=$this->model('Publishers');
        // $this->charityModel=$this->model('Charity');
        $this->adminModel=$this->model('Admins');

        $this->customerModel=$this->model('Customers');

        $this->superadminModel=$this->model('Super_admin');

        $this->moderatorModel=$this->model('Moderators');

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
                if($this->userModel->signupCustomerPending($data)){
                    // send the email
                    $userEmail = $data['email'];
                    $mail = new PHPMailer(true);
                    $otp = mt_rand(1000000, 9999999);
                    $timestamp = $_SERVER["REQUEST_TIME"];
                    $_SESSION['time'] = $timestamp;
                    $_SESSION['otp'] = $otp;
                    $_SESSION['user_email'] = $userEmail;
        
                    try {
                        //Server settings
                        $mail->isSMTP();
                        $mail->Host       = MAIL_HOST;
                        $mail->SMTPAuth   = true;
                        $mail->Username   = MAIL_USER;
                        $mail->Password   = MAIL_PASS;
                        $mail->SMTPSecure = MAIL_SECURITY;
                        $mail->Port       = MAIL_PORT;
        
                        //Recipients
                        $mail->setFrom('readspot27@gmail.com', 'READSPOT');
                        $mail->addAddress($userEmail);
        
                        // Content
                        $mail->isHTML(true);
                        $mail->Subject = 'Verify your email';
                        $mail->Body = "Enter this OTP for verify your email account: $otp";
        
                        $mail->send();
                        redirect('landing/verifyemail');
                    }catch (Exception $e) {
                            error_log('Email sending failed: ' . $e->getMessage());
                            $data['email_err'] = 'Something went wrong. Please try again later.';
                            $this->view('landing/signupCustomer', $data); // Pass $data to the view
                            exit; 
                        }
                } else{
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
    public function verifyemail(){
        $userId = null; // Initialize $userId
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            if (isset($_SESSION['otp']) && isset($_SESSION['time'])) {
                $oldOtp = $_SESSION['otp'];
                $userEmail = $_SESSION['user_email'];
    
                $userDetails = $this->userModel->findUserByEmail($userEmail);
    
                if ($userDetails) {
                    $userId = $userDetails[0]->user_id;
    
                    $timestamp = $_SERVER["REQUEST_TIME"];
                    $remainingTime = isset($_SESSION['remaining_time']) ? $_SESSION['remaining_time'] : 60;
    
                    if (($timestamp - $_SESSION['time']) > $remainingTime) {  // 60 seconds for 1 minute
                        $data = [
                            'user_id' => $userId,
                            'otp_err' => "OTP expired. Please try again.",
                            'remaining_time' => 0
                        ];
                        $this->view('landing/verifyemail', $data);
                        exit; // Ensure no further processing after redirection
                    } else {
                        $data = [
                            'user_id' => $userId,
                            'otp' => trim($_POST['otp']),
                            'otp_err' => '',
                            'remaining_time' => $remainingTime - ($timestamp - $_SESSION['time'])
                        ];
    
                        // validate otp
                        if (empty($data['otp']) || $data['otp'] != $oldOtp) {
                            $data['otp_err'] = 'Incorrect OTP';
                            $this->view('landing/verifyemail', $data);
                            exit; // Ensure no further processing after redirection
                        }
    
                        // make sure errors are empty
                        if (empty($data['otp_err'])) {
                            // validate
                            if ($data['otp'] == $oldOtp) {
                                if($this->userModel->verifyemailCustomer($userId) && $this->userModel->verifyemailUsers($userId) ){
                                    echo '<script>';
                                    echo 'setTimeout(function() { alert("OTP is correct!"); redirectToLogin(); }, 100);'; // Delayed alert
                                    echo 'function redirectToLogin() {';
                                    echo '    window.location.href = "' . URLROOT . '/landing/login"; ';  
                                    echo '}';
                                    echo '</script>';
                                    exit;
                                } else {
                                    // Log the error or redirect to an error page
                                    error_log('Verification failed: Something went wrong');
                                    // Redirect to an error page
                                    redirect('error');
                                    // OR display a specific error message
                                    $data['error_message'] = 'Verification failed. Please try again later.';
                                    $this->view('error_page', $data);
                                    exit;
                                }
                            }
                        }
                    }
                } else {
                    $data = [
                        'user_id' => $userId,
                        'otp_err' => "User not found. Please request a new OTP.",
                        'remaining_time' => 0
                    ];
                    $this->view('landing/verifyemail', $data);
                    exit;
                }
            }
        } else {
            // Handle the case when it's not a POST request
            if (isset($_SESSION['user_email'])) {
                $userEmail = $_SESSION['user_email'];
                $userDetails = $this->userModel->findUserByEmail($userEmail);
    
                if ($userDetails) {
                    $userId = $userDetails[0]->user_id;
                }
            }
    
            $remainingTime = isset($_SESSION['remaining_time']) ? $_SESSION['remaining_time'] : 60;
    
            $data = [
                'user_id' => $userId,
                'otp' => '',
                'otp_err' => '',
                'remaining_time' => $remainingTime,
            ];
    
            $this->view('landing/verifyemail', $data);
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
                if ($this->userModel->signupPubPending($data)) {
                    echo '<script>';
                    echo 'alert("Wait for the administration approval!\nWe will notify through the email after approving your registration request. Thank You!");';
                    echo 'window.location.href = "' . URLROOT . '/landing/index";';  // Construct the complete URL
                    echo '</script>';
                
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
                    
                        echo '<script>';
                        echo 'alert("Wait for the administration approval!\nWe will notify through the email after approving your registration request. Thank You!");';
                        echo 'window.location.href = "' . URLROOT . '/landing/index";';  
                        echo '</script>';
                    }
                    
                else{
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
    // public  function generateUniqueToken($length = 32)
    // {
    //     // Generate random bytes using openssl_random_pseudo_bytes
    //     $randomBytes = openssl_random_pseudo_bytes($length / 2);

    //     // Convert to hexadecimal
    //     $token = bin2hex($randomBytes);

    //     return $token;
    // }

    // public function setRememberMeCookie($token)
    // {
    //     // Set a cookie with the unique token
    //     setcookie('userToken', $token, time() + 30 * 24 * 60 * 60); // 30 days expiration
    // }
    public function login(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            // process form
            $_POST=filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            //init data
            $data=[
                
                'email'=>trim($_POST['email']),
                'pass'=>trim($_POST['pass']),
                'remember_me' => isset($_POST['rememberMe']) && $_POST['rememberMe'] === '1', 
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
                    if ($data['remember_me']) {
                        $uniqueToken = $this->generateUniqueToken();
                        $this->setRememberMeCookie($uniqueToken);
                    }
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
                'remember_me'=>'',
                'email_err'=>'',
                'pass_err'=>'',
            ];

            $this->view('landing/login',$data);

        }       
    }
    public function enteremail() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            //init data
            $data = [
                'email' => trim($_POST['email']),
                'email_err' => '',
            ];
            //validate email
            if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['email_err'] = 'Please enter a valid email';
                $this->view('landing/enteremail', $data); // Pass $data to the view
                exit; // Ensure no further processing after redirection
            }
    
            //check for user/email
            if ($this->userModel->findUserByEmail($data['email'])) {
                //user found
            } else {
                $data['email_err'] = 'Email not found. Please enter a valid email address';
                $this->view('landing/enteremail', $data); // Pass $data to the view
                exit; // Ensure no further processing after redirection
            }
    
            //make sure errors are empty
            if (empty($data['email_err'])) {
                $userEmail = $data['email'];
    
                $mail = new PHPMailer(true);
                $otp = mt_rand(100000, 999999);

                $timestamp = $_SERVER["REQUEST_TIME"];


                $_SESSION['time'] = $timestamp;
                $_SESSION['otp'] = $otp;
                $_SESSION['user_email'] = $userEmail;
    
                try {
                    //Server settings
                    $mail->isSMTP();
                    $mail->Host       = MAIL_HOST;
                    $mail->SMTPAuth   = true;
                    $mail->Username   = MAIL_USER;
                    $mail->Password   = MAIL_PASS;
                    $mail->SMTPSecure = MAIL_SECURITY;
                    $mail->Port       = MAIL_PORT;
    
                    //Recipients
                    $mail->setFrom('readspot27@gmail.com', 'READSPOT');
                    $mail->addAddress($userEmail);
    
                    // Content
                    $mail->isHTML(true);
                    $mail->Subject = 'Reset Your password';
                    $mail->Body = "Enter this OTP for reset your password: $otp";
    
                    $mail->send();
    
                    // Redirect or perform other actions as needed
                    redirect('landing/enterotp');
                } catch (Exception $e) {
                    error_log('Email sending failed: ' . $e->getMessage());
                    $data['email_err'] = 'Something went wrong. Please try again later.';
                    $this->view('landing/enteremail', $data); // Pass $data to the view
                    exit; // Ensure no further processing after redirection
                }
            }
        } else {
            $data = [
                'email' => '',
                'email_err' => '',
            ];
    
            $this->view('landing/enteremail', $data);
        }
    }
    
    public function enterotp() {

        $userId = null; // Initialize $userId
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            if (isset($_SESSION['otp']) && isset($_SESSION['time'])) {
                $oldOtp = $_SESSION['otp'];
                $userEmail = $_SESSION['user_email'];
    
                $userDetails = $this->userModel->findUserByEmail($userEmail);
    
                if ($userDetails) {
                    $userId = $userDetails[0]->user_id;
    
                    $timestamp = $_SERVER["REQUEST_TIME"];
                    $remainingTime = isset($_SESSION['remaining_time']) ? $_SESSION['remaining_time'] : 60;
    
                    if (($timestamp - $_SESSION['time']) > $remainingTime) {  // 60 seconds for 1 minute
                        $data = [
                            'user_id' => $userId,
                            'otp_err' => "OTP expired. Please try again.",
                            'remaining_time' => 0
                        ];
                        $this->view('landing/enterotp', $data);
                        exit; // Ensure no further processing after redirection
                    } else {
                        $data = [
                            'user_id' => $userId,
                            'otp' => trim($_POST['otp']),
                            'otp_err' => '',
                            'remaining_time' => $remainingTime - ($timestamp - $_SESSION['time'])
                        ];
    
                        // validate otp
                        if (empty($data['otp']) || $data['otp'] != $oldOtp) {
                            $data['otp_err'] = 'Incorrect OTP';
                            $this->view('landing/enterotp', $data);
                            exit; // Ensure no further processing after redirection
                        }
    
                        // make sure errors are empty
                        if (empty($data['otp_err'])) {
                            // validate
                            if ($data['otp'] == $oldOtp) {
                                echo '<script>';
                                echo 'setTimeout(function() { alert("OTP is correct!"); redirectToUpdatePass(); }, 100);'; // Delayed alert
                                echo 'function redirectToUpdatePass() {';
                                echo '    window.location.href = "' . URLROOT . '/landing/updatepass/' . $userId . '";';  
                                echo '}';
                                echo '</script>';
                                exit;
                            }
                        }

                    }
                } else {
                    $data = [
                        'user_id' => $userId,
                        'otp_err' => "User not found. Please request a new OTP.",
                        'remaining_time' => 0
                    ];
                    $this->view('landing/enterotp', $data);
                    exit;
                }
            }
        } else {
            // Handle the case when it's not a POST request
            if (isset($_SESSION['user_email'])) {
                $userEmail = $_SESSION['user_email'];
                $userDetails = $this->userModel->findUserByEmail($userEmail);
    
                if ($userDetails) {
                    $userId = $userDetails[0]->user_id;
                }
            }
    
            $remainingTime = isset($_SESSION['remaining_time']) ? $_SESSION['remaining_time'] : 60;
    
            $data = [
                'user_id' => $userId,
                'otp' => '',
                'otp_err' => '',
                'remaining_time' => $remainingTime,
            ];
    
            $this->view('landing/enterotp', $data);
        }
    }
    
    
        
    public function updatepass($user_id) {
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // var_dump($_SESSION);
            // process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // $userEmail=$_SESSION['user_email'] ;
            $data = [
                'user_id' => $user_id,
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
                $user = $this->userModel->findUserById($user_id);
                $user_role=$user[0]->user_role;
                
                if ($user) {
                    // Hash the password
                   
                    $data['pass']=password_hash($data['pass'],PASSWORD_DEFAULT);
                    // Update the user's password
                    if ($this->userModel->updatePassword($data)) {
                        if($user_role=='publisher'){
                            if($this->userModel->updatePasswordPub($data)){
                                redirect('landing/login');
                            }else {
                                die('Something went wrong');
                            }
                        }else if($user_role=='customer'){
                            if($this->userModel->updatePasswordCus($data)){
                                redirect('landing/login');
                            }else {
                                die('Something went wrong');
                            }
                        }else if($user_role=='charity'){
                            if($this->userModel->updatePasswordCharity($data)){
                                redirect('landing/login');
                            }else {
                                die('Something went wrong');
                            }
                        }
                       
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
            // $userEmail=$_SESSION['user_email'] ;
            // GET request, load the view
            $data = [
                'user_id' => $user_id,
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
         
        }elseif ($user->user_role == 'customer') {
            $customerDetails = $this->customerModel->findCustomerById($user->user_id);
            $_SESSION['customer_id'] = $customerDetails->customer_id;
            redirect('customer/Home');
         
        }elseif ($user->user_role == 'charity') {
            
            redirect('charity/index');
        
        }elseif ($user->user_role == 'super_admin') {
            $superadminDetails = $this->superadminModel->findSuperAdminById($user->user_id);
            $_SESSION['superadmin_id'] = $superadminDetails->superadmin_id;
            // $publisher=$this->userModel->findUserByPubId(user_id);           
            redirect('superadmin/index');
        
        }elseif ($user->user_role == 'moderator') {
            // $moderatorDetails = $this->moderatorModel->findModeratorById($user->user_id);
            // $_SESSION['moderator_id'] = $moderatorDetails->moderator_id;
            // $publisher=$this->userModel->findUserByPubId(user_id);           
            redirect('moderator/index');
        
        }

        elseif ($user->user_role == 'moderator'){
            $moderatorDetails = $this->moderatorModel->findModeratorById($user->user_id);
            $_SESSION['moderator_id'] = $moderatorDetails->moderator_id;
            redirect('moderator/index');
        }
    
    }
    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);    
        unset($_SESSION['user_pass']);
        session_destroy();
        redirect('landing/index');
    }

}