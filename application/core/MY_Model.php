<?php
class MY_Model extends CI_Model{

	protected $table_name;
	
	function __construct()
	{
		parent::__construct();
	}
	
	function set_table($tbl_name)
	{
		$this->table_name = $tbl_name;
	}
	
	/**
	 * Gets all records from $this->table_name given the criteria.  No Joins. 
	 * Useful for Queries that involve One Table Only
	 *
	 * @param array or string $where - Criteria for SELECT QUERY
	 * @param string $fields - The fieldnames for the query
	 * @param string $order_by - ORDER BY keyword in a SELECT QUERY
	 * @param int $limit - LIMIT keyword
 	 * @param int $offset - the offset of a SELECT QUERY
	 * @access public
	 *
	 * @return multi-dimensional array RESULT or Query
	 */
	function get( $where = array(), $fields = '*', $order_by = '', $offset = 0, $limit = 0 )
	{
		
		$this->db->select( $fields, FALSE );
		
		if($limit != 0)
		{
			$this->db->limit( $limit , $offset );
		}
		
		if($order_by != '')
		{
			$this->db->order_by( $order_by );
		}
		
		if( (is_array( $where ) && count( $where ) > 0) || $where != '' )
		{
			$this->db->where( $where );
		}
		
		$query = $this->db->get( $this->table_name );
		
		if($query->num_rows() > 0)
		{
			return $query->result_array();
		}
		else
		{
			return false;
		}
		
	}
	
	/**
	 * Checks if a particular record already exists
	 * 
	 * @param array or string $where - Criteria for SELECT QUERY
	 * @access public
	 *
	 * @return boolean - TRUE if a record Exists and FALSE if not
	 */
	function exists($where)
	{
	
		$query = $this->db->get_where( $this->table_name, $where );
		
		if($query->num_rows == 1)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
		
	}
	
	function add( $field_values = array() )
	{
	
		if($this->db->insert( $this->table_name, $field_values) == 1 )
		{
			return $this->db->insert_id();
		}
		else
		{
			return $this->db->_error_message();
		}
		
	}
	
	function update( $field_values = array(), $where = array() )
	{
		$update = $this->db->update( $this->table_name, $field_values, $where );
		#echo $this->db->_error_message();
		return $update;
	}
	
	function delete( $where = array() )
	{
		
		if($this->db->delete( $this->table_name, $where ))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
		
	}
	
}
?>