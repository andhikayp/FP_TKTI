<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH.'/core/MY_Protectedcontroller.php';

class Landing_Page extends MY_Protectedcontroller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('slice');
		$this->load->library('form_validation');
		$this->load->model('users');
	}

	public function index(){
		$data['penerima'] = $this->users->countUser('Penerima');
		$data['relawan'] = $this->users->countUser('Relawan');
		$data['donatur'] = $this->users->countUser('Donatur');
		$data['mitra'] = $this->users->countUser('Mitra');
		$this->slice->view('landing_page', $data);
	}
}
