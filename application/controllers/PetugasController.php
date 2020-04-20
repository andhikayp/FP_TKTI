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

		if($this->session->user_login['username']){
			$this->username = $this->session->user_login['username'];			
		}
	}

	public function indexProfil(){
		$data['petugas'] = $this->users->getUser($this->username);
		$this->slice->view('dashboard.profil.petugas.index', $data);
	}

	public function editProfil(){
		$data['petugas'] = $this->users->getUser($this->username);
		if ($_SERVER['REQUEST_METHOD'] == "GET"){
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
}