<?php

require(APPPATH.'/libraries/REST_Controller.php');

 

class geofencesrest extends REST_Controller {

    public function __construct() {

               parent::__construct();

               $this->load->database();

               $this->load->model('geomodel');

              

    } 



    public function index_get()

    {

        $this->response($this->geomodel->getLatitudeLongitudeRadius());

    }



    public function usercheck_post()

    {

       

        $username = $this->post('username');

        $status =  $this->post('status');

        $checkdate =  $this->post('checkdate');



        $inserted = $this->geomodel->setUserCheck($username,$checkdate,$status);



        if($inserted){

            $this->response(true);

        }else{

            $this->response(false);

        }

        

    }



    public function authenticateuser_post(){

        $username = $this->post('username');

        $password =  $this->post('password');



        $check = $this->geomodel->authenticateUser($username,$password);

        if($check==true)

        {

            $this->response($check);

        }else{

            $this->response(false);

        }



    }





}