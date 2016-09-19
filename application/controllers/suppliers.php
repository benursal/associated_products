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
		
		// get details
		$suppliers = new Supplier();
		$suppliers->get();
		
		$data['rows'] = $suppliers;
		
		$this->output('supplier_list', $data);
	}
	
}
?>