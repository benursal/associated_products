<?php
class Orderline extends DataMapper 
{	
	var $table = 'orderline';

	function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}
?>