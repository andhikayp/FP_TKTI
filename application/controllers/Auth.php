<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() 
	{ 
		parent::__construct();
		$this->load->library('slice');
		$this->load->library('form_validation');
		$this->load->model('Authentikasi');	
		$this->load->model('Users');	
		$this->load->library('session');

		if($this->session->userdata('user_login'))
		{ 
			redirect(base_url("dashboard/index")); 
		}
	}
 
	public function index() 
	{ 
		$this->slice->view('auth/login'); 
	}

	private function validation()
	{
		$this->form_validation->set_rules('loginUsername', 'Username', 'required', array('required' => 'Email wajib diisi'));
		$this->form_validation->set_rules('loginPassword', 'Password', 'required', array('required' => 'Password wajib diisi'));
		if ($this->form_validation->run() == FALSE)
		{
			return false;
		}
		else
		{
			return true;
		}
	}

	function dologin() 
	{ 
		$status = $this->validation();
		if($status == FALSE)
		{
			$this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
			return redirect(base_url('auth/index'));
		}
		$username = $this->input->post('loginUsername', TRUE); 
		$password = $this->input->post('loginPassword', TRUE); 
		$namatabel ="user"; 
		$user = $this->Authentikasi->check_login($namatabel, array('email' => $username), array('password' => $password));
		if($user != FALSE) 
		{ 	
			$data_session = array(
				'id' => $user->id,
				'role' => $user->role,
				'nama' => $user->nama,
				'foto_ktp' => $user->foto_ktp,
				'foto_kk' => $user->foto_kk,
				'foto_depan_rumah' => $user->foto_depan_rumah,
				'username' => $user->email,
				'alamat' => $user->alamat,
				'latitude' => $user->latitude,
				'longitude' => $user->longitude,
				'jmlh_terima_makanan' => $user->jmlh_terima_makanan,
				'is_verif' => $user->is_verif,
			);
			$this->session->set_userdata('user_login',$data_session);
			if ($user->latitude) {
				// $data['penerima'] = $this->users->countUser('Penerima');
				// $data['relawan'] = $this->users->countUser('Relawan');
				// $data['donatur'] = $this->users->countUser('Donatur');
				// $data['mitra'] = $this->users->countUser('Mitra');
				// var_dump($data); return;
				// $this->slice->view('dashboard/index', $data);
				redirect(base_url("dashboard/index"));
			}
			else {
				redirect(base_url("PetugasController/editProfil"));
			}
		} 
		else 
		{ 
			$this->session->set_flashdata('message', array('type' => 'error', 'message' => ["Email atau password tidak sesuai"]));
			redirect(base_url("auth/index")); 
		} 
	}

	public function register()
	{
		$this->slice->view('auth.register');
	}

	public function save()
	{
		$this->db->insert('user', $this->input->post());
		$this->session->set_flashdata('message', array('type' => 'success', 'message' => ["Akun berhasil dibuat"]));
		$this->slice->view('auth/login');
	}
}
