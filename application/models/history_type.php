<?php
class History_type extends DataMapper 
{	
	var $has_many = array(
		//Patient
		'patient' => array(
			'class' => 'patient',
			'other_field' => 'history_type',
			'join_table' => 'history_types_patients'
		)
	);
	
	function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}
?>