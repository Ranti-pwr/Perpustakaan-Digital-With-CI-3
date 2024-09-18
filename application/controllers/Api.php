<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController
{

	function __construct()
	{
		// Construct the parent class
		parent::__construct();
		$this->load->database();
	}

	public function user_get($id = null)
	{
		// Fetch all users if no ID is provided
		if ($id === null) {
			$users = $this->db->order_by('nama', 'asc')->get('user')->result_array();

			if ($users) {
				// Set the response and exit
				$this->response($users, 200);
			} else {
				$this->response([
					'status' => false,
					'message' => 'No users were found'
				], 404);
			}
		} else {
			// Fetch a specific user by ID
			$user = $this->db->get_where('user', ['id_user' => $id])->row_array();

			if ($user) {
				// Set the response and exit
				$this->response($user, 200);
			} else {
				$this->response([
					'status' => false,
					'message' => 'No such user found'
				], 404);
			}
		}
	}



	public function buku_get()
	{
		$buku = $this->db->get('buku')->result_array();

		if($buku):
			$this->response($buku, 200);
		else:
			$this->response([
				'status' => false,
				'message' => 'No such book found'
			], 404);
		endif;
	}
	
}
