<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('secure_site_url'))
{
    function secure_site_url( $url = '' )
	{
		$CI =& get_instance();
		return $CI->config->item('secure_base_url') . $url;
	}
}

if ( ! function_exists('ben_js_redirect'))
{
    function ben_js_redirect( $url = '' )
	{
		echo '<script>document.location = "'.$url.'";</script>';
	}
}
?>