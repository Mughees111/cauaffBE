<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * handles the keys
 * 
 * @since 1.0
 * @author DeDevelopers
 * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
 */
class Keys extends ADMIN_Controller {
    /**
     * constructs ADMIN_Controller as parent object
     * loads the neccassary class
     * checks if current user has the rights to access this class
     * 
     * @since 1.0
     * @author DeDevelopers
     * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
     */
    function __construct()
    {
        parent::__construct();
        auth();
        $this->redirect_role(4);
        $this->data['active'] = 'key';
        $this->load->model('keys_model','key');
    }
    /**
     * loads the listing page
     * 
     * @return view listing view
     * 
     * @since 1.0
     * @author DeDevelopers
     * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
     */
    public function index()
    {

        $this->data['title'] = 'Keys';
        $this->data['sub'] = 'keys';
        $this->data['js'] = 'listing';
        $this->data['jsfile'] = 'js/general_listing';
        $this->data['keys'] = $this->key->get_all_keys();
        $this->data['content'] = $this->load->view('backend/keys/listing',$this->data,true);
        $this->load->view('backend/common/template',$this->data);

    }
    /**
     * loads the trash page
     * 
     * @return view trash
     * 
     * @since 1.0
     * @author DeDevelopers
     * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
     */
    public function trash()
    {

        $this->data['title'] = 'Trash keys';
        $this->data['sub'] = 'trash';
        $this->data['js'] = 'listing';
        $this->data['jsfile'] = 'js/general_listing';
        $this->data['keys'] = $this->key->get_all_trash_keys();
        $this->data['content'] = $this->load->view('backend/keys/trash',$this->data,true);
        $this->load->view('backend/common/template',$this->data);

    }
    /**
     * moves row from trash to back to listing page
     * 
     * @param  integer $id id of row in trash
     * @return redirect     back to trash view
     * 
     * @since 1.0
     * @author DeDevelopers
     * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
     */
    public function restore($id){
        
        $dbData['deleted_by'] = $this->session->userdata('admin_id');
        $dbData['is_deleted'] = 0;
        $this->db->where('id',$id);
        $this->db->update('keyys', $dbData);
        $this->session->set_flashdata('msg', 'key restored successfully!');
        redirect('admin/trash-keys');
    }
    /**
     * loads the add view, then handles the submitted data
     * 
     * @since 1.0
     * @author DeDevelopers
     * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
     */
    public function add (){

        $dlang = dlang();
        $langs = langs();
        $input = "title";
        $this->form_validation->set_rules($input,'Title','trim|required|callback_check_key');

       
        $this->form_validation->set_message('required','This field is required.');
        $this->form_validation->set_message('alpha_numeric_spaces','Only alphabet and numbers are allowed.');
        if($this->form_validation->run() === false){
            $this->data['title'] = 'Add New Key';
            $this->data['sub'] = 'add-key';
           
            $this->data['content'] = $this->load->view('backend/keys/add',$this->data,true);
            $this->load->view('backend/common/template',$this->data);
        }else{
            $dbData['title'] = $this->input->post('title');
           
            $dbData['created_at'] = date('Y-m-d H:i:s');
            $dbData['created_by'] = $this->session->userdata('admin_id');
            $dbData['updated_at'] = date('Y-m-d H:i:s');
            $dbData['updated_by'] = $this->session->userdata('admin_id');


            $this->db->insert('keyys',$dbData);

            $key_id = $this->db->insert_id();

            $this->db->where("key_id",$key_id)->delete("user_keys");
            foreach($this->input->post("users") as $user_id)
            {
                $survey = $this->db->where("id",$user_id)->get("keyys")->result_object()[0];
                $this->db->insert("user_keys",array(
                    "key_id"=>$key_id,
                    "user_id"=>$user_id,
                    "search_elem"=>$survey->title
                ));

                $this->send_notif($key_id,$user_id);
            }



            $this->session->set_flashdata('msg','New key added successfully!');
            redirect('admin/keys');

        }
    }

    private function send_notif($key_id,$user_id)
    {
        $key = $this->db->where("id",$key_id)->get("keyys")->result_object()[0];
        $user = $this->db->where("id",$user_id)->get("users")->result_object()[0];

        $notif["data"] = (Object) array();
        $notif["tag"] = "Updates";
        $notif["title"] ="Your survey key: ".$key->title . " has been updated";
        $notif["msg"] = "Open your app to see the details";
        if($user->push_id!="")
            try{
                $x = push_notif($user->push_id,$notif);
            }
            catch(Exception $e)
            {
            }
        else {
        }

        $user_notif = array(
            "title"=>$notif["title"],
            "key_id"=>$key_id,
            "user_id"=>$user_id,
            "created_at"=>date("Y-m-d H:i:s"),
            "seen"=>0
        );

        $this->db->insert("user_notifs",$user_notif);
        return true;
    }
    /**
     * validation check
     * 
     * @since 1.0
     * @author DeDevelopers
     * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
     */
    public function check_key($title){

        $result = $this->key->get_key_by_title($title);
        if(!empty($title)) {
            if ($result->num_rows() > 0) {
                $this->form_validation->set_message('check_key', 'This key already exist.');
                return false;
            } else {
                return true;
            }
        }else{
            $this->form_validation->set_message('check_key', 'This field is required.');
            return false;
        }
    }

    /**
     * changes status of given id row in database
     * 
     * @param  integer $id     id of row in database
     * @param  integer $status new status to set
     * @return redirect        redirects to sucess page
     * 
     * @since 1.0
     * @author DeDevelopers
     * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
     */
    public function status($id,$status){

        $result = $this->key->get_key_by_id($id);

        if(!$result){

            $this->session->set_flashdata('err','Invalid request.');
            redirect('admin/404_page');

        }

        $key_status = 1;

        if($status == 1){

            $key_status = 0;

        }

        $dbData['status'] = $key_status;
        $dbData['updated_at'] = date('Y-m-d H:i:s');
        $dbData['updated_by'] = $this->session->userdata('admin_id');

        $this->db->where('id',$id);
        $this->db->update('keyys',$dbData);
        $this->session->set_flashdata('msg','Key status updated successfully!');
        redirect('admin/keys');
    }
    /**
     * loads the add view, then handles the submitted data
     * 
     * @param integer $id id of row in database
     * 
     * @since 1.0
     * @author DeDevelopers
     * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
     */
    public function edit($id){

        $result = $this->key->get_key_by_id($id);
        $this->data["the_id"] = $id;

        if(!$result){

            $this->session->set_flashdata('err','Invalid request.');
            redirect('admin/404_page');

        }

        $this->data['data'] = $result;


        $input = "title";
        $this->form_validation->set_rules($input,'Title','trim|required|callback_check_key_edit['.$id.']');

        $this->form_validation->set_message('required','This field is required.');
        $this->form_validation->set_message('alpha_numeric_spaces','Only alphabet and numbers are allowed.');
        
        if($this->form_validation->run() === false){
            $this->data['title'] = 'Edit Key';
            
            $this->data['content'] = $this->load->view('backend/keys/edit',$this->data,true);
             
            $this->load->view('backend/common/template',$this->data);
        }else{


            $dbData['title'] = $this->input->post('title');


            $dbData['updated_at'] = date('Y-m-d H:i:s');
            $dbData['updated_by'] = $this->session->userdata('admin_id');
           
            $this->db->where("id",$id);
            $this->db->update('keyys',$dbData);


            $key_id = $id;

            
            $this->db->where("key_id",$key_id)->delete("user_keys");
            foreach($this->input->post("users") as $user_id)
            {
                $survey = $this->db->where("id",$user_id)->get("keyys")->result_object()[0];
                $this->db->insert("user_keys",array(
                    "key_id"=>$key_id,
                    "user_id"=>$user_id,
                    "search_elem"=>$survey->title
                ));


                $this->send_notif($key_id,$user_id);
            }

            $this->session->set_flashdata('msg','key updated successfully!');
            redirect('admin/keys');

        }
    }
    /**
     * validation check
     * 
     * @since 1.0
     * @author DeDevelopers
     * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
     */
    public function check_key_edit($title,$id){

        $result = $this->key->get_key_by_title($title);
        if(!empty($title)) {
            if ($result->num_rows() > 0) {
                $result = $result->row();
                if($result->id == $id){
                    return true;
                }else{
                    $this->form_validation->set_message('check_key_edit', 'This key already exist.');
                    return false;
                }
            } else {
                return true;
            }
        }else{
            $this->form_validation->set_message('check_key_edit', 'This field is required.');
            return false;
        }
    }
    /**
     * deletes the row in database and moves it to trash
     * 
     * @param  integer $id id of row to move to trash
     * @return redirect     back to listing page
     * 
     * @since 1.0
     * @author DeDevelopers
     * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
     */
    public function delete($id){
        $result = $this->key->get_key_by_id($id);

        if(!$result){

            $this->session->set_flashdata('err','Invalid request.');
            redirect('admin/404_page');

        }
        $dbData['deleted_by'] = $this->session->userdata('admin_id');
        $dbData['is_deleted'] = 1;
        $this->db->where('id',$id);
        $this->db->update('keyys', $dbData);
        $this->session->set_flashdata('msg', 'Key deleted successfully!');
        redirect('admin/keys');
    }

    /**
     * removes the row (and it's related data) in database permanently
     * 
     * @param  integer $id id of row to remove
     * @return redirect     back to listing page
     * 
     * @since 1.0
     * @author DeDevelopers
     * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
     */
    public function remove($id){
        $result = $this->db->where("id",$id)->where("is_deleted",1)->get("keyys")->result_object()[0];
        if(!$result){

            $this->session->set_flashdata('err','Invalid request.');
            redirect('admin/404_page');
        }
        $this->db->where('id',$id);
        $this->db->delete('keyys');
        $this->session->set_flashdata('msg', 'Key deleted permanently!');
        redirect('admin/keys');
    }
}
