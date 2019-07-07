<?php
defined('BASEPATH') OR exit('No direct script access allowed');

	/**
	 * 
	 */
	class Blog_model extends CI_Model
	{
		
		public function __construct()
		{
			$this->load->database();
		}

		public function get_blog(){
			$this->db->select('*');
			$this->db->from('posts');
			$query = $this->db->get();
			return $query->result_array();
		}

		public function save_blog($title, $body){
			$data = array('posttitle' => $title, 'postdescription' => $body);
			return $this->db->insert('posts', $data);
		}
	}