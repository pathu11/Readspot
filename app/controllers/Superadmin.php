
<?php
class Superadmin extends Controller{
    private $superadminModel;
   
    private $userModel;
  
    private $db;
    public function __construct(){
        $this->superadminModel=$this->model('Super_admin');
        // $this->adminModel=$this->model('Admins');
        $this->userModel=$this->model('User');
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
            $data = [
                'superadminDetails' => $superadminDetails,
                'superadminName'=>$superadminDetails[0]->name,
                'superadminEmail'=>$superadminDetails[0]->email,
                'countModerators'=>$countModerators,
                'countAdmins'=>$countAdmins,
                'countCustomers'=>$countCustomers,
                'countPublishers'=>$countPublishers,
                'countCharity'=>$countCharity,
                'countDelivery'=>$countDelivery

            ];
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
                    var_dump($data); 
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

    public function deleteadmins($user_id)
{

    if ($this->superadminModel->deleteadmins($user_id)) {
//            var_dump($package_id);
        if ($this->superadminModel->deleteusers($user_id)){
            flash('post_message', 'Admin Removed');
            redirect('superadmin/admins');
        }
        
    } else {
        die('Something went wrong');
    }
}

public function deletemoderators($user_id)

{
    if (!isLoggedInSuperAdmin()) {
        redirect('landing/login');
    }
    if ($this->superadminModel->deletemoderators($user_id)) {
//            var_dump($package_id);
        if ($this->superadminModel->deleteusers($user_id)){
            flash('post_message', 'Moderator Removed');
            redirect('superadmin/moderators');
        }
        
    } else {
        die('Something went wrong');
    }
}
public function deletedelivery($user_id)
{
    if (!isLoggedIn()) {
        redirect('landing/login');
    }
    if ($this->superadminModel->deletedelivery($user_id)) {
//            var_dump($package_id);
        if ($this->superadminModel->deleteusers($user_id)){
            flash('post_message', 'delivery Removed');
            redirect('superadmin/delivery');
        }
        
    } else {
        die('Something went wrong');
    }
}
public function deletecustomers($user_id)
{
    if ($this->superadminModel->deletecustomers($user_id)) {
//            var_dump($package_id);
        if ($this->superadminModel->deleteusers($user_id)){
            flash('post_message', 'customer Removed');
            redirect('superadmin/customers');
        }
        
    } else {
        die('Something went wrong');
    }
}
public function deletepublishers($user_id)
{
    if ($this->superadminModel->deletepublishers($user_id)) {
        if ($this->superadminModel->deleteusers($user_id)){
            flash('post_message', 'publisher Removed');
            redirect('superadmin/publishers');
        }
        
    } else {
        die('Something went wrong');
    }
}
public function deletecharity($user_id)
{
    if ($this->superadminModel->deletecharity($user_id)) {
//            var_dump($package_id);
        if ($this->superadminModel->deleteusers($user_id)){
            flash('post_message', 'charity organization Removed');
            redirect('superadmin/charity');
        }
        
    } else {
        die('Something went wrong');
    }
}

// public function order(){
    
// }





    

}