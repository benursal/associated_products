<?php
//Controller for Users
class User_Controller extends MY_Controller
{
	var $account;
	
	function __construct()
	{
		parent::__construct();
		
		#$this->header_file = 'user/account_header';
		#$this->footer_file = 'user/account_footer';
		
		//Get account
		$this->account = new User();
		$this->account->where( 'username', $this->session->userdata('username') );
		$this->account->get();
		
		
		$this->header_data['user'] = $this->account;
		
		//check if loggedin
		$this->check_login();
		
	}
	
	//Must check if the user has logged in
	function check_login()
	{	
		//check if the email address is not set
		if( !$this->session->userdata('username') )
		{
			//if not set, redirect to login page
			redirect('users/login');
		}
	}
}

?>