
<?php
class Charity extends Controller
{
    private $charityModel;
    public function  __construct()
    {
        $this->charityModel = $this->model('CharityEvents');
    }
    public function index()
    {
        if (!isLoggedInCharity()) {
            redirect('charity/index');
        }
        $this->view('charity/index');
    }

    public function event()
    {
        if (!isLoggedInCharity()) {
            redirect('charity/index'); 
        }
        $results = $this->charityModel->getEvents();
        $this->view('charity/event-management', $data = ['allEvents' => $results]);
    }

    public function addEvent()
    {
        if (!isLoggedInCharity()) {
            redirect('charity/index');
        }
        $this->view('charity/addEvent');
    }

    public function donation()
    {
        if (!isLoggedInCharity()) {
            redirect('charity/donation_request');
        }
        $results = $this->charityModel->getCharityUsers();
        $this->view('charity/donation_request', $data = ['allUsers' => $results]);
    }
    public function userrequest()
    {
        $customerId = isset($_POST['customerId']) ? $_POST['customerId'] : null;
        $customerDetails = $this->charityModel->getCharityUsersById($customerId);
        $customerRequests = $this->charityModel->getCustomerRequests($customerId);
        $this->view('charity/userRequest', $data = ['allRequests' => $customerRequests, 'customerDetail' => $customerDetails]);
    }

    public function userrequestform()
    {
        $requestId = isset($_POST['donate_id']) ? $_POST['donate_id'] : null;
        $this->charityModel->markAsRead($requestId);
        $donation = $this->charityModel->getDonationById($requestId);
        $this->view('charity/user-req-form', $data= ['requestDetail' => $donation]);
    }

    public function confirmEvent()
    {
        // print_r($_POST);
        // die();
        $this->charityModel->acceptRequest($_POST['doantionId']);
        $this->view('charity/confirm-event');
    }

    public function customerSupport()
    {
        $this->view('charity/customerSupport');
    }

    // public function aboutUs()
    // {
    //     $this->view('charity/aboutus');
    // }

    public function editprofile()
    {
        $this->view('charity/edit-profile');
    }


    public function notification()
    {
        $results = $this->charityModel->allRequestNotifications();
        $this->view('charity/notification', $data = ['allNotifications' => $results]);
    }

    public function donationQuery()
    {
        $this->view('charity/donationQuery');
    }
    public function viewEvent()
    {
        $event = $this->charityModel->getEventById($_POST['eventId']);
        $this->view('charity/viewEvent', $data = ['event' => $event]);
    }


    public function createEvent()
    {
        $string = implode(", ", $_POST['bookCategory']);

        $event_name = $_POST['eventName'];
        $location = $_POST['eventLocation'];
        $start_date = $_POST['startDate'];
        $end_date = $_POST['endDate'];
        $start_time = $_POST['startTime'];
        $end_time = $_POST['endTime'];
        $deadline = $_POST['deadlineDate'];
        $book_category = $string;
        $poster = "test";
        $contact_no = $_POST['charityMemberPhone'];
        $description = $_POST['description'];

        if ($this->charityModel->addEvent($event_name, $location, $start_date, $end_date, $start_time, $end_time,$deadline, $book_category, $poster, $contact_no, $description)) {
            redirect('charity/event');
        } else {
            die('Something went wrong');
        }
    }

    public function updateEvent()
    {
        $event_name = $_POST['eventName'];
        $location = $_POST['eventLocation'];
        $start_date = $_POST['startDate'];
        $end_date = $_POST['endDate'];
        $start_time = $_POST['startTime'];
        $end_time = $_POST['endTime'];
        $deadline = $_POST['deadline'];
        $book_category = $_POST['bookCategory'];
        $poster = "test";
        $contact_no = $_POST['charityMemberPhone'];
        $description = $_POST['description'];

        if ($this->charityModel->updateEvent($_POST['eventId'], $event_name, $location, $start_date, $end_date, $start_time, $end_time, $deadline, $book_category, $poster, $contact_no, $description)) {
            redirect('charity/event');
        } else {
            die('Something went wrong');
        }
    }

    public function updateDeadline()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->charityModel->updateDeadline($_SESSION['eventId'], $_POST['deadline'])) {
                redirect('charity/event');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function deleteEvent(){
       
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            if($this->charityModel->deleteEvent($_POST['eventId'])){
                redirect('charity/event');
            }
            else{
                die('Something went wrong');
            }
        }
    }

    public function rejectEvent()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // print_r($_POST);
            // die();
            if($_POST['reason'] == "other")
            {
                $reason = $_POST['customReason'];
            } else {
                $reason = $_POST['reason'];
            }
            
            if ($this->charityModel->rejectEvent($_POST['doantionId'], $reason)) {
                redirect('charity/donation');
            } else {
                die('Something went wrong');
            }
        }
    }

    public function notificationMarkAsRead()
    {   
        $id = $_POST['donate_id'];
        $this->charityModel->markAsRead($id);
        redirect('charity/notification');
    }
    

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_pass']);
        session_destroy();
        redirect('landing/index');
    }

}

?>