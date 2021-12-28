<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class users extends ADMIN_Controller {

    function __construct()
    {
        parent::__construct();
        auth();
        $this->redirect_role(5);

        $this->data['active'] = 'users';
        $this->load->model('users_model','user');
        $this->load->model('location_model','location');
    }

    public function index()
    {

        $this->data['title'] = 'Users';
        $this->data['sub'] = 'users';
        $this->data['js'] = 'listing';
        $this->data['jsfile'] = 'js/users_listing';
        $this->data['users'] = $this->user->get_all_users();
        $this->data['content'] = $this->load->view('backend/users/listing', $this->data,true);
        $this->load->view('backend/common/template',$this->data);
    }
    public function trash()
    {
        $this->data['title'] = 'Trash Users';
        $this->data['sub'] = 'trash-users';
        $this->data['js'] = 'listing';
        $this->data['jsfile'] = 'js/users_listing';
        $this->data['users'] = $this->user->get_all_trashed_users();
        $this->data['content'] = $this->load->view('backend/users/trash', $this->data,true);
        $this->load->view('backend/common/template',$this->data);
    }

    public function add (){

        $this->form_validation->set_rules('name','Name','trim|required');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|callback_check_email');
        $this->form_validation->set_message('required','This field is required.');
        $this->form_validation->set_message('alpha_numeric_spaces','Only alphabet and numbers are allowed.');
        if($this->form_validation->run() === false){
            $this->data['title'] = 'Add New user';
            $this->data['sub'] = 'add-user';
            $this->data['jsfile'] = 'js/add_user';
            


            $this->data['content'] = $this->load->view('backend/users/add',$this->data,true);
            $this->load->view('backend/common/template',$this->data);
        }else{

            $dbData['name'] = $this->input->post('name');
            $dbData['username'] = $this->input->post('name');
            $dbData['email'] = $this->input->post('email');
       
            $dbData['created_at'] = date('Y-m-d H:i:s');
            $dbData['created_by'] = $this->session->userdata('admin_id');
            $dbData['updated_at'] = date('Y-m-d H:i:s');
            $dbData['updated_by'] = $this->session->userdata('admin_id');

            $dbData["password"] = md5($this->input->post("password"));
            $this->db->insert('users',$dbData);


            $id = $this->db->insert_id();

          





            $this->load->library('email');

            // prepare email
            $this->email
                ->from(settings()->email, settings()->site_title)
                ->to($dbData['email'])
                ->subject("Welcome Onboard")
                ->message("Admin just created your account as a user on ".settings()->site_title.", your login details are:<br> Your username is: <br> <span style='background:#f5f5f5;padding:5px;'>".$dbData['email']."</span> <br> Your password is: <br> <span style='background:#f5f5f5;padding:5px;'>".$this->input->post('password')."</span> <br> <b>You can login in the app</b>")
                ->set_mailtype('html');

            // send email
            $this->email->send();


            $this->session->set_flashdata('msg','New user added successfully!');
            redirect('admin/users');
        }
    }

    public function check_email($email){

        $result = $this->user->get_user_by_email($email);
        if(!empty($email)) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->form_validation->set_message('check_email', 'Please enter the valid email address.');
                return false;
            }else{
                if ($result->num_rows() > 0) {
                    $this->form_validation->set_message('check_email', 'This email already exist.');
                    return false;
                } else {
                    return true;
                }
            }

        }else{
            $this->form_validation->set_message('check_email', 'This field is required.');
            return false;
        }
    }

    public function password($id){

        $result = $this->user->get_user_by_id($id);

        if(!$result){

            $this->session->set_flashdata('err','Invalid request.');
            redirect('admin/404_page');

        }

        $this->data['data'] = $result;
        $this->form_validation->set_rules('password','Password','trim|required');
        
        if($this->form_validation->run() === false){
            $this->data['title'] = 'Change user Password';
            $this->data['sub'] = 'edit-user';
            $this->data['content'] = $this->load->view('backend/users/password',$this->data,true);
            $this->load->view('backend/common/template',$this->data);
        }else{

            $dbData['password'] = md5($this->input->post('password'));
            $dbData['updated_at'] = date('Y-m-d H:i:s');
            $dbData['updated_by'] = $this->session->userdata('admin_id');
            $this->db->where('id',$id);
            $this->db->update('users', $dbData);



            $this->load->library('email');

            // prepare email
            $this->email
                ->from(settings()->email, settings()->site_title)
                ->to($dbData['email'])
                ->subject("Password Changed")
                ->message("Admin just changed your password on ".settings()->site_title.", your login details are:<br> Your username is: <br> <span style='background:#f5f5f5;padding:5px;'>".$dbData['email']."</span> <br> Your password is: <br> <span style='background:#f5f5f5;padding:5px;'>".$this->input->post('password')."</span> <br> <b>You can login in the app</b>")
                ->set_mailtype('html');

            // send email
            $this->email->send();



            $this->session->set_flashdata('msg', 'user password updated successfully!');
            redirect('admin/users');

        }
    }


    public function status($id,$status){

        $result = $this->user->get_user_by_id($id);

        if(!$result){

            $this->session->set_flashdata('err','Invalid request.');
            redirect('admin/404_page');

        }

        $user_status = 1;

        if($status == 1){

            $user_status = 0;

        }

        $dbData['status'] = $user_status;
        $dbData['updated_at'] = date('Y-m-d H:i:s');
        $dbData['updated_by'] = $this->session->userdata('admin_id');

        $this->db->where('id',$id);
        $this->db->update('users',$dbData);
        $this->session->set_flashdata('msg','user status updated successfully!');
        redirect('admin/users');
    }

    public function edit($id){

        $result = $this->user->get_user_by_id($id);

        if(!$result){

            $this->session->set_flashdata('err','Invalid request.');
            redirect('admin/404_page');

        }

        $this->data['data'] = $result;
        $this->form_validation->set_rules('name','Name','trim|required');
       
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|callback_check_email_edit['.$id.']');
        
        $this->form_validation->set_message('required','This field is required.');
        $this->form_validation->set_message('alpha_numeric_spaces','Only alphabet and numbers are allowed.');
        if($this->form_validation->run() === false){
            $this->data['title'] = 'Edit user';
            $this->data['sub'] = 'edit-user';
            $this->data['jsfile'] = 'js/add_user';
            $this->data['content'] = $this->load->view('backend/users/edit',$this->data,true);
            // print_r(validation_errors());exit;
            $this->load->view('backend/common/template',$this->data);
        }else{

            $dbData['name'] = $this->input->post('name');
            $dbData['username'] = $this->input->post('name');
           
            $dbData['email'] = $this->input->post('email');
       
            
            $dbData['updated_at'] = date('Y-m-d H:i:s');
            $dbData['updated_by'] = $this->session->userdata('admin_id');
            $this->db->where('id',$id);
            $this->db->update('users', $dbData);
           
            $this->session->set_flashdata('msg', 'user updated successfully!');
            redirect('admin/users');

        }
    }

    public function check_email_edit($email,$id){

        $result = $this->user->get_user_by_email($email);
        if(!empty($email)) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->form_validation->set_message('check_email_edit', 'Please enter the valid email address.');
                return false;
            }else{
                if ($result->num_rows() > 0) {
                    $result = $result->row();
                    if($result->id == $id){
                        return true;
                    }else{
                        $this->form_validation->set_message('check_email_edit', 'This email already exist.');
                        return false;
                    }
                } else {
                    return true;
                }
            }

        }else{
            $this->form_validation->set_message('check_email_edit', 'This field is required.');
            return false;
        }
    }


    public function delete($id){
        $result = $this->user->get_user_by_id($id);

        if(!$result){
            $this->session->set_flashdata('err','Invalid request.');
            redirect('admin/404_page');
        }
        
        $this->db->where('id',$id);
        $this->db->update('users', array("is_deleted"=>1));


       
        $this->session->set_flashdata('msg', 'user deleted successfully!');
        redirect('admin/users');
    }
    public function restore($id){
        
        $dbData['deleted_by'] = $this->session->userdata('admin_id');
        $dbData['is_deleted'] = 0;
        $this->db->where('id',$id);
        $this->db->update('users', $dbData);
        $this->session->set_flashdata('msg', 'user restored successfully!');
        redirect('admin/trash-users');
    }
    public function d_p($id){
        
 
        $this->db->where('id',$id);
        $this->db->delete('users');
        $this->session->set_flashdata('msg', 'user removed successfully!');
        redirect('admin/trash-users');
    }
 
    
    public function user_detail($id)
    {       
        $result = $this->user->get_user_by_id($id);

        if(!$result){

            $this->session->set_flashdata('err','Invalid request.');
            redirect('admin/404_page');

        }
        $this->data['title'] = 'user Detail';
        $this->data['sub'] = 'add-user';
        $this->data['jsfile'] = 'js/user_detail';
        $this->data['user_detail'] = $this->user->get_user_by_id($id);
        $this->data['projects'] = $this->user->get_project_by_id($id);
        $this->data['attachments'] = (object)array();
        foreach($this->data['projects'] as $project)
        {
            $project_id = $project->id;
        }
        if($project_id)     
        {
            $this->data['attachments'] = $this->user->get_attachments_by_id($project_id);
        }
        $this->data['content'] = $this->load->view('backend/users/detail',$this->data,true);
        $this->load->view('backend/common/template',$this->data);
    }
    
}
