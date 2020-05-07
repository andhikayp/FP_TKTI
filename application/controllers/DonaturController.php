<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DonaturController extends CI_Controller {

	public $menu_id;

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

		if(!$this->session->user_login)
		{
			$this->session->set_flashdata('message', array('type' => 'error', 'message' => ["Silahkan masuk terlebih dahulu"]));
			redirect(base_url("auth/index")); 
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

	public function create($id)
	{
		if ($_SERVER['REQUEST_METHOD'] == "GET"){
			$data['menu_id']=$id;
			$data['menu']=$this->query->getJumlahPesanan($id);
			$data['mitra']=$this->query->getDataMitra($data['menu']->id_mitra);
			$data['jumlah_transfer'] = (105/100) * $data['menu']->harga;
			$this->slice->view('dashboard.donasi.create', $data);
			//query data menu jumlah, harga, id_menu, mitra_id
		}
	}

	public function posted(){
		if($_SERVER['REQUEST_METHOD'] == "POST"){

			$config['upload_path']          = './img/folder_bukti/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 30000;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;
			$config['overwrite']			= true;

			$this->load->library('upload', $config);
			$this->upload->do_upload('bukti');
			
			$data['menu']=$this->query->getJumlahPesanan($this->input->post('id_menu'));
			$data['mitra']=$this->query->getDataMitra($data['menu']->id_mitra);
			$data['relawan']=$this->query->getRelawanOrderBy();
			var_dump($data['relawan']);
			$dt = new DateTime();
			$harga_plus_gaji = (105/100) * $data['menu']->harga;

			$insert_data = [
                'jumlah_makanan' => $data['menu']->jumlah,
                'harga' => $harga_plus_gaji,
                'tanggal_donasi' => $dt->format('Y-m-d H:i:s'),
				'donatur_id' =>  $this->session->user_login['id'],
				'deskripsi' => $this->input->post('deskripsi'),
				'nama_mitra' => $data['mitra']->nama, 
				'alamat' => $data['mitra']->alamat,
				'longitude' => $data['mitra']->longitude,
				'latitude' => $data['mitra']->latitude,
				'mitra_id' => $data['menu']->id_mitra,
				'relawan_id' => $data['relawan']->id,
				'menu_id' => $this->input->post('id_menu'),
				'bukti' => $_FILES["bukti"]["name"],
                
			];

			$update_jumlah_antar = $data['relawan']->jmlh_terima_makanan + 1;
				$this->db->set('jmlh_terima_makanan', $update_jumlah_antar);
				$this->db->where('id', $data['relawan']->id);
				$status = $this->db->update('user');
            try{
				$this->db->insert('donasi', $insert_data);
				$data['donasi'] =  $this->query->getIDDonasi($dt->format('Y-m-d H:i:s'));
				$data['penerima']= $this->query->getPenerima();
				$data['relawan']=$this->query->getRelawanOrderBy();
				// var_dump($data['donasi']->jumlah_makanan); return;
				$jumlah_makanan = $data['donasi']->jumlah_makanan;
				$id_donasi = $data['donasi']->id;
				foreach ($data['penerima'] as $data) {
					if ($jumlah_makanan - $data->jmlh_anggota_keluarga > 0) {
						$jumlah_makanan -= $data->jmlh_anggota_keluarga;
					}
					else {
						$data->jmlh_anggota_keluarga = $jumlah_makanan;
						$jumlah_makanan = -100;
					}
					$insert_data = [
						'penerima_id' => $data->id,
						'nama' => $data->nama,
						'alamat' => $data->alamat,
						'telp' =>  $data->no_telp,
						'jumlah_makanan' => $data->jmlh_anggota_keluarga,
						'longitude' => $data->longitude,
						'latitude' => $data->latitude,
						'id_donasi' => $id_donasi,
						'flag_kirim' => '0',
					];
					$this->db->insert('penerima_donasi', $insert_data);
					
					// update jumlah makanan
					$update_jumlah_makanan = $data->jmlh_terima_makanan + 1;
					$this->db->set('jmlh_terima_makanan', $update_jumlah_makanan);
					$this->db->where('id', $data->id);
					$status = $this->db->update('user');

					if ($jumlah_makanan == -100) break;
				}

				// var_dump($data['relawan']->jmlh_terima_makanan);
				//update relawan
				// $update_jumlah_antar = $data['relawan']->jmlh_terima_makanan + 1;
				// $this->db->set('jmlh_terima_makanan', $update_jumlah_antar);
				// $this->db->where('id', $data['relawan']->id);
				// $status = $this->db->update('user');
				

                $this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Sukses Menambah Data Donasi']));
				return redirect(base_url('DonaturController/detail_donasi/'.$id_donasi));	
            } catch(Exception $e){
                $this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
				$this->session->set_flashdata('post_data', $this->input->post(NULL, TRUE));
				return redirect(base_url('DonaturController/create'));
			}
		}
		else{
			show_error("Method Not Allowed", 405);
		}
	}

	public function daftarPenerima(){
		$this->slice->view('dashboard.donasi.daftar_penerima',$data);
	}

	public function detail_penerima($id){
		$data['penerima']= $this->query->getPenerimaByID($id);
		$this->slice->view('dashboard.donasi.detail_penerima',$data);
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

	public function request()
	{
		if ($_SERVER['REQUEST_METHOD'] == "GET"){
			$this->slice->view('dashboard.donasi.request');
		}
		elseif($_SERVER['REQUEST_METHOD'] == "POST"){
			$status = $this->db->insert('request', $this->input->post());
			if(!$status){
				$this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
				$this->session->set_flashdata('post_data', $this->input->post(NULL, TRUE));
				return redirect(base_url('DonaturController/request'));	
			}
			else{
				$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Request Makanan Berhasil Dilakukan. Tunggu Notifikasi Lebih Lanjut']));
				return redirect(base_url('DonaturController/list_request'));	
			}
		}
		else{
			show_error("Method Not Allowed", 405);
		}
	}

	public function list_request()
	{
		if ($this->session->user_login['role'] == "Penerima Makanan") {
			$data['donasi'] = $this->query->get_request_id($this->session->user_login['id']);
		}
		else {
			$data['donasi'] = $this->query->all('request');
		}
		$this->slice->view('dashboard.donasi.list_request', $data);
	}

	public function detail_request($id)
	{
		$data['request'] = $this->query->find('request', $id);
		$data['penerima'] = $this->query->find('user', $data['request']->user_id);
		$data['pengirim'] = $this->query->find('user', $data['request']->user_pengirim);
		$data['donatur'] = $this->query->find('user', $data['request']->user_donatur);
		$this->slice->view('dashboard.donasi.detail_request', $data);
	}

	public function terima($id)
	{
		date_default_timezone_set('Asia/Jakarta'); 
		$this->db->set('status', 2);
		$this->db->set('tanggal_verif', date("Y-m-d H:i:s"));
        $this->db->where('id', $id);
		$status = $this->db->update('request');
		if(!$status){
			$this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
		}
		else{
			$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Tanda Terima Berhasil']));
		}
		return redirect(base_url('DonaturController/list_request'));	
	}

	public function detail_donasi($id)
	{
		$data['donasi'] = $this->query->find('donasi', $id);
		$data['donatur'] = $this->query->find('user', $data['donasi']->donatur_id);
		$data['mitra'] = $this->query->find('user', $data['donasi']->mitra_id);
		$data['relawan'] = $this->query->find('user', $data['donasi']->relawan_id);
		$data['menu'] = $this->query->find('menu', $data['donasi']->menu_id);
		$data['penerima'] = $this->users->getPenerima($id);
		$data['progres'] = ($this->users->getPenerimaDone($id)->done / count($data['penerima'])) * 100;
		$this->slice->view('dashboard.donasi.detail_donasi', $data);
	}

	public function kirim($id)
	{
		// var_dump($id); return;
		$data['kirim'] = $this->query->kirim($id);
		$this->slice->view('dashboard.donasi.kirim', $data);
	}
}

/* End of file DonaturController.php */
/* Location: ./application/controllers/DonaturController.php */