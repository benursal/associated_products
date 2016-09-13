<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Paypal Class
 *
 * This class supports paypal payment
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		Jed O. Hatamosa
 * @link		
 */
class Paypal {
	
	//variable for paypal payment url
	//var $paypal_url = 'https://www.paypal.com/cgi-bin/webscr';
	var $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
	
	//variable fir port listener
	//options: 80 for http and 443 for ssl or https
	var $port_listener = 80;
	
	//variable that holds the last error
	var $error = '';
	
	//variable for paypal fields
	var $fields = array();
	
	//variable for IPN posted data
	var $ipn_data = array();
	
	var $ipn_data_str = '';
	
	//variable for IPN validation response
	var $ipn_response = array();
	
	//variable for IPN log file
	var $ipn_log_file = 'ipnlogs.log';
	
	var $ipn_log = 1;
	
	

	/**
	 * Constructor
	 *
	 * Initializes the Paypal class
	 *
	 * @access	public
	 */
	function Paypal()
	{	
		
	}
	
	
	/**
	 * sets the variables to new values
	 *
	 * accepts associative array config
	 *
	 * @access	public
	 * @param	array $config
	 * @return	none
	 */
	function set_config($config = '')
	{
		if($config != ''){
			if(isset($config['url']))
				$this->paypal_url = $config['url'];
			if(isset($config['port']))
				$this->port_listener = $config['port'];
			if(isset($config['log_file']))
				$this->ipn_log_file = $config['log_file'];
		}
	}
	
	
	/**
	 * adds new paypal field
	 *
	 * accepts string $key and string $value
	 *
	 * @access	public
	 * @param	string $key, string $value
	 * @return	Boolean
	 */
	function add_field($key, $value)
	{
		$this->fields[$key] = $value;
	}
	
	
	/**
	 * submits added fields to paypal
	 *
	 *
	 * @access	public
	 * @param	none
	 * @return	none
	 */
	function submit()
	{
?>
		<!DOCTYPE html>
		<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
		<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
		<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
		<head>
		<meta charset="utf-8" />

		  <meta name="viewport" content="width=device-width" />

		  <title>Rebalancing Act | Paypal Payment</title>

		  <script>
			function load()
			{
				//alert('tae');
				var str = '<form method="post" name="paypal_form" action="<?php echo $this->paypal_url;?>">' + 
			<?php
			foreach ($this->fields as $key => $value) {
				echo '\'<input type="hidden" name="'.$key.'" value="'.$value.'" />\' + ';
			}
			?>
			'<input type="hidden" name="charset" value="utf-8">' + 
			'<div id="interstitial">' + 
				'<div class="row">' + 
					'<div class="twelve columns">' + 
						'<img src="<?php echo secure_site_url(); ?>assets/images/logo.png" alt="Rebalancing Act" />' + 
						'<h1>We\'re processing your order</h1>' + 
						'<p>You will be taken to the PayPal website shortly.</p>' + 
					'</div>' + 
				'</div>' + 
			'</div>' + 
			'<input type="submit" class="button" value="Click here" style="visibility:hidden" />' + 
			'</form>';
				document.getElementById('processing').innerHTML = str;
				document.paypal_form.submit();
				//alert(str);
			}
		  </script>
		  <noscript><h1>Javascript must be enabled to complete this transaction</h1></noscript>
		</head>
		<body id="processing" onLoad="load()">
			
		</body>
		</html>
		
		
		
<?php
	}
	
	
	/**
	 * validates the posted values from IPN
	 *
	 *
	 * @access	public
	 * @param	none
	 * @return	Boolean
	 */
	function validate_ipn()
	{

		$paypal_url = parse_url($this->paypal_url);  
		
		// read the post from PayPal system and add 'cmd'
		$request = 'cmd=_notify-validate';
		$this->ipn_data_str = '';
		foreach ($_POST as $key => $value) {
			/* if(($key == 'txn_type' && ($value != 'web_accept' && $value != 'subscr_payment')) || ($key == 'reason_code' && $value == 'refund')){
			 $log_msg = 'Refund by QQ through Paypal';
			 log_message('error',$log_msg);
			 $this->last_error = 'Refund by QQ through Paypal';
			 $this->log_ipn_results(true);
			 //return false;       
			} */
			
			if($key != 'custom'){
				$value = urlencode(stripslashes($value));
				$value = preg_replace('/(.*[^%^0^D])(%0A)(.*)/i','${1}%0D%0A${3}',$value);
			}
			$request .= "&$key=$value";
			$this->ipn_data_str .= "&$key=$value";
			$this->ipn_data[$key] = urldecode($value);
		}
		 $log_msg = 'updated Values';
		 log_message('error',$log_msg.' '.print_r($request,true));
		 $this->last_error = 'Original Values';
		 $this->log_ipn_results(true);
		// post back to PayPal system to validate
		$header = "POST /cgi-bin/webscr HTTP/1.0\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: " . strlen($request) . "\r\n\r\n";
		
		$fp = fsockopen ($paypal_url['host'], $this->port_listener, $errno, $errstr, 30);
		 
		
		if (!$fp) {
			//cannot open connection
			$this->last_error = "fsockopen error no. $errnum: $errstr";
			//$this->log_ipn_results(true); 
			$log_msg = 'Transaction : FP PROBLEM '."fsockopen error no. $errnum: $errstr";
			log_message('error',$log_msg);
			 return false;
		} else {
			$log_msg = 'Transaction : NO PROBLEM SA FP ';
			log_message('error',$log_msg);
			
			fputs ($fp, $header . $request);
	
			$log_msg = 'ANTIS WHILE';
			log_message('error',$log_msg);
			
			while (!feof($fp)) {
				$log_msg = 'SULOD WHILE ANTIS FGETS';
				log_message('error',$log_msg);
				$this->ipn_response .= fgets($fp, 1024);
				#$this->ipn_response .= stream_get_contents($fp, 1024);
				$log_msg = 'SULOD WHILE TAPUS FGETS';
				log_message('error',$log_msg);
			}
			
			fclose ($fp);
		}
		
		$log_msg = 'LAB-OT GWA SA WHILE ';
		log_message('error',$log_msg);
		
		//if (eregi("VERIFIED",$this->ipn_response)) {
			 // Valid IPN transaction.
			 $this->log_ipn_results(true);
			 $log_msg = 'Transaction : Verified';
			 log_message('error',$log_msg.' '.$this->ipn_response);
			 return true;       
		 
		/*} else {
			 // Invalid IPN transaction.  Check the log for details.
			 $this->last_error = 'IPN Validation Failed.';
			 $this->log_ipn_results(true); 
			 $log_msg = 'Transaction : Not Verified';
			 log_message('error',$log_msg.' '.$this->ipn_response);
			 return false;
		 
		}*/
	}
	
	
	
	/**
	 * logs the ipn results
	 *
	 *
	 * @access	public
	 * @param	$success
	 * @return	none
	 */
	function log_ipn_results($success) {
       
      if (!$this->ipn_log) 
	  	return;  // is logging turned off?
      
      // Timestamp
      $text = '['.date('m/d/Y g:i A').'] - '; 
      
      // Success or failure being logged?
      if ($success) 
	  	$text .= "SUCCESS!\n";
      else 
	  	$text .= 'FAIL: '.$this->last_error."\n";
      
      // Log the POST variables
      $text .= "IPN POST Vars from Paypal:\n";
      foreach ($this->ipn_data as $key=>$value) {
         $text .= "$key=$value, ";
      }
 
      // Log the response from the paypal server
      $text .= "\nIPN Response from Paypal Server:\n ".$this->ipn_response;
      
      // Write to log
      $fp=fopen($this->ipn_log_file,'a');
      fwrite($fp, $text . "\n\n"); 

      fclose($fp);  // close file
   }
	
	
}
// END Paypal class

/* End of file Paypal.php */
/* Location: ./system/application/libraries/Paypal.php */