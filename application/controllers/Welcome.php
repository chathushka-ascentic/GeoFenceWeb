<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('Ion_auth');
	}

	public function index()
	{

		if (!$this->ion_auth->logged_in())
		{
			redirect('auth/login');
		}else{
			redirect('manager/index');
		}
	}
}
