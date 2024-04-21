
<?php
class Charity extends Controller
{
    public function  __construct()
    {
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
        $this->view('charity/event-management');
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
        $this->view('charity/donation_request');
    }
    public function userrequest()
    {
        $this->view('charity/userRequest');
    }

    public function userrequestform()
    {
        $this->view('charity/user-req-form');
    }

    public function customerSupport()
    {
        $this->view('charity/customerSupport');
    }

    public function aboutUs()
    {
        $this->view('charity/aboutus');
    }

    public function donationQuery()
    {
        $this->view('charity/donationQuery');
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to_email = "recipient@example.com"; // Change this to your email address
    $subject = "Rejection Reason";
    $reason = $_POST['reason'];
    $customReason = $_POST['customReason'];

    $message = "Reason: $reason\n";
    if ($reason == "other") {
        $message .= "Custom Reason: $customReason\n";
    }

    // Send email
    if (mail($to_email, $subject, $message)) {
        echo "Email sent successfully!";
    } else {
        echo "Email sending failed!";
    }
}
?>