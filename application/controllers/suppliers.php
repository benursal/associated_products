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
			site_url('assets/suppliers.js')
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
		
		// external js
		$data['js_assets'] = array(
			site_url('assets/suppliers.js')
		);
		
		$this->output('suppliers/add_new', $data);
	}
	
	function save_supplier()
	{
		if( $this->is_ajax() )
		{
			$s = new Supplier();
			$s->sID = $this->input->post('sID');
			$s->name = $this->input->post('name');
			$s->address = $this->input->post('address');
			
			if( $s->save() )
			{
				echo $s->id;
			}
			else
			{
				echo 'ERROR';
			}
		}
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
	
	function test()
	{
		$supplier = new Supplier();
		$supplier->where('sID', 'Arizona');
		$supplier->get();
		
		//$supplier->address = 'sdf';
		
		//$supplier->update();
		
		/*echo $supplier->address . '<br />';
		echo $supplier->sID . '<br />';
		echo $supplier->name . '<br />';*/
		
		$supplier->status = 0;
		$supplier->save();
		
		$this->show_profiler();
	}
	
	/* stateless */
	function remove( $id = '' )
	{
		if( $this->is_ajax() )
		{

			$supplier = new Supplier();
			$supplier->where('sID', $id);
			$supplier->get();
			
			if( $supplier->exists() )
			{
				
				$supplier->status = 0;
				
				if( $supplier->save() )
				{
					echo 1;
				}
				else
				{
					echo 'ERROR';
				}
			}
			else
			{
				echo 'ERROR';
			}
			
		}
	}
	
}
?>