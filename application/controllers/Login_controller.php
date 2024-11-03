<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url','database');
		// $currentUri = $this->uri->uri_string();
		// if(empty($this->session->userdata('user_id')) && ($currentUri!='login' or $currentUri!='validation') ){
		// 	// redirect('login'); // Change to your actual login route
		// }
	}
	public function login_view()
	{	
		$this->load->view('login_view');

	}
	public function login_validation(){
		if ($this->input->post()) {
			$validation_errors = $this->validateLoginForm($_POST);
			$post_data = $this->input->post();
			$email = $post_data['username_login'];
			$password = $post_data['password_login'];
			
			$data =$this->db->from('users')->where('email',$email)->get()->result_array();
			if(!empty($data)){
				if($data[0]['password'] ==$password){
					$data = array(
						'user_id' => $data[0]['user_id'],
						'first_name' => $data[0]['first_name'],
						'last_name' => $data[0]['last_name'],
						'email' => $data[0]['email'],
						'password' => $data[0]['password'],
						'type' => $data[0]['type'],
						'user_name' => $data[0]['first_name'].' '.$data[0]['last_name'],
					);
					$this->session->set_userdata($data);
					redirect('dashbaord');
				}else{
					redirect('login');
				}
			}else{
				redirect('login');
			}	
		}
	}
	function validateLoginForm($data) {
		$errors = [];
	
		// Validate username
		if (empty($data['username_login'])) {
			$errors['username_login'] = 'Username is required.';
		}
		// Validate password
		if (empty($data['password_login'])) {
			$errors['password_login'] = 'Password is required.';
		} elseif (strlen($data['password_login']) < 6) { // Example: Password should be at least 6 characters
			$errors['password_login'] = 'Password must be at least 6 characters long.';
		}
	
		return $errors;
	}
	public function dashboard(){

		$present = $this->db->select('count(attendance_id) as count')->where('attendance_type', 'Present');
				if($this->session->userdata('type')=='1'){
					$present->where('user_id', $this->session->userdata('user_id'));
				}
		$present = $present->get('attendance')->result_array();
		$absent = $this->db->select('count(attendance_id) as count')->where('attendance_type', 'Absent');
				if($this->session->userdata('type')=='1'){
					$absent->where('user_id', $this->session->userdata('user_id'));
				}
		$absent = 	$absent->get('attendance')->result_array();

		$student_count = $this->db->select('count(user_id) as count')->where('type', '1');
		$student_count = 	$student_count->get('users')->result_array();

		$teacher_count = $this->db->select('count(user_id) as count')->where('type', '2');
		$teacher_count = 	$teacher_count->get('users')->result_array();
		$all = $present[0]['count']+$absent[0]['count'];
		$data = array(
			'all'=>$all,
			'present'=>$present[0]['count'],
			'absent'=>$absent[0]['count'],
			'student_count'=>$student_count[0]['count'],
			'teacher_count'=>$teacher_count[0]['count'],
		);
		$this->render('student',$data);
	}
	public function profile(){
		$this->render('profile');
	}
	public function attendance(){
		$data = $this->db->join('users','users.user_id = attendance.user_id');
				if($this->session->userdata('type')=='1'){
					$data->where('users.user_id', $this->session->userdata('user_id'));
				}
		$data = $data->get('attendance')->result_array();
		$this->render('attendance',array('data'=>$data));
	}
	public function registration(){
		$post_data = $this->input->post('data');
		$data = array(
				'first_name'=>$post_data['f_name'],
				'last_name'=>$post_data['l_name'],
				'type'=>$post_data['user_type'],
				'email'=>$post_data['email'],
				'password'=>$post_data['password'],
		);
		$update = $this->db->insert('users',$data);
		$response = array('status'=>false,'message'=>'something went wrong');
		if($update){
			$response = array('status'=>true,'message'=>'Registered successfully');
		}
		echo json_encode($response);
	}
	public function render($view,$data=''){
		// $view = array
		$this->load->view('includes/template',array('view'=>$view,'data'=>$data));
	}
	public function logout() {
        $this->session->sess_destroy();
        redirect('login'); // Change to your actual login route
    }
	public function add_attendance(){
		$this->render('add_attendance');
	}
	public function save_attendance(){
		$post_data = $this->input->post();
		$save=0;
		$array_data = '';
		if(!empty($post_data['data'])){
			$data = $post_data['data'];
			$user_id = $this->session->userdata('user_id');
			$date = $data['date'];
			$attendance_type = $data['attendance_type'];
			$array_data = array(
				'date' => $date,
				'user_id' => $user_id,
				'attendance_type' => $attendance_type,
			);
			$save = $this->db->insert('attendance',$array_data);
		}
		$response = array('status' =>false);
		if($save){
			$response = array('status' =>true);
		}
		echo json_encode($response);
	}
	public function delete_attendance(){
		$post_data = $this->input->post();
		$attendance_id = $post_data['attendance_id'];
		$delete = $this->db->delete('attendance',array('attendance_id'=>$attendance_id));
		$response = array('status' =>false);
		if($delete){
			$response = array('status' =>true);
		}
		echo json_encode($response);
	}
	public function edit_user(){
		$post_data = $this->input->post();
		$array = array();
		$user_id = $post_data['user_id'];
		if(isset($post_data['user_id'])){
			unset($post_data['user_id']);
		}
		$update = $this->db->update('users',$post_data,array('user_id' =>$user_id));
		$data =$this->db->from('users')->where('user_id',$user_id)->get()->result_array();
		$data = array(
			'user_id' => $data[0]['user_id'],
			'first_name' => $data[0]['first_name'],
			'last_name' => $data[0]['last_name'],
			'email' => $data[0]['email'],
			'password' => $data[0]['password'],
			'type' => $data[0]['type'],
			'user_name' => $data[0]['first_name'].' '.$data[0]['last_name'],
		);
		$this->session->set_userdata($data);
		$response = array('status' =>false);
		if($update){
			$response = array('status' =>true);
		}
		echo json_encode($response);
	}
	public function student(){
		$data = $this->db->select('users.user_id,users.email,users.first_name,users.last_name,abs.count_abs,prs.count_prs')
				->join('(select count(attendance_type) as count_abs,user_id from attendance where attendance_type="Absent" group by user_id) as abs ','abs.user_id=users.user_id','left')
				->join('(select count(attendance_type) as count_prs,user_id from attendance where attendance_type="Present" group by user_id) as prs ','prs.user_id=users.user_id','left')
				->where('type', '1')
				->get('users')->result_array();
		$this->render('student_list_view',array('data'=>$data));
	}
	public function add_student_view($type){
		$this->render('register_user_view',array('type'=>$type));
	}
	public function check_email_exist(){
		$post_data = $this->input->post();

		$email = $post_data['email'];
		$data = $this->db->where('email',$email)->get('users')->result_array();
		$response = array('status' =>true);
		$val = false;
		if($this->session->userdata('user_id')!='' && $this->session->userdata('email')==$email){
			$val= true;
		}
		if(!empty($data) && !$val){
			$response = array('status' =>false,'message'=>'Email already exists');
		}
		echo json_encode($response);
	}
	function delete_user(){
		$post_data = $this->input->post();
		$user_id = $post_data['user_id'];
		$delete = $this->db->delete('users',array('user_id'=>$user_id));
		$response = array('status' =>false);
		if($delete){
			$response = array('status' =>true);
		}
		echo json_encode($response);
	}
	public function teacher_list_view(){
		$data = $this->db->where('type', '2')
				->get('users')->result_array();
		$this->render('teacher_list_view',array('data'=>$data));
	}
}
