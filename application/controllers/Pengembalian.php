<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengembalian extends CI_Controller {
	function __construct(){
		parent::__construct();
		if(!$this->session->userdata('is_logged_in') == true)
		{
			redirect('auth');
		}
	}

	public function index()
	{


		if ($this->session->userdata('bulan2')) {
            $bulan =  $this->session->userdata('bulan2');
        } else {
            $bulan = date('n');
        }
        if ($this->session->userdata('tahun2')) {
            $tahun = $this->session->userdata('tahun2');
        } else {
            $tahun = date('Y');
        }

		$data['title'] = 'Data Pengembalian';

        // Fetch users and books
        $data['users'] = $this->db->where('role', 'anggota')->get('user')->result_array();
        $this->db->select('buku.*, kategori.kategori')
                 ->from('buku')
                 ->join('kategori', 'kategori.id_kategori = buku.id_kategori');
        $data['buku'] = $this->db->get()->result_array();
		$data['users'] = $this->db->get_where('user', ['role' => $this->session->userdata('role')])->row();

		$this->db->select('pinjam.id_pinjam, user.nama, pinjam.tgl_pinjam, pinjam.tgl_kembali, pinjam.balik, pinjam.status, denda.denda, denda.lama_waktu, denda.tgl_denda');
		$this->db->from('pinjam');
		$this->db->join('user', 'pinjam.id_user = user.id_user');
		$this->db->join('denda', 'denda.id_pinjam = pinjam.id_pinjam', 'left')->where('status', 'Dikembalikan');

		// $this->db->join('buku', 'pinjam.id_buku = buku.id_buku');

		$data['peminjaman'] = $this->db->get()->result_array();

		// var_dump($data['peminjaman']);die();
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('transaksi/kembali');
		$this->load->view('template/footer');
	}

	function ceksesi()
	{
		$all_session_data = $this->session->all_userdata();
		echo '<pre>';
		print_r($all_session_data);
		echo '</pre>';
	}

	public function screturn()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        $data = [
            'bulan2' => $bulan,
            'tahun2' => $tahun
        ];
        $this->session->set_userdata($data);
        redirect('pengembalian');
    }

	public function tranPdf()
	{
		if ($this->session->userdata('bulan1')) {
            $bulan =  $this->session->userdata('bulan1');
        } else {
            $bulan = date('n');
        }
        if ($this->session->userdata('tahun')) {
            $tahun = $this->session->userdata('tahun');
        } else {
            $tahun = date('Y');
        }

		$bln = array(
            '1' => 'Januari',
            '2' => 'Februari',
            '3' => 'Maret',
            '4' => 'April',
            '5' => 'Mei',
            '6' => 'Juni',
            '7' => 'Juli',
            '8' => 'Agustus',
            '9' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        );
		
		$this->db->select('pinjam.id_pinjam, user.nama, pinjam.tgl_pinjam, pinjam.tgl_kembali, pinjam.balik, pinjam.status, denda.denda, denda.lama_waktu, denda.tgl_denda');
		$this->db->from('pinjam');
		$this->db->join('user', 'pinjam.id_user = user.id_user');
		$this->db->join('denda', 'denda.id_pinjam = pinjam.id_pinjam', 'left')->where('status', 'Dikembalikan');
		$this->db->where('MONTH(pinjam.tgl_pinjam)', $bulan);
		$this->db->where('YEAR(pinjam.tgl_pinjam)', $tahun);

		$data['laporan'] = $this->db->get()->result_array();
		$data['title'] = 'Laporan Peminjaman';
		$data['tahun'] = $tahun;
		// $data['bulan'] = implode(',', $bln);
		$data['bulan'] = $bln[$bulan];
		$file_pdf = $data['title'];
		$paper = 'A4';
        $orientation = "landscape";
		$html = $this->load->view('transaksi/genkembali', $data, true);
		$this->pdf->generate($html, $file_pdf, $paper, $orientation);

	}

	public function delete($id) 
	{
		$this->db->where('id_pinjam', $id);
        $this->db->delete('pinjam');
        $this->db->where('id_pinjam', $id);
        $this->db->delete('denda');
		echo '<script>alert("Berhasil Hapus pengambalian");window.location="'.site_url('pengembalian').'"</script>';
        // redirect('pengembalian');
	}
}
