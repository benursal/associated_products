<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Nice_Pagination{

	var $total_records = 0; //Total Number of records based on the query
	var $records_per_page = 15;
	var $current_page = 0;
	var $link_address = '';
	var $links_to_display = 10; //number of links to display
	
	var $str_links = '';
	var $page_number = 0;
	
	function __construct(){
		//Nothing here
	}
	
	private function make_link_pages(){
		
		$num_pages = ceil($this->total_records / $this->records_per_page);
		
		$this->str_links = '<div class="pages">';
		
		$y = 0;
		for($x = 0; $x < $num_pages; $x++){
			//set suffix
			if($x == 0)
				$suffix = '';
			else
				$suffix = '-'.($x + 1);
			//set pages	
			if($x == $this->current_page) //If Current Page
				$this->str_links .= '<span class="current">'. ($x + 1) .'</span>';
			else{
				$this->str_links .= '<a href="'.$this->link_address.$suffix.'">'. ($x + 1).'</a>';
			}
		}
		
		$this->str_links .= '<br style="clear:both"></div>';
		if($num_pages == 1)
			$this->str_links = ''; //don't show pagination if there is only 1 page
	}
	
	function get_current_page_number(){
		return $this->page_number;
	}
	
	function get_page_links(){
		$this->make_link_pages();
		return $this->str_links;
	}
	
}
?>