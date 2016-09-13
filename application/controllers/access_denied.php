<?php
class Access_Denied extends Witt_Controller{
	function index(){
		$data['title'] = 'Access Denied';
		$data['content_title'] = 'Access Denied';
		
		$data['js'] = array();
		
		$data['content'] = '<h1>You are restricted</h1>';
		$this->parser->parse('templates/admin_template', $data);
	}
}
?>