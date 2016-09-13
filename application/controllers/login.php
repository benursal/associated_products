<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		
		$this->has_logged_in();
		
		$this->header_file = 'login_header';
		$this->footer_file = 'login_footer';
	}
	
	function index()
	{
		$this->login();
	}
	
	function login( $error = null, $username = null )
	{
		$data['page_title'] = 'User Login';
		$data['message'] = $error;
		$data['username'] = $username;
		
		$this->output('login', $data);
	}
	
	//Process User Login
	function process_login()
	{
		//$this->show_profiler();
		if( !$this->input->post('user_login') || !$this->input->post('user_password') )
		{
			//Call "login" function of this controller
			//Add a parameter which is the error message
			$this->login('Please complete all fields');
		}
		else
		{
			//check database
			$user = new User();
			$user->where('login_username', $this->input->post('user_login'));
			$user->where('password', md5(SALT.$this->input->post('user_password').SALT));
			$user->where('status', 1);
			$user->get();
			//Check email address and password exists
			if( $user->exists() )
			{
				$this->session->set_userdata('usir_nim', $this->input->post('user_login'));
				redirect('reminders');
				//echo 'congrats';
			}
			else
			{
				//If invalid email address and password combination
				//Show Login Form with Error message
				$this->login('Incorrect Username / Password', $this->input->post('user_login'));
			}
		}
		
	}
	
	function has_logged_in()
	{	
		//check if the email address is not set
		if( $this->session->userdata('usir_nim') )
		{
			redirect('reminders');
		}
		
	}
}
?>