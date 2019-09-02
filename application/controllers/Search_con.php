<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Search_con extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
	}

	// public function index(){
	// 	$this->load->view('search');
	// }

	public function search(){
		$this->load->view('templates/header2');
		$invoice = $this->input->post('invoice');
		$data='';
		$query = $this->db->query('SELECT * FROM soa_notification WHERE invoice_no LIKE %'.$invoice.'%')->result_array();
		// print_r($query);

		$this->load->view('search');
	}
}