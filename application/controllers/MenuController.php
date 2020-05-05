<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MenuController extends CI_Controller
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
		$this->load->model('menu');
		$this->load->model('query');

		if($this->session->user_login['username']){
			$this->username = $this->session->user_login['username'];			
        }
    }

    public function index($id)
    {
		// $id = $this->session->user_login['id'];
		$data['menu'] = $this->menu->getAllMenu($id);
		$data['mitra']= $this->query->getMitraByID($id);
		$this->slice->view('dashboard.menu.index', $data);
	}
	
	public function tambah($id)
	{
		$data['id'] = $this->session->user_login['id'];
		$this->slice->view('dashboard.menu.tambah', $data);
	}

	public function saveMenu()
	{
		$config['upload_path']          = './img/menu/';
		$config['allowed_types']        = 'gif|jpg|png|jpeg';
		$config['max_size']             = 30000;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		$config['overwrite']			= true;

		$this->load->library('upload', $config);
		$this->upload->do_upload('foto');
		// $this->upload->data();
		$insert_data = [
            'nama_menu' => $this->input->post('nama'),
            'harga' => $this->input->post('harga'),
            'jumlah' => $this->input->post('jumlah'),
            'id_mitra' => $this->input->post('id'),
            'deskripsi' => $this->input->post('deskripsi'),
            'foto_menu' => $_FILES["foto"]["name"],
        ];
        try{
            $this->db->insert('menu', $insert_data);
            $this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Sukses Menambah Menu']));
			return redirect(base_url('MenuController/index'));	
        } catch(Exception $e){
            $this->session->set_flashdata('message', array('type' => 'error', 'message' => [validation_errors()]));
			$this->session->set_flashdata('post_data', $this->input->post(NULL, TRUE));
			return redirect(base_url('MenuController/tambah'));
        }
	}

	public function detail($id)
	{
		$data['menu'] = $this->menu->getMenuById($id);
		// var_dump($data);
		$this->slice->view('dashboard.menu.detail', $data);
	}

	public function edit($id)
	{

		$data['menu'] = $this->menu->getMenuById($id);
		// var_dump($data);
		$this->slice->view('dashboard.menu.edit', $data);
	}

	public function saveEdit()
	{
		$input = $this->input->post(NULL, TRUE);
		// var_dump($input);
		$status = $this->menu->updateMenu($this->input->post('id'), $input);
		$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Sukses Mengedit Data Menu']));
		return redirect(base_url('MenuController/index'));
	}

	public function deleteMenu($id){
		$this->menu->delMenu($id);
		$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Menu Berhasil Dihapus']));
		return redirect(base_url('MenuController/index'));
	}

	public function daftarMitra()
	{
		$data['mitra'] = $this->menu->getAllMitra();
		// var_dump($data['mitra'][0]); return;
		$this->slice->view('dashboard.menu.mitra', $data);
	}
}
?>