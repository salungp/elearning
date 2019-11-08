<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Video extends CI_Controller {
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
		$data = $this->db->get('videos')->result_array();

		$this->load->view('templates/header', ['title' => 'Elearning - List video tutorial']);
		$this->load->view('video/index', ['data' => $data]);
		$this->load->view('templates/footer');
	}

	public function create() {
		$this->load->view('templates/header', ['title' => 'Elearning - Upload video baru']);
		$this->load->view('video/create');
		$this->load->view('templates/footer');
	}

	public function store() {
		$user = $this->db->get_where('users', ['id' => $this->session->userdata('user_id')])->row_array();

		if ($this->db->get_where('videos', ['title' => $this->input->post('title')])->row_array()) {
			$message = '<div class="alert alert-danger">
								Maaf judul ini sudah ada!
						    </div>';

			$this->session->set_flashdata('message', $message);
			redirect('video/create/');
			die;
		}
		
		$config['upload_path'] = './users/images/thumbs/';
		$config['allowed_types'] = 'jpg|png|gif';
		$config['max_size']     = 50000;
		$config['max_width'] = '5024';
		$config['max_height'] = '5068';

		$this->load->library('upload', $config);

		$this->upload->initialize($config);

		$this->form_validation->set_rules('title', '<strong>title</strong>', 'required');
		$this->form_validation->set_rules('description', '<strong>description</strong>', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->create();
		} else {
			if (!$this->upload->do_upload('link_thumbnail')) {
				$this->load->view('templates/header', ['title' => 'Elearning - Upload video baru']);
				$this->load->view('video/create', ['error' => $this->upload->display_errors()]);
				$this->load->view('templates/footer');
			} else {
				$thumbnail = $this->upload->data('file_name');

				$this->db->insert('videos', [
					'title' => htmlspecialchars($this->input->post('title')),
					'description' => htmlspecialchars($this->input->post('description')),
					'author' => $user['id'],
					'slug' => strtolower(str_replace(' ', '-', $this->input->post('title'))),
					'link_thumbnail' => 'users/images/thumbs/'.$thumbnail
				]);

				$data = $this->db->get_where('videos', ['slug' => strtolower(str_replace(' ', '-', $this->input->post('title')))])->row_array();

				$message = '<div class="alert alert-success">
								Data berhasil disimpan silahkan masukkan file video!
						    </div>';

				$this->session->set_flashdata('message', $message);
				redirect('upload_video/'.$data['id']);
			}
		}
	}

	public function uploadPage($id) {
		$this->load->view('templates/header', ['title' => 'Elearning - Upload video']);
		$this->load->view('video/upload', ['id' => $id]);
		$this->load->view('templates/footer');
	}

	public function upload($id) {
		$config['upload_path'] = './users/videos/';
		$config['allowed_types'] = 'mp4|mkv|3gp';
		$config['max_size']     = 500000;
		$config['max_width'] = '50024';
		$config['max_height'] = '50068';

		$this->load->library('upload', $config);

		$this->upload->initialize($config);

		if (!$this->upload->do_upload('link_video')) {
			$this->load->view('templates/header', ['title' => 'Elearning - Upload video baru']);
			$this->load->view('video/upload', ['error' => $this->upload->display_errors(), 'id' => $id]);
			$this->load->view('templates/footer');
		} else {
			$this->db->where('id', $id);
			$this->db->update('videos', ['link_video' => $this->upload->data('file_name')]);
			$message = '<div class="alert alert-success">
								Data berhasil disimpan silahkan masukkan file video!
						    </div>';

			$this->session->set_flashdata('message', $message);
			redirect('video/');
		}
	}

	public function watch($slug) {
		$video = $this->db->get_where('videos', ['slug' => $slug])->row_array();
		if (!$video) {
			show_404();
		}
		$this->load->view('templates/header', ['title' => $video['title']]);
		$this->db->order_by('id', 'desc');
		$this->load->view('video/single', ['video' => $video, 'data' => $this->db->get('videos')->result_array()]);
		$this->load->view('templates/footer');
	}

	public function cari() {
		$this->db->order_by('id', 'desc');
		$this->db->like('title', $this->input->get('key'));
		$data = $this->db->get('videos')->result_array();

		$this->load->view('templates/header', ['title' => 'Elearning - List video tutorial']);
		$this->load->view('video/index', ['data' => $data, 'cari' => $this->input->get('key')]);
		$this->load->view('templates/footer');
	}

	public function destroy($id) {
		$video = $this->db->get_where('videos', ['id' => $id])->row_array();
		if (!$video) {
			show_404();
		}
		unlink($video['link_thumbnail']);
		unlink('./users/videos/'.$video['link_video']);
		$this->db->delete('videos', ['id' => $id]);
		$message = '<div class="alert alert-success">
								Video berhasil dihapus!
						    </div>';

		$this->session->set_flashdata('message', $message);
		redirect();
	}

	public function edit($id) {
		$video = $this->db->get_where('videos', ['id' => $id])->row_array();
		if (!$video) {
			show_404();
		}
		$this->load->view('templates/header', ['title' => 'Elearning - Edit video']);
		$this->load->view('video/edit', ['video' => $video]);
		$this->load->view('templates/footer');
	}

	public function update($id) {
		$user = $this->db->get_where('users', ['id' => $this->session->userdata('user_id')])->row_array();
		$old = $this->db->get_where('videos', ['id' => $id])->row_array();

		if ($this->db->get_where('videos', ['title' => $this->input->post('title')])->row_array()) {
			$message = '<div class="alert alert-danger">
								Maaf judul ini sudah ada!
						    </div>';

			$this->session->set_flashdata('message', $message);
			redirect('video/create/');
			die;
		}
		
		$config['upload_path'] = './users/images/thumbs/';
		$config['allowed_types'] = 'jpg|png|gif';
		$config['max_size']     = 50000;
		$config['max_width'] = '5024';
		$config['max_height'] = '5068';

		$this->load->library('upload', $config);

		$this->upload->initialize($config);

		$this->form_validation->set_rules('title', '<strong>title</strong>', 'required');
		$this->form_validation->set_rules('description', '<strong>description</strong>', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header', ['title' => 'Elearning - Upload video baru']);
			$this->load->view('video/create');
			$this->load->view('templates/footer');
		} else {
			if (!$this->upload->do_upload('link_thumbnail')) {
				$this->load->view('templates/header', ['title' => 'Elearning - Upload video baru']);
				$this->load->view('video/create', ['error' => $this->upload->display_errors()]);
				$this->load->view('templates/footer');
			} else {
				unlink($old['link_thumbnail']);
				$thumbnail = $this->upload->data('file_name');
				$this->db->where('id', $id);
				$this->db->update('videos', [
					'title' => htmlspecialchars($this->input->post('title')),
					'description' => htmlspecialchars($this->input->post('description')),
					'author' => $user['id'],
					'slug' => strtolower(str_replace(' ', '-', $this->input->post('title'))),
					'link_thumbnail' => 'users/images/thumbs/'.$thumbnail
				]);

				$message = '<div class="alert alert-success">
								Video berhasil diupdate!
						    </div>';

				$this->session->set_flashdata('message', $message);
				redirect();
			}
		}
	}
}