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
			// get the latest transaction number
			$lastTransNum = $this->transNum;
			
			$val = explode('-',$lastTransNum);
			$newNum = $val[0]+1;
			$newNum = trans_number_prefix( strlen( $newNum ), $newNum );
			
			return $newNum.'-'.date('Y');
			
			//echo "Old: $lastTransNum, New: $newNum";
		}
		else // if there are no existing records yet 
		{
			return '001-'.date('Y');
		}
		
		
	}
}
?>