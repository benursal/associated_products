<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends User_Controller
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
		$u = new Delivery();
		$u->get();
		$result = $u->all_to_array();
		$this->show_pre( $result );
	}
	
	
	
}
?>