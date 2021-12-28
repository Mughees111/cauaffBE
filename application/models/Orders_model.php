<?php

class Orders_model extends CI_Model{
	
	public function get_all_orders($field='id',$order = 'DESC')
	{
        $result = $this->db->query('
			SELECT *
			FROM orders
			WHERE is_deleted  = 0
			AND junk = 0
			ORDER BY '.$field.' '.$order.'
			'
        );

        return $result;

	}

	public function get_all_trash_orders($field='id',$order = 'DESC')
	{
        $result = $this->db->query('
			SELECT *
			FROM orders
			WHERE is_deleted  = 1
			AND junk = 0
			ORDER BY '.$field.' '.$order.'
			'
        );

        return $result;

	}

    public function get_all_active_orders($field='id',$order = 'DESC')
    {
        $result = $this->db->query('
			SELECT *
			FROM orders
			WHERE is_deleted  = 0
			AND status  = 1
			AND junk = 0
			ORDER BY '.$field.' '.$order.'
			'
        );

        return $result;

    }
	public function get_order_by_title($title)
	{
        $result = $this->db->query('
			SELECT *
			FROM orders
			WHERE is_deleted  = 0
			AND junk = 0
			AND title = "'.$title.'"
			'
        );

        return $result;

	}

	public function get_order_by_id($id){

        $result = $this->db->query('
			SELECT *
			FROM orders
			WHERE is_deleted  = 0
			AND id = '.$id.'
			AND junk = 0
			ORDER BY id DESC
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
