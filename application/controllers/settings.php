<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends Front_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	
	function backup_db()
	{
		// Load the DB utility class
		$this->load->dbutil();

		// Backup your entire database and assign it to a variable
		$backup =& $this->dbutil->backup(array('format' => 'txt')); 

		// Load the file helper and write the file to your server
		$this->load->helper('file');
		// the filename
		$filename = BACKUP_PATH . 'drmonte-' . date('Y-m-d-h-i-s') . '.txt';
		// write the file
		$write = write_file($filename, $backup); 
		
		// check if successful
		if( $write )
		{
			$data['status'] = 'success';
			$data['message'] = 'Database backup successful!  The file can be found in <strong>' . $filename . '</strong>.';
			
		}
		else
		{
			$data['status'] = 'danger';
			$data['message'] = 'There was an error in backing up the database';
		}
		
		$data['page_title'] = 'Database Backup';
		$this->output('backup_view', $data);
	}
	
}
?>