<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Misc extends User_Controller // Miscellaneous (terms, delivery, validity)
{
	function __construct()
	{
		parent::__construct();		
	}
	
	function index()
	{
		//
	}
	
	function save_term()
	{
		$val = $this->input->post('term_name');
		
		$r = new Term();
		$r->where('termName', $val);
		$r->get();
		
		if( !$r->exists() )
		{
			$a = new Term();
			$a->termName = $val;
			$save = $a->save();
			
			if( $save )
			{
				//$a->get();
				echo $a->id;
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
	
	function save_delivery()
	{
		$val = $this->input->post('delivery_name');
		
		$r = new Delivery();
		$r->where('delName', $val);
		$r->get();
		
		if( !$r->exists() )
		{
			$a = new Delivery();
			$a->delName = $val;
			$save = $a->save();
			
			if( $save )
			{
				//$a->get();
				echo $a->id;
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
	
	function save_validity()
	{
		$val = $this->input->post('validity_name');
		
		$r = new Validity();
		$r->where('valName', $val);
		$r->get();
		
		if( !$r->exists() )
		{
			$a = new Validity();
			$a->valName = $val;
			$save = $a->save();
			
			if( $save )
			{
				//$a->get();
				echo $a->id;
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
		
		//$this->show_profiler();
	}
	
	function igits()
	{
		$r = new Validity();
		$r->valName = 'shit';
		$r->save();
		
		echo $r->id;
	}
	
}