
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
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $superadminDetails = $this->superadminModel->findSuperAdminById($user_id);  
            $data = [
                'superadminDetails' => $superadminDetails,
                'superadminName'=>$superadminDetails[0]->name,
                'superadminEmail'=>$superadminDetails[0]->email
               

            ];
            $this->view('superadmin/index',$data);
        }
        
    }

    public function addAdmin(){
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

    public function addModerator(){
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
        if (!isLoggedIn()) {
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
        if (!isLoggedIn()) {
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

    

}