<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manager extends CI_Controller {

	function __construct()
	{
		parent::__construct();
        $this->load->database();
		$this->load->helper('url');
		$this->load->library('Ion_auth');
        $this->load->library('form_validation');
        $this->load->model('geomodel');
        $this->load->library('grocery_CRUD');
	}

	public function index()
	{
       // echo "asdasd";
        if (!$this->ion_auth->logged_in())
		{
            redirect('auth/login', 'refresh');
			$dataMenu['logged'] = false;
		}else{
			$dataMenu['logged'] = true;
		}
        
		$dataMenu['page_title'] = 'Select an option';
        
        $this->load->view('header');
        $this->load->view('menu', $dataMenu);
        $this->load->view('content');
        $this->load->view('footer');
	}

    public function setFencer(){
        if (!$this->ion_auth->logged_in())
		{
            redirect('auth/login', 'refresh');
			$dataMenu['logged'] = false;
		}else{
			$dataMenu['logged'] = true;
		}

        $dataMenu['page_title'] = 'Fence a location';
        $data['submitted'] = '';
        $geodetails= $this->geomodel->getLatitudeLongitudeRadius();	

        $data['v_longitude'] = $geodetails[0]->longitude;
        $data['v_latitude'] = $geodetails[0]->latitude;
        $data['v_radius'] = $geodetails[0]->radius;
        
        $this->form_validation->set_rules('longitude', 'Longitude', 'trim|required|greater_than[0]');
		$this->form_validation->set_rules('latitude', 'Latitude', 'trim|required|greater_than[0]');
        $this->form_validation->set_rules('radius', 'Radius', 'trim|required|greater_than[0]');

        if($this->form_validation->run()==true){
            $longitude = $this->input->post('longitude');
			$latitude = $this->input->post('latitude');
			$radius = $this->input->post('radius');

            $data['v_radius'] = $radius;
            $data['v_longitude'] = $longitude;
            $data['v_latitude'] = $latitude;

            $inserted = $this->geomodel->insertLatitudeLongitudeRadius($longitude,$latitude,$radius);
            if($inserted){
                $data['submitted'] = 'Coordinates saved!';
            }else{
                $data['submitted'] = 'Error saving data';
            }

            
        }

        $this->load->view('header');
                $this->load->view('menu', $dataMenu);
                $this->load->view('setfencelocation',$data);
                $this->load->view('footer');
    }

    public function browsechecksbyuser(){
        
		if (!$this->ion_auth->logged_in())
		{
            redirect('auth/login', 'refresh');
			$dataMenu['logged'] = false;
		}else{
			$dataMenu['logged'] = true;
		}
		

        $dataMenu['page_title'] = 'Browse Check IN/OUT by User';
        $users = $this->ion_auth->users()->result();
        $data['users'] = $users;

        $this->form_validation->set_rules('usernamefield', 'Username', 'trim|required');
        $this->form_validation->set_rules('datetimefield', 'Date', 'trim|required');

        if($this->form_validation->run()==true){
            $username = $this->input->post('usernamefield');
			$checkdate = $this->input->post('datetimefield');

            $orderdate = explode('/', $checkdate);
            $month = $orderdate[0];
            $date = $orderdate[1];
            $year = $orderdate[2];

            $time = strtotime($month.'/'.$date.'/'.$year);
            $checkdate = date('Y-m-d H:i:s',$time);
            $checkDateBefore = date('Y-m-d H:i:s',strtotime('-1 day',$time));
            $checkDateAfter = date('Y-m-d H:i:s',strtotime('+1 day',$time));
        
            $crud = new grocery_CRUD();
            $crud->set_table('userfencing');
            $crud->where("username ='" .$username."' AND checktime > '".$checkDateBefore."' AND checktime < '".$checkDateAfter."'");
            $output = $crud->render();
            $this->_grid_output($output); 
        }else{
            $this->load->view('header');
            $this->load->view('menu', $dataMenu);
            $this->load->view('browsechecksbyuser',$data);
            $this->load->view('footer');
        }

    }


    public function alluserfencechecks(){
        if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login', 'refresh');
		}

        $crud = new grocery_CRUD();
        $crud->set_table('userfencing');
        $output = $crud->render();
        $this->_grid_output($output);        
    }
    
    function _grid_output($output = null)
    {
        if (!$this->ion_auth->logged_in())
		{
            redirect('auth/login', 'refresh');
			$dataMenu['logged'] = false;
		}else{
			$dataMenu['logged'] = true;
		}
	$dataMenu['page_title'] = 'User Check Details';
        $this->load->view('header');
        $this->load->view('menu', $dataMenu);
        $this->load->view('alluserfences',$output);    
        $this->load->view('footer');
       
    }
    
    
}
