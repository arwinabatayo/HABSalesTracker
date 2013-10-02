<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_cost_of_sales extends CI_Model
{
	var $table_name = 'cost_of_sales';
	
	function __construct()
	{
		parent::__construct();

		return $this->db->table_exists($this->table_name); //Check if table exists
	}
	
	
	
	
	/* =Setters
	-------------------------------------------------------------- */
	function setNewCostOfSale($cost_of_sale_data = array())
	{
		$this->db->set('cost_of_sale_id',$cost_of_sale_data['cost_of_sale_id']);
		$this->db->set('project_id',$cost_of_sale_data['project_id']);
		$this->db->set('type',$cost_of_sale_data['type']);
		$this->db->set('budget',$cost_of_sale_data['budget']);
		$this->db->set('created',date('Y-m-d G:i:s'));
		
		$this->db->insert($this->table_name);
		return $cost_of_sale_data['cost_of_sale_id'];
	}
	
	function setUpdateCostOfSale($cost_of_sale_id,$cost_of_sale_data = array())
	{
		$this->db->where('cost_of_sale_id',$cost_of_sale_id);
		$this->db->set('type',$cost_of_sale_data['type']);
		$this->db->set('budget',$cost_of_sale_data['budget']);
		$this->db->update($this->table_name);
		return $this->db->affected_rows();
	}
	

	
	
	
	/* =Getters
	-------------------------------------------------------------- */
	function getCostOfSaleByProjectId($project_id)
	{
		$this->db->where("project_id",$project_id);
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	function getCostOfSaleByIdAndProjectId($cost_of_sale_id,$project_id)
	{
		$this->db->where("cost_of_sale_id",$cost_of_sale_id);
		$this->db->where("project_id",$project_id);
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	
	
	
	/* =Checkers
	-------------------------------------------------------------- */
	function costOfSaleIdExists($cost_of_sale_id)
	{
		$this->db->select('cost_of_sale_id');
		$this->db->where('cost_of_sale_id',$cost_of_sale_id);
		$result = $this->db->get($this->table_name);
		return ($result->num_rows() == 1) ? true : false;
	}
}