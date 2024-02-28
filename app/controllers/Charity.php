
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
    

    public function customerSupport(){
        $this->view('charity/customerSupport');
    }

    public function aboutUs(){
        $this->view('charity/aboutus');
    }

    public function donationQuery(){
        $this->view('charity/donationQuery');
    }
}
