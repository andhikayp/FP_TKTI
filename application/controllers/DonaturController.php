<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DonaturController extends CI_Controller {

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
		$this->load->model('barang');
		$this->load->model('query');

		if($this->session->user_login['username']){
			$this->username = $this->session->user_login['username'];			
		}
	}

	public function index()
	{
		if ($this->session->user_login['role'] == "Donatur") {
			$data['donasi'] = $this->query->get_donasi_id($this->session->user_login['id']);
		}
		else {
			$data['donasi'] = $this->query->all('donasi');
		}
		$this->slice->view('dashboard.donasi.index', $data);
	}

	public function create()
	{
		if ($_SERVER['REQUEST_METHOD'] == "GET"){
			$this->slice->view('dashboard.donasi.create');
		}
		elseif($_SERVER['REQUEST_METHOD'] == "POST"){
			$status = $this->db->insert('donasi', $this->input->post());
			if(!$status){
				$this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
				$this->session->set_flashdata('post_data', $this->input->post(NULL, TRUE));
				return redirect(base_url('DonaturController/create'));	
			}
			else{
				$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Input Donasi Berhasil Dilakukan. Tunggu Proses Verifikasi']));
				return redirect(base_url('DonaturController/index'));	
			}
		}
		else{
			show_error("Method Not Allowed", 405);
		}
	}

	public function verifikasi($id)
	{
		//randoman pembagian
		date_default_timezone_set('Asia/Jakarta'); 
		$this->db->set('is_verif', 1);
		$this->db->set('tanggal_verif', date("Y-m-d H:i:s"));
        $this->db->where('id', $id);
		$status = $this->db->update('donasi');
		if(!$status){
			$this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
		}
		else{
			$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Proses Verifikasi Berhasil']));
		}
		return redirect(base_url('DonaturController/index'));	
	}

}

/* End of file DonaturController.php */
/* Location: ./application/controllers/DonaturController.php */