<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site extends CI_Controller {
	public function index(){
		
		$this->home();
	
	}
	
	public function home(){	
		$this->load->view("site_header");
		$this->load->view("site_nav");		
		$this->load->view("content_login");
		$this->load->view("site_footer");	
	}
	
	public function members(){			
		$this->load->view("site_header");
		$this->load->view("site_nav");		
		$this->load->view("content_members");
		$this->load->view("site_footer");	
	}
	
	public function get_member_info(){
		//header("Content-Type: application/json");
		$this->load->model("model_get_member_details");		
		echo $this->model_get_member_details->db_pull();
	}
	
	public function get_child_info(){
		$key = $this->input->post('key');
		$this->load->model("model_get_member_details");		
		echo $this->model_get_member_details->db_pull_children($key);
	}
		
		
	public function terms(){				
		$this->load->view("site_header");
		$this->load->view("site_nav");		
		$this->load->view("content_terms");
		$this->load->view("site_footer");
	}
}
