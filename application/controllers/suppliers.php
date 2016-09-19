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
	
	// search
	function search()
	{
		$data['page_title'] = 'List of Suppliers';
		
		// get details
		$suppliers = new Supplier();
		$suppliers->where('status', 1);
		$suppliers->get();
		
		$data['rows'] = $suppliers;
		
		// external js
		$data['js_assets'] = array(
			'suppliers.js'
		);
		
		$this->output('suppliers/supplier_list', $data);
	}
	
	// add new
	function add_new()
	{
		$data['page_title'] = 'Add New Supplier';
		
		// get details
		$suppliers = new Supplier();
		$suppliers->get();
		
		$data['rows'] = $suppliers;
		
		$this->output('suppliers/add_new', $data);
	}
	
	// edit
	function edit( $id )
	{
		$data['page_title'] = 'List of Suppliers';
		
		// get details
		$suppliers = new Supplier();		
		$suppliers->get();
		
		$data['rows'] = $suppliers;
		
		$this->output('suppliers/supplier_list', $data);
	}
	
	
	/* stateless */
	function remove( $id = '' )
	{
		
	}
	
}
?>