<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Ben_Pagination{

	var $total_records = 0; //Total Number of records based on the query
	var $records_per_page = 20;
	var $current_page = 0;
	var $link_address = '';
	var $links_to_display = 10; //number of links to display
	
	var $str_links = '';
	
	function __construct(){
		//Nothing here
	}
	
	function refresh(){
		$this->total_records = 0; //Total Number of records based on the query
		$this->records_per_page = 20;
		$this->current_page = 0;
		$this->link_address = '';
		$this->links_to_display = 10; //number of links to display
	}
	
	private function make_link_pages(){
		$num_total_links = ceil($this->total_records / $this->records_per_page);
		$middle_link = floor( ($this->links_to_display - 1) / 2 );
		
		if($num_total_links > 1){ //If the total number of links is greater than 1 THEN display pagination
		
			if($num_total_links <= $this->links_to_display){ //If the total number of links is less than or equal to the number of links to display
				
				$start_count = 1;
				$end_count = $num_total_links;
				
			}else{ //Total Number of Links is greater than the Number of Links to Display
				if($this->current_page >= $middle_link){				
					
					$end_count = ($this->links_to_display - $middle_link) + $this->current_page;
					$end_count = ($end_count > $num_total_links) ? $num_total_links : $end_count;
					
					$start_count = $end_count - $this->links_to_display;
					
				}else{
					
					$start_count = 1;
					$end_count = $this->links_to_display;
					
				}	
			}
			
			
			$this->str_links = '<nav><ul class="pagination">';
			
			if($this->current_page > 1){
				$this->str_links .= '<li><a href="'.$this->link_address.'1">First &laquo;</a></li>';
				$this->str_links .= '<li><a href="'.$this->link_address.($this->current_page - 1).'">Previous</a></li>';
			}
			
			for($x = $start_count; $x <= $end_count; $x++){
				if($x == $this->current_page)
					$this->str_links .= '<li class="active"><a href="#">'. ($x) .'</a></li>';
				else
				{
					if( $x > 0 )
					{
						$this->str_links .= '<li><a href="'.$this->link_address.$x.'">'. ($x).'</a></li>';
					}
				}
			}
			
			if($this->current_page < $num_total_links ){
				$this->str_links .= '<li><a href="'.$this->link_address.($this->current_page + 1).'">Next</a></li>';
				$this->str_links .= '<li><a href="'.$this->link_address.($num_total_links).'">Last &raquo;</a></li>';
			}
			
			$this->str_links .= '</ul></nav>';
		}
	}
	
	function get_page_links(){
		$this->make_link_pages();
		return $this->str_links;
	}
	
}
?>