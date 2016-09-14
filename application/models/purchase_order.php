<?php
class Purchase_Order extends DataMapper 
{	
	var $table = 'po';
	
	function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}
?>