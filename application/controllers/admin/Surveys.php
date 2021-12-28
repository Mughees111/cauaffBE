<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * handles the surveys
 * 
 * @since 1.0
 * @author DeDevelopers
 * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
 */
class Surveys extends ADMIN_Controller {
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
        $this->redirect_role(8);
        $this->data['active'] = 'survey';
        $this->load->model('surveys_model','survey');
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

        $this->data['title'] = 'Surveys';
        $this->data['sub'] = 'surveys';
        $this->data['js'] = 'listing';
        $this->data['jsfile'] = 'js/general_listing';
        $this->data['surveys'] = $this->survey->get_all_surveys();
        $this->data['content'] = $this->load->view('backend/surveys/listing',$this->data,true);
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

        $this->data['title'] = 'Trash Surveys';
        $this->data['sub'] = 'trash';
        $this->data['js'] = 'listing';
        $this->data['jsfile'] = 'js/general_listing';
        $this->data['surveys'] = $this->survey->get_all_trash_surveys();
        $this->data['content'] = $this->load->view('backend/surveys/trash',$this->data,true);
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
        $this->db->update('surveys', $dbData);
        $this->session->set_flashdata('msg', 'Survey restored successfully!');
        redirect('admin/trash-surveys');
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
        $this->form_validation->set_rules($input,'Title','trim|required|callback_check_survey');

       
        $this->form_validation->set_message('required','This field is required.');
        $this->form_validation->set_message('alpha_numeric_spaces','Only alphabet and numbers are allowed.');
        if($this->form_validation->run() === false){
            $this->data['title'] = 'Add New Survey';
            $this->data['sub'] = 'add-survey';
           
            $this->data['content'] = $this->load->view('backend/surveys/add',$this->data,true);
            $this->load->view('backend/common/template',$this->data);
        }else{
            $dbData['title'] = $this->input->post('title');
            $dbData['link'] = $this->input->post('link');

           
            $dbData['created_at'] = date('Y-m-d H:i:s');
            $dbData['created_by'] = $this->session->userdata('admin_id');
            $dbData['updated_at'] = date('Y-m-d H:i:s');
            $dbData['updated_by'] = $this->session->userdata('admin_id');


            $this->db->insert('surveys',$dbData);


            $survey_id = $this->db->insert_id();

            $this->db->where("survey_id",$survey_id)->delete("survey_keys");
            foreach($this->input->post("keys") as $key_id)
            {
                $key = $this->db->where("id",$key_id)->get("keyys")->result_object()[0];
                $this->db->insert("survey_keys",array(
                    "survey_id"=>$survey_id,
                    "key_id"=>$key_id,
                    "search_elem"=>$key->title
                ));
            }


            $this->session->set_flashdata('msg','New Survey added successfully!');
            redirect('admin/surveys');

        }
    }
    /**
     * validation check
     * 
     * @since 1.0
     * @author DeDevelopers
     * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
     */
    public function check_survey($title){

        $result = $this->survey->get_survey_by_title($title);
        if(!empty($title)) {
            if ($result->num_rows() > 0) {
                $this->form_validation->set_message('check_survey', 'This survey already exist.');
                return false;
            } else {
                return true;
            }
        }else{
            $this->form_validation->set_message('check_survey', 'This field is required.');
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

        $result = $this->survey->get_survey_by_id($id);

        if(!$result){

            $this->session->set_flashdata('err','Invalid request.');
            redirect('admin/404_page');

        }

        $survey_status = 1;

        if($status == 1){

            $survey_status = 0;

        }

        $dbData['status'] = $survey_status;
        $dbData['updated_at'] = date('Y-m-d H:i:s');
        $dbData['updated_by'] = $this->session->userdata('admin_id');

        $this->db->where('id',$id);
        $this->db->update('surveys',$dbData);
        $this->session->set_flashdata('msg','Survey status updated successfully!');
        redirect('admin/surveys');
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

        $result = $this->survey->get_survey_by_id($id);
        $this->data["the_id"] = $id;

        if(!$result){

            $this->session->set_flashdata('err','Invalid request.');
            redirect('admin/404_page');

        }

        $this->data['data'] = $result;


        $input = "title";
        $this->form_validation->set_rules($input,'Title','trim|required|callback_check_survey_edit['.$id.']');

        $this->form_validation->set_message('required','This field is required.');
        $this->form_validation->set_message('alpha_numeric_spaces','Only alphabet and numbers are allowed.');
        
        if($this->form_validation->run() === false){
            $this->data['title'] = 'Edit survey';
            
            $this->data['content'] = $this->load->view('backend/surveys/edit',$this->data,true);
             
            $this->load->view('backend/common/template',$this->data);
        }else{


            $dbData['title'] = $this->input->post('title');
            $dbData['link'] = $this->input->post('link');


            $dbData['updated_at'] = date('Y-m-d H:i:s');
            $dbData['updated_by'] = $this->session->userdata('admin_id');
           
            $this->db->where("id",$id);
            $this->db->update('surveys',$dbData);

            // $all_survey_keys = $this->db->where("survey_id",$survey_id)->


            $survey_id = $id;

            $this->db->where("survey_id",$survey_id)->delete("survey_keys");
            foreach($this->input->post("keys") as $key_id)
            {
                $key = $this->db->where("id",$key_id)->get("keyys")->result_object()[0];
                $this->db->insert("survey_keys",array(
                    "survey_id"=>$survey_id,
                    "key_id"=>$key_id,
                    "search_elem"=>$key->title
                ));
            }



            $this->session->set_flashdata('msg','Survey updated successfully!');
            redirect('admin/surveys');

        }
    }
    /**
     * validation check
     * 
     * @since 1.0
     * @author DeDevelopers
     * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
     */
    public function check_survey_edit($title,$id){

        $result = $this->survey->get_survey_by_title($title);
        if(!empty($title)) {
            if ($result->num_rows() > 0) {
                $result = $result->row();
                if($result->id == $id){
                    return true;
                }else{
                    $this->form_validation->set_message('check_survey_edit', 'This survey already exist.');
                    return false;
                }
            } else {
                return true;
            }
        }else{
            $this->form_validation->set_message('check_survey_edit', 'This field is required.');
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
        $result = $this->survey->get_survey_by_id($id);

        if(!$result){

            $this->session->set_flashdata('err','Invalid request.');
            redirect('admin/404_page');

        }
        $dbData['deleted_by'] = $this->session->userdata('admin_id');
        $dbData['is_deleted'] = 1;
        $this->db->where('id',$id);
        $this->db->update('surveys', $dbData);
        $this->session->set_flashdata('msg', 'Survey deleted successfully!');
        redirect('admin/surveys');
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
        $result = $this->db->where("id",$id)->where("is_deleted",1)->get("surveys")->result_object()[0];
        if(!$result){

            $this->session->set_flashdata('err','Invalid request.');
            redirect('admin/404_page');
        }
        $this->db->where('id',$id);
        $this->db->delete('surveys');
        $this->session->set_flashdata('msg', 'Survey deleted permanently!');
        redirect('admin/surveys');
    }
}
