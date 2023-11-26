<?php
 class Admin extends Controller{
  private $adminModel;
  
  private $userModel;

  private $db;
  public function __construct(){
      $this->adminModel=$this->model('Admins');
      $this->userModel=$this->model('User');
     
     
      $this->db = new Database();

  }
  public function index(){
      if (!isLoggedIn()) {
          redirect('landing/login');
      } else {
          $user_id = $_SESSION['user_id'];
         
          $adminDetails = $this->adminModel->findAdminById($user_id);  
          $data = [
              'adminDetails' => $adminDetails,
              'adminName'=>$adminDetails[0]->name
          ];
          $this->view('admin/index', $data);
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

  public function updateBookCategory($id){
    $user_id = $_SESSION['user_id'];
         
    $adminDetails = $this->adminModel->findAdminById($user_id);
    
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

        $data = [
            'adminDetails' => $adminDetails,
            'adminName'=>$adminDetails[0]->name,
            'id'=>$id,
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
            if($this->adminModel->updateBookCategory($data)){
                flash('update_success','You are updated the book category successfully');
                redirect('admin/categories');
            }else{
                die('Something went wrong');
            }
        }
        //Load view with errors
        else{
            $this->view('admin/updateBookCategory',$data);
        }
        
    }

    else{
        $bookCategory = $this->adminModel->findBookCategoryById($id);
        
        $data=[
            'adminDetails' => $adminDetails,
            'adminName'=>$adminDetails[0]->name,
            'id'=>$id,
            'book_category'=>$bookCategory->category,
            'description'=>$bookCategory->description,
            'book_category_err'=>'',
            'description_err'=>''
        ];

        $this->view('admin/updateBookCategory',$data);
    }
    
    
  }

  public function deleteBookCategory($id){
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if($this->adminModel->deleteBookCategory($id)){
            flash('delete_success','You deleted the book category successfully');
            redirect('admin/categories');
        }
        else{
            die('Something went wrong');
        }
    }
    else{
        redirect('admin/categories');
    }
  }
 }