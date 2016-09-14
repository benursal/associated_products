<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		
		//$this->has_logged_in();
		
		//$this->header_file = 'login_header';
		//$this->footer_file = 'login_footer';
	}
	
	function index()
	{
		$u = new User();
		$u->get();
		echo $u->all_to_json();
	}
	
	
}
?>