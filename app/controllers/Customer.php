<?php 
class Customer extends Controller {
    private $customerModel;
  
    private $userModel;
  
    private $db;
    public function __construct(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        }
        $this->customerModel=$this->model('Customers');
        $this->userModel=$this->model('User');  
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

    

    public function Home(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/Home', $data);
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
                   
                    $customerid = $customerDetails[0]->customer_id;
                    $publisherName = $customerDetails[0]->name;                   
                } else {
                    echo "Not found";
                }
            }            
            $data=[
                'bookName' => trim($_POST['bookName']),
                'author' => trim($_POST['author']),
                'category' => trim($_POST['category']),
                'bookCondition' => trim($_POST['bookCondition']),
                'publishedYear' => trim($_POST['publishedYear']),
                'price' => trim($_POST['price']),
                'priceType' => trim($_POST['priceType']),
                'weights' => trim($_POST['weights']),
                'isbnNumber' => trim($_POST['isbnNumber']),
                'issnNumber' => trim($_POST['issnNumber']),
                'issmNumber' => trim($_POST['issmNumber']),
                'descriptions' => trim($_POST['descriptions']),
                'imgFront' => '',
                'imgBack' => '',
                'imgInside' => '',
                'accName' => trim($_POST['accName']),
                'accNumber' => trim($_POST['accNumber']),
                'bankName' => trim($_POST['bankName']),
                'branchName' => trim($_POST['branchName']),
                'town' => trim($_POST['town']),
                'district' => trim($_POST['district']),
                'postalCode' => trim($_POST['postalCode']),
                'customer_id' => trim($customerid),// Replace this with the actual customer ID
                
                'bookName_err'=>'',
                'author_err'=>'',
                'category_err'=>'',
                'bookCondition_err'=>'',
                'publishedYear_err'=>'',
                'price_err'=>'',
                'priceType_err'=>'',
                'weights_err'=>'',
                'ISBN_err'=>'',
                'descriptions_err'=>'',
                'imgFront_err'=>'',
                'imgBack_err'=>'',
                'imgInside_err'=>'',
                'accName_err'=>'',
                'accNumber_err'=>'',
                'bankName_err'=>'',
                'branchName_err'=>'',
                'town_err'=>'',
                'district_err'=>'',
                'postalCode_err'=>''
            ];

           
            //validate book name
            if(empty($data['bookName'])){
                $data['bookName_err']='Please enter the Book name';      
            // }else{
            //     if($this->publisherModel->findbookByName($data['book_name'])){
            //         $data['book_name_err']='Book name is already taken'; 
            //     }
            }

            if(empty($data['author'])){
                $data['author_err']='Please enter Author name';      
            }

            if(empty($data['category'])){
                $data['category_err']='Please select the category';      
            }

            if(empty($data['bookCondition'])){
                $data['bookCondition_err']='Please select the book condition';      
            }
            
            if(empty($data['publishedYear'])){
                $data['publishedYear_err']='Please enter published year';      
            }

            if(empty($data['price'])){
                $data['price_err']='Please enter the price';      
            }else if($data['price']<0 ){
                $data['price_err']='Please enter a valid price'; 
            }

            if(empty($data['priceType'])){
                $data['priceType_err']='Please select the price type';      
            }
            
            if(empty($data['weights'])){
                $data['weights_err']='Please enter the weight';      
            }else if($data['weights']<0 ){
                $data['weights_err']='Please enter a valid weight'; 
            }

            //validate ISBN
            if(empty($data['isbnNumber']) && empty($data['issnNumber']) && empty($data['issmNumber'])){
                $data['ISBN_err']='Please enter ISBN _NO or ISSN_NO or ISSM_NO';      
            }

            if(empty($data['descriptions'])){
                $data['descriptions_err']='Please enter the description';      
            }

            if(empty($data['accName'])){
                $data['accName_err']='Please enter Account name';      
            }

            if(empty($data['accNumber'])){
                $data['accNumber_err']='Please enter Account number';      
            }

            if(empty($data['bankName'])){
                $data['bankName_err']='Please enter Bank name';      
            }

            if(empty($data['branchName'])){
                $data['branchName_err']='Please enter Branch name';      
            }

            if(empty($data['town'])){
                $data['town_err']='Please enter Town';      
            }

            if(empty($data['district'])){
                $data['district_err']='Please enter District';      
            }

            if(empty($data['postalCode'])){
                $data['postalCode_err']='Please enter postal code';      
            }
           
            
            //make sure errors are empty
            if(empty($data['bookName_err']) && empty($data['author_err']) && empty($data['category_err']) &&empty($data['bookCondition_err']) && empty($data['publishedYear_err']) && empty($data['price_err']) && empty($data['priceType_err']) && empty($data['weights_err']) && empty($data['ISBN_err']) && empty($data['descriptions_err']) && empty($data['accName_err']) && empty($data['accNumber_err']) && empty($data['bankName_err']) && empty($data['branchName_err']) && empty($data['town_err']) && empty($data['district_err']) && empty($data['postalCode_err'])){

                //image
                if (isset($_FILES['imgFront']['name']) AND !empty($_FILES['imgFront']['name'])) {
         
         
                    $img_name = $_FILES['imgFront']['name'];
                    $tmp_name = $_FILES['imgFront']['tmp_name'];
                    $error = $_FILES['imgFront']['error'];
                    
                    if($error === 0){
                       $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                       $img_ex_to_lc = strtolower($img_ex);
           
                       $allowed_exs = array('jpg', 'jpeg', 'png');
                       if(in_array($img_ex_to_lc, $allowed_exs)){
                          $new_img_name = $data['bookName'] .'-imgBack.'. $img_ex_to_lc;
                          $img_upload_path = "../public/assets/images/customer/AddUsedBook/".$new_img_name;
                          move_uploaded_file($tmp_name, $img_upload_path);

                          $data['imgBack']=$new_img_name;
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
                          $new_img_name = $data['bookName'] .'-imgFront.'. $img_ex_to_lc;
                          $img_upload_path = "../public/assets/images/customer/AddUsedBook/".$new_img_name;
                          move_uploaded_file($tmp_name, $img_upload_path);

                          $data['imgFront']=$new_img_name;
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
                          $new_img_name = $data['bookName'] .'-imgInside.'. $img_ex_to_lc;
                          $img_upload_path = "../public/assets/images/customer/AddUsedBook/".$new_img_name;
                          move_uploaded_file($tmp_name, $img_upload_path);

                          $data['imgInside']=$new_img_name;
                       }
                    }
                }
                
                if($this->customerModel->AddUsedBook($data)){
                    flash('add_success','You are added the book  successfully');
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
                    $customerName = $customerDetails[0]->name;                   
                } else {
                    echo "Not found";
                }
            }     
            $data=[
                // 'bookCategoryDetails'=>$bookCategoryDetails,
                'customerName'=>$customerName,
                'bookName' => '',
                'author' => '',
                'category' => '',
                'bookCondition' => '',
                'publishedYear' => '',
                'price' => '',
                'priceType' => '',
                'weights' => '',
                'isbnNumber' => '',
                'issnNumber' => '',
                'issmNumber' => '',
                'descriptions' => '',
                'imgFront' => '',
                'imgBack' => '',
                'imgInside' => '',
                'accName' => '',
                'accNumber' => '',
                'bankName' => '',
                'branchName' => '',
                'town' => '',
                'district' => '',
                'postalCode' => '',
                'customer_id' => '',

                'bookName_err'=>'',
                'author_err'=>'',
                'category_err'=>'',
                'bookCondition_err'=>'',
                'publishedYear_err'=>'',
                'price_err'=>'',
                'priceType_err'=>'',
                'weights_err'=>'',
                'ISBN_err'=>'',
                'descriptions_err'=>'',
                'imgFront_err'=>'',
                'imgBack_err'=>'',
                'imgInside_err'=>'',
                'accName_err'=>'',
                'accNumber_err'=>'',
                'bankName_err'=>'',
                'branchName_err'=>'',
                'town_err'=>'',
                'district_err'=>'',
                'postalCode_err'=>''
                
            ];

            $this->view('customer/AddUsedBook',$data);

        }
        // else {
        //     $user_id = $_SESSION['user_id'];
           
        //     $customerDetails = $this->customerModel->findCustomerById($user_id);  
        //     $data = [
        //         'customerDetails' => $customerDetails,
        //         'customerName' => $customerDetails[0]->name
        //     ];
        //     $this->view('customer/AddUsedBook', $data);
        // }
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
    
    public function BookDetails(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
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
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
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
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/BuyNewBooks', $data);
        }
    } 
    
    public function BuyUsedBook(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/BuyUsedBook', $data);
        }
    } 
    
    public function Cart(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
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
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/ExchangeBook', $data);
        }
    } 

    public function ExchangeBookDetails(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/ExchangeBookDetails', $data);
        }
    } 

    public function ExchangeBooks(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
            ];
            $this->view('customer/ExchangeBooks', $data);
        }
    } 

    // public function Home(){
        
    //     $this->view('customer/Home');
    // } 

    public function Notification(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $customerDetails = $this->customerModel->findCustomerById($user_id);  
            $data = [
                'customerDetails' => $customerDetails,
                'customerName' => $customerDetails[0]->name
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
                'bookId'=>$bookId,
                'bookName' => trim($_POST['bookName']),
                'author' => trim($_POST['author']),
                'category' => trim($_POST['category']),
                'bookCondition' => trim($_POST['bookCondition']),
                'publishedYear' => trim($_POST['publishedYear']),
                'price' => trim($_POST['price']),
                'priceType' => trim($_POST['priceType']),
                'weights' => trim($_POST['weights']),
                'isbnNumber' => trim($_POST['isbnNumber']),
                'issnNumber' => trim($_POST['issnNumber']),
                'issmNumber' => trim($_POST['issmNumber']),
                'descriptions' => trim($_POST['descriptions']),
                'imgFront' => '',
                'imgBack' => '',
                'imgInside' => '',
                'accName' => trim($_POST['accName']),
                'accNumber' => trim($_POST['accNumber']),
                'bankName' => trim($_POST['bankName']),
                'branchName' => trim($_POST['branchName']),
                'town' => trim($_POST['town']),
                'district' => trim($_POST['district']),
                'postalCode' => trim($_POST['postalCode']),
                'customer_id' => trim($customer_id),// Replace this with the actual customer ID
                
                'bookName_err'=>'',
                'author_err'=>'',
                'category_err'=>'',
                'bookCondition_err'=>'',
                'publishedYear_err'=>'',
                'price_err'=>'',
                'priceType_err'=>'',
                'weights_err'=>'',
                'ISBN_err'=>'',
                'descriptions_err'=>'',
                'imgFront_err'=>'',
                'imgBack_err'=>'',
                'imgInside_err'=>'',
                'accName_err'=>'',
                'accNumber_err'=>'',
                'bankName_err'=>'',
                'branchName_err'=>'',
                'town_err'=>'',
                'district_err'=>'',
                'postalCode_err'=>''
            ];

           
            //validate book name
            if(empty($data['bookName'])){
                $data['bookName_err']='Please enter the Book name';      
            // }else{
            //     if($this->publisherModel->findbookByName($data['book_name'])){
            //         $data['book_name_err']='Book name is already taken'; 
            //     }
            }

            if(empty($data['author'])){
                $data['author_err']='Please enter Author name';      
            }

            if(empty($data['category'])){
                $data['category_err']='Please select the category';      
            }

            if(empty($data['bookCondition'])){
                $data['bookCondition_err']='Please select the book condition';      
            }
            
            if(empty($data['publishedYear'])){
                $data['publishedYear_err']='Please enter published year';      
            }

            if(empty($data['price'])){
                $data['price_err']='Please enter the price';      
            }else if($data['price']<0 ){
                $data['price_err']='Please enter a valid price'; 
            }

            if(empty($data['priceType'])){
                $data['priceType_err']='Please select the price type';      
            }
            
            if(empty($data['weights'])){
                $data['weights_err']='Please enter the weight';      
            }else if($data['weights']<0 ){
                $data['weights_err']='Please enter a valid weight'; 
            }

            //validate ISBN
            if(empty($data['isbnNumber']) && empty($data['issnNumber']) && empty($data['issmNumber'])){
                $data['ISBN_err']='Please enter ISBN _NO or ISSN_NO or ISSM_NO';      
            }

            if(empty($data['descriptions'])){
                $data['descriptions_err']='Please enter the description';      
            }

            if(empty($data['accName'])){
                $data['accName_err']='Please enter Account name';      
            }

            if(empty($data['accNumber'])){
                $data['accNumber_err']='Please enter Account number';      
            }

            if(empty($data['bankName'])){
                $data['bankName_err']='Please enter Bank name';      
            }

            if(empty($data['branchName'])){
                $data['branchName_err']='Please enter Branch name';      
            }

            if(empty($data['town'])){
                $data['town_err']='Please enter Town';      
            }

            if(empty($data['district'])){
                $data['district_err']='Please enter District';      
            }

            if(empty($data['postalCode'])){
                $data['postalCode_err']='Please enter postal code';      
            }
           
            
            //make sure errors are empty
            if(empty($data['bookName_err']) && empty($data['author_err']) && empty($data['category_err']) &&empty($data['bookCondition_err']) && empty($data['publishedYear_err']) && empty($data['price_err']) && empty($data['priceType_err']) && empty($data['weights_err']) && empty($data['ISBN_err']) && empty($data['descriptions_err']) && empty($data['accName_err']) && empty($data['accNumber_err']) && empty($data['bankName_err']) && empty($data['branchName_err']) && empty($data['town_err']) && empty($data['district_err']) && empty($data['postalCode_err'])){

                //image
                if (isset($_FILES['imgFront']['name']) AND !empty($_FILES['imgFront']['name'])) {
         
         
                    $img_name = $_FILES['imgFront']['name'];
                    $tmp_name = $_FILES['imgFront']['tmp_name'];
                    $error = $_FILES['imgFront']['error'];
                    
                    if($error === 0){
                       $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                       $img_ex_to_lc = strtolower($img_ex);
           
                       $allowed_exs = array('jpg', 'jpeg', 'png');
                       if(in_array($img_ex_to_lc, $allowed_exs)){
                          $new_img_name = $data['bookName'] .'-imgBack.'. $img_ex_to_lc;
                          $img_upload_path = "../public/assets/images/customer/AddUsedBook/".$new_img_name;
                          move_uploaded_file($tmp_name, $img_upload_path);

                          $data['imgBack']=$new_img_name;
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
                          $new_img_name = $data['bookName'] .'-imgFront.'. $img_ex_to_lc;
                          $img_upload_path = "../public/assets/images/customer/AddUsedBook/".$new_img_name;
                          move_uploaded_file($tmp_name, $img_upload_path);

                          $data['imgFront']=$new_img_name;
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
                          $new_img_name = $data['bookName'] .'-imgInside.'. $img_ex_to_lc;
                          $img_upload_path = "../public/assets/images/customer/AddUsedBook/".$new_img_name;
                          move_uploaded_file($tmp_name, $img_upload_path);

                          $data['imgInside']=$new_img_name;
                       }
                    }
                }
                
                if($this->customerModel->updateusedbook($data)){
                    flash('update_success','You are added the book  successfully');
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
                'bookId'=>$bookId,
                'bookName' => $UsedBookId->bookName,
                'author' => $UsedBookId->author,
                'category' => $UsedBookId->category,
                'bookCondition' => $UsedBookId->bookCondition,
                'publishedYear' => $UsedBookId->publishedYear,
                'price' => $UsedBookId->price,
                'priceType' => $UsedBookId->priceType,
                'weights' => $UsedBookId->weights,
                'isbnNumber' => $UsedBookId->isbnNumber,
                'issnNumber' => $UsedBookId->issnNumber,
                'issmNumber' => $UsedBookId->issmNumber,
                'descriptions' => $UsedBookId->descriptions,
                'imgFront' => $UsedBookId->imgFront,
                'imgBack' => $UsedBookId->imgBack,
                'imgInside' => $UsedBookId->imgInside,
                'accName' => $UsedBookId->accName,
                'accNumber' => $UsedBookId->accNumber,
                'bankName' => $UsedBookId->bankName,
                'branchName' => $UsedBookId->branchName,
                'town' => $UsedBookId->town,
                'district' => $UsedBookId->district,
                'postalCode' => $UsedBookId->postalCode,
                'customer_id' => $UsedBookId->customer_id,

                'bookName_err'=>'',
                'author_err'=>'',
                'category_err'=>'',
                'bookCondition_err'=>'',
                'publishedYear_err'=>'',
                'price_err'=>'',
                'priceType_err'=>'',
                'weights_err'=>'',
                'ISBN_err'=>'',
                'descriptions_err'=>'',
                'imgFront_err'=>'',
                'imgBack_err'=>'',
                'imgInside_err'=>'',
                'accName_err'=>'',
                'accNumber_err'=>'',
                'bankName_err'=>'',
                'branchName_err'=>'',
                'town_err'=>'',
                'district_err'=>'',
                'postalCode_err'=>''
            ];


            $this->view('customer/updateusedbook', $data);

        }
    } 


    public function deleteusedbook($bookId)
    {
        if ($this->customerModel->deleteusedbook($bookId)) {   
            flash('post_message', 'book is Removed');
            redirect('customer/UsedBooks');
            
            
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
                $UsedBookId = $this->customerModel->getUsedBookById($bookId);
                
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
            'customerName' => $customerDetails[0]->name
        ];
        $this->view('customer/ViewBook', $data);
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
}