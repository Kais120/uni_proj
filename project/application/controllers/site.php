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
	
	public function getMemberInfo(){		
		$this->load->model("model_member");		
		echo $this->model_member->dbPull();
	}
	
	public function getChildInfo(){
		$key = $this->input->post('key');
		$this->load->model("model_member");		
		echo $this->model_member->dbPullChildren($key);
	}
	
	public function getChildMedical(){
		$key = $this->input->post('key');
		$this->load->model("model_member");
		echo $this->model_member->dbPullChildrenMedical($key);
	}
	
	public function updateParentInfo(){
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
		$this->load->model("model_member");	
		echo $this->model_member->dbUpdateParent($key, $array);		
	}
	
	public function updateChildInfo(){
		$key = $this->input->post('key');
		$array = array(	
			'member_fname' => $this->input->post('childFirstName'),
			'member_mname' => $this->input->post('childMiddleName'),
			'member_lname' => $this->input->post('childLastName'),
			'member_dob' => $this->input->post('childDOB'),			
		);
		$medical = $this->input->post('medical');
		$this->load->model("model_member");	
		echo $this->model_member->dbUpdateChild($key, $array, $medical);		
	}
	
	public function addChild(){		
		$array = array(
			'registration_id' => $this->input->post('parentKey'),
			'member_fname' => $this->input->post('childFirstName'),
			'member_mname' => $this->input->post('childMiddleName'),
			'member_lname' => $this->input->post('childLastName'),
			'member_dob' => $this->input->post('childDOB'),	
		);
		$medical = $this->input->post('medical');
		$this->load->model("model_member");
		$this->model_member->dbAddChild($array, $medical);
	}
	
	public function addParent(){
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
		$this->load->model("model_member");
		$this->model_member->dbAddParent($array);
	}		
		
	public function terms(){				
		$this->load->view("site_header");
		$this->load->view("site_nav");
		$this->load->model("model_term");
		$data["year"]=$this->model_term->dbPull();		
		$this->load->view("content_terms",$data);
		$this->load->view("site_footer");
	}
	
	public function getTerms(){
		$year = $this->input->post('year');
		$this->load->model("model_term");
		echo $this->model_term->dbGetTermDetails($year);
	}
	
	public function addTerm(){
		$array = array(			
			'term_description' => $this->input->post('description'),
			'start_date' => $this->input->post('start_date'),
			'end_date' => $this->input->post('end_date')			
		);
		$this->load->model("model_term");
		$this->model_term->dbAddTerm($array);
	}
	
	public function updateTerm(){
		$key = $this->input->post('key');
		$array = array(			
			'term_description' => $this->input->post('description'),
			'start_date' => $this->input->post('start_date'),
			'end_date' => $this->input->post('end_date')			
		);
		$this->load->model("model_term");
		$this->model_term->dbUpdateTerm($array,$key);
	}
	
	public function payments(){
		$this->load->view("site_header");
		$this->load->view("site_nav");	
		$this->load->model("model_term");
		$data["year"]=$this->model_term->dbPull();		
		$this->load->view("content_payments",$data);
		$this->load->view("site_footer");
	}
	
	public function getPayments(){
		$year = $this->input->post('year');
		$term = $this->input->post('term');
		$this->load->model("model_payment");
		echo $this->model_payment->dbGetPayments($term, $year);		
	}
	
	public function getPaymentDetails(){
		$transactionId = $this->input->post('transaction_id');		
		$this->load->model("model_payment");
		echo $this->model_payment->dbGetPaymentDetails($transactionId);		
	}	
	
	public function savePayment(){
		$transactionId = $this->input->post('transaction_id');
		$array = array(		
			'payment_date' => $this->input->post('paid_date'),
			'amount_paid' => $this->input->post('amount'),
			'payment_type' => $this->input->post('type')			
		);		
		$this->load->model("model_payment");
		echo $this->model_payment->dbUpdatePayment($transactionId, $array);		
	}
	
	public function sports(){				
		$this->load->view("site_header");
		$this->load->view("site_nav");		
		$this->load->view("content_sports");
		$this->load->view("site_footer");
	}
	
	public function getSkills(){
		$key =  $this->input->post('key');
		$this->load->model("model_sport");
		echo $this->model_sport->dbPullData($key);	
	}
	
	public function getTasks(){
		$key = $this->input->post('key');
		$this->load->model("model_sport");
		echo $this->model_sport->dbGetTasks($key);	
	}
	
	public function updateSkill(){
		$key = $this->input->post('key');
		$array = array(		
			'skill_band' => $this->input->post('skill_band'),
			'skill_band_description' => $this->input->post('skill_description')
		);
		$this->load->model("model_sport");
		echo $this->model_sport->dbUpdateSkill($key, $array);
	}
	
	public function updateTask(){
		$key = $this->input->post('key');
		$array = array(		
			'task' => $this->input->post('task_name'),
			'task_description' => $this->input->post('task_description')
		);
		$this->load->model("model_sport");
		echo $this->model_sport->dbUpdateTask($key, $array);
	}
	
	public function addSkill(){
		$array = array(	
			'sport_id' => $this->input->post('sport'), 
			'skill_band' => $this->input->post('skill_band'),
			'skill_band_description' => $this->input->post('skill_description')
		);
		$this->load->model("model_sport");
		$this->model_sport->dbAddSkill($array);
	}
	
	public function addTask(){
		$array = array(		
			'skill_id' => $this->input->post('skill_id'), 
			'task' => $this->input->post('task'),
			'task_description' => $this->input->post('task_description')
		);
		$this->load->model("model_sport");
		$this->model_sport->dbAddTask($array);
	}
	
	public function staff(){				
		$this->load->view("site_header");
		$this->load->view("site_nav");
		$this->load->model("model_staff");
		$data['staff'] = $this->model_staff->dbPullData();
		$this->load->view("content_staff", $data);
		$this->load->view("site_footer");
	}
	
	public function getStaffDetails(){
		$staffId = $this->input->post('key');
		$this->load->model("model_staff");
		echo $this->model_staff->dbPullDetails($staffId);
	}
	
	public function saveStaff(){
		$active='0';
		if ($this->input->post('active')!=null)
			$active=$this->input->post('active');
			
		$staffId = $this->input->post('staff_id');
		$staff = array(			
			'staff_fname' => $this->input->post('fname'),
			'staff_mname' => $this->input->post('mname'),
			'staff_lname' => $this->input->post('lname'),
			'home_number' => $this->input->post('hnumber'),
			'mobile_number' => $this->input->post('mnumber'),
			'emg_contact_name' => $this->input->post('emgname'),
			'emg_contact_number' => $this->input->post('emgnumber'),
			'staff_email' => $this->input->post('email'),
			'active' => $active,			
		);		
		$this->load->library('encrypt');
		if ($this->input->post('password')!='')
			$password = $this->encrypt->encode($this->input->post('password'));
		else 
			$password = 'null';		
		$type = $this->input->post('type');		
		$this->load->model("model_staff");
		$this->model_staff->dbUpdateStaff($staffId, $staff, $password, $type);
		header( 'Location: '.base_url().'site/staff');
	}
	
	public function addStaff(){	
		$active='0';
		if ($this->input->post('active')!=null)
			$active=$this->input->post('active');	
			
		$staff = array(			
			'staff_fname' => $this->input->post('fname'),
			'staff_mname' => $this->input->post('mname'),
			'staff_lname' => $this->input->post('lname'),
			'home_number' => $this->input->post('hnumber'),
			'mobile_number' => $this->input->post('mnumber'),
			'emg_contact_name' => $this->input->post('emgname'),
			'emg_contact_number' => $this->input->post('emgnumber'),
			'staff_email' => $this->input->post('email'),
			'active' => $active,	
		);		
		
		$this->load->library('encrypt');
		$user = array(
			'staff_id'=>'',
			'username' => $this->input->post('username'),
			'type' => $this->input->post('type'),
			'password' => $this->encrypt->encode($this->input->post('password'))			
		);						
		$this->load->model("model_staff");
		$this->model_staff->dbAddStaff($staff, $user);
		header( 'Location: '.base_url().'site/staff') ;		
	}
	
	public function checkUsername(){
		$username = $this->input->post('username');
		$this->load->model("model_staff");
		echo $this->model_staff->dbCheckUsername($username);		
	}
			
}
