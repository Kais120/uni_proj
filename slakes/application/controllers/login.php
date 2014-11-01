<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class login extends CI_Controller {
	
	public function index(){	
		if ($this->session->userdata('logged_in'))
			redirect('site', 'refresh');
		$this->load->helper(array('form'));
		$data['title'] = 'Sign in';
		$this->load->view("site_header",$data);
		$this->load->view("site_nav_login");		
		$this->load->view("content_login");
		$this->load->view("site_footer");	
	}
	
	public function retrieve_password(){
		$data['title'] = 'Retrieve password';
		$this->load->view("site_header",$data);
		$this->load->view("site_nav_login");		
		$this->load->view("content_retrieve_pass");
		$this->load->view("site_footer");	
	}
	
	public function find_username(){
		$this->load->model("model_user");
		$this->session->set_userdata('username',$this->input->post('username'));
		$question = $this->model_user->db_find_question($this->session->userdata('username'));
		if ($question=="none"){
			$data["message"]="Username not found";
			$data['title'] = 'Retrieve password';
			$this->load->view("site_header",$data);
			$this->load->view("site_nav_login");		
			$this->load->view("content_retrieve_pass", $data);
			$this->load->view("site_footer");
		}else if($question=="" || $question==null){
			$data["message"]="No secret question is found, please report an administrator";
			$data['title'] = 'Retrieve password';
			$this->load->view("site_header",$data);
			$this->load->view("site_nav_login");		
			$this->load->view("content_retrieve_pass", $data);
			$this->load->view("site_footer");
		}else{
			$data["question"] = $question;
			$data['title'] = 'Retrieve password';
			$this->load->view("site_header",$data);
			$this->load->view("site_nav_login");		
			$this->load->view("content_question",$data);
			$this->load->view("site_footer");
		}
	}
	
	public function get_result(){
		$this->load->model("model_user");
		$result = $this->model_user->db_get_result($this->session->userdata('username'), $this->input->post('answer'));
		if (!$result){
			$data["message"]="Incorrect answer <br/>";
			$data['title'] = 'Retrieve password';
			$this->load->view("site_header",$data);
			$this->load->view("site_nav_login");		
			$this->load->view("content_result",$data);
			$this->load->view("site_footer");
		}else{
			$data["message"]="Your password is ".$result."<br/>";
			$data['title'] = 'Retrieve password';
			$this->load->view("site_header",$data);
			$this->load->view("site_nav_login");		
			$this->load->view("content_result",$data);
			$this->load->view("site_footer");
		}
	}
	
}