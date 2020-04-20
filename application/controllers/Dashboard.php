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

		if($this->session->user_login['username']){
			$this->username = $this->session->user_login['username'];			
		}
	}

	public function index()
	{
		$this->slice->view('dashboard/index');
	}
}
