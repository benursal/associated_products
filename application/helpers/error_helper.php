<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('show_errors'))
{
    function show_errors( $message = 'An error has occured' )
	{
		$CI =& get_instance();
		
		echo '<h1>' . $message . '</h1>';
	}
}

?>