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
		// load pagination library
		$this->load->library('ben_pagination');
		
		$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
		$keyword = (isset($_GET['keyword'])) ? $_GET['keyword'] : '';
		
		$data['page_title'] = 'List of Suppliers';
		
		// get details
		$suppliers = new Supplier();
		$suppliers->group_start();
		$suppliers->like('name', $keyword);
		$suppliers->or_like('address', $keyword);
		$suppliers->or_like('sID', $keyword);
		$suppliers->group_end();
		$suppliers->where('status', 1);
		
		// clone first for later use
		$s = $suppliers->get_clone();
		
		$suppliers->get();		
		
		// set pagination
		$this->ben_pagination->total_records = $suppliers->result_count();
		$this->ben_pagination->records_per_page = RECORDS_PER_PAGE;
		$this->ben_pagination->current_page = $page;
		$this->ben_pagination->link_address = site_url() . 'suppliers/search?keyword='.$keyword.'&page=';
		$this->ben_pagination->links_to_display = 10;
		
		// query with limit
		$s->order_by('name', 'ASC');
		$s->limit(RECORDS_PER_PAGE, (($page - 1) * RECORDS_PER_PAGE));
		$s->get();
		
		$data['rows'] = $s;
		$data['pagination'] = $this->ben_pagination->get_page_links();
		
		// external js
		$data['js_assets'] = array(
			site_url('assets/suppliers.js')
		);
		
		$this->output('suppliers/supplier_list', $data);
		
		#$this->show_profiler();
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
	
	/*function save_supplier()
	{
		if( $this->is_ajax() )
		{
			$s = new Supplier();
			$s->sID = $this->create_code( $this->input->post('name') );
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
	}*/
	
	function save_supplier()
	{
		if( $this->is_ajax() )
		{
			$val = ucwords( $this->input->post('supplier_name') );
			
			$r = new Supplier();
			$r->where('name', $val);
			$r->get();
			
			if( !$r->exists() )
			{
				$sID = $this->create_code($val);
				
				$a = new Supplier();
				$a->sID = $sID;
				$a->name = $val;
				$a->address = ucwords( $this->input->post('supplier_address') );
				
				$save = $a->save();
				
				if( $save )
				{
					echo $a->sID;
				}
				else
				{
					echo 'ERROR';
				}
			}
			else
			{
				echo 'EXISTS';
			}
		}
		//$this->show_profiler();
	}
	
	function create_code( $name = '' )
	{
		$code = '';
		
		$n = explode(' ', $name);
		foreach( $n as $val )
		{
			$code .= substr($val, 0, 1);
		}
		
		$code .= substr(md5(date('Ymds')), 4, 4);
		return $code;
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
	
	function igits()
	{
		$s = new Supplier();
		$s->where('name', 'Jackie Chan');
		$s->where('id !=', 28);
		$s->get();
		
		$this->show_profiler();
	}
	
	function update_supplier()
	{
		if( $this->is_ajax() )
		{
			$id = $this->input->post('id');
			$name = $this->input->post('name');
			
			// check if it exists
			$s = new Supplier();
			$s->where('name', $name);
			$s->where('id !=', $id);
			$s->get();
			
			if( $s->exists() ) // 
			{
				echo 'EXISTS';
			}
			else
			{
				$s = new Supplier();
				$s->where('id', $id);
				$s->get();
				
				$s->name = $name;
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