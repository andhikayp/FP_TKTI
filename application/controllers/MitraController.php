<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MitraController extends CI_Controller
{
    public function index()
    {
		
    }
    
    public function pesanan_masuk()
    {

		$this->slice->view('dashboard.mitra.pesanan_masuk');
    }
}
?>