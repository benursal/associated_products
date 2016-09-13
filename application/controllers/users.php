<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends Front_Controller
{
	function __construct()
	{
		//$this->header_file = 'user/login_header';
		//$this->footer_file = 'user/login_footer';
		
		parent::__construct();
		
		//Include Form Validation Library
		$this->load->library('form_validation');
		// select footer nav
		$this->footer_data['current_menu'] = 'navUsers';
	}
	
	// list patients
	function index()
	{
		$this->search();
	}
	
	function search()
	{
		//$this->show_profiler();
		
		$this->load->library('ben_pagination');
		
		// get the keyword
		$keyword = $this->input->get('keyword');
		$page = ( $this->input->get('page') != '' ) ? $this->input->get('page') : 1;
		
		$rows_per_page = 5;
		
		// Create user object
		$p = new User();
		
		// if there is a search done
		if( $keyword )
		{
			$p->group_start();
			$p->or_like('login_username', $keyword);
			$p->or_like('name', $keyword);
			$p->group_end();
		}
		
		// status must be 1
		$p->order_by('login_username ASC');
		$p->where('status', 1);
		$p->get_paged( $page, $rows_per_page ); // 5 rows at a time
		
		// append to the url
		$data['url_append'] = "?keyword=$keyword&page=";
		$data['current_page'] = $page;
		
		//
		if( $page > 1 && !$p->exists() )
		{
			redirect( 'users/search' . $data['url_append'] . ($page - 1) );
		}
		
		$this->ben_pagination->total_records = $p->count();
		$this->ben_pagination->records_per_page = $rows_per_page;
		$this->ben_pagination->current_page = $page;
		$this->ben_pagination->link_address = site_url('users/search'.$data['url_append']);
		
		$data['pagination'] = $this->ben_pagination->get_page_links();
		
		
		$data['p'] = $p; //get the object
		$data['page_title'] = 'Users List';	
		$data['user_type'] = $this->session->userdata('usir_tayp');	
		$data['keyword'] = $keyword;
		
		$this->output('user/users', $data);
	}
	
	// add new user 
	function add_new()
	{
		$this->is_admin();
		
		$data['page_title'] = 'Add New User';
		$this->output('user/add_new_user', $data);
	}
	
	// Edit User
	function edit( $username = '' )
	{
		$this->is_admin();
		
		//$this->show_profiler();
		
		$p = new User();
		$p->where('login_username', $username)->get();
		
		if( $p->exists() )
		{
			$data['p'] = $p;
			$data['my_profile'] = false; // if it is my profile
			$data['page_title'] = "Edit User - $p->login_username";
			
			$this->output('user/edit_user', $data);
		}
		else
		{
			show_errors();
		}
	}
	
	// Edit User
	function my_profile()
	{
		
		//$this->show_profiler();
		
		$p = new User();
		$p->where('login_username', $this->session->userdata('usir_nim'))->get();
		
		if( $p->exists() )
		{
			$data['p'] = $p;
			$data['page_title'] = "My Profile";
			$data['my_profile'] = true; // if it is my profile
			
			$this->output('user/edit_user', $data);
		}
		else
		{
			show_errors();
		}
	}
	
	function update_user( $redirect = '')
	{
		//$this->is_admin();
		
		$p = new User();
		$p->where('id', $this->input->post('userID'))->get();
		
		if( $p->exists() )
		{
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('user_type', 'User Type', 'required');
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			
			// if there is a password
			if( $this->input->post('password') != '' || $this->input->post('confirm_password') != '' )
			{
				$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
				$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
			}
			
			if ($this->form_validation->run() == FALSE)
			{
			
				$pat = array(
					'id' => $p->id,
					'login_username' => $p->login_username,
					'name' => set_value('name'),
					'user_type' => set_value('user_type')
				);
				
				$data['p'] = (object) $pat;
				
				if( $redirect != 'my_profile' )
				{
					$data['page_title'] = "Edit User - $p->login_username";
					$data['my_profile'] = false;
				}
				else
				{
					$data['page_title'] = "My Profile";
					$data['my_profile'] = true; // if it is my profile
				}
				
				$this->output('user/edit_user', $data);
			}
			else
			{
				// update
				//If successful
				$p->name = $this->input->post('name');
				$p->user_type = $this->input->post('user_type');
				
				// if there is a password
				if( $this->input->post('password') != '' || $this->input->post('confirm_password') != '' )
				{
					//Add salt before and after the password and convert to MD5
					$p->password = md5(SALT.$this->input->post('password').SALT);
				}
				
				//Save New User
				if( $p->save() )
				{
					// set message session data
					$this->session->set_userdata('success_message', 'User record updated successfully');
					// created
					redirect('users/'.$redirect);
				}
				else
				{
					echo 'an error has occured while saving...';
				}
			}
		}
		else
		{
			show_errors();
		}
	}
	
	// Create User
	function create_user()
	{
		$this->is_admin();
		
		/*Set Validation Rules*/
		//Check Email address
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|is_unique[users.login_username]');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('user_type', 'User Type', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
		$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
		
		$this->form_validation->set_message('is_unique', 'Username <u>' . $this->input->post('username') . '</u> already exists');
		
		//Run Validator
		if ($this->form_validation->run() == FALSE)
		{
			//An error has occured
			$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
			$this->add_new();
		}
		else
		{
			//If successful
			$user = new User();
			$user->login_username = $this->input->post('username');
			$user->name = $this->input->post('name');
			$user->user_type = $this->input->post('user_type');
			//Add salt before and after the password and convert to MD5
			$user->password = md5(SALT.$this->input->post('password').SALT);
			//Current Date and Time as Registered datetime
			$user->datetime_created = date('Y-m-d H:i:s');
			
			//Save New User
			if( $user->save() )
			{
				// set message session data
				$this->session->set_userdata('success_message', 'New user successfully created');
				// created
				redirect('users');
			}
			else
			{
				echo 'an error has occured while saving...';
			}
		}

	}
	
	function logout()
	{
		$this->session->unset_userdata('usir_nim');
		redirect('login');
	}
	
	function test()
	{
		$to = "benursal@hotmail.com";
		$subject = "Test mail";
		$message = "Hello! This is a simple email message.";
		$from = "benursal@gmail.com";
		$headers = "From:" . $from;
		mail($to,$subject,$message,$headers);
		echo "Mail Sent.";
	}
	
	function delete_selected_users()
	{
		$this->is_admin();
		
		//$this->show_profiler();
		
		// if there are
		if( $this->input->post() )
		{
			// get patients that have been checked
			$p = new User();
			$p->where_in('id', $this->input->post('cb_patient_id'))->get();
			
			// delete
			if( $p->delete_all() )
			{
				$this->session->set_userdata('success_message', 'The selected users have been successfully deleted.');
				//redirect to search
				redirect('users/search?keyword=' . $this->input->get('keyword') . '&page=' . $this->input->get('page'));
			}
			else
			{
				show_errors('An error has occured while deleting...');
			}
			
		}
		else
		{
			//redirect to search
			redirect('patients');
		}
	}
	
	// delete user individually
	function delete_user( $username = '' )
	{
		$this->is_admin();
		
		//$this->show_profiler();
		
		// if there are
		if( $username != '' )
		{
			// get user
			$p = new User();
			$p->where('login_username', $username)->get();
			
			// update status to 0
			if( $p->delete() )
			{
				$this->session->set_userdata('success_message', 'User record has been successfully deleted.');
				//redirect to search
				redirect('users/search?keyword=' . $this->input->get('keyword') . '&page=' . $this->input->get('page'));
			}
			else
			{
				show_errors('An error has occured while deleting...');
			}
			
		}
		else
		{
			//redirect to search
			redirect('users');
		}
	}
}
?>