<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Site_staff extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_user','',TRUE);
		if(!$this->session->userdata('logged_in'))
			redirect('login', 'refresh');
		if($this->get_account_type()=='administrator')
			redirect('site', 'refresh');
	}

	public function index(){			
		$this->schedule();	
	}
	
	public function members(){			
		$this->load->view("site_header");
		$this->load->view("site_nav_staff");				
		$this->load->view("content_members_staff");
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
			'medical_notes' => $this->input->post('notes')
		);
		$medical = $this->input->post('medical');
		$skill =  array(
			'1' => array('member_id' => $key, 'skill_id' =>  $this->input->post('tennis_skill'), 'number_lessons'=>$this->input->post('tennis_number')),
			'2' => array('member_id' => $key, 'skill_id' =>  $this->input->post('swimming_skill'), 'number_lessons'=>$this->input->post('swimming_number'))
		);
		$this->load->model("model_member");	
		echo $this->model_member->dbUpdateChild($key, $array, $medical, $skill);		
	}
	
	public function addChild(){		
		$array = array(
			'registration_id' => $this->input->post('parentKey'),
			'member_fname' => $this->input->post('childFirstName'),
			'member_mname' => $this->input->post('childMiddleName'),
			'member_lname' => $this->input->post('childLastName'),
			'member_dob' => $this->input->post('childDOB'),
			'medical_notes' => $this->input->post('notes')
		);
		$skill =  array(
			1 => array('member_id' => 0, 'skill_id' =>  $this->input->post('tennis_skill'), 'number_lessons'=>$this->input->post('tennis_number')),
			2 => array('member_id' => 0, 'skill_id' =>  $this->input->post('swimming_skill'), 'number_lessons'=>$this->input->post('swimming_number'))
		);
		$medical = $this->input->post('medical');
		$this->load->model("model_member");
		$this->model_member->dbAddChild($array, $medical, $skill);
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
		
		
	public function payments(){
		$this->load->view("site_header");
		$this->load->view("site_nav_staff");	
		$this->load->model("model_term");
		$data["year"]=$this->model_term->dbPull();		
		$this->load->view("content_payments_staff",$data);
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
		echo $this->model_payment->dbSavePayment($transactionId, $array);		
	}
	
	public function updatePayment(){
		$transactionId = $this->input->post('transaction_id');
		$array = array(		
			'payment_date' => $this->input->post('paid_date'),
			'amount_paid' => $this->input->post('amount'),
			'payment_type' => $this->input->post('type')			
		);		
		$this->load->model("model_payment");
		$this->model_payment->dbUpdatePayment($transactionId, $array);		
	}
	
	public function groups(){
		$this->load->view("site_header");
		$this->load->view("site_nav_staff");				
		$this->load->view("content_groups_staff");
		$this->load->view("site_footer");
	}
	
	public function getSkillsSelect(){
		$this->load->model("model_group");
		echo $this->model_group->dbGetSkills($this->input->post('sport'));
	}
	
	function getYearsSelect(){
		$this->load->model("model_term");
		echo $this->model_term->dbGetYearSelect();
	}
	
	function getTermsSelect(){
		$this->load->model("model_term");
		echo $this->model_term->dbGetTermSelect($this->input->post('year'));
	}
	
	function getGroupsSelect(){
		$this->load->model("model_group");
		echo $this->model_group->dbGetGroupSelect($this->input->post('term'), $this->input->post('skill'));
	}
	
	function getChildrenList(){
		$group = $this->input->post('group');
		$skill = $this->input->post('skill');
		$this->load->model("model_group");
		echo $this->model_group->dbGetChildrenListStaff($group, $skill);
	}
	
	function getTrainingDays(){
		$group = $this->input->post('group');
		$this->load->model("model_group");
		echo $this->model_group->dbGetTrainingDays($group);
	}
	
	function getGroupTasks(){
		$skill = $this->input->post('skill');
		$this->load->model("model_group");
		echo $this->model_group->dbGetGroupTasks($skill);
	}
	
	function getMemberProgress(){
		$schedId = $this->input->post('day');
		$memberId = $this->input->post('member_id');
		$this->load->model("model_group");
		echo $this->model_group->dbGetMemberProgress($schedId, $memberId);
	}
	
	function updateMemberProgress(){
		$memberId = $this->input->post('member_id');
		$schedId = $this->input->post('day');
		$tasks = $this->input->post('tasks');
		$attend = $this->input->post('attendance');
		$notes = $this->input->post('notes');
		$staffId = 1;
		$this->load->model("model_group");
		$this->model_group->dbUpdateMemberProgress($memberId, $schedId, $tasks, $attend, $staffId, $notes);
	}
	
	function createGroup(){		
		$group = array(			
			'group_name' => $this->input->post('name'),
			'lesson_id' => $this->input->post('type'),
			'skill_id' => $this->input->post('skill'),
			'max_number' => $this->input->post('num'),
			'term_id' => $this->input->post('term'),
			'date_created' => date('Y-m-d')
		);		
		$sched = array(
			'group_id' => 0,
			'staff_id' =>  $this->input->post('staff'),
			'date_created' => date('Y-m-d'),
			'weekday' => $this->input->post('day'),			
			'start_time' => $this->input->post('sttime'),
			'end_time' => $this->input->post('entime')			
		);
		$this->load->model("model_group");
		$this->model_group->dbCreateGroup($group, $sched);
	}
	
	function getPaymentsList(){
		$parent = $this->input->post('parent');
		$term = $this->input->post('term');
		$this->load->model("model_payment");
		echo $this->model_payment->dbGetPaymentsList($parent, $term);
	}
		
	function getPaymentDetailsParent(){
		$transactionId = $this->input->post('transaction_id');
		$this->load->model("model_payment");
		echo $this->model_payment->dbGetPaymentDetailsParent($transactionId);
	}
	
	function getSelectChild(){
		$this->load->model("model_member");
		echo $this->model_member->dbGetSelectChild($this->input->post('parent'));
	}
	
	function getGroupChild(){
		$this->load->model("model_group");
		echo $this->model_group->dbGetGroupChild($this->input->post('term'), $this->input->post('child'));
	}
	
	function getPaymentDetailsGroup(){
		$this->load->model("model_payment");
		echo $this->model_payment->dbGetPaymentDetailsGroup($this->input->post('group'), $this->input->post('child'));
	}
	
	function updatePaymentGroup(){
		$array = array(
			'number_lessons' => $this->input->post('num_lessons'),
			'total_amount' => $this->input->post('total')
		);
		$groupId = $this->input->post('group');
		$memberId = $this->input->post('child');
		$this->load->model("model_payment");
		$this->model_payment->dbUpdatePaymentGroup($groupId, $memberId, $array);
	}
	
	function addNewPayment(){
		$array = array(
			'payment_id' => 0,
			'payment_date' => date('Y-m-d'),
			'payment_type' => $this->input->post('type'),
			'amount_paid' => $this->input->post('amount')
		);
		$groupId = $this->input->post('group');
		$memberId = $this->input->post('child');
		$this->load->model("model_payment");
		$this->model_payment->dbAddNewPayment($groupId, $memberId, $array);
	}
	
	function getChildLevels(){		
		$this->load->model("model_sport");
		echo $this->model_sport->dbGetChildLevels($this->input->post('child'));		
	}
	
	function getSkillsList(){
		$this->load->model('model_sport');
		echo $this->model_sport->dbGetSkillLevels();
	}
	
	function getMemberProgressList(){
		$this->load->model("model_member");	
		echo $this->model_member->dbGetMemberProgressList($this->input->post('child'), $this->input->post('term'));
	}
	
	function getPerformedTasks(){
		$this->load->model('model_group');
		echo $this->model_group->dbGetPerformedTasks($this->input->post('progress'));
	}

	public function schedule(){	
		$this->load->view("site_header");
		$this->load->view("site_nav_staff");		
		$this->load->view("content_schedule_staff");
		$this->load->view("site_footer");	
	}
	
	function getSchedule(){
		$start = $this->input->get('start');
		$end = $this->input->get('end');
		$this->load->model('model_sport');
		echo $this->model_sport->dbGetSchedule('2',$start, $end);
	}
	
	function logout(){
	   $this->session->unset_userdata('logged_in');
	   $this->session->sess_destroy();
	   redirect('login', 'refresh');
	}
	
	function profile(){
		$this->load->view("site_header");
		$this->load->view("site_nav_staff");
		$this->load->model("model_staff");
		$data['details']=$this->model_staff->dbPullProfile($this->session->userdata('logged_in')['id']);
		$this->load->view("content_profile", $data);
		$this->load->view("site_footer");		
	}
	
	function saveProfile(){
		$staffId = $this->session->userdata('logged_in')['id'];
		$staff = array(			
			'staff_fname' => $this->input->post('fname'),
			'staff_mname' => $this->input->post('mname'),
			'staff_lname' => $this->input->post('lname'),
			'home_number' => $this->input->post('hnumber'),
			'mobile_number' => $this->input->post('mnumber'),
			'emg_contact_name' => $this->input->post('emgname'),
			'emg_contact_number' => $this->input->post('emgnumber'),
			'staff_email' => $this->input->post('email')			
		);		
		$this->load->library('encrypt');
		$password = $this->encrypt->encode($this->input->post('password'));		
		$this->load->model("model_staff");
		$this->model_staff->dbSaveProfile($staffId, $staff, $password);
		header( 'Location: '.base_url().'site/profile');		
	}
	
	private function get_account_type(){
		return $this->model_user->db_get_account_type($this->session->userdata('logged_in')['id']);
	}
}
