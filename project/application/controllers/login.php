<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {
	public function index(){	
		if ($this->session->userdata('logged_in'))
			redirect('site', 'refresh');
		$this->load->helper(array('form'));
		$this->load->view("site_header");
		$this->load->view("site_nav_login");		
		$this->load->view("content_login");
		$this->load->view("site_footer");	

	}
}