<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Suppliers extends User_Controller
{
	function __construct()
	{
		parent::__construct();		
	}
	
	function index()
	{
		$this->search();
	}
	
	function search()
	{
		$data['page_title'] = 'List of Suppliers';
		
		$this->output('supplier_list', $data);
	}
	
}
?>