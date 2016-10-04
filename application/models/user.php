<?php
class User extends DataMapper 
{	
	var $table = 'preparer';
	
	function __construct($id = NULL)
    {
        parent::__construct($id);
    }
	
	function convert_password( $raw_pw )
	{
		$password = md5( SALT . $raw_pw . SALT );
		return substr($password, 0, 32);
	}
}
?>