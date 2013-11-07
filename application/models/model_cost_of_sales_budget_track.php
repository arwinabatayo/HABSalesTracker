<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_cost_of_sales_budget_track extends CI_Model
{
	var $table_name = 'cost_of_sales_budget_track';
	
	function __construct()
	{
		parent::__construct();

		return $this->db->table_exists($this->table_name); //Check if table exists
	}
	
	
	
	
	/* =Setters
	-------------------------------------------------------------- */
	function setNewCostOfSalesBudgetTrack($cost_of_sale_budget_track = array())
	{
		$this->db->set('cost_of_sale_budget_track_id',$cost_of_sale_budget_track['cost_of_sale_budget_track_id']);
		$this->db->set('cost_of_sale_id',$cost_of_sale_budget_track['cost_of_sale_id']);
		$this->db->set('project_id',$cost_of_sale_budget_track['project_id']);
		$this->db->set('month',$cost_of_sale_budget_track['month']);
		$this->db->set('year',$cost_of_sale_budget_track['year']);
		$this->db->set('budget',$cost_of_sale_budget_track['budget']);
		$this->db->set('created',date('Y-m-d G:i:s'));
		
		$this->db->insert($this->table_name);
		return $cost_of_sale_budget_track['cost_of_sale_budget_track_id'];
	}
	
	function setUpdateCostOfSalesBudgetTrack($cost_of_sale_budget_track_id,$cost_of_sale_budget_track = array())
	{
		$this->db->where('cost_of_sale_budget_track_id',$cost_of_sale_budget_track_id);
		$this->db->set('budget',$cost_of_sale_budget_track['budget']);
		$this->db->update($this->table_name);
		return $this->db->affected_rows();
	}
	

	
	
	
	/* =Getters
	-------------------------------------------------------------- */
	function getCostOfSalesBudgetTrackById($cost_of_sale_budget_track_id)
	{
		$this->db->where("cost_of_sale_budget_track_id",$cost_of_sale_budget_track_id);
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	function getCostOfSalesBudgetTrackByCostOfSaleId($cost_of_sale_id)
	{
		$this->db->where("cost_of_sale_id",$cost_of_sale_id);
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	function getCostOfSalesBudgetTrackByProjectId($project_id)
	{
		$this->db->where("project_id",$project_id);
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	function getCostOfSalesBudgetTrackByCostOfSaleIdAndProjectId($cost_of_sale_id,$project_id)
	{
		$this->db->where("cost_of_sale_id",$cost_of_sale_id);
		$this->db->where("project_id",$project_id);
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	function getCostOfSalesBudgetTrackByCostOfSalesIdAndProjectIdAndYear($cost_of_sale_id,$project_id,$year)
	{
		$this->db->where("cost_of_sale_id",$cost_of_sale_id);
		$this->db->where("project_id",$project_id);
		$this->db->where("year",$year);
		$this->db->order_by("month ASC");
		$this->db->order_by("year DESC");
		$query = $this->db->get($this->table_name);
		return $query->result();
	}
	
	
	
	
	/* =Checkers
	-------------------------------------------------------------- */
	function costOfSalesBudgetTrackIdExists($cost_of_sale_budget_track_id)
	{
		$this->db->select('cost_of_sale_budget_track_id');
		$this->db->where('cost_of_sale_budget_track_id',$cost_of_sale_budget_track_id);
		$result = $this->db->get($this->table_name);
		return ($result->num_rows() == 1) ? true : false;
	}
}