<?php

class HIBP_Model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
// this gets all info of each row in the database for the user to see all of the previous Breached they have saved
    function previousBreached() {
        $query = $this->db->get('hibp_check');
        return $query;
        //select * from hibp_check;
        //
    }
// this is for adding the accounnt that the user wants to the database
    function AddBreached($data, $Email) {
        $this->db->select("Email");
        $this->db->where("Email", $Email);
        $query = $this->db->get('hibp_check');
        //select Email where Email = Email from hibp_check;
        // this would check id the account is already in the database if so the account wont be added again this stops have a 
        // crazy amount of the exact same rows
        if ($query->num_rows() > 0) {
            echo "This account has already been added";
        } else {
            // if the account hasnt been added to the database before it would now.
            $this->db->insert('hibp_check', $data);
            echo 'Breach has been added';
            //INSERT INTO table_name (Email, Name, BreachDate, PwnCount, Description, DataClasses, IsVerified, IsFabricated)
            //VALUES ($data);
        }
    }
// this will delete the row in the database of the account that the user wants to delete
    function deleteBreached($email) {
        $this->db->where('email', $email);
        $this->db->delete('hibp_check');
        //DELETE FROM hibp_check WHERE email=$email;
    }
}
