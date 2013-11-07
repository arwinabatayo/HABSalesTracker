<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inserts extends MY_Controller
{
	function index()
	{
		$super_admin = array(
			'email' => 'arwin.a@hotairballoongroup.com',
			'password' => 'olgastrode',
			'name' => 'Arwin Abatayo',
			'role' => 'super',
			'last_ip' => $this->input->ip_address(),
			'active' => 'true',
		);
		
		$this->model_users->setNewUser($super_admin);
		
		/*
		$add_clients = array(
			'Absolute',
			'Adidas',
			'AMAES',
			'Anchor Butter',
			'Anlene',
			'Anlene CRM',
			'Ayala Life',
			'Banapple',
			'Bayer Philippines',
			"Bugsy's",
			'CDO',
			'Chowking',
			'Cobra',
			'Eton',
			'EyeFly',
			'EYP',
			'Fontera',
			'Ginebra San Miguel Inc',
			'Havianas Philippines',
			'Holcim',
			'Honda',
			'Honda City',
			'Honda CRM',
			'Isuzu',
			'Jollibee',
		);
		
		foreach ($add_clients as $v)
		{
			$this->model_clients->setNewClient(
				array(
					'user_id' => $this->session->userdata('id'),
					'name' => $v,
					'department' => 'agency',
					'active' => 'true',
				)
			);
			sleep(1);
		}
		*/
		
		/*
		$add_clients = array(
			'Absolute',
			'Adidas',
			'AMAES',
			'Anchor Butter',
			'Anlene',
			'Anlene CRM',
			'Ayala Life',
			'Banapple',
			'Bayer Philippines',
			"Bugsy's",
			'CDO',
		);
		
		foreach ($add_clients as $v)
		{
			$this->model_clients->setNewClient(
				array(
					'user_id' => $this->session->userdata('id'),
					'name' => $v,
					'department' => 'altitude',
					'active' => 'true',
				)
			);
			sleep(1);
		}
		*/
	}
}