<?php

class verify_login extends CI_Controller {
 
	function __construct(){
		parent::__construct();
		$this->load->model('model_user','',TRUE);
	}
 
	function index(){
	   //This method will have the credentials validation
	   $this->load->library('form_validation');
	 
	   $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
	   $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|callback_check_database');
	 
	   if($this->form_validation->run() == FALSE)
	   {
		 //Field validation failed.  User redirected to login page
			$data['title'] = 'Sign in';
			$this->load->view("site_header",$data);
			$this->load->view("site_nav_login");		
			$this->load->view("content_login");
			$this->load->view("site_footer");	
	   }
	   else
	   {
		 //Go to private area
			if($this->get_account_type()=='administrator')			
				redirect('site', 'refresh');
			else
				redirect('site_staff', 'refresh');
	   }
	}
 
	function check_database($password){
	   //Field validation succeeded.  Validate against database
		$username = $this->input->post('username');		
	   //query the database
		$result = $this->model_user->login($username, $password);
	 
		if($result)
		{
			$sess_array = array();
			foreach($result as $row)
			{
				$sess_array = array(
					'id' => $row->staff_id,
					'username' => $row->username
				);
				$this->session->set_userdata('logged_in', $sess_array);
			}
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_database', '<p style="color:red">Invalid username or password/Locked account</p>');
			return false;
		}
	}
	
	private function get_account_type(){
		return $this->model_user->db_get_account_type($this->session->userdata('logged_in')['id']);
	}
}
?>