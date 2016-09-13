<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Errors extends Front_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function access_denied()
	{
	
		$this->load->view('access_denied');
		
	}
}
?>