<?php
class Customer extends DataMapper 
{	
	var $table = 'customer';
	
	function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}
?>