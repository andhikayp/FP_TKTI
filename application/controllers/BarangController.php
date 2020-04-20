<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BarangController extends CI_Controller 
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
		$this->load->model('barang');

		if($this->session->user_login['username']){
			$this->username = $this->session->user_login['username'];			
		}
	}

	public function index()
	{
		$data['barang'] = $this->barang->getAllBarang();
		$this->slice->view('dashboard.barang.admin.index', $data);
	}

	public function tambah()
	{
		$data['kategori'] = $this->barang->getKategori();
		$this->slice->view('dashboard.barang.admin.tambah', $data);
	}

	public function saveBarang()
	{
		$config['upload_path']          = './img/barang/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']             = 30000;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		$config['overwrite']			= true;

		$this->load->library('upload', $config);
		$this->upload->do_upload('foto');
		$insert_data = [
            'nama' => $this->input->post('nama'),
            'foto' => $_FILES["foto"]["name"],
            'deskripsi' => $this->input->post('deskripsi'),
            'kategori' => $this->input->post('kategori'),
            'harga_beli' => $this->input->post('harga_beli'),
            'harga_jual' => $this->input->post('harga_jual'),
            'stok' => $this->input->post('stok'),
        ];
        try{
            $this->db->insert('barang', $insert_data);
            $this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Sukses Menambah Barang']));
			return redirect(base_url('BarangController/index'));	
        } catch(Exception $e){
            $this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
			$this->session->set_flashdata('post_data', $this->input->post(NULL, TRUE));
			return redirect(base_url('BarangController/tambah'));
        }
	}

	public function tambahStok()
	{
		$data['barang'] = $this->barang->getAllBarang();
		$this->slice->view('dashboard.barang.admin.tambah_stok', $data);
	}

	public function saveStokBarang()
	{
		$barang = $this->barang->getBarangID($this->input->post('nama'));
		$barang->stok = $barang->stok + (int)$this->input->post('stok');
		$update_data = [
            'stok' => $barang->stok,
        ];
        $this->db->where('id',$this->input->post('nama'));
        try{
            $this->db->update('barang', $update_data);
            $this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Stok Barang Berhasil Ditambah']));
			return redirect(base_url('BarangController/index'));
        } catch(Exception $e) {
        	$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Stok Barang Gagal Ditambah']));
			return redirect(base_url('BarangController/index'));
        }
	}

	public function deleteBarang($id)
	{
		$this->barang->delbarang($id);
		$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Barang Berhasil Dihapus']));
		return redirect(base_url('BarangController/index'));
	}

	public function editHarga($id)
	{
		$data['barang'] = $this->barang->getBarangID($id);
		$this->slice->view('dashboard.barang.admin.edit', $data);
	}

	public function saveHarga()
	{
		$update_data = [
            'harga_beli' => $this->input->post('harga_beli'),
            'harga_jual' => $this->input->post('harga_jual'),
        ];
        $this->db->where('id',$this->input->post('id'));
        try{
            $this->db->update('barang', $update_data);
            $this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Harga Barang Berhasil Diedit']));
			return redirect(base_url('BarangController/index'));
        } catch(Exception $e) {
        	$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Harga Barang Gagal Diedit']));
			return redirect(base_url('BarangController/index'));
        }
	}
}