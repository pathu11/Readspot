
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require APPROOT . '\vendor\autoload.php';
class Superadmin extends Controller{
    private $superadminModel;
   
    private $userModel;
    private $publisherModel;
  
    private $db;
    public function __construct(){
        $this->superadminModel=$this->model('Super_admin');
        // $this->adminModel=$this->model('Admins');
        $this->userModel=$this->model('User');
        $this->publisherModel=$this->model('Publishers');
        $this->db = new Database();

    }
    public function index(){
        if (!isLoggedInSuperAdmin()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $superadminDetails = $this->superadminModel->findSuperAdminById($user_id);  
            $countAdmins = $this->superadminModel->countAdmins(); 
            $countModerators = $this->superadminModel->countModerators(); 
            $countDelivery = $this->superadminModel->countDelivery(); 
            $countCustomers = $this->superadminModel->countCustomers (); 
            $countPublishers = $this->superadminModel->countPublishers(); 
            $countCharity = $this->superadminModel->countCharity(); 
            $countComplaints=$this->superadminModel->getResolvedCount() ;
            $resolved_count=$countComplaints[0]->resolved_count;
            $unresolved_count=$countComplaints[0]->unresolved_count;
            $UserCountByDate=$this->superadminModel->getUserCountByDate();
            $UserLoginCountToday=$this->superadminModel->UserLoginCountToday();
          
           
            $data = [
                'superadminDetails' => $superadminDetails,
                'superadminName'=>$superadminDetails[0]->name,
                'superadminEmail'=>$superadminDetails[0]->email,
                'countModerators'=>$countModerators,
                'countAdmins'=>$countAdmins,
                'countCustomers'=>$countCustomers,
                'countPublishers'=>$countPublishers,
                'countCharity'=>$countCharity,
                'countDelivery'=>$countDelivery,
                'resolved_count'=>$resolved_count,
                'unresolved_count'=>$unresolved_count,
                'UserCountByDate'=>$UserCountByDate,
                'UserLoginCountToday'=>$UserLoginCountToday

            ];
            // print_r($UserLoginCountToday);
            $this->view('superadmin/index',$data);
        }
        
    }

    public function addAdmin(){
        if (!isLoggedInSuperAdmin()) {
            redirect('landing/login');
        }
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
            if( empty($data['name_err']) && empty($data['email_err'])  &&empty($data['pass_err']) && empty($data['confirm_pass_err'])  ){
                //validate

                //hash password
                $data['pass']=password_hash($data['pass'],PASSWORD_DEFAULT);

                //regsiter user
                if($this->superadminModel->addAdmin($data)){
                    flash('Successfully Added');
                    redirect('superadmin/admins');
                }else{
                    die('Something went wrong');
                }
            }else{
                $this->view('superadmin/addAdmin',$data);
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
            

            $this->view('superadmin/addAdmin',$data);

        }   
    }
    public function updateAdmin($user_id){
        if(!isLoggedInSuperAdmin()){
            redirect('landing/login');
        }
        // $user_id = $_SESSION['user_id'];
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // process form
            // sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // init data
            $data = [
                'user_id'=>$user_id,
                // 'admin_id' => $admin_id,
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'pass' => trim($_POST['pass']),
                'confirm_pass' => trim($_POST['confirm_pass']),
                'name_err' => '',
                'email_err' => '',
                'pass_err' => '',
                'confirm_pass_err' => '',
            ];
    
            // validate name
            if(empty($data['name'])){
                $data['name_err'] = 'Please enter the name';      
            }
    
            // validate email
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter email';      
            }
            // validate password
            if(!empty($data['pass']) && strlen($data['pass']) < 6){
                $data['pass_err'] = 'Password must be at least 6 characters'; 
            }
    
            // validate confirm password
            if(!empty($data['confirm_pass']) && $data['pass'] != $data['confirm_pass']){
                $data['confirm_pass_err'] = 'Passwords do not match';
            }
    
            // make sure errors are empty
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['pass_err']) && empty($data['confirm_pass_err'])){
                // validate
                // hash password if it is provided
                if(!empty($data['pass'])){
                    $data['pass'] = password_hash($data['pass'], PASSWORD_DEFAULT);
                }
    
                // update admin
                if($this->superadminModel->updateAdmin($data) ){
                   
                        flash('Successfully Updated');
                        redirect('superadmin/admins');
                }else{
                    echo 'Update Admin Failed';
                    // var_dump($data); 
                    die();
                }
            }else{
                $this->view('superadmin/updateAdmin', $data);
            }
        }else{
            // Display the form with existing data
            $admin = $this->superadminModel->findAdminById($user_id);
            
            if ($admin) {
                $data = [
                    'user_id' => $user_id,
                    'name' => $admin[0]->name,
                    'email' => $admin[0]->email,
                    'pass' => '',
                    'confirm_pass' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'pass_err' => '',
                    'confirm_pass_err' => '',
                ];
                
                $this->view('superadmin/updateAdmin', $data);
            } else {
             
                echo 'Admin not found for ID: ' . $admin_id;
                die();
            }
        }
    }

    public function updateModerator($user_id){
        if(!isLoggedInSuperAdmin()){
            redirect('landing/login');
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // process form
            // sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // init data
            $data = [
                'user_id' => $user_id,
                
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'pass' => trim($_POST['pass']),
                'confirm_pass' => trim($_POST['confirm_pass']),
                'name_err' => '',
                'email_err' => '',
                'pass_err' => '',
                'confirm_pass_err' => '',
            ];
    
            // validate name
            if(empty($data['name'])){
                $data['name_err'] = 'Please enter the name';      
            }
    
            // validate email
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter email';      
            }
            // validate password
            if(!empty($data['pass']) && strlen($data['pass']) < 6){
                $data['pass_err'] = 'Password must be at least 6 characters'; 
            }
    
            // validate confirm password
            if(!empty($data['confirm_pass']) && $data['pass'] != $data['confirm_pass']){
                $data['confirm_pass_err'] = 'Passwords do not match';
            }
            // make sure errors are empty
            if(empty($data['name_err']) && empty($data['email_err']) && empty($data['pass_err']) && empty($data['confirm_pass_err'])){
                // validate
                // hash password if it is provided
                if(!empty($data['pass'])){
                    $data['pass'] = password_hash($data['pass'], PASSWORD_DEFAULT);
                }           
                if($this->superadminModel->updateModerator($data)){   
                    flash('Successfully Updated');
                    redirect('superadmin/moderators');
                }else{
                    die('Something went wrong');
                }
            }else{
                $this->view('superadmin/updateModerator', $data);
            }
        }else{
            // Display the form with existing data
            $moderator = $this->superadminModel->findModeratorById($user_id);
            
            if ($moderator) {
                $data = [
                    'user_id' => $user_id,
                    'name' => $moderator[0]->name,
                    'email' => $moderator[0]->email,
                    'pass' => '',
                    'confirm_pass' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'pass_err' => '',
                    'confirm_pass_err' => '',
                ];
               
                $this->view('superadmin/updateModerator', $data);
            } else {
             
                echo 'Moderator not found for ID: ' . $user_id;
                die();
            }
        }
    }
    public function updateDelivery($user_id){
        if(!isLoggedInSuperAdmin()){
            redirect('landing/login');
        }
        $superAdmin_userId=$_SESSION['user_id'];
        // print_r($superAdmin_userId);
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
       
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            // init data
            $data = [
                'user_id' => $user_id,
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'pass' => trim($_POST['pass']),
                'confirm_pass' => trim($_POST['confirm_pass']),
                'name_err' => '',
                'email_err' => '',
                'pass_err' => '',
                'confirm_pass_err' => '',
            ];
            // validate name 
            if(empty($data['name'])){
                $data['name_err'] = 'Please enter the name';      
            }
    
            // validate email
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter email';      
            }
            // validate password
            if(!empty($data['pass']) && strlen($data['pass']) < 6){
                $data['pass_err'] = 'Password must be at least 6 characters'; 
            }
            // validate confirm password
            if(!empty($data['confirm_pass']) && $data['pass'] != $data['confirm_pass']){
                $data['confirm_pass_err'] = 'Passwords do not match';
            }
            // make sure errors are empty
            if(  empty($data['email_err']) &&empty($data['name_err']) && empty($data['pass_err']) &&empty($data['confirm_pass_err'])){
                // validate
                // hash password if it is provided
                if(!empty($data['pass'])){
                    $data['pass'] = password_hash($data['pass'], PASSWORD_DEFAULT);
                }else{
                    echo '<script>alert("error password")</script>';
                }
                if($this->superadminModel->updateDelivery($data)){
                    // echo "successfully:";
                    if($this->superadminModel->updateUsers($data)){
                        flash('Successfully Updated');
                        redirect('superadmin/delivery');
                    }else{
                        die('Something went wrong');
                    } 
                }else{
                    die('Something went wrong');
                    echo '<script>alert("error 1")</script>';

                }
            }else{
                echo '<script>alert("error 2")</script>';
                $this->view('superadmin/updateDelivery', $data);
            }
        }else{
            // Display the form with existing data
            $Delivery = $this->superadminModel->findDeliveryById($user_id);
            $superadminDetails = $this->superadminModel->findSuperAdminById($superAdmin_userId);  
            if ($Delivery) {
                $data = [
                    'superadminName'=>$superadminDetails[0]->name,
                    'user_id' => $user_id,
                    'name' => $Delivery[0]->name,
                    'email' => $Delivery[0]->email,
                    'pass' => '',
                    'confirm_pass' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'pass_err' => '',
                    'confirm_pass_err' => '',
                ];
               
                $this->view('superadmin/updateDelivery', $data);
            } else {
             
                echo 'Delivery not found for ID: ' . $user_id;
                die();
            }
        }
    }
    public function addModerator(){
        if (!isLoggedInSuperAdmin()) {
            redirect('landing/login');
        }
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
            if( empty($data['name_err']) && empty($data['email_err'])  &&empty($data['pass_err']) && empty($data['confirm_pass_err'])  ){
                //validate

                //hash password
                $data['pass']=password_hash($data['pass'],PASSWORD_DEFAULT);

                //regsiter user
                if($this->superadminModel->addModerator($data)){
                    flash('Successfully Added');
                    redirect('superadmin/moderators');
                }else{
                    die('Something went wrong');
                }
            }else{
                $this->view('superadmin/addModerator',$data);
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
            

            $this->view('superadmin/addModerator',$data);

        }       
    }

    public function admins(){
        if (!isLoggedInSuperAdmin()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $addadminDetails = $this->superadminModel->getAdmins(); 
            $superadminDetails = $this->superadminModel->findSuperAdminById($user_id);   
            $data = [
                'addadminDetails' => $addadminDetails,
                'superadminDetails' => $superadminDetails,
                'superadminName'=>$superadminDetails[0]->name,
                'superadminEmail'=>$superadminDetails[0]->email,
            ];
            $this->view('superadmin/admins', $data);
        }
    }
    public function moderators(){
        if (!isLoggedInSuperAdmin()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $addmoderatorDetails = $this->superadminModel->getModerator(); 
            $superadminDetails = $this->superadminModel->findSuperAdminById($user_id);   
            $data = [
                'addmoderatorDetails' => $addmoderatorDetails,
                'superadminDetails' => $superadminDetails,
                'superadminName'=>$superadminDetails[0]->name,
                'superadminEmail'=>$superadminDetails[0]->email,
            ];
            $this->view('superadmin/moderators', $data);
        }
    }
    public function addDelivery(){
        if (!isLoggedInSuperAdmin()) {
            redirect('landing/login');
        }
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
            if( empty($data['name_err']) && empty($data['email_err'])  &&empty($data['pass_err']) && empty($data['confirm_pass_err'])  ){
                //validate

                //hash password
                $data['pass']=password_hash($data['pass'],PASSWORD_DEFAULT);

                //regsiter user
                if($this->superadminModel->addDelivery($data)){
                    flash('Successfully Added');
                    redirect('superadmin/delivery');
                }else{
                    die('Something went wrong');
                }
            }else{
                $this->view('superadmin/addDelivery',$data);
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
            

            $this->view('superadmin/addDelivery',$data);

        }       
    }

    public function delivery(){
        if (!isLoggedInSuperAdmin()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $adddeliveryDetails = $this->superadminModel->getDelivery(); 
            $superadminDetails = $this->superadminModel->findSuperAdminById($user_id);   
            $data = [
                'adddeliveryDetails' => $adddeliveryDetails,
                'superadminDetails' => $superadminDetails,
                'superadminName'=>$superadminDetails[0]->name,
                'superadminEmail'=>$superadminDetails[0]->email,
            ];
            $this->view('superadmin/delivery', $data);
        }
    }
    public function customers(){
        if (!isLoggedInSuperAdmin()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $addcustomersDetails = $this->superadminModel->getCustomers(); 
            $superadminDetails = $this->superadminModel->findSuperAdminById($user_id);   
            $data = [
                'addcustomersDetails' => $addcustomersDetails,
                'superadminDetails' => $superadminDetails,
                'superadminName'=>$superadminDetails[0]->name,
                'superadminEmail'=>$superadminDetails[0]->email,
                
               

            ];
            $this->view('superadmin/customers', $data);
        }
    }
    public function publishers(){
        if (!isLoggedInSuperAdmin()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $addpublishersDetails = $this->superadminModel->getPublishers(); 
            $superadminDetails = $this->superadminModel->findSuperAdminById($user_id);   
            $data = [
                'addpublishersDetails' => $addpublishersDetails,
                'superadminDetails' => $superadminDetails,
                'superadminName'=>$superadminDetails[0]->name,
                'superadminEmail'=>$superadminDetails[0]->email,
                
               

            ];
            $this->view('superadmin/publishers', $data);
        }
    }

    public function charity(){
        if (!isLoggedInSuperAdmin()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $addcharityDetails = $this->superadminModel->getCharity(); 
            $superadminDetails = $this->superadminModel->findSuperAdminById($user_id);   
            $data = [
                'addcharityDetails' => $addcharityDetails,
                'superadminDetails' => $superadminDetails,
                'superadminName'=>$superadminDetails[0]->name,
                'superadminEmail'=>$superadminDetails[0]->email,
                
               

            ];
            $this->view('superadmin/charity', $data);
        }
    }
    private function sentEmails($userEmail,$subject,$body){
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
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
        } catch (Exception $e) {
            die('Something went wrong: ' . $mail->ErrorInfo);
        }
    }

    public function deleteadmins($user_id)
{

    $userDetails=$this->superadminModel->getuserDetails($user_id);
    $name=$userDetails[0]->name;
    $email=$userDetails[0]->email;
    if ($this->superadminModel->rejectadmin($user_id)) {       
        if ($this->superadminModel->rejectUser($user_id)) {       
            if ($this->superadminModel->insertRemove_list($user_id,$email,$name)) {  

                redirect('superadmin/admins'); 
            
        } 
        
    } 
        
    } 
}

public function deletemoderators($user_id)

{
    if (!isLoggedInSuperAdmin()) {
        redirect('landing/login');
    }
    $userDetails=$this->superadminModel->getuserDetails($user_id);
    $name=$userDetails[0]->name;
    $email=$userDetails[0]->email;
    if ($this->superadminModel->rejectmoderator($user_id)) {       
        if ($this->superadminModel->rejectUser($user_id)) {       
            if ($this->superadminModel->insertRemove_list($user_id,$email,$name)) {  
                $subject = "Your account has been removed from the site";
                $body = "Dear $name,<br><br>Your account has been removed from our system.<br><br>If you have any inquiries or need further assistance, please contact our support team at readspot27@gmail.com.<br><br>Thank you for being a part of our community.<br><br>Best regards,<br>ReadSpot Team";

                $this->sentEmails($email, $subject, $body);     
                redirect('superadmin/moderators'); 
            
        } 
        
    } 
        
    } 
}
public function deletedelivery($user_id)
{
    if (!isLoggedIn()) {
        redirect('landing/login');
    }
    $userDetails=$this->superadminModel->getuserDetails($user_id);
    $name=$userDetails[0]->name;
    $email=$userDetails[0]->email;
    if ($this->superadminModel->rejectdelivery($user_id)) {       
        if ($this->superadminModel->rejectUser($user_id)) {       
            if ($this->superadminModel->insertRemove_list($user_id,$email,$name)) {    
                $subject = "Your account has been removed from the site";
                $body = "Dear $name,<br><br>Your account has been removed from our system.<br><br>If you have any inquiries or need further assistance, please contact our support team at readspot27@gmail.com.<br><br>Thank you for being a part of our community.<br><br>Best regards,<br>ReadSpot Team"; 
                $this->sentEmails($email, $subject, $body);   
                redirect('superadmin/delivery'); 
            
        } 
        
    } 
        
    } else {
        die('Something went wrong');
    }
}
public function deletecustomers($user_id)
{
    $userDetails=$this->superadminModel->getuserDetails($user_id);
    $name=$userDetails[0]->name;
    $email=$userDetails[0]->email;
    if ($this->superadminModel->rejectUser($user_id)) {
       if ($this->superadminModel->rejectcustomers($user_id)){
        if ($this->superadminModel->insertRemove_list($user_id,$name,$email)){
            $subject = "Your account has been removed from the site";
            $body = "Dear $name,<br><br>Your account has been removed from our system.<br><br>If you have any inquiries or need further assistance, please contact our support team at readspot27@gmail.com.<br><br>Thank you for being a part of our community.<br><br>Best regards,<br>ReadSpot Team"; 
            $this->sentEmails($email, $subject, $body); 
            redirect('superadmin/customers');
       }
            
       }
        
    } else {
        die('Something went wrong');
    }
}
public function deletepublishers($user_id)
{
   $userDetails=$this->superadminModel->getuserDetails($user_id);
    $name=$userDetails[0]->name;
    $email=$userDetails[0]->email;
    if ($this->superadminModel->rejectpublisher($user_id)) {       
        if ($this->superadminModel->rejectUser($user_id)) {       
            if ($this->superadminModel->insertRemove_list($user_id,$email,$name)) {  
                $subject = "Your account has been removed from the site";
                $body = "Dear $name,<br><br>Your account has been removed from our system.<br><br>If you have any inquiries or need further assistance, please contact our support team at readspot27@gmail.com.<br><br>Thank you for being a part of our community.<br><br>Best regards,<br>ReadSpot Team";  
                $this->sentEmails($email, $subject, $body);     
                redirect('superadmin/publishers'); 
            
        } 
        
    } 
        
    } else {
        die('Something went wrong');
    }
}
public function deletecharity($user_id)
{
    $userDetails=$this->superadminModel->getuserDetails($user_id);
    $name=$userDetails[0]->name;
    $email=$userDetails[0]->email;
    if ($this->superadminModel->rejectcharity($user_id)) {       
        if ($this->superadminModel->rejectUser($user_id)) {       
            if ($this->superadminModel->insertRemove_list($user_id,$email,$name)) {  
                $subject = "Your account has been removed from the site";
                $body = "Dear $name,<br><br>Your account has been removed from our system.<br><br>If you have any inquiries or need further assistance, please contact our support team at readspot27@gmail.com.<br><br>Thank you for being a part of our community.<br><br>Best regards,<br>ReadSpot Team"; 
                $this->sentEmails($email, $subject, $body);      
                redirect('superadmin/charity');    
        }    
    }   
    }  else {
        die('Something went wrong');
    }
}
public function restrictpublishers($user_id)
{
    $userDetails=$this->superadminModel->getuserDetails($user_id);
    $name=$userDetails[0]->name;
    $email=$userDetails[0]->email;
    if ($this->superadminModel->restrictpublishers($user_id)) {
//            var_dump($package_id);
        if ($this->superadminModel->restrictusers($user_id)){
            $subject = "Your account has been removed from the site";
            $body = "Dear $name,<br><br>Your account has been restricted for violating our community guidelines. As a result, you will not be able to access certain features for the next 7 days.<br><br>If you believe this action was taken in error or have any questions, please contact our support team at readspot27@gmail.com.<br><br>Thank you for your understanding.<br><br>Best regards,<br>ReadSpot Team";
            $this->sentEmails($email, $subject, $body); 

            redirect('superadmin/publishers');
        }
        
    } else {
        die('Something went wrong');
    }
}
public function restrictcharity($user_id)
{
    $userDetails=$this->superadminModel->getuserDetails($user_id);
    $name=$userDetails[0]->name;
    $email=$userDetails[0]->email;
    if ($this->superadminModel->restrictcharity($user_id)) {
//            var_dump($package_id);
        if ($this->superadminModel->restrictusers($user_id)){
            $subject = "Your account has been removed from the site";
            $body = "Dear $name,<br><br>Your account has been restricted for violating our community guidelines. As a result, you will not be able to access certain features for the next 7 days.<br><br>If you believe this action was taken in error or have any questions, please contact our support team at readspot27@gmail.com.<br><br>Thank you for your understanding.<br><br>Best regards,<br>ReadSpot Team";
            $this->sentEmails($email, $subject, $body); 
            redirect('superadmin/charity');
        }
        
    } else {
        die('Something went wrong');
    }
}
public function restrictcustomers($user_id)
{
    $userDetails=$this->superadminModel->getuserDetails($user_id);
    $name=$userDetails[0]->name;
    $email=$userDetails[0]->email;
    if ($this->superadminModel->restrictcustomers($user_id)) {
//            var_dump($package_id);
        if ($this->superadminModel->restrictusers($user_id)){
            $subject = "Your account has been removed from the site";
            $body = "Dear $name,<br><br>Your account has been restricted for violating our community guidelines. As a result, you will not be able to access certain features for the next 7 days.<br><br>If you believe this action was taken in error or have any questions, please contact our support team at readspot27@gmail.com.<br><br>Thank you for your understanding.<br><br>Best regards,<br>ReadSpot Team";
            $this->sentEmails($email, $subject, $body); 
            redirect('superadmin/customers');
        }
        
    } else {
        die('Something went wrong');
    }
}
public function restrictadmins($user_id)
{
    $userDetails=$this->superadminModel->getuserDetails($user_id);
    $name=$userDetails[0]->name;
    $email=$userDetails[0]->email;
    if ($this->superadminModel->restrictadmin($user_id)) {
//            var_dump($package_id);
        if ($this->superadminModel->restrictusers($user_id)){
            $subject = "Your account has been removed from the site";
            $body = "Dear $name,<br><br>Your account has been restricted for violating our community guidelines. As a result, you will not be able to access certain features for the next 7 days.<br><br>If you believe this action was taken in error or have any questions, please contact our support team at readspot27@gmail.com.<br><br>Thank you for your understanding.<br><br>Best regards,<br>ReadSpot Team";
            $this->sentEmails($email, $subject, $body); 
            redirect('superadmin/admins');
        }
        
    } else {
        die('Something went wrong');
    }
}
public function restrictmoderators($user_id)
{
    $userDetails=$this->superadminModel->getuserDetails($user_id);
    $name=$userDetails[0]->name;
    $email=$userDetails[0]->email;
    if ($this->superadminModel->restrictmoderators($user_id)) {
//            var_dump($package_id);
        if ($this->superadminModel->restrictusers($user_id)){
            $subject = "Your account has been removed from the site";
            $body = "Dear $name,<br><br>Your account has been restricted for violating our community guidelines. As a result, you will not be able to access certain features for the next 7 days.<br><br>If you believe this action was taken in error or have any questions, please contact our support team at readspot27@gmail.com.<br><br>Thank you for your understanding.<br><br>Best regards,<br>ReadSpot Team";
            $this->sentEmails($email, $subject, $body); 
            redirect('superadmin/moderators');
        }
        
    } else {
        die('Something went wrong');
    }
}
public function restrictdelivery($user_id)
{
    $userDetails=$this->superadminModel->getuserDetails($user_id);
    $name=$userDetails[0]->name;
    $email=$userDetails[0]->email;
    if ($this->superadminModel->restrictdelivery($user_id)) {
//            var_dump($package_id);
        if ($this->superadminModel->restrictusers($user_id)){
            $subject = "Your account has been removed from the site";
            $body = "Dear $name,<br><br>Your account has been restricted for violating our community guidelines. As a result, you will not be able to access certain features for the next 7 days.<br><br>If you believe this action was taken in error or have any questions, please contact our support team at readspot27@gmail.com.<br><br>Thank you for your understanding.<br><br>Best regards,<br>ReadSpot Team";
            $this->sentEmails($email, $subject, $body); 
            redirect('superadmin/moderators');
        }
        
    } else {
        die('Something went wrong');
    }
}
    public function removeList(){
        if (!isLoggedInSuperAdmin()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
        
            $removerDetails = $this->superadminModel->getRemover(); 
            $superadminDetails = $this->superadminModel->findSuperAdminById($user_id);   
            $data = [
                'removerDetails' => $removerDetails,
                'superadminDetails' => $superadminDetails,
                'superadminName'=>$superadminDetails[0]->name,
                'superadminEmail'=>$superadminDetails[0]->email,
            ];  
            $this->view('superadmin/removeList',$data); 
        }   
    }
    public function restoreusers($remove_id){
        if (!isLoggedInSuperAdmin()) {
            redirect('landing/login');
        } else {
            $userDetails=$this->superadminModel->getUserRoleByRemoveId($remove_id);
            $user_role=$userDetails[0]->user_role;
            $user_id=$userDetails[0]->user_id;
            $email=$userDetails[0]->email;
            $name=$userDetails[0]->name;
            if($this->superadminModel->restoreusers($remove_id)){
                // if($user_role=='customers'){
                    if($this->superadminModel->updateUserStatus($user_id,$user_role)){
                        $subject = "Your account has been removed from the site";
                        $body = "Dear $name,<br><br>We're pleased to inform you that your account has been successfully restored after resolving the necessary inquiries.<br><br>If you have any further questions or need assistance, please don't hesitate to contact us at support@readspot.com.<br><br>Thank you for your patience and understanding.<br><br>Best regards,<br>ReadSpot Team";

                        $this->sentEmails($email, $subject, $body); 
                        redirect('superadmin/removeList');
                // }
                
            }else{
                die('something were wrong');
            }
        }
    }
}
public function notifications(){
    if(!isLoggedInSuperAdmin()){
        redirect('landing/login');
    }else{

        $user_id = $_SESSION['user_id'];
        $superadminDetails = $this->superadminModel->findSuperAdminById($user_id);  
       
        $ChatDetails=$this->publisherModel->getChatDetailsById($user_id);
        $sender_id=$ChatDetails[0]->outgoing_msg_id;
       
        $senderDetails=$this->publisherModel->finduserDetails($sender_id);
      
        $data=[
            'chatDetails'=>$ChatDetails,
            'user_id'=>$user_id,
            'superadminName'=>$superadminDetails[0]->name,
            'superadminDetails'=>$superadminDetails,
            'senderName'=>$senderDetails->name
        ];

        $this->view('superadmin/notifications',$data);

}
}

public function complaints(){
    if(!isLoggedInSuperAdmin()){
        redirect('landing/login');
    }else{

        $user_id = $_SESSION['user_id'];
        $superadminDetails = $this->superadminModel->findSuperAdminById($user_id);  
       
        $complintsDetails=$this->superadminModel->getComplaintsDetails();
       
      
        $data=[
            
            'user_id'=>$user_id,
            'superadminName'=>$superadminDetails[0]->name,
            'superadminDetails'=>$superadminDetails,
           'complintsDetails'=>$complintsDetails
        ];

        $this->view('superadmin/complaints',$data);

} 
}

public function proceedResolved($complaintId, $reason) {
   
    $success = $this->superadminModel->updateComplaint($complaintId, $reason);
    if ($success) {
      
        header('Location: ' . URLROOT . '/superadmin/complaints');
    } else {
        
    }
}



public function reports(){
    if (!isLoggedInSuperAdmin()) {
        redirect('landing/login');
    } else {
        $user_id = $_SESSION['user_id'];
    
        $superadminDetails = $this->superadminModel->findSuperAdminById($user_id); 
        $monthlyRegisteredUserCount = $this->superadminModel->getMonthlyRegisteredUserCount();
        $monthlyLoginCount = $this->superadminModel->getMonthlyloginCount();
        $monthlyLogoutCount = $this->superadminModel->getMonthlylogoutCount();
        $countCustomers = $this->superadminModel->countCustomers();
        $countPublishers = $this->superadminModel->countPublishers();
        $countCharity = $this->superadminModel->countCharity();
        $totalLoggedInTime = $this->superadminModel->getTotalLoggedInTime();
        
        $registrationCounts = [];
        $loginCounts = [];
        $logoutCounts = [];

        foreach ($monthlyRegisteredUserCount as $row) {
            $registrationCounts[$row->registration_day] = $row->num_users_registered;
        }
        foreach($monthlyLoginCount as $row){
            $loginCounts[$row->login_date] = $row->num_logins;
        }
        foreach($monthlyLogoutCount as $row){
            $logoutCounts[$row->logout_date] = $row->num_logouts;
        }


        // Fill in any missing days in the past month with a count of zero
        $currentDate = new DateTime();
        $endDate = new DateTime('first day of this month');
        $endDate->modify('last day of last month');
        $interval = new DateInterval('P1D');
        $period = new DatePeriod($endDate, $interval, $currentDate);

        foreach ($period as $date) {
            $registrationDay = $date->format('Y-m-d');
            $loginDay = $date->format('Y-m-d');
            $logoutDay = $date->format('Y-m-d');
            if (!isset($registrationCounts[$registrationDay])) {
                $registrationCounts[$registrationDay] = 0;
            }
            if (!isset($loginCounts[$loginDay])) {
                $loginCounts[$loginDay] = 0;
            }
            if (!isset($logoutCounts[$logoutDay])) {
                $logoutCounts[$logoutDay] = 0;
            }
        }

        ksort($registrationCounts);
        ksort($loginCounts);
        ksort($logoutCounts);

        $Userlabels = [];
        $Userdata = [];
        foreach ($registrationCounts as $registrationDay => $numUsersRegistered) {
            $Userlabels[] = $registrationDay;
            $Userdata[] = $numUsersRegistered;
        }

        $loginlabels = [];
        $logindata = [];
        foreach ($loginCounts as $loginDay => $numlogins) {
            $loginlabels[] = $loginDay;
            $logindata[] = $numlogins;
        }

        $logoutlabels = [];
        $logoutdata = [];
        foreach ($logoutCounts as $logoutDay => $numlogouts) {
            $logoutlabels[] = $logoutDay;
            $logoutdata[] = $numlogouts;
        }
        
        $data = [
            'superadminDetails' => $superadminDetails,
            'superadminName'=>$superadminDetails[0]->name,
            'superadminEmail'=>$superadminDetails[0]->email,
            'Userlabels'=>$Userlabels,
            'Userdata'=>$Userdata,
            'loginlabels'=>$loginlabels,
            'logindata'=>$logindata,
            'logoutlabels'=>$logoutlabels,
            'logoutdata'=>$logoutdata,

            'countCustomers'=>$countCustomers,
            'countPublishers'=>$countPublishers,
            'countCharity'=>$countCharity,
            'totalLoggedInTime'=>$totalLoggedInTime,
        ];
        $this->view('superadmin/reports', $data);
    }
}
}


    

