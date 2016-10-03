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
		
	}
	
	function save_delivery()
	{
		
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