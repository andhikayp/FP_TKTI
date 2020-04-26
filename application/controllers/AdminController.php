<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/core/MY_Protectedcontroller.php';

class AdminController extends MY_Protectedcontroller
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
		
		if(!$this->session->user_login)
		{
			$this->session->set_flashdata('message', array('type' => 'error', 'message' => ["Silahkan masuk terlebih dahulu"]));
			redirect(base_url("auth/index")); 
        }
	}

	public function userPetugas(){
		$data['kasir'] = $this->users->getUserKasir();
		$this->slice->view('dashboard.profil.admin.index', $data);
	}

	public function deleteUser($id){
		$this->users->deluser($id);
		$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Siswa Berhasil Dihapus']));
		return redirect(base_url('AdminController/userPetugas'));
	}

	public function tambahUser(){
		if ($_SERVER['REQUEST_METHOD'] == "GET"){
			$this->slice->view('dashboard.profil.admin.tambah');
		}
		elseif($_SERVER['REQUEST_METHOD'] == "POST"){

			$config['upload_path']          = './img/profil/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 30000;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;
			$config['overwrite']			= true;

			$this->load->library('upload', $config);
			$this->upload->do_upload('foto');
			$insert_data = [
                'nama' => $this->input->post('nama'),
                'telp' => $this->input->post('telp'),
                'alamat' => $this->input->post('alamat'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'foto' => $_FILES["foto"]["name"],
                'role' => 2,
            ];
            try{
                $this->db->insert('user', $insert_data);
                $this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Sukses Menambah Petugas Kasir']));
				return redirect(base_url('AdminController/userPetugas'));	
            } catch(Exception $e){
                $this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
				$this->session->set_flashdata('post_data', $this->input->post(NULL, TRUE));
				return redirect(base_url('AdminController/tambahUser'));
            }
		}
		else{
			show_error("Method Not Allowed", 405);
		}
	}

	public function editUser($id)
	{
		if ($_SERVER['REQUEST_METHOD'] == "GET"){
			$data['siswa'] = $this->users->getUserID($id);
			$this->slice->view('dashboard.profil.admin.edit', $data);
		} else{
			show_error("Method Not Allowed", 405);
		}
	}

	public function saveEdit()
	{
		if($_SERVER['REQUEST_METHOD'] == "POST"){
			$input = $this->input->post(NULL, TRUE);
			$status = $this->users->updateProfil($this->input->post('email'), $input);
            $this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Sukses Mengedit Data Petugas Kasir']));
			return redirect(base_url('AdminController/userPetugas'));	
		}
		else{
			show_error("Method Not Allowed", 405);
		}
	}
}
