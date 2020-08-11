<?php

error_reporting(0);
class mainController extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
//Will bring to the index page
    public function index() {
        // URL http://localhost:80/CI-HIBPErinA/index.php/mainController/index
        $this->load->view('index');
    }
// This function will check if the account that the user have put in is breached or not.
    public function check() {
        // URL http://localhost:80/CI-HIBPErinA/index.php/mainController/check
        // this will the input value of user 
        $Email = $this->input->post('Email');
        $this->load->helper('file');
//hibp kwy
        $hibp_api_key = "cd4628204fbe429aab051338ca74ab";
        //$requestHeaders = new Headers(request.headers);
        //header('Hibp-Api-Key', $hibp_api_key);
        //this was trying to put the hibp key in for auth
        $header = array('http' => array('hibp_api_key' => $hibp_api_key));
        $baglam = stream_context_create($header);
        
// JSON URL
        $url = 'https://haveibeenpwned.com/api/v3/breach/' . $Email;
// Put the contents of the url into a variable
        $url2 = header($url . "hibp-api-key: cd4628204fbe429aab051338ca74ab");
//$filepath = drupal_realpath($url2['path']);

        $json = file_get_contents($url, false, $baglam);
        $options = array(
            CURLOPT_RETURNTRANSFER => true, // return web page
            CURLOPT_HEADER => false, // don't return headers
            CURLOPT_FOLLOWLOCATION => true, // follow redirects
            CURLOPT_ENCODING => "", // handle all encodings
            CURLOPT_USERAGENT => "", // who am i
            CURLOPT_AUTOREFERER => true, // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120, // timeout on connect
            CURLOPT_TIMEOUT => 120, // timeout on response
            CURLOPT_MAXREDIRS => 10, // stop after 10 redirects
            CURLOPT_SSL_VERIFYPEER => false, // Disabled SSL Cert checks
        );
        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $json = curl_exec($ch);

        if ($json == NULL) {
            //Message to the user if the account wasnt found 
            echo 'Account not found';
            $this->load->view('index');
        } else {
            //Decode the JSON feed
            $object = json_decode($json);
            // get the info from the json
            $data = array(
                'Email' => $object->Title,
                'Name' => $object->Name,
                'Domain' => $object->Domain,
                'BreachDate' => $object->BreachDate,
                'PwnCount' => $object->PwnCount,
                'Description' => $object->Description,
                'DataClasses' => implode(" ",$object->DataClasses),
                'IsVerified' => $object->IsVerified,
                'IsFabricated' => $object->IsFabricated
            );
            // goes to the check page with the info from the json
            $this->load->view('check', $data);
        }
    }
// this function gets the account that have ben shaved by then users
    public function previousEmail() {
        //http://localhost:80/CI-HIBPErinA/index.php/mainController/previousEmail
        //$this->load->model('HIBP_Model');
        $data = array(
            'query' => $this->HIBP_Model->previousBreached()
        );
        $this->load->view('previousEmail', $data);
    }
//this lets the user add all of the details of the breach account that came back from the check 
//funcation and will bring the user back to the index page
    public function AddBreached($Email) {
        //http://localhost:80/CI-HIBPErinA/index.php/mainController/AddBreached
        $url = 'https://haveibeenpwned.com/api/v3/breach/' . $Email;
        $options = array(
            CURLOPT_RETURNTRANSFER => true, // return web page
            CURLOPT_HEADER => false, // don't return headers
            CURLOPT_FOLLOWLOCATION => true, // follow redirects
            CURLOPT_ENCODING => "", // handle all encodings
            CURLOPT_USERAGENT => "", // who am i
            CURLOPT_AUTOREFERER => true, // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120, // timeout on connect
            CURLOPT_TIMEOUT => 120, // timeout on response
            CURLOPT_MAXREDIRS => 10, // stop after 10 redirects
            CURLOPT_SSL_VERIFYPEER => false, // Disabled SSL Cert checks
        );
        $ch = curl_init($url);
        curl_setopt_array($ch, $options);
        $json = curl_exec($ch);
        if ($json == NULL) {
            echo 'Account not found';
        } else {
            $object = json_decode($json);
            $data = array(
                'Email' => $object->Title,
                'Name' => $object->Name,
                'Domain' => $object->Domain,
                'BreachDate' => $object->BreachDate,
                'PwnCount' => $object->PwnCount,
                'Description' => $object->Description,
                'DataClasses' => implode(" ",$object->DataClasses),
                'IsVerified' => $object->IsVerified,
                'IsFabricated' => $object->IsFabricated
            );
           
    $this->HIBP_Model->AddBreached($data, $Email);
        $this->load->view('index');
        }
    }
    // this function lets the user delete accounts that have been saved in the database
    public function deleteBreach($email) {
        //http://localhost:80/CI-HIBPErinA/index.php/mainController/deleteBreach
    $this->HIBP_Model->deleteBreached($email);
    $this->previousEmail();
           
    }


}
