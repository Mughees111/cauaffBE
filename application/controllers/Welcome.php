<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;

class Welcome extends ADMIN_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		redirect("/admin");
	}
	public function postDetails($id)
	{
		$data["id"] = $id;
		$this->load->view("frontend/post",$data);
	}

}
