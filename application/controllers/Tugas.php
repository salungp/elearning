<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas extends CI_Controller {
	public $file_name;

	public function __construct() {
		parent::__construct();
		if (!$this->session->userdata('user_id')) {
			redirect('login_page');
			exit;
		}
		$this->load->library('form_validation');
	}
	
	public function index() {
		$this->db->order_by('id', 'desc');
		$data = $this->db->get('tasks')->result_array();
		$this->load->view('templates/header', ['title' => 'Elearning - List tugas dari bapak/ibu guru']);
		$this->load->view('tugas/index', ['data' => $data]);
		$this->load->view('templates/footer');
	}

	public function create() {
		$this->load->view('templates/header', ['title' => 'Elearning - tambah tugas']);
		$this->load->view('tugas/create');
		$this->load->view('templates/footer');
	}

	public function store() {
		$this->form_validation->set_rules('title', '<strong>title</strong>', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->create();
		} else {
			// cek file is added!
			if (isset($_FILES['file'])) {
				$this->uploadFile();
			}

			$this->db->insert('tasks', [
				'title' => htmlspecialchars($this->input->post('title')),
				'description' => htmlspecialchars($this->input->post('description')),
				'author' => $this->session->userdata('user_id'),
				'file' => $this->file_name
			]);

			$message = '<div class="alert alert-success">
						Tugas berhasil ditambahkan!
				        </div>';

			$this->session->set_flashdata('message', $message);
			redirect('add_task');
		}
	}

	public function uploadFile() {
		$config['upload_path'] = './users/files/';
		$config['allowed_types'] = 'jpg|png|gif|pdf|pptx|docx|mp4|xls';
		$config['max_size']     = 50000;
		$config['max_width'] = '5024';
		$config['max_height'] = '5068';

		$this->load->library('upload', $config);

		$this->upload->initialize($config);

		if (!$this->upload->do_upload('file')) {
			$this->load->view('templates/header', ['title' => 'Elearning - tambah tugas']);
			$this->load->view('tugas/create', ['error' => $this->upload->display_errors()]);
			$this->load->view('templates/footer');
		} else {
			$this->file_name = $this->upload->data('file_name');
		}
	}
}