<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Seo_Pagination{

	var $total_records = 0; //Total Number of records based on the query
	var $records_per_page = 20;
	var $current_page = 0;
	var $link_address = '';
	var $links_to_display = 10; //number of links to display
	
	var $str_links = '';
	var $page_number = 0;
	var $home_links = '';
	
	var $ordinary_links_start_count = 1;
	var $current_page_in_home = false; //Returns true if the current page is a homepage SMS and false if not
	
	function __construct(){
		//Nothing here
	}
	
	function set_homepage_links($links){
		$this->home_links = $links;
	}
	
	function get_homepage_links(){
		$links = $this->home_links;
		$num_sms = $links['num_sms'] / RECORDS_PER_PAGE;
		$this->ordinary_links_start_count = ceil($num_sms) + 1;
		
		$str = '';
		for($x = 1; $x <= ceil($num_sms); $x++){
			$suffix =  ($x == 1) ? '' : '-'.$x;
			
			if($links['subcategory_url'].$suffix == $this->current_page || ($x == 1 && $this->current_page == '')){
				$str .= '<span class="current">'. $x .'</span>';
				$this->page_number = ($x - 1);
				$this->current_page_in_home = true;
			}else
				$str .= '<a href="'.$this->link_address.'/'.$links['subcategory_url'].$suffix.'">'.$x.'</a>';
		}
		return $str;
	}
	
	private function make_link_pages($links){
		
		$this->str_links = '<div class="pages">';
		if($this->home_links != '')
			$this->str_links .= $this->get_homepage_links();
		
		$y = 0;
		$num_sms = 0;
		for($x = 0; $x < count($links); $x++){
			$num_sms = $links[$x]['num_sms'];
			$suffix = '';
			$suffix_count = 1;
			
			if($num_sms > 0){
				do{
					if($suffix_count > 1) $suffix = '-'.$suffix_count;
					if($links[$x]['subcategory_url'].$suffix == $this->current_page){
						$this->str_links .= '<span class="current">'. ($y + $this->ordinary_links_start_count) .'</span>';
						$this->page_number = $y;
					}else
						$this->str_links .= '<a href="'.$this->link_address.'/'.$links[$x]['subcategory_url'].$suffix.'">'.
						($y + $this->ordinary_links_start_count).
						'</a>';
					
					$num_sms -= $this->records_per_page;
					$suffix_count++;
					$y++;
				}while($num_sms > 0);
			}
		}
		
		$this->str_links .= '<br style="clear:both"></div>';
		if($y == 1)
			$this->str_links = ''; //don't show pagination if there is only 1 page
	}
	
	function get_current_page_number(){
		return $this->page_number;
	}
	
	function get_page_links($links){
		$this->make_link_pages($links);
		return $this->str_links;
	}
	
	function current_is_in_home(){ //returns the value of $this->current_page_in_home
		return $this->current_page_in_home;
	}
	
}
?>