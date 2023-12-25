<?php
// require_once 'libraries/Core.php';
class Publisher extends Controller{
    
    private $publisherModel;
    private $orderModel;
    private $userModel;
    private $adminModel;
    private $db;
    public function __construct(){
        $this->publisherModel=$this->model('Publishers');
        $this->userModel=$this->model('User');
        $this->orderModel=$this->model('Orders');
        $this->adminModel=$this->model('Admins');
        $this->db = new Database();
        
    }
    
    public function index(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
            $publisherDetails = $this->publisherModel->findPublisherById($user_id);
            $publisher_id =$publisherDetails[0]->publisher_id;
            $bookCount=$this->publisherModel->countBooks($publisher_id);
            $orderCount=$this->orderModel->countOrders($publisher_id);
            $orderProCount=$this->orderModel->countProOrders($publisher_id);
            $orderDelCount=$this->orderModel->countDelOrders($publisher_id);
            $orderShipCount=$this->orderModel->countShipOrders($publisher_id);
            $orderReturnedCount=$this->orderModel->countReturnedOrders($publisher_id);
            
            $data = [
                'publisherDetails' => $publisherDetails, 
                'bookCount'    =>$bookCount,
                'orderCount'    =>$orderCount,
                'orderProCount'    =>$orderProCount,
                'orderDelCount'    =>$orderDelCount,
                'orderReturnedCount'    =>$orderReturnedCount,
                'orderShipCount'    =>$orderShipCount,
                'publisher_id'   =>$publisher_id ,
                'publisherName'  =>$publisherDetails[0] ->name
            ];
            $this->view('publisher/index', $data);
        } 
    }
    public function weightcalc(){
        if(!isLoggedIn()){
            redirect('landing/login');
        }else{
            $user_id = $_SESSION['user_id'];
                
                $publisherDetails = $this->publisherModel->findPublisherById($user_id);
               
                if ($publisherDetails) {
                   
                   
                    $publisherName = $publisherDetails[0]->name;                   
                } else {
                    echo "Not found";
                }
                $data=[
                    'publisherDetails' => $publisherDetails,
                   'publisherName'=>$publisherName
                    
                ];
    

        }
        $this->view('publisher/weightcalc',$data);
    }

    public function addbooks(){
        if(!isLoggedIn()){
            redirect('/landing/login');
        }
        if($_SERVER['REQUEST_METHOD']=='POST'){
            // process form
            // sanitize post data
            $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
            $publisherid = null;
    
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                
                $publisherDetails = $this->publisherModel->findPublisherById($user_id);
                $bookCategoryDetails = $this->adminModel->getBookCategories();
                if ($publisherDetails) {
                   
                    $publisherid = $publisherDetails[0]->publisher_id;
                    $publisherName = $publisherDetails[1]->name;                   
                } else {
                    echo "Not found";
                }
            }            
            $data=[
                'book_name' => trim($_POST['book_name']),
                'ISBN_no' => trim($_POST['ISBN_no']),
                'author' => trim($_POST['author']),
                'price' => trim($_POST['price']),
                'category' => trim($_POST['category']),
                'weight' => trim($_POST['weight']),
                'descript' => trim($_POST['descript']),
                'quantity' => trim($_POST['quantity']),
                'publisher_id' => trim($publisherid),// Replace this with the actual publisher ID
                // 'img1' => trim($_POST['img1']),
                // 'img2' => trim($_POST['img2']),
                // 'book_name'=>trim($_POST['book_name']),
                'img1'=>'',
                'img2'=>'',
                'book_name_err'=>'',
                'ISBN_no_err'=>'',
                'author_err'=>'',
                'price_err'=>'',
                'category_err'=>'',
                'weight_err'=>'',
                'descript_err'=>'',
                'quantity_err'=>'',
                'img1_err'=>'',
                'img2_err'=>'',
                
            ];

           
            //validate book name
            
            if(empty($data['book_name'])){
                $data['book_name_err']='Please enter the Book name';      
            }else{
                if($this->publisherModel->findbookByName($data['book_name'],$data['publisher_id'])){
                    $data['book_name_err']='Book name is already taken'; 
                }
            }
            //validate ISBN
            if(empty($data['ISBN_no'])){
                $data['ISBN_no_err']='Please enter ISBN _NO';      
            }
            //validate password
            if(empty($data['author'])){
                $data['author_err']='Please enter Author name';      
            }

            
             if(empty($data['price'])){
                $data['price_err']='Please enter the price';      
            }else if($data['price']<0 ){
                $data['price_err']='Please enter a valid price'; 
            }
            if(empty($data['category'])){
                $data['category_err']='Please select the category';      
            }
            if(empty($data['weight'])){
                $data['weight_err']='Please enter the weight';      
            }else if($data['weight']<0 ){
                $data['weight_err']='Please enter a valid weight'; 
            }
            if(empty($data['descript'])){
                $data['descript_err']='Please enter the description';      
            }
            // Validate book quantity
            if (empty($data['quantity'])) {
                $data['quantity_err'] = 'Please enter the number of books';
            } else if (!filter_var($data['quantity'], FILTER_VALIDATE_INT) || $data['quantity'] < 0) {
                $data['quantity_err'] = 'Please enter a valid positive integer';
            }
           
            

            //make sure errors are empty
            if( empty($data['book_name_err']) && empty($data['ISBN_no_err']) && empty($data['author_err']) &&empty($data['price_err']) && empty($data['category_err']) && empty($data['weight_err']) && empty($data['descript_err']) && empty($data['qunatity_err'])  ){

                //image
                if (isset($_FILES['img1']['name']) AND !empty($_FILES['img1']['name'])) {
         
         
                    $img_name = $_FILES['img1']['name'];
                    $tmp_name = $_FILES['img1']['tmp_name'];
                    $error = $_FILES['img1']['error'];
                    
                    if($error === 0){
                       $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                       $img_ex_to_lc = strtolower($img_ex);
           
                       $allowed_exs = array('jpg', 'jpeg', 'png');
                       if(in_array($img_ex_to_lc, $allowed_exs)){
                          $new_img_name = $data['book_name'].$data['publisher_id'] .'-img1.'. $img_ex_to_lc;
                          $img_upload_path = "../public/assets/images/publisher/addbooks/".$new_img_name;
                          move_uploaded_file($tmp_name, $img_upload_path);

                          $data['img1']=$new_img_name;
                       }
                    }
                }
                if (isset($_FILES['img2']['name']) AND !empty($_FILES['img2']['name'])) {
         
         
                    $img_name = $_FILES['img2']['name'];
                    $tmp_name = $_FILES['img2']['tmp_name'];
                    $error = $_FILES['img2']['error'];
                    
                    if($error === 0){
                       $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                       $img_ex_to_lc = strtolower($img_ex);
           
                       $allowed_exs = array('jpg', 'jpeg', 'png');
                       if(in_array($img_ex_to_lc, $allowed_exs)){
                          $new_img_name = $data['book_name'].$data['publisher_id'] .'-img2.'. $img_ex_to_lc;
                          $img_upload_path = "../public/assets/images/publisher/addbooks/".$new_img_name;
                          move_uploaded_file($tmp_name, $img_upload_path);

                          $data['img2']=$new_img_name;
                       }
                    }
                }
                
                if($this->publisherModel->addBooks($data)){
                    flash('add_success','You are added the book  successfully');
                    redirect('publisher/editPostalForBooks/' . $publisherid);

                }else{
                    die('Something went wrong');
                }
            }else{
                $this->view('publisher/addBooks',$data);
            }


        }else{
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                
                $publisherDetails = $this->publisherModel->findPublisherById($user_id);
                $bookCategoryDetails = $this->adminModel->getBookCategories();
                if ($publisherDetails) {
                    $publisherName = $publisherDetails[0]->name;                   
                } else {
                    echo "Not found";
                }
            }     
            $data=[
                'publisherDetails' => $publisherDetails,
                'bookCategoryDetails'=>$bookCategoryDetails,
                'publisherName'=>$publisherName,
                'book_name' => '',
                'ISBN_no' => '',
                'author' => '',
                'price' => '',
                'category' => '',
                'weight' => '',
                'descript' => '',
                'quantity' =>'',
                'publisher_id' => '',// Replace this with the actual publisher ID
                'img1' => '',
                'img2' => '',
                
                'book_name_err'=>'',
                'ISBN_no_err'=>'',
                'author_err'=>'',
                'price_err'=>'',
                'category_err'=>'',
                'weight_err'=>'',
                'descript_err'=>'',
                'quantity_err'=>'',
                'img1_err'=>'',
                'img2_err'=>'',
                
            ];

            $this->view('publisher/addbooks',$data);

        }
    }

    public function editpostalForBooks($publisher_id){
        if(!isLoggedIn()){
            redirect('landing/login');
        }
    
        $user_id = $_SESSION['user_id'];
        $publisherDetails = $this->publisherModel->findPublisherById($user_id);
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Form submitted, process the data
    
            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            $data = [
                'publisher_id' => $publisher_id,
                'postal_name' => trim($_POST['postal_name']),
                'street_name' => trim($_POST['street_name']),
                'town' => trim($_POST['town']),
                'district' => trim($_POST['district']),
                'postal_code' => trim($_POST['postal_code']),
                'postal_name_err' => '',
                'street_name_err' => '',
                'town_err' => '',
                'district_err' => '',
                'postal_code_err' => '',
            ];
               
                //validate book name
                if(empty($data['postal_name'])){
                    $data['postal_name_err']='Please enter the  name';      
                }
                //validate ISBN
                if(empty($data['street_name'])){
                    $data['street_name_err']='Please enter street name';      
                }
                //validate password
                if(empty($data['town'])){
                    $data['town_err']='Please enter the town';      
                }
    
                
                 if(empty($data['district'])){
                    $data['district_err']='Please select the district';      
                }
                if(empty($data['postal_code'])){
                    $data['postal_code_err']='Please enter the postal code';      
                }
               
    
                //make sure errors are empty
                if( empty($data['postal_name_err']) && empty($data['street_name_err']) && empty($data['town_err']) &&empty($data['district_err']) && empty($data['postal_code_err'])   ){

                   
                    
                    
                    if($this->publisherModel->editpostal($data)){
                        flash('update_success','You are added the book  successfully');
                        redirect('publisher/editAccountForBooks/'.$publisher_id);
                    }else{
                        die('Something went wrong');
                    }
                }else{
                        $this->view('publisher/editpostalForBooks',$data);
                    }
    
                   
            }else{
                     
                $publishers = $this->publisherModel->findPublisherBypubId($publisher_id);
                
                
                $data = [
                    'publisherDetails' => $publisherDetails,
                    'publisher_id' => $publisher_id,
                    'postal_name' => $publishers->postal_name,
                    'street_name' => $publishers->street_name,
                    'town' => $publishers->town,
                    'district' => $publishers->district,
                    'postal_code' => $publishers->postal_code,
                    'postal_name_err'=>'',
                    'street_name_err'=>'',
                    'town_err'=>'',
                    'district_err'=>'',
                    'postal_code_err'=>'',
                    'publisherName'  =>$publishers ->name
                   
                ];


                $this->view('publisher/editpostalForBooks',$data);
    
            }  
    }

    public function editAccountForBooks($publisher_id) {
        if (!isLoggedIn()) {
            redirect('landing/login');
        }
    
        $user_id = $_SESSION['user_id'];
    
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Form submitted, process the data
    
            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            $data = [
                'publisher_id' => $publisher_id,
                'account_name' => trim($_POST['account_name']),
                'account_no' => trim($_POST['account_no']),
                'bank_name' => trim($_POST['bank_name']),
                'branch_name' => trim($_POST['branch_name']),
                'account_name_err' => '',
                'account_no_err' => '',
                'bank_name_err' => '',
                'branch_name_err' => '',
            ];
    
            if (empty($data['account_name_err']) && empty($data['account_no_err']) && empty($data['bank_name_err']) && empty($data['branch_name_err'])) {
                // If validation succeeds, update account details
                if ($this->publisherModel->editAccount($data) && $this->publisherModel->AddBookApproval($data)) {
                    // Now add book approval

                    flash('update_success', 'You have updated the account and added book approval successfully');
                    redirect('publisher/productGallery');
                   
                } else {
                    die('Something went wrong with updating account details');
                }
            } else {
                // Validation failed, show the form with errors
                $this->view('publisher/editAccountForBooks', $data);
            }
        } else {
            // Display the form with current account details
            $publishers = $this->publisherModel->findPublisherBypubId($publisher_id);
            $data = [
                'publisher_id' => $publisher_id,
                'account_name' => $publishers->account_name,
                'account_no' => $publishers->account_no,
                'bank_name' => $publishers->bank_name,
                'branch_name' => $publishers->branch_name,
                'account_name_err' => '',
                'account_no_err' => '',
                'bank_name_err' => '',
                'branch_name_err' => '',
            ];
            $this->view('publisher/editAccountForBooks', $data);
        }
    }
    
    public function deletebooks($book_id)
{
    if ($this->publisherModel->deletebooks($book_id)) {   
        flash('post_message', 'book is Removed');
        redirect('publisher/productGallery');
        
        
    } else {
        die('Something went wrong');
    }
}
    public function customerSupport(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        }
        $publisherid = null;
    
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            
            $publisherDetails = $this->publisherModel->findPublisherById($user_id);
           
            if ($publisherDetails) {
               
                $publisherid = $publisherDetails[0]->publisher_id;
              
                $messageDetails = $this->publisherModel->findMessageByUserId($user_id);
                
            } else {
                echo "Not found";
            }
        } else {
            echo "Not a publisher";
        }
    
        $data = [
            'publisherid' => $publisherid,
            'publisherDetails' => $publisherDetails,
            'messageDetails' => $messageDetails,
            'publisherName'  =>$publisherDetails[0] ->name
        ];
    

        $this->view('publisher/customerSupport',$data);
    }
    
    public function deliveredorders()
{
    if (!isLoggedIn()) {
        redirect('landing/login');
    }

    $publisherid = null;
    $publisherDetails = null;
    $orderDetails = null;
    $customerName = null;
    $publisherName = null;

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        $publisherDetails = $this->publisherModel->findPublisherById($user_id);

        if ($publisherDetails) {
            $publisherid = $publisherDetails[0]->publisher_id;
            $publisherName = $publisherDetails[0]->name;

            if ($publisherid) {
                $orderDetails = $this->orderModel->findNewBookDeliveredOrdersBypubId($publisherid);

                if ($orderDetails) {
                    foreach ($orderDetails as $order) {
                        $customerName = $order->customer_name;
                        // Additional processing if needed
                    }
                } else {
                    echo "No orders found";
                }
            } else {
                echo "Publisher ID not found";
            }
        } else {
            echo "Publisher not found";
        }
    } else {
        echo "Not logged in as a publisher";
    }

    $data = [
        'publisherid' => $publisherid,
        'publisherDetails' => $publisherDetails,
        'orderDetails' => $orderDetails,
        'customerName' => $customerName,
        'publisherName' => $publisherName
    ];

    $this->view('publisher/deliveredorders', $data);
}
public function processingorders()
{
    if (!isLoggedIn()) {
        redirect('landing/login');
    }

    $publisherid = null;
    $publisherDetails = null;
    $orderDetails = null;
    $customerName = null;
    $publisherName = null;

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        $publisherDetails = $this->publisherModel->findPublisherById($user_id);

        if ($publisherDetails) {
            $publisherid = $publisherDetails[0]->publisher_id;
            $publisherName = $publisherDetails[0]->name;

            if ($publisherid) {
                $orderDetails = $this->orderModel->findNewBookProOrdersBypubId($publisherid);

                if ($orderDetails) {
                    foreach ($orderDetails as $order) {
                        $customerName = $order->customer_name;
                        // Additional processing if needed
                    }
                } else {
                    echo "No orders found";
                }
            } else {
                echo "Publisher ID not found";
            }
        } else {
            echo "Publisher not found";
        }
    } else {
        echo "Not logged in as a publisher";
    }

    $data = [
        'publisherid' => $publisherid,
        'publisherDetails' => $publisherDetails,
        'orderDetails' => $orderDetails,
        'customerName' => $customerName,
        'publisherName' => $publisherName
    ];

    $this->view('publisher/processingorders', $data);
}

   
    public function shippedorders(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        }
        $publisherid = null;
       
        $publisherDetails = null;
        $orderDetails = null;
        $customerName = null;
        $publisherName = null;
    
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            
            $publisherDetails = $this->publisherModel->findPublisherById($user_id);
    
            if ($publisherDetails) {
                $publisherid = $publisherDetails[0]->publisher_id;
                $publisherName = $publisherDetails[0]->name;
                if ($publisherid) {
                    $orderDetails = $this->orderModel->findNewBookShippingOrdersBypubId($publisherid);
    
                    if ($orderDetails) {
                        // Assuming findBrandNewBookProOrdersBypubId returns an array of orders
                        foreach ($orderDetails as $order) {
                            // $publisherName = $order->publisher_name;
                            $customerName = $order->customer_name;

                        }
                    } else {
                        echo "No orders found";
                    }
                } else {
                    echo "Publisher ID not found";
                }
            } else {
                echo "Publisher not found";
            }
        } else {
            echo "Not logged in as a publisher";
        }
    
        $data = [
            'publisherid' => $publisherid,
            'publisherDetails' => $publisherDetails,
            'orderDetails' => $orderDetails,
            'customerName' => $customerName,
            
            'publisherName'  =>$publisherName
        ];
        $this->view('publisher/shippedorders',$data);
    }
    
    public function returnedorders(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        }
        $publisherid = null;
        
        $publisherDetails = null;
        $orderDetails = null;
        $customerName = null;
        $publisherName = null;
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            
            $publisherDetails = $this->publisherModel->findPublisherById($user_id);
    
            if ($publisherDetails) {
                $publisherid = $publisherDetails[0]->publisher_id;
                $publisherName = $publisherDetails[0]->name;
                if ($publisherid) {
                    $orderDetails = $this->orderModel->findNewBookReturnedOrdersBypubId($publisherid);
    
                    if ($orderDetails) {
                        // Assuming findBrandNewBookProOrdersBypubId returns an array of orders
                        foreach ($orderDetails as $order) {
                            // $publisherName = $order->publisher_name;
                            $customerName = $order->customer_name;

                        }
                    } else {
                        echo "No orders found";
                    }
                } else {
                    echo "Publisher ID not found";
                }
            } else {
                echo "Publisher not found";
            }
        } else {
            echo "Not logged in as a publisher";
        }
    
        $data = [
            'publisherid' => $publisherid,
            'publisherDetails' => $publisherDetails,
            'orderDetails' => $orderDetails,
            'customerName' => $customerName,
            
            'publisherName'  =>$publisherName
        ];
        $this->view('publisher/returnedorders',$data);
    }
    
    
    public function productGallery() {
        if (!isLoggedIn()) {
            redirect('landing/login');
        }
        $publisherid = null;
    
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            
            $publisherDetails = $this->publisherModel->findPublisherById($user_id);
           
            if ($publisherDetails) {
               
                $publisherid = $publisherDetails[0]->publisher_id;
              
                $bookDetails = $this->publisherModel->findBookByPubId($publisherid);
                
            } else {
                echo "Not found";
            }
        } else {
            echo "Not a publisher";
        }
    
        $data = [
            'publisherid' => $publisherid,
            'publisherDetails' => $publisherDetails,
            'bookDetails' => $bookDetails,
            'publisherName'  =>$publisherDetails[0] ->name
        ];
    
        $this->view('publisher/productGallery', $data);
    }
    
    
    public function setting(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
            // Fetch publisher details and render the view
            $publisherDetails = $this->publisherModel->findPublisherById($user_id); // Ensure the method exists in the UserModel
            $data = [
                'publisherDetails' => $publisherDetails,
                'publisherName'  =>$publisherDetails[0] ->name
            ];
            $this->view('publisher/setting', $data); // Ensure you are using the correct view file
        }
      
    }
    public function editpostal($publisher_id){
        if(!isLoggedIn()){
            redirect('landing/login');
        }
    
        $user_id = $_SESSION['user_id'];

        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Form submitted, process the data
    
            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            $data = [
                'publisher_id' => $publisher_id,
                'postal_name' => trim($_POST['postal_name']),
                'street_name' => trim($_POST['street_name']),
                'town' => trim($_POST['town']),
                'district' => trim($_POST['district']),
                'postal_code' => trim($_POST['postal_code']),
                'postal_name_err' => '',
                'street_name_err' => '',
                'town_err' => '',
                'district_err' => '',
                'postal_code_err' => '',
            ];
               
                //validate book name
                if(empty($data['postal_name'])){
                    $data['postal_name_err']='Please enter the  name';      
                }
                //validate ISBN
                if(empty($data['street_name'])){
                    $data['street_name_err']='Please enter street name';      
                }
                //validate password
                if(empty($data['town'])){
                    $data['town_err']='Please enter the town';      
                }
    
                
                 if(empty($data['district'])){
                    $data['district_err']='Please select the district';      
                }
                if(empty($data['postal_code'])){
                    $data['postal_code_err']='Please enter the postal code';      
                }
               
    
                //make sure errors are empty
                if( empty($data['postal_name_err']) && empty($data['street_name_err']) && empty($data['town_err']) &&empty($data['district_err']) && empty($data['postal_code_err'])   ){

                   
                    
                    
                    if($this->publisherModel->editpostal($data)){
                        flash('update_success','You are added the book  successfully');
                        redirect('publisher/setting');
                    }else{
                        die('Something went wrong');
                    }
                }else{
                        $this->view('publisher/editpostal',$data);
                    }
    
                   
            }else{
                     
                $publishers = $this->publisherModel->findPublisherBypubId($publisher_id);
               
                
                $data = [
                    
                    'publisher_id' => $publisher_id,
                    'postal_name' => $publishers->postal_name,
                    'street_name' => $publishers->street_name,
                    'town' => $publishers->town,
                    'district' => $publishers->district,
                    'postal_code' => $publishers->postal_code,
                    'postal_name_err'=>'',
                    'street_name_err'=>'',
                    'town_err'=>'',
                    'district_err'=>'',
                    'postal_code_err'=>'',
                    'publisherName'  =>$publishers ->name,
                   
                   
                ];


                $this->view('publisher/editpostal',$data);
    
            }  
    }

    public function editAccount($publisher_id){
        if(!isLoggedIn()){
            redirect('landing/login');
        }
    
        $user_id = $_SESSION['user_id'];

        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Form submitted, process the data
    
            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            $data = [
                'publisher_id' => $publisher_id,
                'account_name' => trim($_POST['account_name']),
                'account_no' => trim($_POST['account_no']),
                'bank_name' => trim($_POST['bank_name']),
                'branch_name' => trim($_POST['branch_name']),
                
                'account_name_err' => '',
                'account_no_err' => '',
                'bank_name_err' => '',
                'branch_name_err' => '',
            ];
               
                //validate book name
                if(empty($data['account_name'])){
                    $data['account_name_err']='Please enter the account holder name';      
                }
                //validate ISBN
                if(empty($data['account_no'])){
                    $data['account_no_err']='Please enter correct account number';      
                }
                //validate password
                if(empty($data['bank_name'])){
                    $data['bank_name_err']='Please enter the bank name';      
                }
    
                
                 if(empty($data['branch_name'])){
                    $data['branch_name_err']='Please enter the branch name';      
                }
                
               
    
                //make sure errors are empty
                if( empty($data['account_name_err']) && empty($data['account_no_err']) && empty($data['bank_name_err']) &&empty($data['branch_name_err'])   ){

                   
                    
                    
                    if($this->publisherModel->editAccount($data)){
                        flash('update_success','You are added the book  successfully');
                        redirect('publisher/setting');
                    }else{
                        die('Something went wrong');
                    }
                }else{
                        $this->view('publisher/editAccount',$data);
                    }
    
                   
            }else{
                     
                $publishers = $this->publisherModel->findPublisherBypubId($publisher_id);
                $data = [
                    
                    'publisher_id' => $publisher_id,
                    'account_name' => $publishers->account_name,
                    'account_no' => $publishers->account_no,
                    'bank_name' => $publishers->bank_name,
                    'branch_name' => $publishers->branch_name,
                    
                    'account_name_err' => '',
                    'account_no_err' => '',
                    'bank_name_err' => '',
                    'branch_name_err' => '',  
                ];
                $this->view('publisher/editAccount',$data);
            }  
    }

    public function editProfile($publisher_id){
        if(!isLoggedIn()){
            redirect('landing/login');
        }
    
        $user_id = $_SESSION['user_id'];

        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Form submitted, process the data
    
            // Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
    
            $data = [
                'publisher_id' => $publisher_id,
                'profile_img'=>'',
                'name' => trim($_POST['name']),
                'contact_no' => trim($_POST['contact_no']),    
                // 'profile_img_err' => '',
                'name_err' => '',
                'contact_no_err' => '',
               
            ];
               
                //validate book name
                // if(empty($data['profile_img'])){
                //     $data['profile_img_err']='Please enter the profile picture';      
                // }
                //validate ISBN
                if(empty($data['name'])){
                    $data['name_err']='Please enter the name';      
                }
                //validate password
                if(empty($data['contact_no'])){
                    $data['contact_no_err']='Please enter the contact_no';      
                }
                //make sure errors are empty
                if(  empty($data['name_err']) && empty($data['contact_no_err'])    ){
                    // Handle profile image upload
            if (isset($_FILES['profile_img']['name']) && !empty($_FILES['profile_img']['name'])) {

                $img_name = $_FILES['profile_img']['name'];
                $tmp_name = $_FILES['profile_img']['tmp_name'];
                $error = $_FILES['profile_img']['error'];

                if ($error === 0) {
                    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                    $img_ex_to_lc = strtolower($img_ex);

                    $allowed_exs = array('jpg', 'jpeg', 'png');
                    if (in_array($img_ex_to_lc, $allowed_exs)) {
                        $new_img_name = $data['name'] . '-profile_img.' . $img_ex_to_lc;
                        $img_upload_path = "../public/assets/images/publisher/addbooks/" . $new_img_name;

                        if (!move_uploaded_file($tmp_name, $img_upload_path)) {
                            // Handle file upload error
                            $data['profile_img_err'] = 'Error uploading profile picture';
                        } else {
                            $data['profile_img'] = $new_img_name;
                        }
                    } else {
                        $data['profile_img_err'] = 'Invalid file format. Only JPEG, JPG, and PNG files are allowed.';
                    }
                } else {
                    // Handle file upload error based on the error code
                    switch ($error) {
                        case UPLOAD_ERR_INI_SIZE:
                            $data['profile_img_err'] = 'The uploaded file exceeds the maximum upload size.';
                            break;
                        case UPLOAD_ERR_FORM_SIZE:
                            $data['profile_img_err'] = 'The uploaded file exceeds the maximum form size.';
                            break;
                        case UPLOAD_ERR_PARTIAL:
                            $data['profile_img_err'] = 'The uploaded file was only partially uploaded.';
                            break;
                        case UPLOAD_ERR_NO_FILE:
                            // No file was uploaded
                            break;
                        default:
                            $data['profile_img_err'] = 'An unknown error occurred while uploading the profile picture.';
                    }
                }
            }
                   
                    
                    
                    if($this->publisherModel->editProfile($data)){
                        flash('update_success','You are added the book  successfully');
                        redirect('publisher/setting');
                    }else{
                        die('Something went wrong');
                    }
                }else{
                        $this->view('publisher/editProfile',$data);
                    }
    
                   
            }else{
                     
                $publishers = $this->publisherModel->findPublisherBypubId($publisher_id);
                
                
                $data = [
                    
                    'publisher_id' => $publisher_id,
                    'profile_img' => $publishers->profile_img,
                    'name' => $publishers->name,
                    'contact_no' => $publishers->contact_no,
                    'profile_img_err' => '',
                    'name_err' => '',
                    'contact_no_err' => '',
                   
                ];


                $this->view('publisher/editProfile',$data);
    
            }  
    }
    
    public function update($book_id){
        if(!isLoggedIn()){
            redirect('landing/login');
        }
            $user_id = $_SESSION['user_id'];
            // $books = $this->publisherModel->findBookById($book_id);
            // $publisher_id=$books[0]->publisher_id;
            $publisherDetails = $this->publisherModel->findPublisherById($user_id);
            $bookCategoryDetails = $this->adminModel->getBookCategories();
            $publisher_id=$publisherDetails[0]->publisher_id;
            if($_SERVER['REQUEST_METHOD']=='POST'){
                // process form
                // sanitize post data
                $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
    
    
                          
                $data=[
                    // 'publisherDetails'=>$publisherDetails,
                    // 'publisherName'=>$publisherDetails[0]->name,
                    'book_id'=>$book_id,
                    'book_name' => trim($_POST['book_name']),
                    'ISBN_no' => trim($_POST['ISBN_no']),
                    'author' => trim($_POST['author']),
                    'price' => trim($_POST['price']),
                    'category' => trim($_POST['category']),
                    'weight' => trim($_POST['weight']),
                    'descript' => trim($_POST['descript']),
                    'quantity' => trim($_POST['quantity']),
                    // 'publisher_id' => $publisherDetails[0]->publisher_id,,// Replace this with the actual publisher ID
                    'img1' => '',
                    'img2' => '',
                    // 'book_name'=>trim($_POST['book_name']),
                    
                    'book_name_err'=>'',
                    'ISBN_no_err'=>'',
                    'author_err'=>'',
                    'price_err'=>'',
                    'category_err'=>'',
                    'weight_err'=>'',
                    'descript_err'=>'',
                    'quantity_err'=>'',
                    // 'img1_err'=>'',
                    // 'img2_err'=>'',
                    
                ];
    
               
                //validate book name
                if(empty($data['book_name'])){
                    $data['book_name_err']='Please enter the Book name';      
                }
                //validate ISBN
                if(empty($data['ISBN_no'])){
                    $data['ISBN_no_err']='Please enter ISBN _NO';      
                }
                //validate password
                if(empty($data['author'])){
                    $data['author_err']='Please enter Author name';      
                }
    
                
                 if(empty($data['price'])){
                    $data['price_err']='Please enter the price';      
                }else if($data['price']<0 ){
                    $data['price_err']='Please enter a valid price'; 
                }
                if(empty($data['category'])){
                    $data['category_err']='Please select the category';      
                }
                if(empty($data['weight'])){
                    $data['weight_err']='Please enter the weight';      
                }else if($data['weight']<0 ){
                    $data['weight_err']='Please enter a valid weight'; 
                }
                if(empty($data['descript'])){
                    $data['descript_err']='Please enter the description';      
                }
                // Validate book quantity
                if (empty($data['quantity'])) {
                    $data['quantity_err'] = 'Please enter the number of books';
                } else if (!filter_var($data['quantity'], FILTER_VALIDATE_INT) || $data['quantity'] < 0) {
                    $data['quantity_err'] = 'Please enter a valid positive integer';
                }
               
                
    
                //make sure errors are empty
                if( empty($data['book_name_err']) && empty($data['ISBN_no_err']) && empty($data['author_err']) &&empty($data['price_err']) && empty($data['category_err']) && empty($data['weight_err']) && empty($data['descript_err']) && empty($data['qunatity_err'])  ){

                    //image
                    if (isset($_FILES['img1']['name']) AND !empty($_FILES['img1']['name'])) {
            
            
                        $img_name = $_FILES['img1']['name'];
                        $tmp_name = $_FILES['img1']['tmp_name'];
                        $error = $_FILES['img1']['error'];
                        
                        if($error === 0){
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_to_lc = strtolower($img_ex);
            
                        $allowed_exs = array('jpg', 'jpeg', 'png');
                        if(in_array($img_ex_to_lc, $allowed_exs)){
                            $new_img_name = $data['book_name'] .'-img1.'. $img_ex_to_lc;
                            $img_upload_path = "../public/assets/images/publisher/addbooks/".$new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path);

                            $data['img1']=$new_img_name;
                        }
                        }
                    }
                    if (isset($_FILES['img2']['name']) AND !empty($_FILES['img2']['name'])) {
            
            
                        $img_name = $_FILES['img2']['name'];
                        $tmp_name = $_FILES['img2']['tmp_name'];
                        $error = $_FILES['img2']['error'];
                        
                        if($error === 0){
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_to_lc = strtolower($img_ex);
            
                        $allowed_exs = array('jpg', 'jpeg', 'png');
                        if(in_array($img_ex_to_lc, $allowed_exs)){
                            $new_img_name = $data['book_name'] .'-img2.'. $img_ex_to_lc;
                            $img_upload_path = "../public/assets/images/publisher/addbooks/".$new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path);

                            $data['img2']=$new_img_name;
                        }
                        }
                    }
                    
                    if($this->publisherModel->update($data)){
                        flash('update_success','You are added the book  successfully');
                        redirect('publisher/productGallery');
                    }else{
                        die('Something went wrong');
                    }
                    }else{
                        $this->view('publisher/update',$data);
                    }
            }else{
                     
                $bookCategoryDetails = $this->adminModel->getBookCategories();
                // ...
                $books = $this->publisherModel->findBookById($book_id);
                if($books->publisher_id != $publisher_id){
                    redirect('publisher/productGallery');
                  }
                $data = [
                    'publisherDetails' => $publisherDetails,
                    'bookCategoryDetails'=>$bookCategoryDetails,
                    'book_id' => $book_id,
                    'book_name' => $books->book_name,
                    'ISBN_no' => $books->ISBN_no,
                    'author' => $books->author,
                    'price' => $books->price,
                    'category' => $books->category,
                    'weight' => $books->weight,
                    'descript' => $books->descript,
                    'quantity' => $books->quantity,
                    

                    'img1' => $books->img1,
                    'img2' => $books->img2,
                    'book_name_err' => '',
                    'ISBN_no_err' => '',
                    'author_err' => '',
                    'price_err' => '',
                    'category_err' => '',
                    'weight_err' => '',
                    'descript_err' => '',
                    'quantity_err' => '',
                    // 'img1_err' => '',
                    // 'img2_err' => '',   
                ];
                $this->view('publisher/update',$data);
    
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