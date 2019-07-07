<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Blogs extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		
	}

	public function index(){
		$this->load->view('templates/header2');
		$this->load->view('templates/footer2');
	}

	public function show_blog(){
		$this->load->model('blog_model');
		$data['data'] = $this->blog_model->get_blog();
		$this->load->view('templates/header2');
		$this->load->view('blogs/blogs_view', $data);
		$this->load->view('templates/footer2');
	}

	public function create_blog(){
		$this->load->model('blog_model');
		//$this->load->library('session');
		$this->load->view('templates/header2');
		$this->load->view('blogs/blog_create');
		$this->load->view('templates/footer2');
		if ($this->input->post('save')) {
			$title = $this->input->post('title');
			$body = $this->input->post('body');
			if ($title == "" || $body == "") {
				echo 'field is empty';
			}else{
				if ($this->blog_model->save_blog($title, $body)) {
				$this->session->set_flashdata('message', 'Added Sucessfully!!!');
				 redirect('blogs/create_blog');
			}else{
				echo 'no data';
			}
			}
			
		}
	}
}