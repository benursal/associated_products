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
			$q = new Quotation();
		
			$q->year = date('Y');
			$q->date = date('Y-m-d');
			$q->custID = $this->input->post('customer');
			$q->subject = $this->input->post('subject');
			$q->delivery = $this->input->post('delivery');
			$q->validity = $this->input->post('validity');
			$q->terms = $this->input->post('terms');
			$q->attention = $this->input->post('attention');
			$q->transDescript = 'a description';
			$q->totalAmount = $this->input->post('grandTotal');
			$q->prepared = 'Ben Ursal';
			
			$is_saved = false;
			
			do{
				// generate latest transaction number
				$qo = new Quotation();
				$q->transNum = $qo->generate_number(); // assign new number to transnum
				
				// attempt to save
				$q->save();
				$is_saved = $q->id;
				
				echo $q->transNum . '<br />';
				
			}while( !$is_saved );
			
			echo 'saved now';
		
			//$this->show_pre( $_POST );
			$counter = 0;
			foreach( $this->input->post('line-total') as $row )
			{
				echo $_POST['qty'][$counter] . ' - ' . $_POST['price'][$counter] . "<br />";
				$counter++;
			}
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
	
	function igit()
	{
		echo '<iframe src="'.site_url('quotations/test').'" target="_blank"></iframe>';
		echo '<iframe src="'.site_url('quotations/test2').'" target="_blank"></iframe>';
		echo '<iframe src="'.site_url('quotations/test3').'" target="_blank"></iframe>';
		echo '<iframe src="'.site_url('quotations/test4').'" target="_blank"></iframe>';
		echo '<iframe src="'.site_url('quotations/test5').'" target="_blank"></iframe>';
		
		
	}
	
	function test()
	{
		$q = new Quotation();
		//echo $q->increment_transaction_number('213-2016');
		
		//$q->transNum = '005-2016';
		$q->year = '2016';
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
		
		
		//echo $q->save() .' - ' . $q->id;
		//$q->check_last_query();
		
		$is_saved = false;
		
		do{
			// generate latest transaction number
			$qo = new Quotation();
			$q->transNum = $qo->generate_number(); // assign new number to transnum
			
			// attempt to save
			$q->save();
			$is_saved = $q->id;
			
			echo $q->transNum . '<br />';
			
		}while( !$is_saved );
		
		echo 'saved now';
		
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
	
	function transfer()
	{
		$q = new Quotation();
		$q->get();
		
		foreach( $q as $row )
		{
			$n = explode( '-', $row->transNum );
			$row->number = (int)$n[0];
			$row->save();
			//$row->number = $q->
		}
		
	}
	
	function foreign_key()
	{
		$o = new Orderline();
		$o->where('type', 'quotation');
		$o->where('transNum IS NULL');
		$o->get();
		
		foreach( $o as $row )
		{
			//echo $row->num . '<br />';
			
			$q = new Quotation();
			$q->where('transNum', $row->num);
			$q->get();
			
			//echo '<h1>' . $q->id . '</h1>';
			$row->transNum = $q->id;			
			$row->save();
		}
		
		$this->show_profiler();
		
	}
}
?>