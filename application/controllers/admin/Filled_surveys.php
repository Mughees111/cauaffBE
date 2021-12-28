<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * handles the surveys
 * 
 * @since 1.0
 * @author DeDevelopers
 * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
 */
class Filled_surveys extends ADMIN_Controller {
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
        $this->redirect_role(9);
        $this->data['active'] = 'filled_surveys';
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

        $this->data['title'] = 'Filled Surveys';
        $this->data['sub'] = 'filled_surveys';
        $this->data['js'] = 'listing';
        $this->data['jsfile'] = 'js/general_listing';
        $this->data['content'] = $this->load->view('backend/filled_surveys/listing',$this->data,true);
        $this->load->view('backend/common/template',$this->data);
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

        $result = $this->db->where("id",$id)->get("filled_surveys")->result_object()[0];

        if(!$result){

            $this->session->set_flashdata('err','Invalid request.');
            redirect('admin/404_page');

        }

        $survey_status = $status;

       

        $dbData['status'] = $survey_status;
        $dbData['updated_at'] = date('Y-m-d H:i:s');
        $dbData['updated_by'] = $this->session->userdata('admin_id');

        $this->db->where('id',$id);
        $this->db->update('filled_surveys',$dbData);
        $this->session->set_flashdata('msg','Survey status updated successfully!');
        redirect('admin/filled_surveys');
    }
    
    //5f1000142aa0fec124b8be33e7d91386
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
        $result = $this->db->where("id",$id)->where("is_deleted",1)->get("filled_surveys")->result_object()[0];
        if(!$result){

            $this->session->set_flashdata('err','Invalid request.');
            redirect('admin/404_page');
        }
        $this->db->where('id',$id);
        $this->db->delete('filled_surveys');
        $this->session->set_flashdata('msg', 'Survey deleted permanently!');
        redirect('admin/filled_surveys');
    }
}
