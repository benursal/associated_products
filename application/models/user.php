<?php
class User extends DataMapper 
{	
	var $table = 'preparer';
	
	function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}
?>