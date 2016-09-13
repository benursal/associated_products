<?php
class Front_Controller extends MY_Controller
{
	// default value
	// send reminders to patient starting 7 days before lab test schedule
	var $test_days_notification;
	// send reminders to patient starting 13 days before the next pickup of medicines
	var $med_days_notification;
	// default number of days to next lab test
	var $days_to_next_lab_test;
	
	function __construct()
	{
		parent::__construct();
		//$this->show_profiler();
	}
	
	// get user details
	function query_user()
	{
		$u = new User();
		$u->where('login_username', $this->session->userdata('usir_nim'))->get();
		// the name of the user
		$this->session->set_userdata('pangalan', $u->name);
		// user type
		$this->session->set_userdata('usir_tayp', $u->user_type);
	}
	
	function intialize_settings()
	{
		$s = new Setting();
		$s->get();
			
		foreach( $s->all as $row )
		{
			// medication
			if( $row->setting_name == 'medicine_notification_days' )
			{
				$this->med_days_notification = $row->setting_value;
			}
			elseif( $row->setting_name == 'lab_notification_days' ) // lab test
			{
				$this->test_days_notification = $row->setting_value;
			}
			elseif( $row->setting_name == 'days_from_last_lab_test' ) // days to next test
			{
				$this->days_to_next_lab_test = $row->setting_value;
			}
		
		}
	}
	
	//checks if user has logged in
	//Is used to prevent going to Signup and Login pages when already logged in
	function check_login()
	{	
		//check if the email address is not set
		if( !$this->session->userdata('usir_nim') )
		{
			redirect('login');
		}
		
	}
	
	function is_admin()
	{
		if( $this->session->userdata('usir_tayp') < 2)
		{
			redirect('errors/access_denied');
		}
	}
	
	
}

?>