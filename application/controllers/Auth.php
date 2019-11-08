<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index() {
		$this->load->view('auth/login');
	}

	public function registerPage() {
		$this->load->view('auth/register');
	}

	public function login($token) {
		$this->validateLogin();

		$user = $this->db->get_where('users', ['email' => $this->input->post('email')])->row_array();

		if ($user) {
			if (password_verify($this->input->post('password'), $user['password'])) {
				$this->session->set_userdata([
					'user_id' => $user['id']
				]);

				redirect();
			} else {
				$message = '<div class="alert alert-danger">
						Password salah!
				    </div>';

				$this->session->set_flashdata('message', $message);
				redirect('login_page');
			}
		} else {
			$message = '<div class="alert alert-danger">
						Maaf email tidak terdaftar!
				    </div>';

			$this->session->set_flashdata('message', $message);
			redirect('login_page');
		}
	}

	public function register($token) {
		$this->validateRegister();

		// insert data user
		$this->db->insert('users', [
			'name' => htmlspecialchars($this->input->post('name')),
			'email' => htmlspecialchars($this->input->post('email')),
			'kelas' => $this->input->post('kelas_tingkat').'-'.$this->input->post('kelas_jurusan').'-'.$this->input->post('kelas_no'),
			'role_id' => 3,
			'password' => htmlspecialchars(password_hash($this->input->post('password'), PASSWORD_DEFAULT))
		]);

		$message = '<div class="alert alert-success">
						Daftar berhasil silahkan login terlebih dahulu!
				    </div>';

		$this->session->set_flashdata('message', $message);
		redirect('login_page');
	}

	public function validateAuth($page) {
		$this->form_validation->set_rules('name', '<strong>name</strong>', 'required');
		$this->form_validation->set_rules('email', '<strong>email</strong>', 'required|email');
		$this->form_validation->set_rules('password', '<strong>password</strong>', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('auth/'.$page);
		}
	}

	public function validateRegister() {
		$this->validateAuth('register');

		$users = $this->db->get_where('users', ['email' => $this->input->post('email')])->row_array();

		if ($users) {
			$message = '<div class="alert alert-danger">
						Maaf email <strong>'.$this->input->post('email').'</strong> sudah ada!
				    </div>';

			$this->session->set_flashdata('message', $message);
			redirect('register_page');
			die;
		}
	}

	public function validateLogin() {
		$this->validateAuth('login');
	}

	public function logout() {
		if ($this->session->has_userdata('user_id')) {
			$this->session->unset_userdata('user_id');
		}
		redirect('login_page');
	}
}