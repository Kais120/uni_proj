<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start();
class Site extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('model_user','',TRUE);
		if(!$this->session->userdata('logged_in'))
			redirect('login', 'refresh');
		if($this->get_account_type()=='staff')
			redirect('site_staff', 'refresh');
	}

	public function index(){			
		$this->schedule();	
	}
	
	public function members(){	
		$data['title']='Registrations';
		$this->load->view("site_header",$data);
		$this->load->view("site_nav");				
		$this->load->view("content_members");
		$this->load->view("site_footer");	
	}
	
	public function get_member_info(){		
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
			"parent_fname" => htmlentities($this->input->post('firstName')),
			"parent_mname" => htmlentities($this->input->post('middleName')),
			"parent_lname" => htmlentities($this->input->post('lastName')),
			"address1" => htmlentities($this->input->post('addrLine1')),
			"address2" => htmlentities($this->input->post('addrLine2')),
			"suburb" => htmlentities($this->input->post('suburb')),
			"post_code" => htmlentities($this->input->post('postcode')),
			"email" => htmlentities($this->input->post('email')),
			"home_number" => htmlentities($this->input->post('homeNumber')),
			"mobile_number" => htmlentities($this->input->post('mobileNumber')),
			"office_number" => htmlentities($this->input->post('officeNumber')),			
		);
		$this->load->model("model_member");	
		echo $this->model_member->dbUpdateParent($key, $array);		
	}
	
	public function updateChildInfo(){
		$key = htmlentities($this->input->post('key'));
		$array = array(	
			'member_fname' => htmlentities($this->input->post('childFirstName')),
			'member_mname' =>  htmlentities($this->input->post('childMiddleName')),
			'member_lname' =>  htmlentities($this->input->post('childLastName')),
			'member_dob' =>  htmlentities($this->input->post('childDOB')),			
			'medical_notes' =>  htmlentities($this->input->post('notes'))
		);
		$medical = $this->input->post('medical');
		$skill =  array(
			'1' => array('member_id' => $key, 'skill_id' =>   htmlentities($this->input->post('tennis_skill')), 'number_lessons'=> htmlentities($this->input->post('tennis_number'))),
			'2' => array('member_id' => $key, 'skill_id' =>   htmlentities($this->input->post('swimming_skill')), 'number_lessons'=> htmlentities($this->input->post('swimming_number')))
		);
		$this->load->model("model_member");	
		echo $this->model_member->dbUpdateChild($key, $array, $medical, $skill);		
	}
	
	public function add_child(){	
		$skill =  array();
		$array = array(
			'registration_id' => htmlentities($this->input->post('parentKey')),
			'member_fname' => htmlentities($this->input->post('childFirstName')),
			'member_mname' => htmlentities($this->input->post('childMiddleName')),
			'member_lname' => htmlentities($this->input->post('childLastName')),
			'member_dob' => htmlentities($this->input->post('childDOB')),
			'medical_notes' => htmlentities($this->input->post('notes'))
		);
		
		if ($this->input->post('tennis_skill')!='')
			$skill[1] = array('member_id' => 0, 'skill_id' =>  $this->input->post('tennis_skill'), 'number_lessons'=>$this->input->post('tennis_number'));
		if ($this->input->post('swimming_skill')!='')
			$skill[2] = array('member_id' => 0, 'skill_id' =>  $this->input->post('swimming_skill'), 'number_lessons'=>$this->input->post('swimming_number'));
		
		$medical = $this->input->post('medical');
		$this->load->model("model_member");
		$this->model_member->db_add_child($array, $medical, $skill);
	}
	
	public function addParent(){
		$array = array(	
			"parent_fname" => htmlentities($this->input->post('firstName')),
			"parent_mname" => htmlentities($this->input->post('middleName')),
			"parent_lname" => htmlentities($this->input->post('lastName')),
			"address1" => htmlentities($this->input->post('addrLine1')),
			"address2" => htmlentities($this->input->post('addrLine2')),
			"suburb" => htmlentities($this->input->post('suburb')),
			"post_code" => htmlentities($this->input->post('postcode')),
			"email" => htmlentities($this->input->post('email')),
			"home_number" => htmlentities($this->input->post('homeNumber')),
			"mobile_number" => htmlentities($this->input->post('mobileNumber')),
			"office_number" => htmlentities($this->input->post('officeNumber')),			
		);
		$this->load->model("model_member");
		$this->model_member->dbAddParent($array);
	}		
		
	function get_parent_payments(){
		$term = $this->input->post('term');
		$parent = $this->input->post('parent');
		$this->load->model("model_payment");
		echo $this->model_payment->db_get_parent_payments($term, $parent);		
	}
	
	public function terms(){
		$data['title']='Terms';
		$this->load->view("site_header",$data);		
		$this->load->view("site_nav");
		$this->load->model("model_term");
		$data["year"]=$this->model_term->dbPull();		
		$this->load->view("content_terms",$data);
		$this->load->view("site_footer");
	}
	
	public function get_terms(){
		$year = $this->input->post('year');
		$this->load->model("model_term");
		echo $this->model_term->db_get_term_details($year);
	}
	
	public function get_terms_details(){
		$year = $this->input->post('year');
		$this->load->model("model_term");
		echo $this->model_term->db_get_terms_details($year);
	}
	
	public function addTerm(){
		$array = array(			
			'term_description' => htmlentities($this->input->post('description')),
			'start_date' => $this->input->post('start_date'),
			'end_date' => $this->input->post('end_date')			
		);
		$this->load->model("model_term");
		echo $this->model_term->db_add_term($array);
	}
	
	public function updateTerm(){
		$key = $this->input->post('key');
		$array = array(			
			'term_description' => htmlentities($this->input->post('description')),
			'start_date' => $this->input->post('start_date'),
			'end_date' => $this->input->post('end_date')			
		);
		$this->load->model("model_term");
		echo $this->model_term->db_update_term($array,$key);
	}
	
	public function payments(){
		$data['title']='Payments';
		$this->load->view("site_header",$data);
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
	
	public function get_payment_details(){
		$paymentId = $this->input->post('payment_id');		
		$this->load->model("model_payment");
		echo $this->model_payment->db_get_payment_details($paymentId);		
	}	
	
	public function save_payment(){
		$paymentId = $this->input->post('payment_id');
		$array = array(					
			'number_lessons' => $this->input->post('num_lessons'),
			'total_amount' => $this->input->post('total')			
		);		
		$this->load->model("model_payment");
		$this->model_payment->db_save_payment($paymentId, $array);		
	}
	
	function get_transactions(){
		$this->load->model("model_payment");
		echo $this->model_payment->db_get_transactions($this->input->post('payment_id'));
	}
	
	function add_transaction(){
		$array = array(
			'payment_id' => $this->input->post('payment_id'),
			'payment_date' => date('Y-m-d'),
			'payment_type' => htmlentities($this->input->post('type')),
			'amount_paid' => $this->input->post('amount')
		);
		$this->load->model("model_payment");
		$this->model_payment->db_add_transaction($array);
	}
	
	function save_transaction(){
		$transactionId = $this->input->post('transaction_id');
		$array = array(
			'payment_type' => htmlentities($this->input->post('type')),
			'amount_paid' => $this->input->post('amount')
		);
		$this->load->model("model_payment");
		$this->model_payment->db_save_transaction($transactionId, $array);
	}
	
		
	public function sports(){				
		$data['title']='Skills';
		$this->load->view("site_header",$data);
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
			'skill_band' => htmlentities($this->input->post('skill_band')),
			'skill_band_description' => htmlentities($this->input->post('skill_description'))
		);
		$this->load->model("model_sport");
		echo $this->model_sport->dbUpdateSkill($key, $array);
	}
	
	public function updateTask(){
		$key = $this->input->post('key');
		$array = array(		
			'task' => htmlentities($this->input->post('task_name')),
			'task_description' => htmlentities($this->input->post('task_description'))
		);
		$this->load->model("model_sport");
		echo $this->model_sport->dbUpdateTask($key, $array);
	}
	
	public function addSkill(){
		$array = array(	
			'sport_id' => $this->input->post('sport'), 
			'skill_band' => htmlentities($this->input->post('skill_band')),
			'skill_band_description' => htmlentities($this->input->post('skill_description'))
		);
		$this->load->model("model_sport");
		$this->model_sport->dbAddSkill($array);
	}
	
	public function addTask(){
		$array = array(		
			'skill_id' => $this->input->post('skill_id'), 
			'task' => htmlentities($this->input->post('task')),
			'task_description' => htmlentities($this->input->post('task_description'))
		);
		$this->load->model("model_sport");
		$this->model_sport->dbAddTask($array);
	}
	
	public function staff(){				
		$data['title']='Staff';
		$this->load->view("site_header",$data);
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
			'staff_fname' => htmlentities($this->input->post('fname')),
			'staff_mname' => htmlentities($this->input->post('mname')),
			'staff_lname' => htmlentities($this->input->post('lname')),
			'home_number' => htmlentities($this->input->post('hnumber')),
			'mobile_number' => htmlentities($this->input->post('mnumber')),
			'emg_contact_name' => htmlentities($this->input->post('emgname')),
			'emg_contact_number' => htmlentities($this->input->post('emgnumber')),
			'staff_email' => htmlentities($this->input->post('email')),
			'active' => $active		
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
			'staff_fname' => htmlentities($this->input->post('fname')),
			'staff_mname' => htmlentities($this->input->post('mname')),
			'staff_lname' => htmlentities($this->input->post('lname')),
			'home_number' => htmlentities($this->input->post('hnumber')),
			'mobile_number' => htmlentities($this->input->post('mnumber')),
			'emg_contact_name' => htmlentities($this->input->post('emgname')),
			'emg_contact_number' => htmlentities($this->input->post('emgnumber')),
			'staff_email' => htmlentities($this->input->post('email')),
			'active' => $active,	
		);		
		
		$this->load->library('encrypt');
		$user = array(
			'staff_id'=>'',
			'username' => htmlentities($this->input->post('username')),
			'type' => htmlentities($this->input->post('type')),
			'password' => $this->encrypt->encode($this->input->post('password'))			
		);						
		$this->load->model("model_staff");
		$this->model_staff->dbAddStaff($staff, $user);
		header( 'Location: '.base_url().'site/staff') ;		
	}
	
	public function checkUsername(){
		$username = htmlentities($this->input->post('username'));
		$this->load->model("model_staff");
		echo $this->model_staff->dbCheckUsername($username);		
	}
	
	public function lessons(){				
		$data['title']='Lessons';
		$this->load->view("site_header",$data);
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
			'lesson_description' => htmlentities($this->input->post('lesson_name')),
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
			'lesson_description' => htmlentities($this->input->post('lesson_name')),
			'cost' => $this->input->post('lesson_cost')
		);
		$this->load->model("model_sport");
		$this->model_sport->dbAddLesson($array, $sport);
		header( 'Location: '.base_url().'site/lessons');
	}
	
	public function groups(){
		$data['group_id']=$this->input->get('group_id');
		if(null != $this->input->get('group_id')){	
			$groupId = $this->input->get('group_id');
			$this->load->model("model_group");
			$data['groupYear'] = $this->model_group->db_get_select_group_year($groupId);
			$data['groupName'] = $this->model_group->db_get_group_name($groupId);
			$data['groupSkill'] = $this->model_group->db_get_select_group_skill($groupId);		
			$data['groupSport'] = $this->model_group->db_get_group_sport($groupId);
			$data['groupTerm'] = $this->model_group->db_get_select_group_term($groupId);
		}		
		$data['title']='Groups';
		$this->load->view("site_header",$data);
		$this->load->view("site_nav");				
		$this->load->view("content_groups", $data);
		$this->load->view("site_footer");
	}
	
	public function getSkillsSelect(){
		$this->load->model("model_group");
		echo $this->model_group->dbGetSkills($this->input->post('sport'));
	}
	
	function get_year_select(){
		$this->load->model("model_term");
		echo $this->model_term->db_get_year_select();
	}
	
	function get_term_select(){
		$this->load->model("model_term");
		echo $this->model_term->db_get_term_select($this->input->post('year'));
	}
	
	function getGroupsSelect(){
		$this->load->model("model_group");
		echo $this->model_group->dbGetGroupSelect($this->input->post('term'), $this->input->post('skill'));
	}
	
	function getLessonsSelect(){
		$sport = $this->input->post('sport');
		$group = $this->input->post('group');
		$this->load->model("model_group");
		echo $this->model_group->dbGetLessonsSelect($sport, $group);
	}
	
	function getGroupDay(){
		$group = $this->input->post('group');
		$this->load->model("model_group");
		echo $this->model_group->dbGetGroupDay($group);
	}
	
	function getNumPeople(){
		$group = $this->input->post('group');
		$this->load->model("model_group");
		echo $this->model_group->dbGetNumPeople($group);
	}
	
	function getGroupTimes(){
		$group = $this->input->post('group');
		$this->load->model("model_group");
		echo $this->model_group->dbGroupTimes($group);
	}
	
	function get_children_list(){
		$group = $this->input->post('group');
		$skill = $this->input->post('skill');
		$term = $this->input->post('term');
		$this->load->model("model_group");
		echo $this->model_group->db_get_children_list($group, $skill, $term);
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
	
	function addMemberGroup(){
		$memberId = $this->input->post('member_id');
		$groupId = $this->input->post('group_id');
		$this->load->model("model_group");
		$this->model_group->dbAddMemberGroup($memberId, $groupId);
	}
	
	function removeMemberGroup(){		
		$memberId = $this->input->post('member_id');
		$groupId = $this->input->post('group_id');
		$this->load->model("model_group");
		$this->model_group->dbRemoveMemberGroup($memberId, $groupId);
	}
	
	function update_member_progress(){
		$memberId = $this->input->post('member_id');
		$schedId = $this->input->post('day');
		$tasks = $this->input->post('tasks');
		$attend = $this->input->post('attendance');
		$notes = $this->input->post('notes');
		$staffId = $this->session->userdata('logged_in')['id'];
		$this->load->model("model_group");
		$this->model_group->db_update_member_progress($memberId, $schedId, $tasks, $attend, $staffId, $notes);
	}
	
	function getStaffOptions(){		
		$this->load->model("model_staff");
		echo $this->model_staff->dbGetStaffOptions($this->input->post('group'));
	}	
	
	function update_group(){
		$groupId = $this->input->post('group');
		$group = array(			
			'group_name' => htmlentities($this->input->post('name')),
			'lesson_id' => htmlentities($this->input->post('type')),
			'skill_id' => htmlentities($this->input->post('skill')),
			'max_number' => htmlentities($this->input->post('num')),
			'term_id' => htmlentities($this->input->post('term'))
		);		
		$sched = array(			
			'staff_id' =>  $this->input->post('staff'),
			'weekday' => htmlentities($this->input->post('day')),
			'start_time' => $this->input->post('sttime'),
			'end_time' => $this->input->post('entime')
		);
		$this->load->model("model_group");
		echo $this->model_group->db_update_group($groupId, $group, $sched);
	}
	
	function create_group(){		
		$group = array(			
			'group_name' => htmlentities($this->input->post('name')),
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
		echo $this->model_group->db_create_group($group, $sched);
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
		$data['title']='Schedule';
		$this->load->view("site_header",$data);
		$this->load->view("site_nav");		
		$this->load->view("content_schedule");
		$this->load->view("site_footer");	
	}
	
	function get_schedule(){
		$start = $this->input->post('start');
		$end = $this->input->post('end');
		$sport = $this->input->post('sport');
		$this->load->model('model_sport');
		echo $this->model_sport->dbGetSchedule($sport,$start, $end);
	}
	
	function logout(){
	   $this->session->unset_userdata('logged_in');
	   $this->session->sess_destroy();
	   redirect('login', 'refresh');
	}
	
	function profile(){
		$data['title']='Profile';
		$this->load->view("site_header",$data);
		$this->load->view("site_nav");
		$this->load->model("model_staff");
		$data['details']=$this->model_staff->db_pull_profile($this->session->userdata('logged_in')['id']);
		$this->load->view("content_profile", $data);
		$this->load->view("site_footer");		
	}
	
	function save_profile(){
		$staffId = $this->session->userdata('logged_in')['id'];
		$staff = array(			
			'staff_fname' => htmlentities($this->input->post('fname')),
			'staff_mname' => htmlentities($this->input->post('mname')),
			'staff_lname' => htmlentities($this->input->post('lname')),
			'home_number' => htmlentities($this->input->post('hnumber')),
			'mobile_number' => htmlentities($this->input->post('mnumber')),
			'emg_contact_name' => htmlentities($this->input->post('emgname')),
			'emg_contact_number' => htmlentities($this->input->post('emgnumber')),
			'staff_email' => $this->input->post('email')			
		);
		$this->load->library('encrypt');
		if (null!=$this->input->post('password'))
			$user = array(
				'password' => $this->encrypt->encode($this->input->post('password')),
				'question' => $this->input->post('question'),
				'answer' => $this->input->post('answer')			
			);
		else
			$user = array(				
				'question' => $this->input->post('question'),
				'answer' => $this->input->post('answer')			
			);
		$this->load->model("model_staff");
		$this->model_staff->db_save_profile($staffId, $staff, $user);
		header( 'Location: '.base_url().'site/profile');		
	}
	
	private function get_account_type(){
		return $this->model_user->db_get_account_type($this->session->userdata('logged_in')['id']);
	}
	
	public function assignments(){
		$data['title']='Assignments';
		$this->load->view("site_header",$data);
		$this->load->view("site_nav");
		$this->load->model("model_term");
		$data["year"]=$this->model_term->dbPull();	
		$this->load->view("content_assignment", $data);
		$this->load->view("site_footer");
	}
	
	function get_assignments(){
		$this->load->model("model_group");
		echo $this->model_group->db_get_assignments($this->input->post('term'));	
	}
	
	function save_event(){
		$schedId = $this->input->post('id');
		$array = array(
			'schedule_date' => $this->input->post('date'),		
			'start_time' => $this->input->post('start'),
			'end_time' =>  $this->input->post('end')
		);		
		$this->load->model("model_sport");
		$this->model_sport->db_save_event($schedId, $array);		
	}
	
	function delete_event(){
		$schedId = $this->input->post('id');
		$this->load->model("model_sport");
		echo $this->model_sport->db_delete_event($schedId);
	}
	
	function check_parent(){
		$regId = $this->input->post('parent');
		$this->load->model("model_member");
		echo $this->model_member->db_check_parent($regId);
	}
	
	function delete_parent(){
		$regId = $this->input->post('parent');
		$this->load->model("model_member");
		$this->model_member->db_delete_parent($regId);
	}
	
	function check_child(){
		$memId = $this->input->post('child');
		$this->load->model("model_member");
		echo $this->model_member->db_check_child($memId);
	}
	
	function delete_child(){
		$memId = $this->input->post('child');
		$this->load->model("model_member");
		$this->model_member->db_delete_child($memId);
	}
	
	function get_current_date(){
		echo Date('Y-m-d');
	}

}
