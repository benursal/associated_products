<?php
class Admin_Controller extends MY_Controller
{
	var $header_file = 'admin/header';
	var $footer_file = 'admin/footer';
	
	var $admin_id;
	var $admin_type;
	var $admin_name;
	
	function __construct()
	{
		parent::__construct();
		
		$this->admin_id = $this->session->userdata('logged_in_username');
		
		/* Update Admin information */
		$this->check_if_logged_in();
		$this->update_login_info();
	}
	//Returns an array of all the admins
	function get_all_admins()
	{
		$all_admins = array();
		
		$admin = new Admin();
		$admin->get();
		
		foreach( $admin->all as $a )
		{
			$all_admins[ $a->id ] = $a->fullname;
		}
		
		return $all_admins;
	}
	//returns an array of all the admin types
	function get_admin_types()
	{
		$admin_types = false;
		
		$type = new Admin_type();
		$type->get();
		
		foreach( $type->all as $a )
		{
			$admin_types[ $a->id ] = $a->name;
		}
		
		return $admin_types;
	}
	
	
	function update_login_info()
	{
		
		$user = new Admin( $this->admin_id );
		
		if( $user->result_count() )
		{
			//Admin Type
			$type = new Admin_type();
			$type->get_by_id( $user->type );
			
			
			$this->admin_name = $user->fullname;
			$this->admin_type = $user->type;
			
			$this->session->set_userdata('user_is_logged_in', ($user->status == 1) ? true : false);
			
			$this->session->set_userdata('logged_in_email', $user->username);
			$this->session->set_userdata('logged_in_user_full_name', $user->fullname);
			$this->session->set_userdata('logged_in_user_level', $user->type);
			$this->session->set_userdata('logged_in_user_level_name', $type->name);
			
		}
		else
		{
			$this->session->set_userdata('user_is_logged_in', false);
		}
		
	}
	
	function check_if_logged_in()
	{
		if($this->session->userdata('user_is_logged_in') != TRUE)
		{
			redirect('admin/login');
		}
	}
	
	//ajax validation for name availability
	function validate( $field, $id = '' )
	{
		//$this->show_profiler();
		$this->load->model('standard_model');
		
		$value = $this->input->post( $field );		
		if( $value )
		{
			$exists = $this->standard_model->exists( array($field => $value, 'status' => 1) );
			
			/* Used in updates */
			if( $id != '' )
			{
				$rows = $this->standard_model->get( array( 'where' => array( 'id' => $id, 'status' => 1 ), 'table_name' => $this->table_name ) );
				
				if( $rows )
				{
					if( strtolower($value) == strtolower($rows[0][$field]) )
					{
						$exists = false;
					}
				}
			}
			/*---- */
			
			if( $exists )
			{
				echo 'false';
			}
			else
			{
				echo 'true';
			}
		}
	}
	
}

?>