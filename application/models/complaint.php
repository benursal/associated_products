<?php
class Complaint extends DataMapper 
{	
	var $has_one = array(
		//Patient
		'patient' => array(
			'class' => 'patient',
			'other_field' => 'complaint'
		)
	);
	
	function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}
?>