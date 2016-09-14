<?php
class Quotation extends DataMapper 
{	
	var $table = 'quotation';

	function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}
?>