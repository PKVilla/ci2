<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Sample extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
	}

	public function index(){
		$this->load->view('email/email_list_view');
	}
}