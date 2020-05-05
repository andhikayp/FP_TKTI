<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MitraController extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->library('slice');
        $this->load->model('users');
        $this->load->model('query');
    }

    public function index()
    {
    }
    
    public function pesanan_masuk()
    {
        $data['donasi'] = $this->query->all('donasi');
        $this->slice->view('dashboard.mitra.pesanan_masuk', $data);
    }

    public function terima($id){
        $this->db->set('status_donasi', 1);
        $this->db->where('id', $id);
		$status = $this->db->update('donasi');
		return redirect(base_url('MitraController/pesanan_masuk'));
    }

    public function tolak($id){
        $this->db->set('status_donasi', 2);
        $this->db->where('id', $id);
		$status = $this->db->update('donasi');
		return redirect(base_url('MitraController/pesanan_masuk'));
    }
}
?>