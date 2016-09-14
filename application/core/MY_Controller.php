<?php
class MY_Controller extends CI_Controller
{
	var $header_file = 'header';
	var $footer_file = 'footer';
	var $footer_data = array();
	
	function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Manila');
	}
	
	function output( $view, $data = array() )
	{
		$this->load->view( $this->header_file, $data );//Load Header
		$this->load->view($view, $data);//Load actual view
		$this->load->view( $this->footer_file, $this->footer_data );//Load Footer
	}
	
	function show_pre( $array )
	{
		echo '<pre>';
		print_r( $array );
		echo '</pre>';
	}
	
	function is_ajax()
	{
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') //is ajax
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	function show_profiler()
	{
		$this->output->enable_profiler(TRUE);
	}
	
}

?>