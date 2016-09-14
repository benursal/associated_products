<?php
class Supplier extends DataMapper 
{	
	var $table = 'supplier';
	
	function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}
?>