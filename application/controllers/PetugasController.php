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

	public function indexProfil($id){
		$data['petugas'] = $this->users->getUser($id);
		$this->slice->view('dashboard.profil.petugas.index', $data);
	}

	public function editProfil($id){
		$data['petugas'] = $this->users->getUser($id);
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

	public function tambahUser(){
		if ($_SERVER['REQUEST_METHOD'] == "GET"){
			$this->slice->view('dashboard.profil.petugas.tambah');
		}
		elseif($_SERVER['REQUEST_METHOD'] == "POST"){

			$config['upload_path']          = './img/user';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 30000;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;
			$config['overwrite']			= true;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
	
			$files = $_FILES;
			$cpt = count ( $_FILES ['file'] ['name'] );
			for($i = 0; $i < $cpt; $i ++) {

				$_FILES ['file'] ['name'] = $files ['file'] ['name'] [$i];
				$_FILES ['file'] ['type'] = $files ['file'] ['type'] [$i];
				$_FILES ['file'] ['tmp_name'] = $files ['file'] ['tmp_name'] [$i];
				$_FILES ['file'] ['error'] = $files ['file'] ['error'] [$i];
				$_FILES ['file'] ['size'] = $files ['file'] ['size'] [$i];

				$this->upload->do_upload ('file');
			}

			$insert_data = [
				'role' => $this->input->post('role'),
				'nama' => $this->input->post('nama'),
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password'),
                'no_telp' => $this->input->post('telp'),
                'alamat' => $this->input->post('alamat'),
				'foto_ktp' => $files ['file'] ['name'] [0],
				'foto_kk' => $files ['file'] ['name'] [1],
				'foto_depan_rumah' => $files ['file'] ['name'] [2],
            ];
            try{
                $this->db->insert('user', $insert_data);
                $this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Sukses Menambah Petugas Kasir']));
				return redirect(base_url('PetugasController/list_user'));	
            } catch(Exception $e){
                $this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
				$this->session->set_flashdata('post_data', $this->input->post(NULL, TRUE));
				return redirect(base_url('PetugasController/tambahUser'));
            }
		}
		else{
			show_error("Method Not Allowed", 405);
		}

	}
	public function deleteUser($id){
		$this->users->deluser($id);
		$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['User Berhasil Dihapus']));
		return redirect(base_url('PetugasController/list_user'));
	}
}