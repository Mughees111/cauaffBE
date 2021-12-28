<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * handles the colors
 * 
 * @since 1.0
 * @author DeDevelopers
 * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
 */
class Colors extends ADMIN_Controller {
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
        $this->data['active'] = 'color';
        $this->load->model('colors_model','color');
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

        $this->data['title'] = 'colors';
        $this->data['sub'] = 'colors';
        $this->data['js'] = 'listing';
        $this->data['jsfile'] = 'js/general_listing';
        $this->data['colors'] = $this->color->get_all_colors();
        $this->data['content'] = $this->load->view('backend/colors/listing',$this->data,true);
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

        $this->data['title'] = 'Trash colors';
        $this->data['sub'] = 'trash';
        $this->data['js'] = 'listing';
        $this->data['jsfile'] = 'js/general_listing';
        $this->data['colors'] = $this->color->get_all_trash_colors();
        $this->data['content'] = $this->load->view('backend/colors/trash',$this->data,true);
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
        $this->db->update('colors', $dbData);
        $this->session->set_flashdata('msg', 'color restored successfully!');
        redirect('admin/trash-colors');
    }
    /**
     * loads the add view, then handles the submitted data
     * 
     * @since 1.0
     * @author DeDevelopers
     * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
     */
    public function add (){

       
        $input = "background_color";
        $this->form_validation->set_rules($input,'Title','trim|required');

        $input = "forground_color";
        $this->form_validation->set_rules($input,'Title','trim|required');

       
        $this->form_validation->set_message('required','This field is required.');
        $this->form_validation->set_message('alpha_numeric_spaces','Only alphabet and numbers are allowed.');
        if($this->form_validation->run() === false){
            $this->data['title'] = 'Add New color';
            $this->data['sub'] = 'add-color';
           
            $this->data['content'] = $this->load->view('backend/colors/add',$this->data,true);
            $this->load->view('backend/common/template',$this->data);
        }else{
            $dbData['forground_color'] = $this->input->post('forground_color');
            $dbData['background_color'] = $this->input->post('background_color');
           
            $dbData['created_at'] = date('Y-m-d H:i:s');
            $dbData['created_by'] = $this->session->userdata('admin_id');
            $dbData['updated_at'] = date('Y-m-d H:i:s');
            $dbData['updated_by'] = $this->session->userdata('admin_id');


            $this->db->insert('colors',$dbData);


            $this->session->set_flashdata('msg','New color added successfully!');
            redirect('admin/colors');

        }
    }

    
    /**
     * validation check
     * 
     * @since 1.0
     * @author DeDevelopers
     * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
     */
    public function check_color($title){

        $result = $this->color->get_color_by_title($title);
        if(!empty($title)) {
            if ($result->num_rows() > 0) {
                $this->form_validation->set_message('check_color', 'This color already exist.');
                return false;
            } else {
                return true;
            }
        }else{
            $this->form_validation->set_message('check_color', 'This field is required.');
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

        $result = $this->color->get_color_by_id($id);

        if(!$result){

            $this->session->set_flashdata('err','Invalid request.');
            redirect('admin/404_page');

        }

        $color_status = 1;

        if($status == 1){

            $color_status = 0;

        }

        $dbData['status'] = $color_status;
        $dbData['updated_at'] = date('Y-m-d H:i:s');
        $dbData['updated_by'] = $this->session->userdata('admin_id');

        $this->db->where('id',$id);
        $this->db->update('colors',$dbData);
        $this->session->set_flashdata('msg','color status updated successfully!');
        redirect('admin/colors');
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

        $result = $this->color->get_color_by_id($id);
        $this->data["the_id"] = $id;

        if(!$result){

            $this->session->set_flashdata('err','Invalid request.');
            redirect('admin/404_page');

        }

        $this->data['data'] = $result;


        $input = "background_color";
        $this->form_validation->set_rules($input,'Title','trim|required');

        $input = "forground_color";
        $this->form_validation->set_rules($input,'Title','trim|required');

        $this->form_validation->set_message('required','This field is required.');
        $this->form_validation->set_message('alpha_numeric_spaces','Only alphabet and numbers are allowed.');
        
        if($this->form_validation->run() === false){
            $this->data['title'] = 'Edit color';
            
            $this->data['content'] = $this->load->view('backend/colors/edit',$this->data,true);
             
            $this->load->view('backend/common/template',$this->data);
        }else{

            $dbData['forground_color'] = $this->input->post('forground_color');
            $dbData['background_color'] = $this->input->post('background_color');
            


         


            $dbData['updated_at'] = date('Y-m-d H:i:s');
            $dbData['updated_by'] = $this->session->userdata('admin_id');
           
            $this->db->where("id",$id);
            $this->db->update('colors',$dbData);


           
            $this->session->set_flashdata('msg','color updated successfully!');
            redirect('admin/colors');

        }
    }
    /**
     * validation check
     * 
     * @since 1.0
     * @author DeDevelopers
     * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
     */
    public function check_color_edit($title,$id){

        $result = $this->color->get_color_by_title($title);
        if(!empty($title)) {
            if ($result->num_rows() > 0) {
                $result = $result->row();
                if($result->id == $id){
                    return true;
                }else{
                    $this->form_validation->set_message('check_color_edit', 'This color already exist.');
                    return false;
                }
            } else {
                return true;
            }
        }else{
            $this->form_validation->set_message('check_color_edit', 'This field is required.');
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
        $result = $this->color->get_color_by_id($id);

        if(!$result){

            $this->session->set_flashdata('err','Invalid request.');
            redirect('admin/404_page');

        }
        $dbData['deleted_by'] = $this->session->userdata('admin_id');
        $dbData['is_deleted'] = 1;
        $this->db->where('id',$id);
        $this->db->update('colors', $dbData);
        $this->session->set_flashdata('msg', 'color deleted successfully!');
        redirect('admin/colors');
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
        $result = $this->db->where("id",$id)->where("is_deleted",1)->get("colors")->result_object()[0];
        if(!$result){

            $this->session->set_flashdata('err','Invalid request.');
            redirect('admin/404_page');
        }
        $this->db->where('id',$id);
        $this->db->delete('colors');
        $this->session->set_flashdata('msg', 'color deleted permanently!');
        redirect('admin/colors');
    }
}
