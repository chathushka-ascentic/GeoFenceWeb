<?php





class geomodel extends CI_Model {

    

	function __construct() {

           parent::__construct();

           $this->load->library('Bcrypt');

           $this->load->model('Ion_auth_model');

	}



    function getLatitudeLongitudeRadius(){

        $this->db->from('geofence');



		$query = $this->db->get()->result();



		return $query;

    }



    function insertLatitudeLongitudeRadius($longitude,$latitude,$radius){

         $data = array('geofence.longitude'=>$longitude,

        'geofence.latitude'=>$latitude,

        'geofence.radius'=>$radius

         );

        $this->db->truncate('geofence'); 

        if($this->db->insert('geofence', $data)){

            return true;

        }else{

            return false;

        }

        

    }



    function setUserCheck($username,$checktime,$status){

         $data = array('userfencing.username'=>$username,

        'userfencing.status'=>$status,

        'userfencing.checktime'=>$checktime

         );



        if($this->db->insert('userfencing', $data)){

            return true;

        }else{

            return false;

        }

    }



    function getUserFencing($username)

    {

        $this->db->from('userfencing');

		$data = array('userfencing.username'=>$username);

		$this->db->where($data);



		$query = $this->db->get()->result();



		return $query;

    }



    function authenticateUser($username,$password)

    {

        $this->db->from('users');

		$data = array('username'=>$username);

		$this->db->where($data);



		$query = $this->db->get()->result();

        $check = $this->bcrypt->verify($password,$query[0]->password);

        if($check)

        {

            return true;

        }else{

            return false;

        }

    }

}