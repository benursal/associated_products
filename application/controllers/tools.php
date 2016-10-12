<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tools extends Front_Controller
{
	function __construct()
	{
		parent::__construct();		
	}
	
	function index()
	{
		echo REAL_PATH;
	}
	
	function create_backup()
	{
		// Load the DB utility class
		$this->load->dbutil();

		// Backup your entire database and assign it to a variable
		$backup =& $this->dbutil->backup(array('format' => 'sql')); 

		// Load the file helper and write the file to your server
		$this->load->helper('file');
		// the filename
		$filename = REAL_PATH . 'db/app-' . date('Y-m-d-h-i-s') . '.sql';
		// write the file
		$write = write_file($filename, $backup); 
		
		
		return $filename;
	}
	
	function send_message()
	{
		$this->load->library('email');
		
		$file_name = $this->create_backup();
		
		$this->email->attach( $file_name );
		$this->email->from('assokqgm@server226.web-hosting.com', 'Bentong');
		$this->email->to('build_17a7@sendtodropbox.com'); 
		
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');	

		$this->email->send();
		echo $this->email->print_debugger();

	}
}