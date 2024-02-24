
<?php
class Charity extends Controller{
    public function  __construct(){
        parent::__construct();

        // Check login status
        if(!isLoggedInCharity()){
            redirect('charity/index');
        }
    }
    public function index(){
        // if(!isLoggedInCharity()){
        //     redirect('landing/login');
        // }
        
        $this->view('charity/index');
    }
    public function event(){
        $this->view('charity/event-management');
    }
    

}
