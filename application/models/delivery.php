<?php
class Delivery extends DataMapper 
{	
	var $table = 'delivery';
	
	function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}
?>