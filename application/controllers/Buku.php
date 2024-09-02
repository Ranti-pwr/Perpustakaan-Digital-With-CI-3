<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buku extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		if(!$this->session->userdata('is_logged_in') == true)
		{
			redirect('auth');
		}
	}


	public function index()
	{
		$data['title'] = 'Data Buku';
		// Ambil data kategori yang dipilih
		$get_category = $this->input->get('kategori');
	
		//join buku dan kategori berdasarkan id
		//gabungkan nilai bbrp baris menjadi satu string yang dipisah koma spasi
		$this->db->select('buku.*, GROUP_CONCAT(kategori.kategori SEPARATOR ", ") as kategori, COUNT(pinjam.id_pinjam) as pinjam')
				// Menghitung jumlah baris dari tabel pinjam di mana buku tersebut dipinjam dan status peminjamannya
				 ->from('buku')
				 ->join('buku_kategori', 'buku.id_buku = buku_kategori.id_buku')
				 ->join('kategori', 'buku_kategori.id_kategori = kategori.id_kategori')
				 ->join('pinjam', 'buku.id_buku = pinjam.id_buku AND pinjam.status = "Dipinjam"', 'left')
				 ->group_by('buku.id_buku');
				//  ->join('pinjam', 'buku.id_buku = pinjam.id_buku');
		// Mengelompokkan hasil query berdasarkan id_buku => group_by
		// Tujuan: Karena menggunakan GROUP_CONCAT, pengelompokan diperlukan agar semua kategori yang terkait dengan satu buku digabung menjadi satu baris hasil query.
	
		// Filter by category if a category is selected
		if (!empty($get_category)) {
			//filter berdasarkan kategori yang dipilih
			$this->db->where('buku.id_kategori', $get_category);
		}
	
		$data['buku'] = $this->db->get()->result_array();
		$data['users'] = $this->db->get_where('user', ['role' => $this->session->userdata('role')])->row();
	
		// Tampilkan semua kategori di dropdown
		$data['kategori'] = $this->db->get('kategori')->result_array();
	
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('book/buku', $data);
		$this->load->view('template/footer');
	}
	

	public function tambah()
	{
		$this->form_validation->set_rules('judul', 'Judul','required|is_unique[buku.judul]');
		$this->form_validation->set_rules('penerbit', 'Penerbit','required|is_unique[buku.penerbit]');
		$this->form_validation->set_rules('pengarang', 'pengarang','required|is_unique[buku.pengarang]');
		$this->form_validation->set_rules('thn_terbit', 'Tahun Terbit','required');
		$this->form_validation->set_rules('stok', 'Stock','required');
		$this->form_validation->set_rules('kategori[]', 'Kategori','required');
		
		if ($this->form_validation->run() == TRUE)
		{
			$config['upload_path'] 		= 'sh/buku/cover/';
			$config['allowed_types'] 	= 'jpg|jpeg|png|gif';
			$config['max_size'] 		=  3080; //3mb
			// $config['encrypt_name'] 	= TRUE; //opsional
			$config['file_name'] 		=  'cover_'. time();

			$this->load->library('upload', $config);

			if(!$this->upload->do_upload('cover')) 
			{
				$error = $this->upload->display_errors();
				echo $error;
			} elseif ($config['max_size'] > 3080)
			{
				$error = array('error' => 'Ukuran file terlalu besar');
				echo $error;
			} else {
				$data = $this->upload->data(); 
                $cover = $data['file_name'];
                $data = [
                    'judul'				=> $this->input->post('judul'),
                    'penerbit'			=> $this->input->post('penerbit'),
                    'pengarang'			=> $this->input->post('pengarang'),
                    'thn_terbit'		=> $this->input->post('thn_terbit'),
                    'cover'				=> $cover,
                    // 'id_kategori'		=> $this->input->post('id_kategori'),
					'stok'              => $this->input->post('stok')
                ];

                $this->db->insert('buku', $data);
				$buku_id = $this->db->insert_id(); // Dapatkan id_buku dari buku yang baru saja ditambahkan

				$kategori = $this->input->post('kategori');
				foreach ($kategori as $key => $value) {
					$this->db->insert('buku_kategori', [
						'id_buku' => $buku_id,
						'id_kategori' => $value 
					]);

				}
               // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil ditambahkan!</div>');
			   	echo '<script>alert("Data Berhasil ditambahkan");window.location="'.site_url('buku').'"</script>';
                //redirect('buku');
			}
		} else {

			$data['kategori'] = $this->db->get('kategori')->result_array();
			$data['users'] = $this->db->get_where('user', ['role' => $this->session->userdata('role')])->row();
			$data['title'] = 'Tambah Buku';
			$this->load->view('template/header', $data);
			$this->load->view('template/sidebar', $data);
			$this->load->view('book/buku_tambah');
			$this->load->view('template/footer');

		}
	}


	public function edit($id)
	{
		
		$this->form_validation->set_rules('judul', 'Judul','required');
        $this->form_validation->set_rules('penerbit', 'Penerbit','required');
        $this->form_validation->set_rules('pengarang', 'Pengarang','required');
        $this->form_validation->set_rules('thn_terbit', 'Tahun Terbit','required');
        $this->form_validation->set_rules('stok', 'Stock','required');

        if ($this->form_validation->run() == true)
        {
			$cover_old = $this->db->select('cover')->get_where('buku', ['id_buku' => $id])->row()->cover;
			//ambil colom cover di tabel buku berdasarkan id_buku

            $config['upload_path']      = 'sh/buku/cover/';
            $config['allowed_types']    = 'jpg|jpeg|png|gif';
            $config['max_size']         =  3080; //3mb
			$config['encrypt_name'] 	= TRUE;
            $config['file_name'] 		=  'cover_'. time();

			$this->load->library('upload', $config);
			// if(!$this->upload->do_upload('cover'))
			// {
            //     $error = $this->upload->display_errors();
            //     echo $error;

            // } else
			if ($config['max_size'] > 3080) {
				$error = array('error' => 'Ukuran file terlalu besar');

			} else {
				
				if(file_exists($config['upload_path']) . $cover_old)
				{ //jika user mengupload cover baru maka cover lama dihapus
					unlink($config['upload_path'] . $cover_old);
				}

				$data = $this->upload->data(); 
                $cover = $data['file_name'];
                $data = [
                    'judul'                	=> $this->input->post('judul'),
                    'penerbit'            	=> $this->input->post('penerbit'),
                    'pengarang'            	=> $this->input->post('pengarang'),
                    'thn_terbit'        	=> $this->input->post('thn_terbit'),
                    'cover'                	=> $cover,
                    'id_kategori'        	=> $this->input->post('id_kategori'),
                    'stok'                	=> $this->input->post('stok')
                ];

                $this->db->where('id_buku', $id);
                $this->db->update('buku', $data);

				echo '<script>alert("Data Berhasil diupdate");window.location="'.site_url('buku').'"</script>';
			}
		}

		$data['kategori'] = $this->db->get('kategori')->result_array();
		$data['buku'] = $this->db->get_where('buku', ['id_buku' => $id])->row_array();
		$data['users'] = $this->db->get_where('user', ['role' => $this->session->userdata('role')])->row();
		$data['title'] = 'Edit Buku';
		$this->load->view('template/header', $data);
		$this->load->view('template/sidebar', $data);
		$this->load->view('book/buku_update');
		$this->load->view('template/footer');
	}



	public function delete($id)
	{
		if (!is_numeric($id))
		{
			echo '<script>alert("ID buku tidak valid");window.location="'.site_url('buku').'"</script>';
			//redirect('produk/index');
		}
		$buku = $this->db->get_where('buku', ['id_buku' => $id])->row_array();
		if(!$buku)
		{
			echo '<script>alert("Data buku tidak ditemukan");window.location="'.site_url('buku').'"</script>';
		}

		$path_image = './sh/buku/cover/'. $buku['cover'];
		if(file_exists($path_image))
		{
			unlink($path_image);
		}
        $this->db->where('id_buku', $id);
        $this->db->delete('buku');

        echo '<script>alert("Data Berhasil dihapus");window.location="'.site_url('buku').'"</script>';
	}
	

	public function buku_pdf()
	{
		// $this->load->library('Pdf');
		$this->db->select('buku.*, GROUP_CONCAT(kategori.kategori SEPARATOR ", ") as kategori') //gabungkan nilai bbrp baris menjadi satu string yang dipisah ,
				 ->from('buku')//tabel utama
				 ->join('buku_kategori', 'buku.id_buku = buku_kategori.id_buku')
				 ->join('kategori', 'buku_kategori.id_kategori = kategori.id_kategori')
				 ->group_by('buku.id_buku');
		// Mengelompokkan hasil query berdasarkan id_buku => group_by
		// Tujuan: Karena kita menggunakan GROUP_CONCAT, pengelompokan ini diperlukan agar semua kategori yang terkait dengan satu buku digabung menjadi satu baris hasil query.
        $data['laporan'] = $this->db->get()->result_array();
        // $this->load->view('book/bukugen', $data);

        $data['title'] = 'Laporan PDF';
		$file_pdf = $data['title'];
		$paper = 'A4';
        $orientation = "landscape";
		$html = $this->load->view('book/bukugen', $data, true);
		$this->pdf->generate($html, $file_pdf, $paper, $orientation);
	}
}
