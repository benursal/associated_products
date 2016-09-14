<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Patients extends Front_Controller
{
	function __construct()
	{
		parent::__construct();
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
		$keyword = strtolower($this->input->get('keyword'));
		$page = ( $this->input->get('page') != '' ) ? $this->input->get('page') : 1;
		
		$rows_per_page = 10;
		
		// Create patient object
		$p = new Patient();
		$p->order_by('name ASC');
		$p->where('status', 1);
		
		// if there is a search done
		if( $keyword )
		{
			$p->group_start();
			$p->like("code", $keyword);
			$p->or_like("name", $keyword);
			$p->or_like("contact_number", $keyword);
			$p->group_end();
		}
		
		// create a clone
		$p_clone = $p->get_clone();
		// execute the query in the clone
		$p_clone->get();
		
		// get a paged result
		$p->get_paged( $page, $rows_per_page ); // 5 rows at a time
		
		// append to the url
		$data['url_append'] = "?keyword=$keyword&page=";
		$data['current_page'] = $page;
		
		//
		if( $page > 1 && !$p->exists() )
		{
			redirect( 'patients/search' . $data['url_append'] . ($page - 1) );
		}
		
		$this->ben_pagination->total_records = $p_clone->result_count();
		$this->ben_pagination->records_per_page = $rows_per_page;
		$this->ben_pagination->current_page = $page;
		$this->ben_pagination->link_address = site_url('patients/search'.$data['url_append']);
		
		$data['pagination'] = $this->ben_pagination->get_page_links();
		
		$data['patients'] = $p;
		
		if( $this->is_ajax() ) // if not ajax
		{
			$this->load->view('list_patients_subview', $data);
		}
		else // if it is an ajax call
		{
			$data['page_title'] = 'Browse Patients';
			$data['keyword'] = $keyword;
			
			$this->output('list_patients', $data);
		}
	}
	
	// add new patient 
	function add_new()
	{
		$data['page_title'] = 'Add New Patient';
		$this->output('add_new_patient', $data);
	}
	
	// it's time to save the patient record
	function save_patient()
	{
		$p = new Patient();
		// get the post array
		$post = $this->input->post();
		// generate code
		$code = md5( $post['name'] . date('Y-m-d') );
		$code = substr( $code, 0, 8);
		// include code to "related"
		$post['code'] = $code;
		
		// related items
		$related = $p->from_array($post);
		
		// start saving
		if( $p->save( $related ) )
		{
			// create success message
			$this->session->set_userdata('success_message', 'Patient successful added!');
			// redirect
			redirect('patients/history/' . $code);
		}
		else
		{
			echo 'an error has occured';
		}
	}
	
	// validation for phone number
	function valid_phone_number($value)
	{
		
		if (preg_match('^(?:0|\(?\+63\)?)\d{10}', $value))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
		
	}
	
	// History
	function history( $code = '' )
	{
		//$this->show_profiler();
		
		// create patient object
		$p = new Patient();
		// match it with the code
		$p->where('code', $code);
		$p->where('status', 1)->get();
		
		// if the code matches
		if( $p->exists() )
		{
			$h = new History_type();
			$h->get();
			
			$data['page_title'] = 'Patient History';
			$data['history_types'] = $h; // history object
			$data['patient'] = $p; // patient object
			
			$this->output('history', $data);
		}
		else
		{
			show_errors();
		}
	}
	
	// save / update patient history
	function save_history()
	{
		// get the post
		$post = $this->input->post();
		// Get patient
		$p = new Patient();
		$p->where('code', $post['patient_code'])->get();
		
		// Get history type
		$h = new History_type();
		$h->where('id', $post['history_type_id'])->get();
		
		// Save history
		if( $p->save( $h ) )
		{
			$p->set_join_field( $h, 'description', $post['description'] );
			echo 1;
		}
		else
		{
			echo 'error';
		}
	}
	
	// Complaints
	function complaints( $code = '' )
	{
		//$this->show_profiler();
		
		// create patient object
		$p = new Patient();
		// match it with the code
		$p->where('code', $code);
		$p->where('status', 1)->get();
		
		// if the code matches
		if( $p->exists() )
		{
			$c = new Complaint();
			$c->where('status', 1);
			$c->where_related( $p );
			$c->order_by('date DESC');
			$c->get();
			
			$data['page_title'] = 'Patient Complaints';
			$data['complaints'] = $c; // complaint object
			$data['patient'] = $p; // patient object
			
			$this->output('complaints', $data);
		}
		else
		{
			show_errors();
		}
	}
	
	function add_new_complaint( $code = '' )
	{
		//$this->show_profiler();
		
		// create patient object
		$p = new Patient();
		// match it with the code
		$p->where('code', $code);
		$p->where('status', 1)->get();
		
		// if the code matches
		if( $p->exists() )
		{
			$data['page_title'] = 'Add New Patient Complaint';
			$data['patient'] = $p; // patient object
			
			$this->output('add_new_complaint', $data);
		}
		else
		{
			show_errors();
		}
	}
	
	function edit_complaint( $code = '', $complaint_id )
	{
		//$this->show_profiler();
		
		// create patient object
		$p = new Patient();
		// match it with the code
		$p->where('code', $code);
		$p->where('status', 1)->get();
		
		// if the code matches
		if( $p->exists() )
		{
			$c = new Complaint();
			$c->where('id', $complaint_id);
			$c->where('status', 1);
			$c->where_related( $p );
			$c->get();
			
			$data['page_title'] = 'Edit Complaint';
			$data['complaint'] = $c; // complaint object
			$data['patient'] = $p; // patient object
			
			$this->output('edit_complaint', $data);
		}
		else
		{
			show_errors();
		}
	}
	
	function save_complaint( $action = 'new' ) // or "update"
	{
		$post = $this->input->post();
		
		// create patient object
		$p = new Patient();
		// match it with the code
		$p->where('code', $post['patient_code']);
		$p->where('status', 1)->get();
		
		// if the code matches
		if( $p->exists() )
		{
			$c = new Complaint();
			$c->where('id', $post['complaint_id']);
			$c->get();
			// if update
			
			$c->details = $post['the_complaints'];
			$c->diagnosis = $post['the_diagnosis'];
			$c->date = $post['complaint_date'];
			
			$c->save();
			if( $c->save($p) )
			{
				// update or newly-added
				if( $action == 'new' )
				{
					$msg = 'New Complaint / Diagnosis added successfully';
				}
				elseif( $action == 'update' )
				{
					$msg = 'Complaint / Diagnosis updated successfully';
				}
				
				// success message
				$this->session->set_userdata('success_message', $msg);
				redirect('patients/complaints/' . $post['patient_code']);
			}
		}
		else
		{
			show_errors();
		}
	}
	
	// view patient details
	function details( $code = '' )
	{
		//$this->show_profiler();
		
		// create patient object
		$p = new Patient();
		// match it with the code
		$p->where('code', $code);
		$p->where('status', 1)->get();
		
		// if the code matches
		if( $p->exists() )
		{
			$data['page_title'] = 'Patient Details';
			$data['patient'] = $p;
			$this->output('patient_details', $data);
		}
		else
		{
			show_errors();
		}
	}
	
	// edit patient details
	function edit( $code = '' )
	{
		//$this->show_profiler();
		
		// create patient object
		$p = new Patient();
		// match it with the code
		$p->where('code', $code);
		$p->where('status', 1)->get();
		
		// if the code matches
		if( $p->exists() )
		{
			$data['page_title'] = 'Edit Patient - ' . $p->name;
			$data['patient'] = $p;
			$this->output('edit_patient', $data);
		}
		else
		{
			show_errors();
		}
	}
	
	// update patient details
	function update_patient()
	{
		$post = $this->input->post();
		// code
		$code = $post['patient_code'];
		// get patient object
		$p = new Patient();
		$p->where('code', $post['patient_code']);
		$p->where('status', 1);
		$p->get();
		
		if( $p->exists() )
		{
			unset( $post['patient_code'] );
			
			// related items
			$related = $p->from_array($post);
			
			// start saving
			if( $p->save( $related ) )
			{
				$this->session->set_userdata('success_message', 'Update successful!');
				// do a redirect
				redirect('patients/details/' . $code);
			}
			else
			{
				echo 'an error has occured';
			}
		}
	}
	
	// delete patient individually
	function delete_patient( $code = '' )
	{
		
		// get patient
		$p = new Patient();
		$p->where('code', $code);
		
		// update status to 0
		if( $p->update('status', 0) )
		{
			$p->get();
			// set success message
			$this->session->set_userdata('success_message', 'Patient <u>' . $p->name . '</u> record has been successfully deleted.');
			//redirect to search
			redirect('patients');
		}
		else
		{
			show_errors('An error has occured while deleting...');
		}
		
	}
	
	// delete complaint
	function delete_complaint( $code = '', $id = '' )
	{
		
		// get patient
		$c = new Complaint();
		$c->where('id', $id);
		
		// update status to 0
		if( $c->update('status', 0) )
		{
			// set success message
			$this->session->set_userdata('success_message', 'Complaint/diagnosis successfully deleted');
			//redirect to search
			redirect('patients/complaints/' . $code . '/' . $id);
		}
		else
		{
			show_errors('An error has occured while deleting...');
		}
		
	}
	
}
?>