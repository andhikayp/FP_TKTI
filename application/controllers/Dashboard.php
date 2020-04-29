<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/core/MY_Protectedcontroller.php';

class Dashboard extends MY_Protectedcontroller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('slice');
		$this->load->library('form_validation');
		$this->load->model('users');

		if($this->session->user_login['username']){
			$this->username = $this->session->user_login['username'];			
		}
	}

	public function index()
	{
		$data['penerima'] = $this->users->countUser('Penerima');
		$data['relawan'] = $this->users->countUser('Relawan');
		$data['donatur'] = $this->users->countUser('Donatur');
		$data['mitra'] = $this->users->countUser('Mitra');
		if ($this->session->user_login['role'] == "Admin") {
			$data['sebaran'] = $this->users->getPenerima(2);
		}
		$this->slice->view('dashboard/index', $data);
	}

	public function landing_page(){
		$this->slice->view('landing_page');
	}
}
