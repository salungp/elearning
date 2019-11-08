<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct() {
		parent::__construct();
		if (!$this->session->userdata('user_id')) {
			redirect('login_page');
			exit;
		}
	}

	public function index() {
		$user = $this->db->get_where('users', ['id' => $this->session->userdata('user_id')])->row_array();
		$this->load->view('templates/header', ['title' => 'Elearning - Situs tempat belajar berbasis video']);
		$this->load->view('home/index', ['video' => $this->db->get_where('videos', ['author' => $user['id']])->result_array()]);
		$this->load->view('templates/footer');
	}
}