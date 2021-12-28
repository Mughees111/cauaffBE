<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * handles the Push
 * 
 * @since 1.0
 * @author DeDevelopers
 * @copyright Copyright (c) 2019, DeDevelopers, https://dedevelopers.com
 */
class Chat extends ADMIN_Controller {
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
        $this->data['active'] = 'chat';
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
		$this->data['title'] = 'Chat';
        $this->data['sub'] = 'push';
        $this->data['jsfile'] = 'js/push';


        $chats = $this->db->order_by("id","DESC")->get("chat")->result_object()[0];

        if(empty($chats))
        {
            $this->session->set_flashdata('err', 'No chat started yet');
            redirect($_SERVER["HTTP_REFERER"]);
            return;
        }
        redirect(base_url()."admin/chat/chat/".$chats->user_id);
	}

    public function chat($user_id=0)
    {

        $user = $this->db->where("id",$user_id)->get("users")->result_object()[0];


        $this->data['title'] = $user->first_name .' '.$user->last_name;
        $this->data['sub'] = 'chat';
        $this->data['jsfile'] = 'js/pages/chat';


        $chats = $this->db->group_by("user_id")->order_by("id","DESC")->get("chat")->result_object();

        
        $this->data['chats'] = $chats;
        $this->data['user_id'] = $user_id;
        $this->data['user'] = $user;
        $this->data['content'] = $this->load->view('backend/chat/chat', $this->data,true);
        $this->load->view('backend/common/template',$this->data);
    }

    public function get_chat()
    {


        $user_id = $this->input->post("chat_user_id");

        $user = $this->db->where("id",$user_id)->get("users")->result_object()[0];


        $this->data['title'] = $user->first_name .' '.$user->last_name;
        $this->data['sub'] = 'chat';
        $this->data['jsfile'] = 'js/pages/chat';


        $chats = $this->db->where("user_id",$user_id)->order_by("id","ASC")->get("chat")->result_object();
        

        $html = "";

        foreach($chats as $chat){
            $html .= get_chat_elem($chat,$user);
        }

        echo $html;
    }


	
	public function send()
	{
        $msg = $this->input->post("msg");
        $user_id = $this->input->post("chat_user_id");
	    $user = $this->db->where("id",$user_id)->get("users")->result_object()[0];
         $chat = array(
            "msg"=>$msg,
            "sender_id"=>$this->session->userdata('admin_id'),
            "user_id"=>$user_id,
            "admin_id"=>$this->session->userdata('admin_id'),
            "created_at"=>date("Y-m-d H:i:s")
        );

        $this->db->insert("chat",$chat);

        $id = $this->db->insert_id();


        $msg = $this->db->where("id",$id)->get("chat")->result_object()[0];



        $options = array(
            'cluster' => 'ap2',
            'useTLS' => true
          );
          $pusher = new Pusher\Pusher(
            '55cf3dd54765ba92069b',
            'd65b44a4c6f929641ede',
            '1184078',
            $options
          );

          $data['user_id'] = $user_id;
          $data["msg"] = array(
                "_id"=> $msg->id,
                "text"=> $msg->msg,
                "createdAt"=> date("Y-m-d H:i:s",strtotime($msg->created_at)),
                "user"=> array(
                  "_id"=> $this->session->userdata('admin_id'),
                  "name"=> "Admin"
                ));
          $pusher->trigger('chat-channel', 'chat', $data);


        $html = get_chat_elem($msg,$user);

        echo json_encode(array("action"=>"success","html"=>$html));
	}
}
