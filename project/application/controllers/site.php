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
		$this->load->model("model_get_member_details");		
		echo $this->model_get_member_details->db_pull();
	}
	
	public function get_child_info(){
		$key = $this->input->post('key');
		$this->load->model("model_get_member_details");		
		echo $this->model_get_member_details->db_pull_children($key);
	}
	
	public function update_parent_info(){
		$key = $this->input->post('key');
		$array = array(	
			"parent_fname" => $this->input->post('firstName'),
			"parent_mname" => $this->input->post('middleName'),
			"parent_lname" => $this->input->post('lastName'),
			"address1" => $this->input->post('addrLine1'),
			"address2" => $this->input->post('addrLine2'),
			"suburb" => $this->input->post('suburb'),
			"post_code" => $this->input->post('postcode'),
			"email" => $this->input->post('email'),
			"home_number" => $this->input->post('homeNumber'),
			"mobile_number" => $this->input->post('mobileNumber'),
			"office_number" => $this->input->post('officeNumber'),			
		);
		$this->load->model("model_get_member_details");	
		echo $this->model_get_member_details->db_update_parent($key, $array);		
	}
	
	public function update_child_info(){
		$key = $this->input->post('key');
		$array = array(	
			'member_fname' => $this->input->post('childFirstName'),
			'member_mname' => $this->input->post('childMiddleName'),
			'member_lname' => $this->input->post('childLastName'),
			'member_dob' => $this->input->post('childDOB'),			
		);
		$this->load->model("model_get_member_details");	
		echo $this->model_get_member_details->db_update_child($key, $array);		
	}
	
	public function add_parent(){
		$array = array(	
			"parent_fname" => $this->input->post('firstName'),
			"parent_mname" => $this->input->post('middleName'),
			"parent_lname" => $this->input->post('lastName'),
			"address1" => $this->input->post('addrLine1'),
			"address2" => $this->input->post('addrLine2'),
			"suburb" => $this->input->post('suburb'),
			"post_code" => $this->input->post('postcode'),
			"email" => $this->input->post('email'),
			"home_number" => $this->input->post('homeNumber'),
			"mobile_number" => $this->input->post('mobileNumber'),
			"office_number" => $this->input->post('officeNumber'),			
		);
		$this->load->model("model_get_member_details");
		$this->model_get_member_details->db_add_parent($array);
	}
		
		
	public function terms(){				
		$this->load->view("site_header");
		$this->load->view("site_nav");		
		$this->load->view("content_terms");
		$this->load->view("site_footer");
	}
}
