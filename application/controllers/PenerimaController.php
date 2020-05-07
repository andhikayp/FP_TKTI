<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PenerimaController extends CI_Controller {
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
	}

	public function riwayat_penerimaan(){
		$data['penerima']=$this->query->getRiwayatPenerima($this->session->user_login['id']);
		$this->slice->view('dashboard.penerima.riwayat_penerimaan',$data);
	}

	public function detail($id){

		$data['penerima_donasi'] = $this->query->find('penerima_donasi', $id);
		$data['donasi'] = $this->query->find('donasi', $data['penerima_donasi']->id_donasi);
		$data['donatur'] = $this->query->find('user', $data['donasi']->donatur_id);
		$data['mitra'] = $this->query->find('user', $data['donasi']->mitra_id);
		$data['relawan'] = $this->query->find('user', $data['donasi']->relawan_id);
		$data['menu'] = $this->query->find('menu', $data['donasi']->menu_id);
		$data['penerima'] = $this->users->getPenerima($data['donasi']->id);
		$data['progres'] = ($this->users->getPenerimaDone($data['donasi']->id)->done / count($data['penerima'])) * 100;
		// $data['penerima'] = $this->users->getPenerima($id);

		// $data['penerima']=$this->query->getDetailPenerimaan($penerima_donasi_id);
		$this->slice->view('dashboard.penerima.detail_penerimaan',$data);
	}

	public function upload_bukti($id){

		if ($_SERVER['REQUEST_METHOD'] == "GET"){
			$data['penerima_donasi_id']=$id;
			$this->slice->view('dashboard.penerima.upload_bukti',$data);
		}
	}

	public function upload_bukti2(){
		if($_SERVER['REQUEST_METHOD'] == "POST"){

			$config['upload_path']          = './img/folder_bukti';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 30000;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;
			$config['overwrite']			= true;

			$this->load->library('upload', $config);
			$this->upload->do_upload('bukti');

			
	
            try{
				$this->db->set('bukti', $_FILES["bukti"]["name"]);
				$this->db->where('id', $this->input->post('id_penerima_donasi'));
				$status = $this->db->update('penerima_donasi');

                $this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Sukses Upload Bukti Makanan Diterima']));
				return redirect(base_url('PenerimaController/riwayat_penerimaan'));	
            } catch(Exception $e){
                $this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
				$this->session->set_flashdata('post_data', $this->input->post(NULL, TRUE));
				return redirect(base_url('PenerimaController/upload_bukti'));
            }
		}
		else{
			show_error("Method Not Allowed", 405);
		}
		
	}

}