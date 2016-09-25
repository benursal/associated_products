<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quotations extends User_Controller
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
		$q = new Supplier();
		$q->where('status', 1);
		$q->get();
		
		$data['rows'] = $q;
		
		// external js
		$data['js_assets'] = array(
			site_url('assets/suppliers.js')
		);
		
		$this->output('quotations/quotation_list', $data);
	}
	
	
	// add new
	function add_new()
	{
		$data['page_title'] = 'Create New Quotation';
		
		// get latest quotation number
		$q = new Quotation();
		$data['quotation_number'] = $q->generate_number();
		
		// get list of customers
		$c = new Customer();
		$c->get();
		$data['customers'] = $c;
		
		// get list of terms
		$t = new Term();
		$t->get();
		$data['terms'] = $t;
		
		// get list of delivery
		$d = new Delivery();
		$d->get();
		$data['deliveries'] = $d;
		
		// get list of validity
		$v = new Validity();
		//$c->where('status', 1);
		$v->get();
		$data['validities'] = $v;
		
		// external js
		$data['js_assets'] = array(
			site_url('assets/quotations.js')
		);
		
		$this->output('quotations/add_new', $data);
	}
	
	function save()
	{
		if( $this->is_ajax() )
		{
			/*$s = new Supplier();
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
			}*/
			
			
			
			$this->show_pre( $_POST );
		}
	}
	
	// edit
	function edit( $id )
	{
		// get details
		$s = new Supplier();		
		$s->where('id', $id);
		$s->where('status', 1);
		$s->get();
		
		// page title
		$data['page_title'] = 'Edit Supplier "' . $s->name . '"';
		
		// external js
		$data['js_assets'] = array(
			site_url('assets/suppliers.js')
		);
		
		// the row
		$data['row'] = $s;
		
		$this->output('suppliers/edit_supplier', $data);
	}
	
	function update_supplier()
	{
		if( $this->is_ajax() )
		{
			$s = new Supplier();
			$s->where('id', $this->input->post('id'));
			$s->get();
			
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
	
	function test()
	{
		$q = new Quotation();
		//echo $q->increment_transaction_number('213-2016');
		
		$q->transNum = '259-2010';
		$q->year = '2010';
		$q->date = '2010-12-21';
		$q->custID = 'dbi';
		$q->subject = 'PR# 23572812';
		$q->delivery = 2;
		$q->validity = 2;
		$q->terms = 1;
		$q->attention = 'Mr. Joel Chan';
		$q->transDescript = 'PR# 2357280 DBI RS';
		$q->totalAmount = '30807.06';
		$q->prepared = 'Harold Dy';
		
		
		echo $q->save();
		$q->check_last_query();
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