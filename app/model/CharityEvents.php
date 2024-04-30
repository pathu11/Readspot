<?php
class CharityEvents
{
    private $db; 

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addEvent($event_name, $location, $start_date, $end_date, $start_time, $end_time, $deadline, $book_category, $poster, $contact_no, $description)
    {
        try {
            $this->db->query('INSERT INTO charity_event (event_name, location, start_date, end_date, start_time, end_time, book_category, poster, contact_no,description, Deadline_date) 
                                    VALUES (:event_name, :location, :start_date, :end_date, :start_time, :end_time, :book_category, :poster, :contact_no, :description, :deadline)');
            $this->db->bind(':event_name', $event_name);
            $this->db->bind(':location', $location);
            $this->db->bind(':start_date', $start_date);
            $this->db->bind(':end_date', $end_date);
            $this->db->bind(':start_time', $start_time);
            $this->db->bind(':end_time', $end_time);
            $this->db->bind(':book_category', $book_category);
            $this->db->bind(':poster', $poster);
            $this->db->bind(':contact_no', $contact_no);
            $this->db->bind(':description', $description);
            $this->db->bind(':deadline', $deadline);

            return $this->db->execute();
        } catch (\Exception $e) {
            // Handle the exception (e.g., log it, display an error message)
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function getEvents()
    {
        $this->db->query('SELECT * FROM charity_event');
        $results = $this->db->resultSet();
        return $results;
    }

    public function deleteEvent($charity_event_id)
    {
        $this->db->query('UPDATE charity_event SET status = 3 WHERE charity_event_id = :charity_event_id');
        $this->db->bind(':charity_event_id', $charity_event_id);
        return $this->db->execute();
    }



    public function getEventById($id)
    {
        $this->db->query('SELECT * FROM charity_event WHERE charity_event_id = :id');
        $this->db->bind(':id', $id);
        $result = $this->db->single();
        return $result;
    }

    public function updateEvent($id, $event_name, $location, $start_date, $end_date, $start_time, $end_time, $deadline, $book_category, $poster, $contact_no, $description)
    {
        try {
            $this->db->query('UPDATE charity_event SET event_name = :event_name, location = :location, start_date = :start_date, end_date = :end_date, start_time = :start_time, end_time = :end_time, book_category = :book_category, poster = :poster, contact_no = :contact_no, description = :description, Deadline_date = :deadline WHERE charity_event_id = :id');
            $this->db->bind(':id', $id);
            $this->db->bind(':event_name', $event_name);
            $this->db->bind(':location', $location);
            $this->db->bind(':start_date', $start_date);
            $this->db->bind(':end_date', $end_date);
            $this->db->bind(':start_time', $start_time);
            $this->db->bind(':end_time', $end_time);
            $this->db->bind(':book_category', $book_category);
            $this->db->bind(':poster', $poster);
            $this->db->bind(':contact_no', $contact_no);
            $this->db->bind(':description', $description);
            $this->db->bind(':deadline', $deadline);

            return $this->db->execute();
        } catch (\Exception $e) {
            echo 'Error: ' . $e->getMessage();
            return false;
        }
    }

    public function updateDeadline($id, $deadline)
    {
        $this->db->query('UPDATE charity_event SET donation_deadline = :deadline WHERE charity_event_id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':deadline', $deadline);
        return $this->db->execute();
    }

    public function getCharityUsers()
    {
        $this->db->query('SELECT * FROM users u INNER JOIN customers c ON u.email = c.email WHERE user_role = "customer" AND u.status ="approval"');
        $results = $this->db->resultSet();
        // print_r($results);
        // die();
        return $results;
    }

    public function getCharityUsersById($id)
    {
        $this->db->query('SELECT * FROM users u INNER JOIN customers c ON u.email = c.email WHERE c.customer_Id =:id AND u.status ="approval"');
        $this->db->bind(':id', $id);
        $results = $this->db->single();
        return $results;
    }


    public function getCustomerRequests($id)
    {
        $this->db->query('SELECT * FROM donate_books d WHERE d.customer_id = :id');
        $this->db->bind(':id', $id);
        $result = $this->db->resultSet();
        return $result;
    }

    public function getDonationById($id)
    {
        $this->db->query('SELECT * FROM donate_books WHERE donate_id = :id');
        $this->db->bind(':id', $id);
        $result = $this->db->single();
        return $result;
    }

    public function requestCount($id)
    {
        $this->db->query('SELECT COUNT(*) AS count FROM donate_books WHERE customer_id = :id AND mark_as_read = 0');
        $this->db->bind(':id', $id);
        $result = $this->db->single();

        if ($result->count > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function markAsRead($id)
    {
        $this->db->query('UPDATE donate_books SET mark_as_read = 1 WHERE donate_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function acceptRequest($id)
    {
        $this->db->query('UPDATE donate_books SET status = "Accepted" WHERE donate_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }

    public function rejectEvent($id, $message)
    {
        $this->db->query('UPDATE donate_books SET status = "Rejected", reject_reason = :rejectMessage WHERE donate_id = :id');
        $this->db->bind(':id', $id);
        $this->db->bind(':rejectMessage', $message);
        return $this->db->execute();
    }

    public function allRequestNotifications()
    {
        $this->db->query('SELECT * FROM donate_books WHERE mark_as_read = 0');
        $results = $this->db->resultSet();
        return $results;
    }
}
