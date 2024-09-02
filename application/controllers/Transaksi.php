<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->database(); // Ensure the database library is loaded
		if(!$this->session->userdata('is_logged_in') == true)
		{
			redirect('auth');
		}
    }

    public function index() {

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
		$data['title'] = 'Data Peminjaman';

        // Fetch users and books
        $data['user'] = $this->db->where('role', 'anggota')->get('user')->result_array();
		$this->db->select('buku.*, GROUP_CONCAT(kategori.kategori SEPARATOR ", ") as kategori')
		->from('buku')
		->join('buku_kategori', 'buku.id_buku = buku_kategori.id_buku')
		->join('kategori', 'buku_kategori.id_kategori = kategori.id_kategori')
		->group_by('buku.id_buku');
        $data['buku'] = $this->db->get()->result_array();
		$data['users'] = $this->db->get_where('user', ['role' => $this->session->userdata('role')])->row();

		$this->db->select('pinjam.id_pinjam, user.nama, pinjam.tgl_pinjam, pinjam.tgl_kembali, pinjam.balik, pinjam.status, denda.denda, denda.lama_waktu, denda.tgl_denda');
		$this->db->from('pinjam');
		$this->db->join('user', 'pinjam.id_user = user.id_user');
		$this->db->join('denda', 'denda.id_pinjam = pinjam.id_pinjam', 'left')->where('status', 'Dipinjam');
		$this->db->where('MONTH(pinjam.tgl_pinjam)', $bulan);
		$this->db->where('YEAR(pinjam.tgl_pinjam)', $tahun);

		// $this->db->join('buku', 'pinjam.id_buku = buku.id_buku');

		$data['peminjaman'] = $this->db->get()->result_array();

		// var_dump($data['peminjaman']);die();

        // Load views
        $this->load->view('template/header', $data);
        $this->load->view('template/sidebar', $data);
        $this->load->view('transaksi/peminjaman', $data); // Ensure you pass $data to the view
        $this->load->view('template/footer');
    }



	public function kembalikan_buku() {
		$id_pinjam = $this->input->post('id_pinjam');
		$tgl_balik = date('Y-m-d');
		
		// Retrieve the loan data
		$pinjam = $this->db->get_where('pinjam', ['id_pinjam' => $id_pinjam])->row();
	
		// Calculate overdue days and fine
		$tenggat = new DateTime($pinjam->tgl_kembali);
		$tgl_kembali = new DateTime($tgl_balik);
		$hari_terlambat = $tgl_kembali > $tenggat ? $tenggat->diff($tgl_kembali)->days : 0;
		//jika tanggal kembali lebih dari tanggal pengembalian maka akan dihitung denda
		//jika tanggal kembali kurang dari tanggal pengmbalian maka dihitung 0
		$denda = $hari_terlambat * 2000;
	
		// Update the 'pinjam' table with the return date and status
		$this->db->set('status', 'Dikembalikan');
		$this->db->set('balik', $tgl_balik);
		$this->db->where('id_pinjam', $id_pinjam);
		$this->db->update('pinjam');
	
		// If there is a fine, insert it into the 'denda' table
		if ($denda > 0) {
			$this->db->insert('denda', [
				'id_pinjam' => $id_pinjam,
				'denda' => $denda,
				'lama_waktu' => $hari_terlambat,
				'tgl_denda' => $tgl_balik
			]);
		}
		
		redirect('transaksi');
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
		$this->db->join('denda', 'denda.id_pinjam = pinjam.id_pinjam', 'left')->where('status', 'Dipinjam');
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
		$html = $this->load->view('transaksi/genpemin', $data, true);
		$this->pdf->generate($html, $file_pdf, $paper, $orientation);
	}

	public function scbroww()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');

        $data = [
            'bulan1' => $bulan,
            'tahun' => $tahun
        ];
        $this->session->set_userdata($data);
        redirect('transaksi');
    }
	
	
	public function tambah_pinjam()
	{
		// Start transaction
		$this->db->trans_start();

		// Retrieve and check POST data
		$id_buku = $this->input->post('id_buku');
		// $id_user = $this->input->post('id_user');
		// var_dump($id_user);die();e();
		// var_dump($id_buku);die();
		if (!is_array($id_buku) || empty($id_buku)) {
			echo '<script>alert("ID buku tidak valid");window.location="'.site_url('transaksi').'"</script>';
			$this->db->trans_rollback();
			return;
		}
	
		foreach ($id_buku as $index => $buku_id) {
			// Fetch book details
			$buku = $this->db->get_where('buku', ['id_buku' => $buku_id])->row();
	
			// Check if book exists
			if ($buku === NULL) {
				echo '<script>alert("Buku dengan ID'.$buku_id .' tidak ditemukan");window.location="'.site_url('transaksi').'"</script>';
				$this->db->trans_rollback();
				return;
			}
		
			// Check if stock is sufficient
			if ($buku->stok < 1) {
				echo '<script>alert("Stok buku'.$buku->judul .' tidak cukup");window.location="'.site_url('transaksi').'"</script>';
				$this->db->trans_rollback();
				return;
			}
			// Update book stock
			$this->db->where('id_buku', $buku_id)
					 ->set('stok', 'stok-1', false)
					 ->update('buku');
			// Insert into pinjam table
			$data = [
				'id_buku' => $buku_id,
				'id_user' => $this->input->post('id_user'),
				'tgl_pinjam' => $this->input->post('tgl_pinjam'),
				'lama_pinjam' => $this->input->post('lama_pinjam'),
				'tgl_kembali' => date('Y-m-d', strtotime('+' . $this->input->post('lama_pinjam') . ' days', strtotime($this->input->post('tgl_pinjam')))),
				'status' => 'Dipinjam'
			];
	
			$this->db->insert('pinjam', $data);
	
			if ($this->db->affected_rows() === 0) {
				echo '<script>alert("Gagal menambahkan");window.location="'.site_url('transaksi').'"</script>';
				$this->db->trans_rollback();
				return;
			}
		}
	
		// Complete transaction
		$this->db->trans_complete();
	
		// Check for transaction success
		if ($this->db->trans_status() === FALSE) {
			echo '<script>alert("Terjadi kesalahan");window.location="'.site_url('transaksi').'"</script>';
		} else {
			echo '<script>alert("Berhasil");window.location="'.site_url('transaksi').'"</script>';
		}
	}
	
}
