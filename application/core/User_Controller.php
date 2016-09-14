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
		/*$this->account = new User();
		$this->account->where( 'email', $this->session->userdata('emayl_adris') );
		$this->account->get();
		
		//check if loggedin
		$this->check_login();
		*/
	}
	
	//Must check if the user has logged in
	function check_login()
	{	
		//check if the email address is not set
		if( !$this->session->userdata('emayl_adris') )
		{
			//if not set, redirect to login page
			redirect('users/login');
		}
	}
}

?>