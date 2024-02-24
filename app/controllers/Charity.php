
<?php
class Charity extends Controller{
    public function  __construct(){
        parent::__construct();

        // Check login status
        // if(!isLoggedInCharity()){
        //     redirect('charity/index');
        // }
    }
    public function index(){
        if(!isLoggedInCharity()){
            redirect('charity/index');
        }
        
        $this->view('charity/index');
    }
    public function event(){
        if(!isLoggedInCharity()){
            redirect('charity/index');
        }
        $this->view('charity/event-management');
    }
    

}
