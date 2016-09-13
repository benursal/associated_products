<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('secure_site_url'))
{
    function secure_site_url( $url = '' )
	{
		$CI =& get_instance();
		return $CI->config->item('secure_base_url') . $url;
	}
}

if ( ! function_exists('secure_redirect'))
{
	function secure_redirect($uri = '', $method = 'location', $http_response_code = 302)
	{
		$CI =& get_instance();
		$uri = $CI->config->item('secure_base_url') . $uri;

		switch($method)
		{
			case 'refresh'	: header("Refresh:0;url=".$uri);
				break;
			default			: header("Location: ".$uri, TRUE, $http_response_code);
				break;
		}
		exit;
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