<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		// $this->load->helper('url');
		// $this->load->helper('text');
		// $this->load->database();
		// $this->load->library('session');
		// if ($this->session->userdata('status')!= "login") {
		// 	redirect(base_url("auth"));
		// }
		if(!$this->session->userdata('is_logged_in') == true)
		{
			redirect('auth');
		}
	}

	public function index()
	{
		$data['title'] = 'Data Kategori';
		$this->form_validation->set_rules('kategori', 'Kategori', 'required|trim|is_unique[kategori.kategori]',[
			'is_unique' => 'Kategori tersedia !!']);

        $data['kategori'] = $this->db->order_by('kategori', 'asc')->get('kategori')->result_array();
		$data['users'] = $this->db->get_where('user', ['role' => $this->session->userdata('role')])->row();

		if($this->form_validation->run() == false)
		{
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('book/kategori');
			$this->load->view('template/footer');
        } else {
				$this->db->insert('kategori', ['kategori' => $this->input->post('kategori')]);
				redirect('kategori');
		}
	}

	public function update()
	{
        $this->form_validation->set_rules('kategori', 'Kategori', 'required|trim');
		$id = $this->input->post('id_kategori');

        if($this->form_validation->run() == true)
        {
			
			$this->db->update('kategori', ['kategori' => $this->input->post('kategori')], ['id_kategori' => $id]);
			// echo '<script>alert("Berhasil!!");window.location="'.site_url('kategori').'"</script>';
			redirect('kategori');
        } else {
            echo '<script>alert("Gagal menyimpan data!!");window.location="'.site_url('kategori').'"</script>';
		}
	}

	public function delete($id)
	{
        $this->db->delete('kategori', ['id_kategori' => $id]);
		echo '<script>alert("Kategori berhasil dihapus");window.location="'.site_url('kategori').'"</script>';
        //redirect('kategori');
	}
}
