<?php

class Employees_model extends CI_Model{
	
	public function get_all_employees($field='id',$order = 'DESC')
	{
        $result = $this->db->query('
			SELECT *
			FROM employees
			WHERE is_deleted  = 0
			ORDER BY '.$field.' '.$order.'
			'
        );

        return $result;

	}
	public function get_all_trashed_employees($field='id',$order = 'DESC')
	{
        $result = $this->db->query('
			SELECT *
			FROM employees
			WHERE is_deleted  = 1
			ORDER BY '.$field.' '.$order.'
			'
        );

        return $result;

	}

    public function get_all_active_employees($field='id',$order = 'DESC')
    {
        $result = $this->db->query('
			SELECT *
			FROM employees
			WHERE is_deleted  = 0
			AND status  = 1
			ORDER BY '.$field.' '.$order.'
			'
        );

        return $result;

    }
	public function get_employee_by_email($email)
	{
        $result = $this->db->query('
			SELECT *
			FROM employees
			WHERE is_deleted  = 0
			AND email = "'.$email.'"
			'
        );

        return $result;

	}


	public function get_employee_by_employee_id($employee_id)
	{
        $result = $this->db->query('
			SELECT *
			FROM employees
			WHERE is_deleted  = 0
			AND employee_id = "'.$employee_id.'"
			'
        );

        return $result;

	}

	public function get_employee_by_id($id){

        $result = $this->db->query('
			SELECT *
			FROM employees
			WHERE is_deleted  = 0
			AND id = '.$id.'
			'
        );

        if($result->num_rows()>0){

            return $result->row();
        }else{

            return false;

        }
    }
}


?>
