
<?php
class Charity extends Controller{
    public function  __construct(){
       

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

    public function addEvent(){
        if(!isLoggedInCharity()){
            redirect('charity/index');
        }
        $this->view('charity/addEvent');
    }
    
    public function donation(){
        if(!isLoggedInCharity()){
            redirect('charity/donation_request');
        }
        $this->view('charity/donation_request');
    }
    public function userrequest(){
        $this->view('charity/userRequest');
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
