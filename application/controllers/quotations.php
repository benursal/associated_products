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
		// current page
		$page = (isset($_GET['page'])) ? $_GET['page'] : 1;
		$keyword = (isset($_GET['keyword'])) ? $_GET['keyword'] : '';
		
		// load pagination library
		$this->load->library('ben_pagination');
	
		$data['page_title'] = 'List of Quotations';
		
		// query
		$sql_string = 	"SELECT quotation.*, customer.id AS customer_id, customer.custName AS customer_custName 
						FROM (quotation) 
						LEFT JOIN customer ON quotation.custID = customer.custID 
						WHERE (quotation.transNum LIKE '%$keyword%' OR quotation.transDescript LIKE '%$keyword%' 
						OR customer.custName LIKE '%$keyword%')  
						AND quotation.status = 1 
						ORDER BY quotation.date DESC, quotation.transNum DESC";
						
		$query = $this->db->query($sql_string);
		
		
		// set pagination
		$this->ben_pagination->total_records = $query->num_rows();
		$this->ben_pagination->records_per_page = RECORDS_PER_PAGE;
		$this->ben_pagination->current_page = $page;
		$this->ben_pagination->link_address = site_url() . 'quotations/search?keyword='.$keyword.'&page=';
		$this->ben_pagination->links_to_display = 10;
		
		// get the actual string with LIMIT
		$sql_string .= " LIMIT " . RECORDS_PER_PAGE . " OFFSET " . ($page - 1) * RECORDS_PER_PAGE;
		$query2 = $this->db->query($sql_string);
		
		$data['rows'] = $query2->result();
		$data['pagination'] = $this->ben_pagination->get_page_links();
		
		// external js
		$data['js_assets'] = array(
			site_url('assets/quotations.js')
		);
		
		$this->output('quotations/quotation_list', $data);
		
		//$this->show_profiler();
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
	
	function print_view( $id )
	{
		$sql_string = 	"SELECT quotation.*, quotation.id as quotation_id,  
						validity.valName AS validity_name, 
						customer.custName AS customer_name,
						customer.address AS customer_address,
						terms.termName as term_name, 
						delivery.delName as delivery_name, 
						discounts.* 
						FROM (quotation) 
						LEFT JOIN customer ON quotation.custID = customer.custID 
						LEFT JOIN terms ON quotation.terms = terms.id 
						LEFT JOIN validity ON quotation.validity = validity.id 
						LEFT JOIN delivery ON quotation.delivery = delivery.id 
						LEFT JOIN discounts ON quotation.transNum = discounts.transNum 
						WHERE quotation.id = '$id' AND quotation.status = 1";
						
		$query = $this->db->query($sql_string);
		
		if( $query->num_rows() > 0 )
		{
			
			$result = $query->row();
			
			$data['page_title'] = 'Printable View of Quotation [' . $result->transNum . ']';
			$data['row'] = $result;
			
			// get orderline
			$o = new Orderline();
			$o->where('type', 'quotation');
			$o->where('transNum', $result->quotation_id);
			$o->get();
			
			$data['orderline'] = $o;
			
			// set header and footer files
			$this->header_file = 'print_header';
			$this->footer_file = 'print_footer';
			
			$this->output('quotations/print_view', $data);
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
			$q = new Quotation();
		
			$q->year = date('Y');
			$q->date = date('Y-m-d');
			$q->custID = $this->input->post('customer');
			$q->subject = $this->input->post('subject');
			$q->delivery = $this->input->post('delivery');
			$q->validity = $this->input->post('validity');
			$q->terms = $this->input->post('terms');
			$q->attention = $this->input->post('attention');
			$q->transDescript = $this->input->post('transaction_description');
			$q->totalAmount = $this->input->post('grandTotal');
			$q->prepared = $this->account->fname . ' ' . $this->account->lname;
			
			$is_saved = false;
			
			do{
				// generate latest transaction number
				$qo = new Quotation();
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
					$o->type = 'quotation';
					$o->itemNo = $item_number;
					$o->qty = $_POST['qty'][$counter];
					$o->unit = $_POST['unit'][$counter];
					$o->descript = nl2br($_POST['description'][$counter]);
					$o->sPrice = $_POST['s-price'][$counter];
					$o->unitPrice = $_POST['price'][$counter];
					
					$save = $o->save();
					
					
					// increment item number only on fields that have value	
					$item_number++;
				}
				
				$counter++;
			}
			
			// save vat inclusion
			$d = new Discount();
			$d->transNum = $q->transNum;
			$d->inclusion = $this->input->post('vat_inclusion');
			$d->vat = $this->input->post('cb_add_vat');
			$d->rate = $this->input->post('discount_rate');
			$d->save();
			
			$new = new Quotation();
			echo $new->generate_number();
		}
	}
	
	function test_delete()
	{
		$arr = array('8835', '8837');
		$o = new Orderline();
		$o->where('type', 'quotation');
		$o->where('transNum', '10638');
		$o->where_not_in('id', $arr);
		$o->get();
		
		$o->delete_all();
		
		$this->show_profiler();
	}
	
	function update( $trans_id = '' )
	{
		if( $this->is_ajax() && $trans_id != '' )
		{
			$q = new Quotation();
			$q->where('id', $trans_id);
			$q->get();
		
			$q->custID = $this->input->post('customer');
			$q->subject = $this->input->post('subject');
			$q->delivery = $this->input->post('delivery');
			$q->validity = $this->input->post('validity');
			$q->terms = $this->input->post('terms');
			$q->attention = $this->input->post('attention');
			$q->transDescript = $this->input->post('transaction_description');
			$q->totalAmount = $this->input->post('grandTotal');
			$q->prepared = $this->account->fname . ' ' . $this->account->lname;
			
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
					$o->type = 'quotation';
					$o->itemNo = $item_number;
					$o->transNum = $q->id;
					$o->qty = $_POST['qty'][$counter];
					$o->unit = $_POST['unit'][$counter];
					$o->descript = nl2br($_POST['description'][$counter]);
					$o->sPrice = $_POST['s-price'][$counter];
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
			$o->where('type', 'quotation');
			$o->where('transNum', $trans_id);
			$o->where_not_in('id', $retaind_ids);
			$o->get();
			
			$o->delete_all();
			
			// get discount
			$d = new Discount();
			$d->where('transNum', $q->transNum);
			$d->get();
			
			// edit
			$d->inclusion = $this->input->post('vat_inclusion');
			$d->vat = $this->input->post('cb_add_vat');
			$d->rate = $this->input->post('discount_rate');
			
			// update
			$d->save();
			
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
		$sql_string = 	"SELECT quotation.*, quotation.id as quotation_id, 
						validity.id AS validity_id, 
						customer.custID AS customer_id,
						customer.address AS customer_address,
						terms.id as term_id, 
						delivery.id as delivery_id, 
						discounts.inclusion, 
						discounts.vat, 
						discounts.rate 
						FROM (quotation) 
						LEFT JOIN customer ON quotation.custID = customer.custID 
						LEFT JOIN terms ON quotation.terms = terms.id 
						LEFT JOIN validity ON quotation.validity = validity.id 
						LEFT JOIN delivery ON quotation.delivery = delivery.id 
						LEFT JOIN discounts ON quotation.transNum = discounts.transNum 
						WHERE quotation.id = '$id' AND quotation.status = 1";
						
		$query = $this->db->query($sql_string);
		
		if( $query->num_rows() > 0 )
		{
			
			$result = $query->row();
			
			$data['page_title'] = 'Edit Quotation [' . $result->transNum . ']';
			$data['row'] = $result;
			
			// get orderline
			$o = new Orderline();
			$o->where('type', 'quotation');
			$o->where('transNum', $result->quotation_id);
			$o->order_by('itemNo', 'ASC');
			$o->get();
			
			$data['orderline'] = $o;
			
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
			
			$this->output('quotations/edit', $data);
		}
		else
		{
			echo '<h3 class="text-center">This Quotation does not exist</h3>';
		}
		
		#$this->show_profiler();
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

			$row = new Quotation();
			$row->where('id', $id);
			$row->get();
			
			if( $row->exists() )
			{
				
				$row->status = 0;
				
				if( $row->save() )
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
	
	/*function foreign_key()
	{
		$o = new Orderline();
		$o->where('type', 'po');
		//$o->where('transNum IS NULL');
		$o->limit(500,1100);
		$o->get();
		
		foreach( $o as $row )
		{
			echo $row->num . '<br />';
			
			$q = new Purchase_Order();
			$q->where('transNum', $row->num);
			$q->get();
			
			echo $row->num . ' - ' . $q->id . '<br />';
			
			$row->transNum = $q->id;			
			$row->save();
		}
		
		$this->show_profiler();
		
	}*/
}
?>