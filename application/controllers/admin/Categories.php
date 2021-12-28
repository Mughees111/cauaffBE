<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * handles the Categories
 * 
 * @since 1.0
 * @author DeDevelopers
 * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
 */
class Categories extends ADMIN_Controller {
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
        $this->data['active'] = 'category';
        $this->load->model('categories_model','category');
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

		$this->data['title'] = 'Categories';
        $this->data['sub'] = 'categories';
        $this->data['js'] = 'listing';
        $this->data['jsfile'] = 'js/categories_listing';
        $this->data['categories'] = $this->category->get_all_categories();
		$this->data['content'] = $this->load->view('backend/categories/listing',$this->data,true);
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

        $this->data['title'] = 'Trash Categories';
        $this->data['sub'] = 'trash';
        $this->data['js'] = 'listing';
        $this->data['jsfile'] = 'js/categories_listing';
        $this->data['categories'] = $this->category->get_all_trash_categories();
        $this->data['content'] = $this->load->view('backend/categories/trash',$this->data,true);
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
        $this->db->update('categories', $dbData);
        $this->session->set_flashdata('msg', 'Category restored successfully!');
        redirect('admin/trash-categories');
    }
    /**
     * loads the add view, then handles the submitted data
     * 
     * @since 1.0
     * @author DeDevelopers
     * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
     */
	public function add (){

       
        $input = "title";
	    $this->form_validation->set_rules($input,'Title','trim|required|callback_check_category');

        $this->form_validation->set_message('required','This field is required.');
        $this->form_validation->set_message('alpha_numeric_spaces','Only alphabet and numbers are allowed.');
	    if($this->form_validation->run() === false){
            $this->data['title'] = 'Add New Category';
            $this->data['sub'] = 'add-category';
           
           
            $this->data['content'] = $this->load->view('backend/categories/add',$this->data,true);
            $this->load->view('backend/common/template',$this->data);
        }else{
           
            $input = "title";
	        $dbData['title'] = $this->input->post($input);

	        $dbData['slug'] = slug($this->input->post($input));


            $input = "forground_color";
            $dbData['forground_color'] = $this->input->post($input);
            $input = "background_color";
            $dbData['background_color'] = $this->input->post($input);

            $dbData["color_id"] = $this->input->post("color_id");


	      
	        $dbData['created_at'] = date('Y-m-d H:i:s');
	        $dbData['created_by'] = $this->session->userdata('admin_id');
	        $dbData['updated_at'] = date('Y-m-d H:i:s');
            $dbData['updated_by'] = $this->session->userdata('admin_id');
          



            $this->db->insert('categories',$dbData);

          
            $this->session->set_flashdata('msg','New Category added successfully!');
            redirect('admin/categories');

        }
    }
    /**
     * validation check
     * 
     * @since 1.0
     * @author DeDevelopers
     * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
     */
    public function check_category($title){

	    $result = $this->category->get_category_by_title($title);
	    if(!empty($title)) {
            if ($result->num_rows() > 0) {
                $this->form_validation->set_message('check_category', 'This category already exist.');
                return false;
            } else {
                return true;
            }
        }else{
            $this->form_validation->set_message('check_category', 'This field is required.');
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

        $result = $this->category->get_category_by_id($id);

        if(!$result){

            $this->session->set_flashdata('err','Invalid request.');
            redirect('admin/404_page');

        }

        $category_status = 1;

        if($status == 1){

            $category_status = 0;

        }

        $dbData['status'] = $category_status;
        $dbData['updated_at'] = date('Y-m-d H:i:s');
        $dbData['updated_by'] = $this->session->userdata('admin_id');

        $this->db->where('id',$id);
        $this->db->update('categories',$dbData);
        $this->session->set_flashdata('msg','Category status updated successfully!');
        redirect('admin/categories');
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

        $result = $this->category->get_category_by_id($id);
        $this->data["the_id"] = $id;

        if(!$result){

            $this->session->set_flashdata('err','Invalid request.');
            redirect('admin/404_page');

        }

        $this->data['data'] = $result;



    
        $input = "title";
        $this->form_validation->set_rules($input,'Title','trim|required|callback_check_category_edit['.$id.']');

        
        $this->form_validation->set_message('required','This field is required.');
        $this->form_validation->set_message('alpha_numeric_spaces','Only alphabet and numbers are allowed.');
        
        if($this->form_validation->run() === false){
            $this->data['title'] = 'Edit Category';
          
            $this->data['content'] = $this->load->view('backend/categories/edit',$this->data,true);
             
            $this->load->view('backend/common/template',$this->data);
        }else{
           
           
            $input = "title";
            $dbData['title'] = $this->input->post($input);

            $dbData['slug'] = slug($this->input->post($input));
            $dbData["color_id"] = $this->input->post("color_id");

            $input = "forground_color";
            $dbData['forground_color'] = $this->input->post($input);
            $input = "background_color";
            $dbData['background_color'] = $this->input->post($input);

            $dbData['created_at'] = date('Y-m-d H:i:s');
            $dbData['created_by'] = $this->session->userdata('admin_id');
            $dbData['updated_at'] = date('Y-m-d H:i:s');
            $dbData['updated_by'] = $this->session->userdata('admin_id');
                
                $this->db->where("id",$row_id);
                $this->db->update('categories',$dbData);

            $this->session->set_flashdata('msg','Category updated successfully!');
            redirect('admin/categories');

        }
    }
    /**
     * validation check
     * 
     * @since 1.0
     * @author DeDevelopers
     * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
     */
    public function check_category_edit($title,$id){

        $result = $this->category->get_category_by_title($title);
        if(!empty($title)) {
            if ($result->num_rows() > 0) {
                $result = $result->row();
                if($result->id == $id){
                    return true;
                }else{
                    $this->form_validation->set_message('check_category_edit', 'This category already exist.');
                    return false;
                }
            } else {
                return true;
            }
        }else{
            $this->form_validation->set_message('check_category_edit', 'This field is required.');
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
        $result = $this->category->get_category_by_id($id);

        if(!$result){

            $this->session->set_flashdata('err','Invalid request.');
            redirect('admin/404_page');

        }
        $dbData['deleted_by'] = $this->session->userdata('admin_id');
        $dbData['is_deleted'] = 1;
        $this->db->where('id',$id);
        $this->db->update('categories', $dbData);
        $this->session->set_flashdata('msg', 'Category deleted successfully!');
        redirect('admin/categories');
    }
    public function display_order()
    {
        // $result = $this->category->get_category_display_order();

        // if(!$result){

        //     $this->session->set_flashdata('err','Invalid request.');
        //     redirect('admin/404_page');

        // }

        $this->data['data'] = $result;
        $this->form_validation->set_rules('json_order','Title','trim|required');
       
        if($this->form_validation->run() === false){
            $this->data['title'] = 'Edit Categories Display Order';
            $this->data['jsfile'] = "js/categories_display_order";
            $this->data['categories'] = $this->db->where('is_deleted',0)
            ->order_by('display_priority',"ASC")
            ->where('parent',0)
            ->get('categories');

            $this->data['content'] = $this->load->view('backend/categories/display_order',$this->data,true);
             
            $this->load->view('backend/common/template',$this->data);
        }else{


            $json_order = $this->input->post('json_order');
            $json_order = json_decode($json_order);
            $i = 1;
            foreach ($json_order as $json_order_key => $json_order_value) {
                $this->db->where('id',$json_order_value->id)
                ->update('categories',array(
                    'parent'=>0,
                    'display_priority'=>$i
                ));
                $i++;

                foreach($json_order_value->children as $child)
                {
                    $this->db->where('id',$child->id)->update('categories',array('parent'=>$json_order_value->id,'display_priority'=>$i));
                    $i++;
                }
            }
            
            // $this->db->where('id',$id);
            // $this->db->update('categories', $dbData);
            $this->session->set_flashdata('msg', 'Category updated successfully!');
            redirect($_SERVER['HTTP_REFERER']);

        }
    }
}
