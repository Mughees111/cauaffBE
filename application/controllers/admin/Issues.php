<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * handles the Push
 * 
 * @since 1.0
 * @author DeDevelopers
 * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
 */
class Issues extends ADMIN_Controller {
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
        // check_role(1);
        $this->redirect_role(10);
        $this->data['active'] = 'issues';
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
		$this->data['title'] = 'Issues';
    $this->data['sub'] = 'issues';
    $this->data['js'] = 'listing';
    $this->data['jsfile'] = 'js/faqs_listing';
    $this->data['issues'] = $this->db->get("issues");
    $this->data['content'] = $this->load->view('backend/issues/listing',$this->data,true);
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

        $result = $this->db->where("id",$id)->get("issues")->result_object()[0];

        if(!$result){

            $this->session->set_flashdata('err','Invalid request.');
            redirect('admin/404_page');

        }

       

        $dbData['status'] = $status;

        $this->db->where('id',$id);
        $this->db->update('issues',$dbData);
        $this->session->set_flashdata('msg','Issue status updated successfully!');
        redirect('admin/issues');
    }

}
