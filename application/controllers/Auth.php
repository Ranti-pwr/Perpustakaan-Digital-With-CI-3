<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct()
	{
        parent::__construct();

        $this->load->library('form_validation');
			// if ($this->session->userdata('status')!= "login") {
		// 	redirect(base_url("auth"));
		// }
    }

	public function index()
	{

		$this->form_validation->set_rules('email', 'Email','required|trim|valid_email');
		$this->form_validation->set_rules('password', 'Password','required|trim');
		//$this->form_validation->set_error_delimiters('<small class="form-text text-danger pl-3">', '</small>'); //opsional

		if($this->form_validation->run() == FALSE)
		:
            $this->load->view('auth/login');
        else :
			$this->login_user();
		endif;
	}

	private function login_user() 
	{
		$email= htmlspecialchars($this->input->post('email'));
		$password = htmlspecialchars($this->input->post('password'));
		$user = $this->db->get_where('user', ['email' => $email])->row_array();

        if($user) :
			if(password_verify($password, $user['pass'])) :
				$data = [
                    'nama' => $user['nama'],
                    'role' => $user['role'],					
                    'user_id' => $user['id_user'],					
                    'is_logged_in' => true
                ];
                $this->session->set_userdata($data);
				if($this->session->userdata('role') == 'Anggota') :
					echo '<script>alert("User berhasil login");window.location="'.site_url('userpi').'"</script>';
				endif;
				echo '<script>alert("User berhasil login");window.location="'.site_url('home').'"</script>';
                // redirect('home');
            else :
				//$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah!</div>');
				echo '<script>alert("User password salah!!");window.location="'.site_url('auth').'"</script>';
				// echo '<script>alert("User password salah!!");window.location="'.site_url('auth').'"</script>';
				// redirect('auth');
			endif;
		 else :
			echo '<script>alert("User email tidar terdaftar");window.location="'.site_url('auth').'"</script>';
		endif;
	}

	public function register()
	{
		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.nama]', [
			'required' => 'Username wajib diisi',
			'is_unique' => 'Username terdaftar'
		]);
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'required' => 'Password wajib diisi',
            'min_length' => 'Password harus terdiri dari 8 karakter',
            'matches' => 'Password harus sama dengan konfirmasi password'
        ]);	
		$this->form_validation->set_rules('password2', 'Password', 'required|trim', [
			'required' => 'Password wajib diisi',
		]);
		
		// $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');

		if($this->form_validation->run() == false)
		:
			$this->load->view('auth/registrasi');
		 else :
			$inp = $this->input->post();
			$data = [
				'nama' => htmlspecialchars($inp['username']),
				'pass	' => password_hash($inp['password1'], PASSWORD_DEFAULT),
				'email' => htmlspecialchars($inp['email']),
				'role' => 'Anggota'
			];

			$this->db->insert('user', $data);
			echo '<script>alert("User berhasil di registrasi");window.location="'.site_url('auth').'"</script>';
		endif;
	}

	public function coba(){
		echo 'tetstststs';
	}

	public function logout()
	{
		$this->session->unset_userdata('nama');
		$this->session->unset_userdata('role');
		echo '<script>alert("User berhasil logout");window.location="'.site_url('auth').'"</script>';
		//$this->session->sess_destroy();
	}
}
