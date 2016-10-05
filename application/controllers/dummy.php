<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dummy extends Front_Controller
{
	function __construct()
	{
		parent::__construct();		
	}
	
	function index()
	{
		echo 'hello';
	}
}
?>