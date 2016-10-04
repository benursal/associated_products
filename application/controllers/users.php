<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends Front_Controller
{
	function __construct()
	{
		parent::__construct();		
	}
	
	function index()
	{
		$this->login();
	}
	
	function login()
	{
		$this->load->view('user_login');
	}
	
	function process_login()
	{
		$un = $this->input->post('username');
		$pw = $this->input->post('password');
		
		$u = new User();
		$u->where('username', $un);
		$u->where('password', $u->convert_password( $pw ));
		$u->get();
		
		// if login is successful
		if( $u->exists() )
		{
			$this->session->set_userdata('username', $un);
			
			if( $this->input->post('remember_me') ) // if remember me was checked
			{
				$this->session->set_userdata('remember_me', TRUE);
			}

			redirect('dashboard');
		}
		else
		{
			$data['error_message'] = 'Invalid username / password';
			$data['username'] = $this->input->post('username');
			
			$this->load->view('user_login', $data);
		}
		
		//$this->show_profiler();
	}
	
	function validate_login()
	{
		
	}
	
	function forgot_password()
	{
		
	}
}