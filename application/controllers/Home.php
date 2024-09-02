<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
        if(!$this->session->userdata('is_logged_in') == true)
		{
			redirect('auth');
		}
        // $this->load->model('M_data');
        // $this->load->library('form_validation');
        // $this->load->library('pagination');
        // $this->load->helper('url');
        // $this->load->helper('text');
        // $this->load->helper('date');
        // $this->load->helper('download');
        // $this->load->helper('file');
        // $this->load->helper('cookie');
        // $this->load->helper('number');
        // $this->load->helper('xml');
        // $this->load->helper('csv');
        // $this->load->helper('array');
        // $this->load->helper('string');
        // $this->load->helper
	}

	public function index()
	{
		$data['title'] = 'Home';
		$data['users'] = $this->db->get_where('user', ['role' => $this->session->userdata('role')])->row();

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('dashboard');
		$this->load->view('template/footer');
	}
}
