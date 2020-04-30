<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/core/MY_Protectedcontroller.php';

class PetugasController extends MY_Protectedcontroller
{
	public function __construct(){
		parent::__construct();
		$this->load->library('slice');
		$this->load->library('form_validation');
		$this->load->library('pdf');
		$this->load->helper('download');
		$this->load->helper(array('form', 'url'));
		$this->load->helper('path');
		$this->load->helper('date');
		$this->load->model('users');
		$this->load->model('query');

		if($this->session->user_login['username']){
			$this->username = $this->session->user_login['username'];			
		}

		if(!$this->session->user_login)
		{
			$this->session->set_flashdata('message', array('type' => 'error', 'message' => ["Silahkan masuk terlebih dahulu"]));
			redirect(base_url("auth/index")); 
        }
	}

	public function indexProfil(){
		$data['petugas'] = $this->users->getUser($this->session->user_login['id']);
		$this->slice->view('dashboard.profil.petugas.index', $data);
	}

	public function editProfil(){
		$data['petugas'] = $this->users->getUser($this->session->user_login['id']);
		if ($_SERVER['REQUEST_METHOD'] == "GET"){
		// var_dump($data); return;
			$this->slice->view('dashboard.profil.petugas.edit', $data);
		}
		elseif($_SERVER['REQUEST_METHOD'] == "POST"){
			$input = $this->input->post(NULL, TRUE);
			$status = $this->users->updateProfil($this->username, $input);
			if(!$status){
				$this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
				$this->session->set_flashdata('post_data', $this->input->post(NULL, TRUE));
				return redirect(base_url('PetugasController/editProfil'));	
			}
			else{
				$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Sukses Mengubah Profil']));
				return redirect(base_url('PetugasController/indexProfil'));	
			}
		}
		else{
			show_error("Method Not Allowed", 405);
		}
	}

	public function list_user()
	{
		$data['donasi'] = $this->query->all('user');
		$this->slice->view('dashboard.profil.petugas.list', $data);
	}
	public function tambah(){
		$this->slice->view('dashboard.profil.petugas.tambah');
	}

	public function verifikasi($id)
	{
		date_default_timezone_set('Asia/Jakarta'); 
		$this->db->set('is_verif', 1);
		$this->db->set('tanggal_verif', date("Y-m-d H:i:s"));
        $this->db->where('id', $id);
		$status = $this->db->update('user');
		if(!$status){
			$this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
		}
		else{
			$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Proses Verifikasi Berhasil']));
		}
		return redirect(base_url('PetugasController/list_user'));	
	}
}