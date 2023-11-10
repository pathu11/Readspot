<?php
class Publisher extends Controller{
    private $publisherModel;
    
    private $userModel;

    private $db;
    public function __construct(){
        $this->publisherModel=$this->model('Publishers');
        $this->userModel=$this->model('User');
       
       
        $this->db = new Database();

    }
    public function index(){
        if (!isLoggedIn()) {
            redirect('landing/login');
        } else {
            $user_id = $_SESSION['user_id'];
           
            $publisherDetails = $this->publisherModel->findPublisherById($user_id);  
            $data = [
                'publisherDetails' => $publisherDetails
            ];
            $this->view('publisher/index', $data);
        }
       
      
    }
    public function addbooks(){
        if($_SERVER['REQUEST_METHOD']=='POST'){
            // process form
            // sanitize post data
            $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);


            $publisherid = null;
    
            if (isset($_SESSION['user_id'])) {
                $user_id = $_SESSION['user_id'];
                
                $publisherDetails = $this->publisherModel->findPublisherById($user_id);
               
                if ($publisherDetails) {
                   
                    $publisherid = $publisherDetails[0]->publisher_id;                   
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
                'img1' => trim($_POST['img1']),
                'img2' => trim($_POST['img2']),
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
                
                if($this->publisherModel->addBooks($data)){
                    flash('add_success','You are added the book  successfully');
                    redirect('publisher/productGallery');
                }else{
                    die('Something went wrong');
                }
            }else{
                $this->view('publisher/addBooks',$data);
            }


        }else{
            $data=[
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
                // 'img1_err'=>'',
                // 'img2_err'=>'',
                
            ];

            $this->view('publisher/addbooks',$data);

        }
    }

       
       
        
    
    
    public function customerSupport(){
        $this->view('publisher/customerSupport');
    }
    public function deliveredorders(){
        $this->view('publisher/deliveredorders');
    }
    public function processingorders(){
        $this->view('publisher/processingorders');
    }
    

    public function productGallery() {
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
            'bookDetails' => $bookDetails
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
                'publisherDetails' => $publisherDetails
            ];
            $this->view('publisher/setting', $data); // Ensure you are using the correct view file
        }
      
    }
    public function shippedorders(){
        $this->view('publisher/shippedorders');
    }
    public function update($book_id){
            
       
            if($_SERVER['REQUEST_METHOD']=='POST'){
                // process form
                // sanitize post data
                $_POST= filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);
    
    
                $publisherid = null;
        
                if (isset($_SESSION['user_id'])) {
                    $user_id = $_SESSION['user_id'];
                    
                    $publisherDetails = $this->publisherModel->findPublisherById($user_id);
                   
                    if ($publisherDetails) {
                       
                        $publisherid = $publisherDetails[0]->publisher_id;                   
                    } else {
                        echo "Not found";
                    }
                }            
                $data=[
                    'book_id'=>$book_id,
                    'book_name' => trim($_POST['book_name']),
                    'ISBN_no' => trim($_POST['ISBN_no']),
                    'author' => trim($_POST['author']),
                    'price' => trim($_POST['price']),
                    'category' => trim($_POST['category']),
                    'weight' => trim($_POST['weight']),
                    'descript' => trim($_POST['descript']),
                    'quantity' => trim($_POST['quantity']),
                    'publisher_id' => trim($publisherid),// Replace this with the actual publisher ID
                    'img1' => trim($_POST['img1']),
                    'img2' => trim($_POST['img2']),
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
                     
              
                $books=$this->publisherModel->findBookById($book_id);
                // if($books->publisher_id !=$_SESSION['publisher_id']){
                //     redirect('publisher/productGallery');
                // }
                // echo $book_id;
                // var_dump($books['book_name']);
               
                    $data=[
                        // 'book_name' => '',
                        // 'ISBN_no' => '',
                        // 'author' => '',
                        // 'price' => '',
                        // 'category' => '',
                        // 'weight' => '',
                        // 'descript' => '',
                        // 'quantity' =>'',
                        'book_id'=>$book_id,
                        'book_name' => $books['book_name'],
                        'ISBN_no' => $books->ISBN_no,
                        'author' =>$books->author,
                        'price' => $books->price,
                        'category' => $books->category,
                        'weight' => $books->weight,
                        'descript' => $books->descript,
                        'quantity' =>$books->quantity,
                        'publisher_id' => $books->publisher_id,// Replace this with the actual publisher ID
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
                        // 'img1_err'=>'',
                        // 'img2_err'=>'',
                        
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