<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends ADMIN_Controller {

	function __construct()
	{
		parent::__construct();
		auth();
		$this->load->model('dashboard_model','dashboard');
	}
	
	public function index()
	{
		
		$this->data['title'] = 'Dashboard';
		$this->data['active'] = 'dashboard';
		$this->data['js'] = 'dashboard';
		$this->data['content'] = $this->load->view('backend/dashboard',$this->data,true);
		$this->load->view('backend/common/template',$this->data);
		
	}
	//
	public function logout()
	{
		
		$this->session->sess_destroy();
			
		redirect(base_url());
		
	}
	
	public function auth_check(){
		
		
		$admin_data = get_admin_by_id($this->session->userdata('admin_id'))->row();
		
		$data['status'] = 1;
		
		if($admin_data->session_id != $this->session->userdata('sess_id')){
			
			$data['status'] = 0;
		}
		
		echo json_encode($data);
		
	}
	
	public function change_password()
	{
		
		$this->form_validation->set_rules('old','Old Password','trim|required|callback_old_password_check');
		$this->form_validation->set_rules('new_pass','New Password','trim|required|min_length[8]');
		$this->form_validation->set_rules('cpass','Confirm Password','trim|required');
		$this->form_validation->set_message('required','This field is required.');
		
		if($this->form_validation->run() === false){
			
			$this->data['title'] = 'Settings';
			$this->data['active'] = 'settings';
			$this->data['content'] = $this->load->view('change_password',$this->data,true);
			$this->load->view('common/template',$this->data);
			
		}else{
			
			$dbData['password'] = md5($this->input->post('new_pass'));
			$this->db->where('id',$this->session->userdata('admin_id'));
			$this->db->update('admin',$dbData);
			$this->session->set_flashdata('msg','Password updated successfully!');
			redirect('change-password');
			
		}
		
		
	}
	
	public function old_password_check($password)
	{
		$this->load->model('login_model','login');
		if(!empty($password)){
			
			$password = md5($password);
			
			$result = $this->login->get_admin_data_by_id_and_password($this->session->userdata('admin_id'),$password);
			
			if(!$result)
			{
				$this->form_validation->set_message('old_password_check', 'Invalid old password');
				return FALSE;
			}
			else
			{
				return TRUE ;
			}
		}else{
			$this->form_validation->set_message('old_password_check', 'This field is required.');
			return FALSE;
		}
	}
	
	public function notification(){
		
		$result = $this->dashboard->get_one_notification_of_admin();
		$count = $this->dashboard->get_notification_count();
		$notififcation = array();
		$notififcation['push'] = array();
		$notififcation['count'] = $count;
		if($result->num_rows() > 0){
			
			foreach($result->result() as $row){
				$dbData['push_in'] = 1;
				$this->db->where('id',$row->id);
				$this->db->update('notifications',$dbData);
				$arr = array();
				$this->data['data'] = $row;
				$arr['html'] = $this->load->view('notification',$this->data,true);
				$arr['id'] = 'notification-push-'.$row->id;
				$arr['top'] = $this->load->view('top_notification',$this->data,true);
				$notififcation['push'][] = $arr;
				
			}
		}
		echo json_encode($notififcation);
	}

	public function all_notifications()
	{
		$this->data['title'] = 'Notifications';
		$this->data['active'] = 'dashboard';
		$this->data['js'] = 'listing';
		$this->data['jsfile'] = 'notifications_lead';
		$this->data['notifi'] = $this->app->get_all_notification();
		$this->data['content'] = $this->load->view('backend/notifications/notifications',$this->data,true);
		$this->load->view('backend/common/template',$this->data);
	}
	public function detail($id){
		
		$this->data['title'] = 'Notifications Detail';
		$this->data['active'] = 'dashboard';
		$this->data['jsfile'] = 'notifications_lead';
		$this->data['notificationss'] = $this->app->get_quote_by_id($id)->row();
		$dbData['read_it'] = $this->data['notificationss']->read_it==1?0:1;
		$this->db->where('id', $id);

		$this->db->update('notifications', $dbData);
		$this->data['content'] = $this->load->view('backend/notifications/detail',$this->data,true);
		$this->load->view('backend/common/template',$this->data);
	}
	public function delete_notificaton($id)
	{
		$dbData['is_delete'] = 1;
		$this->db->where('id', $id);

		$this->db->update('notifications', $dbData);
		redirect($_SERVER['HTTP_REFERER']);
	}
	
	// LANGUAGE SECTION
	public function languages()
	{
		
		$this->data['title'] = 'Languages';
		$this->data['active'] = 'languages';
		$this->data['js'] = 'dashboard';
		$this->data['languages'] = $this->dashboard->get_language_lists();
		$this->data['content'] = $this->load->view('backend/languages/listing',$this->data,true);
		$this->load->view('backend/common/template',$this->data);
		
	}
	public function add_language()
	{
	
		$this->data['title'] = 'Add New Language';
		$this->data['active'] = 'dashboard';
		$this->data['js'] = 'dashboard';
		$this->data['content'] = $this->load->view('backend/languages/add',$this->data,true);
		$this->load->view('backend/common/template',$this->data);
	}

	public function live_atten()
	{
		$site_id = $this->input->post("site");

		$time = $this->input->post("time");


		$site = $this->db->where("id",$site_id)->get("sites")->result_object()[0];

		$ids = get_employees_ids_on_site($site_id);


		$new = $this->db->where("stamp >",$time)->where_in("employee_id",$ids)->get("checks")->result_object();


		if(empty($new))
		{
			echo json_encode(array("action"=>"failed"));
		}
		else{


			$elems ="";

			$notifs = array();

			foreach($new as $new_one)
			{
				$employee = $this->db->where("id",$new_one->employee_id)->get("employees")->result_object()[0];
				$elems .= print_atten($new_one,$employee,true);



				$title = $employee->first_name.' '.$employee->last_name . " just ". type_to_text($new_one->type) . ' at site: '.$site->title;

				$notifs[] = $title;
			}



			echo json_encode(array(
				"action"=>"success",
				"elems"=>$elems,
				"notifs"=>$notifs,
				"newTime"=>time()
			));
		}
	}
}
