<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchase_Orders extends User_Controller
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
		// current page
		$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
		$keyword = (isset($_GET['keyword'])) ? $_GET['keyword'] : '';
		
		// load pagination library
		$this->load->library('ben_pagination');
	
		$data['page_title'] = 'List of Purchase Orders';
		
		// query
		$sql_string = 	"SELECT po.*, supplier.id AS supplier_id, supplier.name AS supplier_name  
						FROM (po) 
						LEFT JOIN supplier ON po.supplierID = supplier.sID 
						WHERE po.transNum LIKE '%$keyword%' OR po.transDescript LIKE '%$keyword%' 
						OR supplier.name LIKE '%$keyword%' 
						ORDER BY po.id DESC";
						
		$query = $this->db->query($sql_string);
		
		
		// set pagination
		$this->ben_pagination->total_records = $query->num_rows();
		$this->ben_pagination->records_per_page = RECORDS_PER_PAGE;
		$this->ben_pagination->current_page = $page;
		$this->ben_pagination->link_address = site_url() . 'purchase_orders/search?keyword='.$keyword.'&page=';
		$this->ben_pagination->links_to_display = 10;
		
		// get the actual string with LIMIT
		$sql_string .= " LIMIT " . RECORDS_PER_PAGE . " OFFSET " . ($page - 1) * RECORDS_PER_PAGE;
		$query2 = $this->db->query($sql_string);
		
		$data['rows'] = $query2->result();
		$data['pagination'] = $this->ben_pagination->get_page_links();
		
		// external js
		$data['js_assets'] = array(
			site_url('assets/po.js')
		);
		
		$this->output('purchase_orders/po_list', $data);
		
		//$this->show_profiler();
	}
	
	
	// add new
	function add_new( $quotation_id = '' ) // $quotation_id is used to create PO from Quotation
	{
		$data['page_title'] = 'Create New Purchase Order';
		
		// get latest quotation number
		$po = new Purchase_Order();
		$data['po_number'] = $po->generate_number();
		
		// get list of customers
		$s = new Supplier();
		$s->get();
		$data['suppliers'] = $s;
		
		// get list of terms
		$t = new Term();
		$t->get();
		$data['terms'] = $t;
		
		// get list of delivery
		$d = new Delivery();
		$d->get();
		$data['deliveries'] = $d;
		
		// check if there is a quotation ID
		if( $quotation_id != '' )
		{
			$r = new Orderline();
			$r->where('type', 'quotation');
			$r->where('transNum', $quotation_id);
			$r->order_by('itemNo', 'ASC');
			$r->get();
			
			if( $r->exists() )
			{
				$data['rows'] = $r;
			}
		}
		
		// external js
		$data['js_assets'] = array(
			site_url('assets/po.js')
		);
		
		$this->output('purchase_orders/add_new', $data);
		$this->show_profiler();
	}
	
	function print_view( $id )
	{
		$sql_string = 	"SELECT po.*, 
						supplier.name AS supplier_name,
						supplier.address AS supplier_address,
						terms.termName as term_name, 
						delivery.delName as delivery_name 
						FROM (po) 
						LEFT JOIN supplier ON po.supplierID = supplier.sID 
						LEFT JOIN terms ON po.terms = terms.termNum 
						LEFT JOIN delivery ON po.delivery = delivery.delNum 
						WHERE po.id = '$id'";
						
		$query = $this->db->query($sql_string);
		
		if( $query->num_rows() > 0 )
		{
			
			$result = $query->row();
			
			$data['page_title'] = 'Printable View of PO [' . $result->transNum . ']';
			$data['row'] = $result;
			
			// get orderline
			$o = new Orderline();
			$o->where('type', 'po');
			$o->where('transNum', $result->id);
			$o->get();
			
			$data['orderline'] = $o;
			
			// set header and footer files
			$this->header_file = 'print_header';
			$this->footer_file = 'print_footer';
			
			$this->output('purchase_orders/print_view', $data);
		}
		else
		{
			echo '<h3 class="text-center">This Quotation does not exist</h3>';
		}
		
		
		//$this->show_profiler();
	}
	
	function save()
	{
		if( $this->is_ajax() )
		{
			$q = new Purchase_Order();
		
			$q->year = date('Y');
			$q->date = date('Y-m-d');
			$q->supplierID = $this->input->post('supplier');
			$q->refNo = $this->input->post('ref_no');
			$q->delivery = $this->input->post('delivery');
			$q->terms = $this->input->post('terms');
			$q->attention = $this->input->post('attention');
			$q->transDescript = $this->input->post('transaction_description');
			$q->totalAmount = $this->input->post('grandTotal');
			$q->prepared = 'Ben Ursal';
			
			$is_saved = false;
			
			do{
				// generate latest transaction number
				$qo = new Purchase_Order();
				$q->transNum = $qo->generate_number(); // assign new number to transnum
				
				// attempt to save
				$q->save();
				$is_saved = $q->id;
				
				//echo $q->transNum . '<br />';
				
			}while( !$is_saved );
			
			//echo 'saved now';
		
			//$this->show_pre( $_POST );
			$counter = 0;
			$item_number = 1;
			
			foreach( $this->input->post('line-total') as $row )
			{
				if( $row != '' && (double)$row > 0 )
				{
					// save orderline				
					$o = new Orderline();
					
					$o->transNum = $q->id;
					$o->type = 'po';
					$o->itemNo = $item_number;
					$o->qty = $_POST['qty'][$counter];
					$o->unit = $_POST['unit'][$counter];
					$o->descript = $_POST['description'][$counter];
					$o->unitPrice = $_POST['price'][$counter];
					
					$save = $o->save();
					
					
					// increment item number only on fields that have value	
					$item_number++;
				}
				
				$counter++;
			}
			
			
			$new = new Purchase_Order();
			echo $new->generate_number();
		}
		
		//$this->show_profiler();
	}
	
	function update( $trans_id = '' )
	{
		if( $this->is_ajax() && $trans_id != '' )
		{
			$q = new Purchase_Order();
			$q->where('id', $trans_id);
			$q->get();
		
			$q->supplierID = $this->input->post('supplier');
			$q->refNo = $this->input->post('ref_no');
			$q->delivery = $this->input->post('delivery');
			$q->terms = $this->input->post('terms');
			$q->attention = $this->input->post('attention');
			$q->transDescript = $this->input->post('transaction_description');
			$q->totalAmount = $this->input->post('grandTotal');
			//$q->prepared = 'Ben Ursal';
			
			$q->save();
			
			
			$counter = 0;
			$item_number = 1;
			
			$retaind_ids = array();// this array contains orderlin IDs that will be retained
			
			foreach( $this->input->post('line-total') as $row )
			{
				if( $row != '' && (double)$row > 0 )
				{
					// get orderline				
					$o = new Orderline();
					
					if( isset($_POST['ol-id'][$counter]) ) // if there is an orderline ID (this means it's an existing record)
					{
						$o->where('id', $_POST['ol-id'][$counter]);
						$o->get();
						
						// add to retained rows
						//$retaind_ids[] = $_POST['ol-id'][$counter];
					}
					
					// edit
					$o->type = 'po';
					$o->itemNo = $item_number;
					$o->transNum = $q->id;
					$o->qty = $_POST['qty'][$counter];
					$o->unit = $_POST['unit'][$counter];
					$o->descript = $_POST['description'][$counter];
					$o->unitPrice = $_POST['price'][$counter];
					
					// update / add new
					$o->save();
					
					// add to retained rows
					$retaind_ids[] = $o->id;
					
					// increment item number only on fields that have value	
					$item_number++;
				}
				
				$counter++;
			}
			
			// delete rows that have been removed
			$o = new Orderline();
			$o->where('type', 'po');
			$o->where('transNum', $trans_id);
			$o->where_not_in('id', $retaind_ids);
			$o->get();
			
			$o->delete_all();
			
			
			echo 1;
		}
		else
		{
			echo 'ERROR';
		}
		
		#$this->show_profiler();
	}
	
	function baho()
	{
		$this->show_pre( $_POST );
	}
	
	// edit
	function edit( $id )
	{
		$sql_string = 	"SELECT po.*, po.id as po_id, 
						supplier.sID AS supplier_id,
						supplier.address AS supplier_address,
						terms.termNum as term_id, 
						delivery.delNum as delivery_id 
						FROM (po) 
						LEFT JOIN supplier ON po.supplierID = supplier.sID 
						LEFT JOIN terms ON po.terms = terms.termNum 
						LEFT JOIN delivery ON po.delivery = delivery.delNum 
						WHERE po.id = '$id'";
						
		$query = $this->db->query($sql_string);
		
		if( $query->num_rows() > 0 )
		{
			
			$result = $query->row();
			
			$data['page_title'] = 'Edit Purchase Order [' . $result->transNum . ']';
			$data['row'] = $result;
			
			// get orderline
			$o = new Orderline();
			$o->where('type', 'po');
			$o->where('transNum', $result->po_id);
			$o->order_by('itemNo', 'ASC');
			$o->get();
			
			$data['orderline'] = $o;
			
			// get list of suppliers
			$c = new Supplier();
			$c->get();
			$data['suppliers'] = $c;
			
			// get list of terms
			$t = new Term();
			$t->get();
			$data['terms'] = $t;
			
			// get list of delivery
			$d = new Delivery();
			$d->get();
			$data['deliveries'] = $d;
			
			// external js
			$data['js_assets'] = array(
				site_url('assets/po.js')
			);
			
			$this->output('purchase_orders/edit', $data);
		}
		else
		{
			echo '<h3 class="text-center">This Purchase Order does not exist</h3>';
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
		$o->where('type', 'po');
		$o->where('transNum IS NULL');
		$o->get();
		
		foreach( $o as $row )
		{
			//echo $row->num . '<br />';
			
			$q = new Purchase_Order();
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