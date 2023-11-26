<?php 
class Customer extends Controller {
    private $customerModel;
  
    private $userModel;
  
    private $db;
    public function __construct(){
        $this->customerModel=$this->model('Customers');
        $this->userModel=$this->model('User');
       
       
        $this->db = new Database();
  
    }

    public function AboutUs(){

        $this->view('customer/AboutUs');
    } 
    
    public function AddCont(){
        
        $this->view('customer/AddCont');
    } 
    
    public function Addevnt(){
        
        $this->view('customer/Addevnt');
    } 

    public function AddExchangeBook(){
        
        $this->view('customer/AddExchangeBook');
    } 
    
    public function AddUsedBook(){
        
        $this->view('customer/AddUsedBook');
    } 
    
    public function BookContents(){
        
        $this->view('customer/BookContents');
    } 
    
    public function BookDetails(){
        
        $this->view('customer/BookDetails');
    } 
    
    public function BookEvents(){
        
        $this->view('customer/BookEvents');
    } 
    
    public function Bookshelf(){
        
        $this->view('customer/Bookshelf');
    } 
    
    public function BuyNewBooks(){
        
        $this->view('customer/BuyNewBooks');
    } 
    
    public function BuyUsedBooks(){
        
        $this->view('customer/BuyUsedBooks');
    } 
    
    public function Cart(){
        
        $this->view('customer/Cart');
    } 
    
    public function ContactUs(){
        
        $this->view('customer/ContactUs');
    } 
    
    public function Content(){
        
        $this->view('customer/Content');
    } 
    
    public function Dashboard(){
        
        $this->view('customer/Dashboard');
    } 
    
    public function DonateBooks(){
        
        $this->view('customer/DonateBooks');
    } 

    public function Donatedetails(){
        
        $this->view('customer/Donatedetails');
    } 

    public function Event(){
        
        $this->view('customer/Event');
    } 

    public function ExchangeBook(){
        
        $this->view('customer/ExchangeBook');
    } 

    public function ExchangeBookDetails(){
        
        $this->view('customer/ExchangeBookDetails');
    } 

    public function ExchangeBooks(){
        
        $this->view('customer/ExchangeBooks');
    } 

    public function Home(){
        
        $this->view('customer/Home');
    } 

    public function Notification(){
        
        $this->view('customer/Notification');
    } 

    public function Profile(){
        
        $this->view('customer/Profile');
    } 

    public function Services(){
        
        $this->view('customer/Services');
    } 

    public function updateusedbook(){
        
        $this->view('customer/updateusedbook');
    } 

    public function UsedBooks(){
        
        $this->view('customer/UsedBooks');
    } 

    public function ViewBook(){
        
        $this->view('customer/ViewBook');
    } 

    public function viewcontent(){
        
        $this->view('customer/viewcontent');
    } 

    public function viewevents(){
        
        $this->view('customer/viewevents');
    } 
}