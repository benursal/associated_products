<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customers extends User_Controller
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
		
		$data['page_title'] = 'List of Customers';
		
		// get details
		$customers = new Customer();
		$customers->group_start();
		$customers->like('custName', $keyword);
		$customers->or_like('address', $keyword);
		$customers->or_like('custID', $keyword);
		$customers->group_end();
		$customers->where('status', 1);
		
		// clone first for later use
		$s = $customers->get_clone();
		
		$customers->get();		
		
		// set pagination
		$this->ben_pagination->total_records = $customers->result_count();
		$this->ben_pagination->records_per_page = RECORDS_PER_PAGE;
		$this->ben_pagination->current_page = $page;
		$this->ben_pagination->link_address = site_url() . 'customers/search?keyword='.$keyword.'&page=';
		$this->ben_pagination->links_to_display = 10;
		
		// query with limit
		$s->order_by('custName', 'ASC');
		$s->limit(RECORDS_PER_PAGE, (($page - 1) * RECORDS_PER_PAGE));
		$s->get();
		
		$data['rows'] = $s;
		$data['pagination'] = $this->ben_pagination->get_page_links();
		
		// external js
		$data['js_assets'] = array(
			site_url('assets/customers.js')
		);
		
		$this->output('customers/customer_list', $data);
		
		$this->show_profiler();
	}
	
	// add new
	function add_new()
	{
		$data['page_title'] = 'Add New Customer';
		
		// get details
		$customers = new Customer();
		$customers->get();
		
		$data['rows'] = $customers;
		
		// external js
		$data['js_assets'] = array(
			site_url('assets/customers.js')
		);
		
		$this->output('customers/add_new', $data);
	}
	
	/*function save_customer()
	{
		if( $this->is_ajax() )
		{
			$s = new Customer();
			$s->custID = $this->input->post('custID');
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
	
	function save_customer()
	{
		if( $this->is_ajax() )
		{
			$val = ucwords( $this->input->post('customer_name') );
			
			$r = new Customer();
			$r->where('custName', $val);
			$r->get();
			
			if( !$r->exists() )
			{
				$custID = $this->create_code($val);
				
				$a = new Customer();
				$a->custID = $custID;
				$a->custName = $val;
				$a->address = ucwords( $this->input->post('customer_address') );
				
				$save = $a->save();
				
				if( $save )
				{
					echo $a->custID;
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
		$s = new Customer();		
		$s->where('id', $id);
		$s->where('status', 1);
		$s->get();
		
		// page title
		$data['page_title'] = 'Edit Customer "' . $s->custName . '"';
		
		// external js
		$data['js_assets'] = array(
			site_url('assets/customers.js')
		);
		
		// the row
		$data['row'] = $s;
		
		$this->output('customers/edit_customer', $data);
	}
	
	function update_customer()
	{
		if( $this->is_ajax() )
		{
			$id = $this->input->post('id');
			$name = $this->input->post('name');
			
			// check if it exists
			$s = new Customer();
			$s->where('custName', $name);
			$s->where('id !=', $id);
			$s->get();
			
			if( $s->exists() ) // 
			{
				echo 'EXISTS';
			}
			else
			{
				$s = new Customer();
				$s->where('id', $id);
				$s->get();
				
				$s->custName = $name;
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
		$customer = new Customer();
		$customer->where('custID', 'Arizona');
		$customer->get();
		
		//$customer->address = 'sdf';
		
		//$customer->update();
		
		/*echo $customer->address . '<br />';
		echo $customer->custID . '<br />';
		echo $customer->name . '<br />';*/
		
		$customer->status = 0;
		$customer->save();
		
		$this->show_profiler();
	}
	
	/* stateless */
	function remove( $id = '' )
	{
		if( $this->is_ajax() )
		{

			$customer = new Customer();
			$customer->where('custID', $id);
			$customer->get();
			
			if( $customer->exists() )
			{
				
				$customer->status = 0;
				
				if( $customer->save() )
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