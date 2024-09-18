<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		if (!$this->session->userdata('is_logged_in') == true) {
			redirect('auth');
		}
	}

	public function index($role = null)
	{
		$data['title'] = 'Data Pengguna';
		#alternatif query
		//$data['user'] = $this->db->order_by('nama', 'asc')->get('user')->result_array();
		#set sortir for role
		$this->db->from('user')->order_by('nama', 'asc');
		//ambil semua data user dengan urutan nama a-z
		if ($role and in_array($role, ['petugas', 'anggota'])) {
			//buat logika sortir yang hanya bisa dijalankan jika kedua nilai true
			$this->db->where('role', $role);
			//kondisi berdasarkan role 
		}

		$data['user'] = $this->db->get()->result_array();
		$data['users'] = $this->db->get_where('user', ['role' => $this->session->userdata('role')])->row();

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('user/user');
		$this->load->view('template/footer');
	}

	public function tambah()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim|is_unique[user.nama]');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|is_unique[user.email]');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');

		// $this->db->from('user')->where('nama', $this->input->post('nama'));
		// $quer = $this->db->get()->result_array();

		#Alternatif query
		$quer = $this->db->where('nama',  $this->input->post('nama'))->get('user')->result_array();
		// var_dump($quer);
		// die;

		if ($this->form_validation->run() == false) {
			echo '<script>alert("Gagal menyimpan data")</script>';
		} else if ($quer <> null) {
			echo '<script>alert("Nama telah tersedia")</script>';
		} else {
			$data = [
				'nama' => htmlspecialchars($this->input->post('nama')),
				'email' => htmlspecialchars($this->input->post('email')),
				'pass' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role' => $this->input->post('role'),
			];

			$this->db->insert('user', $data);
			echo '<script>alert("berhasil")</script>';
			// $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data pengguna berhasil ditambahkan!</div>');
			redirect('user');
		}
	}


	public function edit()
	{
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim');

		if ($this->form_validation->run() == true) {
			$data = [
				'nama' => htmlspecialchars($this->input->post('nama')),
				'email' => htmlspecialchars($this->input->post('email')),
				// 'pass' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role' => $this->input->post('role'),
			];
			$this->db->update('user', $data, ['id_user' => $this->input->post('id_user')]);
			echo '<script>alert("Berhasil Menambahkan Data");window.location="' . site_url('user') . '"</script>';
		} else {
			echo '<script>alert("Gagal mengupdate data")</script>';
		}
		// var_dump($quer);
	}

	public function bookDetail($id)
	{
		$book = $this->db->get_where('buku', ['id_buku' => $id])->row_array();
		$rating = $this->db->get_where('rating', ['id_buku' => $id])->result_array();

		$data['users'] = $this->db->get_where('user', ['role' => $this->session->userdata('role')])->row();
		$data['book'] = $book;
		$data['rating'] = $rating;
		$data['title'] = 'Book Details';

		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('user/ulasan', $data);
		$this->load->view('template/footer');
	}

	public function submit_review()
	{
		$inp = $this->input->post();

		$this->db->insert(
			'rating',
			[
				'id_user' => $inp['user_id'],
				'id_buku' => $inp['book_id'],
				'rating' => $inp['rating'],
				'review' => $inp['review'],
				'review_date' => date('Y-m-d H:i:s')
			]
		);

		redirect('user/bookDetail/' . $inp['book_id']);
	}

	public function delete($id)
	{
		$this->db->where('id_user', $id);
		$this->db->delete('user');

		//echo '<script>alert("berhasil");window.location=</script>';
		echo '<script>alert("Berhasil Hapus");window.location="' . site_url('user') . '"</script>';
		redirect('user');
	}
}
