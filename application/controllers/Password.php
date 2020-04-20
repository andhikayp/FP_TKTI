<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Password extends CI_Controller {

	public function __construct() 
	{ 
		parent::__construct();
		$this->load->library('slice');
		$this->load->library('form_validation');
		$this->load->model('Authentikasi');
		$this->load->library('session');
		$this->load->model('users');

		if($this->session->user_login['username']){
			$this->username = $this->session->user_login['username'];			
		}
	}
 
	public function index() 
	{
		$this->slice->view('password/ganti_password'); 
	}

	function ganti_password() 
	{ 
		if($this->input->post('password_baru')!=$this->input->post('konfirmasi_password_baru'))
		{
			$this->session->set_flashdata('message', array('type' => 'error', 'message' => ["Password baru dan konfirmasi tidak sama"]));
			redirect(base_url("password/index")); 
		}
		$username = $this->session->user_login['username']; 
		$password = $this->input->post('password_lama'); 
		$user = $this->Authentikasi->check_login("user", array('email' => $username), array('password' => $password)); 
		if($user != FALSE) 
		{ 	
			$res = $this->Authentikasi->ganti_password($username,$this->input->post('password_baru'));
			if($res){
				$this->session->set_flashdata('message', array('type' => 'success', 'message' => ["Password berhasil diubah"]));
				redirect(base_url("dashboard"));
			}
			else {
				$this->session->set_flashdata('message', array('type' => 'error', 'message' => ["Password gagal diubah"]));
				redirect(base_url("password/index"));
			}
		} 
		else { 
			$this->session->set_flashdata('message', array('type' => 'error', 'message' => ["Password lama tidak sesuai"]));
			redirect(base_url("password/index")); 
		} 
	}
}
