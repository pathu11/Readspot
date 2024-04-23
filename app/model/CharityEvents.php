<?php
    class CharityEvents{
        private $db;
        
        public function __construct(){
            $this->db = new Database;
        }

        public function addEvent($event_name, $location, $start_date, $end_date, $start_time, $end_time, $book_category, $poster, $contact_no, $description) {
            try {
                $this->db->query('INSERT INTO charity_event (event_name, location, start_date, end_date, start_time, end_time, book_category, poster, contact_no,description) 
                                    VALUES (:event_name, :location, :start_date, :end_date, :start_time, :end_time, :book_category, :poster, :contact_no, :description)');
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
        
                return $this->db->execute();
            } catch (\Exception $e) {
                // Handle the exception (e.g., log it, display an error message)
                echo 'Error: ' . $e->getMessage();
                return false;
            }
        }

        public function getEvents(){
            $this->db->query('SELECT * FROM charity_event');
            $results = $this->db->resultSet();
            return $results;
        }

        


    }