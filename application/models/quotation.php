<?php
class Quotation extends DataMapper 
{	
	var $table = 'quotation';

	function __construct($id = NULL)
    {
        parent::__construct($id);
    }
	
	function generate_number()
	{
		$this->where('year', date('Y'));
		$this->select_max('transNum');
		$this->get();
		
		//echo $this->result_count();
		
		if( $this->exists() && $this->transNum != '' ) // if there is an existing record
		{
			return $this->increment_transaction_number( $this->transNum );			
		}
		else // if there are no existing records yet 
		{
			return '001-'.date('Y');
		}
		
	}
	
	// increments transaction number by 1
	function increment_transaction_number( $trans_number )
	{
		$val = explode('-',$trans_number);
		$newNum = $val[0]+1;
		$newNum = trans_number_prefix( strlen( $newNum ), $newNum );
		
		return $newNum.'-'.date('Y');
	}
}
?>