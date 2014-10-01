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
	
	public function lessons(){				
		$this->load->view("site_header");
		$this->load->view("site_nav");
		$this->load->model("model_sport");
		$data['sport'] = $this->model_sport->dbPullSports();
		$this->load->view("content_lessons", $data);
		$this->load->view("site_footer");
	}
	
	public function getLessons(){
		$this->load->model("model_sport");
		echo $this->model_sport->dbGetLessons($this->input->post('sport_id'));
	}
	
	public function updateLesson(){
		$lessonId = $this->input->post('lesson_id');
		$array = array(
			'lesson_description' => $this->input->post('lesson_name'),
			'cost' => $this->input->post('lesson_cost')
		);
		$this->load->model("model_sport");
		$this->model_sport->dbUpdateLesson($array, $lessonId);
		header( 'Location: '.base_url().'site/lessons');
	}
	
	public function addLesson(){
		$sport = $this->input->post('sport_type');
		$array = array(
			'sport_id' => '',
			'lesson_description' => $this->input->post('lesson_name'),
			'cost' => $this->input->post('lesson_cost')
		);
		$this->load->model("model_sport");
		$this->model_sport->dbAddLesson($array, $sport);
		header( 'Location: '.base_url().'site/lessons');
	}
	
	public function groups(){
		$this->load->view("site_header");
		$this->load->view("site_nav");				
		$this->load->view("content_groups");
		$this->load->view("site_footer");
	}
	
	public function getSkillsSelect(){
		$this->load->model("model_groups");
		echo $this->model_groups->dbGetSkills($this->input->post('sport'));
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
		$this->load->model("model_groups");
		echo $this->model_groups->dbGetGroupSelect($this->input->post('term'), $this->input->post('skill'));
	}
	
	function getLessonsSelect(){
		$sport = $this->input->post('sport');
		$group = $this->input->post('group');
		$this->load->model("model_groups");
		echo $this->model_groups->dbGetLessonsSelect($sport, $group);
	}
	
	function getGroupDay(){
		$group = $this->input->post('group');
		$this->load->model("model_groups");
		echo $this->model_groups->dbGetGroupDay($group);
	}
	
	function getNumPeople(){
		$group = $this->input->post('group');
		$this->load->model("model_groups");
		echo $this->model_groups->dbGetNumPeople($group);
	}
	
	function getGroupTimes(){
		$group = $this->input->post('group');
		$this->load->model("model_groups");
		echo $this->model_groups->dbGroupTimes($group);
	}
	
	function getChildrenList(){
		$group = $this->input->post('group');
		$skill = $this->input->post('skill');
		$this->load->model("model_groups");
		echo $this->model_groups->dbGetChildrenList($group, $skill);
	}
	
	function getTrainingDays(){
		$group = $this->input->post('group');
		$this->load->model("model_groups");
		echo $this->model_groups->dbGetTrainingDays($group);
	}
	
	function getGroupTasks(){
		$skill = $this->input->post('skill');
		$this->load->model("model_groups");
		echo $this->model_groups->dbGetGroupTasks($skill);
	}
	
	function getMemberProgress(){
		$schedId = $this->input->post('day');
		$memberId = $this->input->post('member_id');
		$this->load->model("model_groups");
		echo $this->model_groups->dbGetMemberProgress($schedId, $memberId);
	}
	
	function addMemberGroup(){
		$memberId = $this->input->post('member_id');
		$groupId = $this->input->post('group_id');
		$this->load->model("model_groups");
		$this->model_groups->dbAddMemberGroup($memberId, $groupId);
	}
	
	function removeMemberGroup(){		
		$memberId = $this->input->post('member_id');
		$groupId = $this->input->post('group_id');
		$this->load->model("model_groups");
		$this->model_groups->dbRemoveMemberGroup($memberId, $groupId);
	}
	
	function updateMemberProgress(){
		$memberId = $this->input->post('member_id');
		$schedId = $this->input->post('day');
		$tasks = $this->input->post('tasks');
		$attend = $this->input->post('attendance');
		$notes = $this->input->post('notes');
		$staffId = 1;
		$this->load->model("model_groups");
		$this->model_groups->dbUpdateMemberProgress($memberId, $schedId, $tasks, $attend, $staffId, $notes);
	}
	
	function getStaffOptions(){		
		$this->load->model("model_staff");
		echo $this->model_staff->dbGetStaffOptions($this->input->post('group'));
	}
	
	
	function updateGroup(){
		$groupId = $this->input->post('group');
		$group = array(			
			'group_name' => $this->input->post('name'),
			'lesson_id' => $this->input->post('type'),
			'skill_id' => $this->input->post('skill'),
			'max_number' => $this->input->post('num'),
			'term_id' => $this->input->post('term')
		);		
		$sched = array(			
			'staff_id' =>  $this->input->post('staff'),
			'weekday' => $this->input->post('day'),
			'start_time' => $this->input->post('sttime'),
			'end_time' => $this->input->post('entime')
		);
		$this->load->model("model_groups");
		$this->model_groups->dbUpdateGroup($groupId, $group, $sched);
	}
	
	function createGroup(){		
		$group = array(			
			'group_name' => $this->input->post('name'),
			'lesson_id' => $this->input->post('type'),
			'skill_id' => $this->input->post('skill'),
			'max_number' => $this->input->post('num'),
			'term_id' => $this->input->post('term')
		);		
		$sched = array(
			'group_id' => 0,
			'staff_id' =>  $this->input->post('staff'),
			'weekday' => $this->input->post('day'),
			'date_created' => date('Y-m-d'),
			'start_time' => $this->input->post('sttime'),
			'end_time' => $this->input->post('entime')
		);
		$this->load->model("model_groups");
		$this->model_groups->dbCreateGroup($group, $sched);
	}
	
}
