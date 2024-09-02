<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userpi extends CI_Controller {
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
		$this->db->select('buku.*, GROUP_CONCAT(kategori.kategori SEPARATOR ", ") as kategori')
		->from('buku')
		->join('buku_kategori', 'buku.id_buku = buku_kategori.id_buku')
		->join('kategori', 'buku_kategori.id_kategori = kategori.id_kategori')
		->where('buku.stok >', 0)
		->group_by('buku.id_buku');

		$data['books'] = $this->db->get()->result_array();
		$data['users'] = $this->db->get_where('user', ['role' => $this->session->userdata('role')])->row();
		$data['title'] = 'User ';

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('user/user_v');
		$this->load->view('template/footer');
	}

	public function user_pinjam() {
		$user_id = $this->session->userdata('user_id'); //user is logged in
	
		$this->db->select('pinjam.*, buku.judul, buku.penerbit, buku.pengarang, kategori.kategori')
         ->from('pinjam')
         ->join('buku', 'pinjam.id_buku = buku.id_buku')
         ->join('buku_kategori', 'buku.id_buku = buku_kategori.id_buku')
         ->join('kategori', 'buku_kategori.id_kategori = kategori.id_kategori')
		//  ->join('denda', 'denda.id_pinjam = pinjam.id_pinjam', 'left')
         ->where('pinjam.id_user', $user_id)
         ->where('pinjam.status', 'Dipinjam')
         ->group_by(['pinjam.id_pinjam', 'kategori.kategori', 'buku.judul','buku.pengarang', 'buku.thn_terbit']);

		$data['borrowed_books'] = $this->db->get()->result_array();

		$data['users'] = $this->db->get_where('user', ['role' => $this->session->userdata('role')])->row();
		$data['title'] = 'My Borrowed Books';
	
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('user/user_borrowed', $data);
		$this->load->view('template/footer');
	}
	
}
