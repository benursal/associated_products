<?php
class Front_Controller extends MY_Controller
{
	
	function __construct()
	{
		parent::__construct();
		
		$this->check_login();
	}
	
	function check_login()
	{	
		//check if the email address is not set
		if( $this->session->userdata('username') )
		{
			//if not set, redirect to login page
			redirect('dashboard');
		}
	}
}

?>