<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('datetime_db_to_app'))
{
    function datetime_db_to_app($date_time)
	{
		$CI =& get_instance();
		
		if($date_time == '0000-00-00 00:00:00' || $date_time == null)
			return '';
			
		$dt = explode(' ', $date_time);
		$date = explode('-', $dt[0]);
		$time = explode(':', $dt[1]);
		
		return date("M d, Y h:i A",mktime($time[0],$time[1],0,$date[1], $date[2], $date[0]));
		#return date("m/d/Y",mktime($time[0],$time[1],0,$date[1], $date[2], $date[0]));
	}
}

if ( ! function_exists('date_db_to_app'))
{
    function date_db_to_app($date_time, $format = "F d, Y")
	{
		$CI =& get_instance();
		
		if($date_time == '0000-00-00 00:00:00' || $date_time == null)
			return '';
		
		$dt = explode(' ', $date_time);
		$date = explode('-', $dt[0]);
		//$time = explode(':', $dt[1]);
		
		return date($format ,mktime(0, 0, 0,$date[1], $date[2], $date[0]));
	}
}


if ( ! function_exists('date_app_to_db'))
{
    function date_app_to_db($date, $format = "Y-m-d")
	{
		$CI =& get_instance();
		
		if($date == '' || $date == null)
			return '';
		
		$date = explode('/', $date);
		
		return date($format ,mktime(0, 0, 0,$date[0], $date[1], $date[2]));
	}
}

if ( ! function_exists('time_db_to_app'))
{
    function time_db_to_app($date_time)
	{
		$CI =& get_instance();
		
		if($date_time == '0000-00-00 00:00:00' || $date_time == null)
			return '';
		
		$dt = explode(' ', $date_time);
		$date = explode('-', $dt[0]);
		$time = explode(':', $dt[1]);
		
		return date("h:i A",mktime($time[0],$time[1],0,$date[1], $date[2], $date[0]));
	}
}

if ( ! function_exists('get_date_range'))
{
    function get_date_range( $date = '')
	{
		$CI =& get_instance();
		
		if($date == '')
		{
			$cur_month = (int)date('m');
			$cur_day = date('d');
			$cur_year = date('Y');
		}
		else
		{
			$date = explode('-', $date);
			
			$cur_month = (int)$date[1];
			$cur_day = $date[2];
			$cur_year = $date[0];
		}
		
		/* get date_from */
		$month = ( $cur_day <= CUTOFF_DAY ) ? $cur_month - 1 : $cur_month;
		$year = ( $month == 0 ) ? $cur_year - 1 : $cur_year;
		$month = ( $month == 0 ) ? 12 : $month;
		$day = CUTOFF_DAY + 1;
		
		if($month < 10) $month = '0'.$month;
		
		$date_array['date_from'] = $year.'-'.$month.'-'.$day;
		
		/* get date_to */
		/*  IF the current day is 1 to CUTOFF_DAY, then use the current month
			If it is greater than the CUTOFF_DAY, then add 1 to the current month
		*/
		$month = ( $cur_day <= CUTOFF_DAY ) ? $cur_month : $cur_month + 1;
		$year = ( $month == 13 ) ? $cur_year + 1 : $cur_year;
		$month = ( $month == 13 ) ? 1 : $month;
		$day = CUTOFF_DAY;
		
		if($month < 10) $month = '0'.$month;
		
		$date_array['date_to'] = $year.'-'.$month.'-'.$day;
		
		return $date_array;
	}
}

if ( ! function_exists('get_previous_date_range'))
{
    function get_previous_date_range( $date_from = '')
	{
		$CI =& get_instance();
		
		$date_array = get_date_range( str_replace('-'.(CUTOFF_DAY + 1), '-'.CUTOFF_DAY, $date_from) );
		return $date_array;
	}
}

if ( ! function_exists('days_left'))
{
    function days_left($start, $end)
	{
		$CI =& get_instance();
		
		$seconds_left = (strtotime($end) - strtotime($start));
		$days_left = $seconds_left / 3600 / 24;
		
		#return $days_left;
		if( $days_left <= 0 )
			return 0;
		elseif( $days_left <= 1 )
			return '1 day';
		else
			return ceil($days_left).' days';
	}
}

?>