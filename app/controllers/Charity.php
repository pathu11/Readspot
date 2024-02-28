
<?php
class Charity extends Controller{
    public function  __construct(){
       
    }
    public function index(){
        
        $this->view('charity/index');
    }
    public function event(){
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