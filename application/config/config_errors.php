<?php
//configure error messages
$config['errors'] = array(
	//Job Details
	'job_type' => array(
		'required' => 'You must choose a job type'
	), 
	'job_title' => array(
		'required' => 'Please enter job title', 
	), 
	'job_category' => array(
		'required' => 'You must choose a category for this job'
	), 
	'job_location' => array(
		'required' => 'Where is this job located'
	), 
	'job_description' => array(
		'required' => 'Please enter the job description'
	), 
	'job_applic_method' => array(
		'required' => 'Please select a job application method'
	),
	/* Only Applicable to server-side validation */
	'job_apply_address' => array(
		//'required'	=> 'Please enter email address for application',
		'valid_email' => 'Please enter a valid email address',
		'valid_url' => 'Please enter a valid URL',
	),
	/* Applicable only if javascript is turned on */
	'apply_by_url'	=>	array(
		'required'	=> 'Please enter the URL',
		'url'	=> 'Please enter a valid URL'
	),
	'apply_by_email'	=>	array(
		'required'	=> 'Please enter the email address',
		'email'	=> 'Please enter a valid email address'
	),
	/* END */
	'job_tc' => array(
		'required' => 'You need to agree with our Terms and Conditions'
	),
	//Company Details
	'company_name' => array(
		'required' => 'Please enter company name', 
		'available_name' => 'Company name already exists', //checks if company name is still available
		'remote'	=> 'Company name already exists' //The same with 'available_name
	), 
	'company_website' => array(
		'valid_url' => 'Please enter valid website URL', 
		'url' => 'Please enter valid website URL', 
	), 
	'company_watcher_name' => array(
		'required' => 'Please enter name of watcher'
	), 
	'company_watcher_email' => array(
		'required' => 'Please enter watcher email address', 
		'valid_email' => 'Please enter a valid email address', 
		'email' => 'Please enter a valid email address', 
		'available_email' => 'Email address is not available', //checks if email address is still available
		'remote' => 'Email address is not available' //The same with 'available_email
	), 
	'company_logo' => array(
		'greater_than' => 'File size exceeds allowable size', 
		'not_allowed' => 'The file you selected is not an image'
	), 
);

?>