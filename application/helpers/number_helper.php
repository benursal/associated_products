<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('trans_number_prefix'))
{
    function trans_number_prefix( $len , $v )
	{
		if($len == 1)
		{
			$tae = '00'.$v;
		}
		else if($len == 2)
		{
			$tae = '0'.$v;
		}
		else if($len == 3)
		{
			$tae = $v;
		}
		
		return $tae;
		
	}
}

?>