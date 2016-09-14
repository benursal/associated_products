<?php
class Concurrency extends DataMapper 
{	
	var $table = 'concurrency';
	
	function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}
?>