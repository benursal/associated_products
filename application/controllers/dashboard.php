<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends User_Controller
{
	function __construct()
	{
		parent::__construct();
		
		//$this->has_logged_in();
		
		//$this->header_file = 'login_header';
		//$this->footer_file = 'login_footer';
	}
	
	function index()
	{
		$data['page_title'] = 'Dashboard';
		
		// get quotations
		$q = new Quotation();
		$q->order_by('id', 'DESC');
		$q->where('status', 1);
		$q->limit(7, 0);
		$q->get();
	
		// get purchase orders
		$p = new Purchase_Order();
		$p->order_by('id', 'DESC');
		$p->where('status', 1);
		$p->limit(7, 0);
		$p->get();
		
		$data['quotations'] = $q;
		$data['purchase_orders'] = $p;
		
		
		$this->output('dashboard', $data);
	}
	
	function shit()
	{
		echo $this->session->shit();
	}
	
	function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('remember_me');

		redirect('users/login');
	}
	
}
?>