<?php
class Patient extends DataMapper 
{	

	var $has_many = array(
		//Complaints
		'complaint' => array(
			'class' => 'complaint',
			'other_field' => 'patient'
		),
		//History
		'history_type' => array(
			'class' => 'history_type',
			'other_field' => 'patient',
			'join_table' => 'history_types_patients'
		)
	);
	
	function __construct($id = NULL)
    {
        parent::__construct($id);
    }
}
?>