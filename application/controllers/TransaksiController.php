<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TransaksiController extends CI_Controller {
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
		$this->load->model('transaksi');
		$this->load->model('barang');

		if($this->session->user_login['username']){
			$this->username = $this->session->user_login['username'];			
		}
	}

	public function index()
	{
		if ($this->session->user_login['role']==2) {
			$data['transaksi'] = $this->transaksi->getTransaksiUser($this->session->user_login['id']);
		}
		elseif ($this->session->user_login['role']==1) {
			$data['transaksi'] = $this->transaksi->getTransaksiAll();
		}
		$this->slice->view('dashboard.transaksi.index', $data);
	}

	public function tambah()
	{
		$data['barang'] = $this->barang->getAllBarang();
		$this->slice->view('dashboard.transaksi.tambah', $data);
	}

	public function saveTransaksi()
	{
		$id_transaksi = date("mdHis");
		$insert_data = [
			'id' => $id_transaksi,
            'id_kasir' => $this->session->user_login['id'],
            'tanggal' => date("Y-m-d H:i:s"),
            'total' => $this->input->post('fix_total'),
        ];
        $this->db->insert('transaksi', $insert_data);

		$count = count($this->input->post('barang'));
		$total_harga = 0;
		for ($i=0; $i < $count; $i++) {
			$data['barang'] = $this->barang->getBarangID($this->input->post('barang')[$i]);
			$data['barang']->stok -= $this->input->post('jumlah')[$i];
			$this->db->where('id',$data['barang']->id);
            $this->db->update('barang', $data['barang']);  
			$insert_data = [
				'id_transaksi' => $id_transaksi,
                'id_barang' => $this->input->post('barang')[$i],
                'jumlah' => $this->input->post('jumlah')[$i],
                'harga_satuan' => $this->input->post('harga_satuan')[$i],
                'harga_beli_satuan' => $data['barang']->harga_beli,
                'harga_total' => $this->input->post('harga_total')[$i],
            ];
            $this->db->insert('jumlah_transaksi', $insert_data);
            $total_harga = $total_harga + ((int)$this->input->post('jumlah')[$i]*(int)$this->input->post('harga_satuan')[$i]);
		}
		$this->session->set_flashdata('message', array('type' => 'success', 'message' => ['Sukses Menambah Transaksi Pembelian']));
		$this->detail($id_transaksi);
		// return redirect(base_url('TransaksiController/tambah'));
	}

	public function detail($id)
	{
		$data['transaksi'] = $this->transaksi->getTransaksi($id);
		$data['detail'] = $this->transaksi->getDetailTransaksi($id);
		$this->slice->view('dashboard.transaksi.detail', $data);
	}

	public function cetak($id)
	{
		$data['transaksi'] = $this->transaksi->getTransaksi($id);
		$data['detail'] = $this->transaksi->getDetailTransaksi($id);
		// var_dump($data['transaksi']); return;

		$no=1;
		ob_start();
		$pdf = new Pdf('P', 'mm', 'A5', true, 'UTF-8', false);
		$pdf->setPrintHeader(false);
		$pdf->setPrintFooter(false);
		$pdf->AddPage('P', 'A5');
		$html = '
		<h4 style="text-align: center;">Kasir Andhika</h4>
		<div style="text-align: center;">
			<img src="'.base_url('img/logo_kasir.png').'" alt="" width="100px">
		</div><br>
		<table style="font-size:10px;" width="100%">
			<tr>
				<td width="20%">ID transaksi</td>
				<td width="3%">:</td>
				<td width="50%">'.$data['transaksi'][0]->id.'</td>
			</tr>
			<tr>
				<td width="20%">Nama Petugas</td>
				<td width="3%">:</td>
				<td width="50%">'.$data['transaksi'][0]->nama.'</td>
			</tr>
			<tr>
				<td width="20%">Tanggal</td>
				<td width="3%">:</td>
				<td width="50%">'.$data['transaksi'][0]->tanggal.'</td>
			</tr>
			<tr>
				<td width="20%">Total Biaya</td>
				<td width="3%">:</td>
				<td width="50%">'."Rp " . number_format($data['transaksi'][0]->total,2,',','.').'</td>
			</tr>
		</table><br>	
		<hr style="color:black; height: 2px; margin-bottom:20px;"/>
		<table width="100%" style="font-size: 9px;">
			<tr>
				<td width="6%" style="text-align: center; font-weight: bold;">No</td>
				<td width="40%" style="text-align: center; font-weight: bold;">Nama Barang</td>
				<td width="14%" style="text-align: center; font-weight: bold;">Jumlah</td>
				<td width="23%" style="text-align: center; font-weight: bold;">Harga Satuan</td>
				<td width="18%" style="text-align: center; font-weight: bold;">Total</td>
			</tr>';
		foreach($data['detail'] as $pelaksanaan)
		{
			$html = $html.'
				<tr>
					<td style="text-align: center;">'.$no.'</td>
					<td style="text-align: center;">'.$pelaksanaan->nama.'</td>
					<td style="text-align: center;">'.$pelaksanaan->jumlah.'</td>
					<td style="text-align: center;">'."Rp " . number_format($pelaksanaan->harga_satuan,2,',','.').'</td>
					<td style="text-align: right;">'."Rp " . number_format($pelaksanaan->harga_total,2,',','.').'</td>
				</tr>';
				$no++;
		}
		$html = $html.'</table>';
		$pdf->writeHTML($html, true, false, true, false, '');
		ob_clean();
		$filename="Transaksi_".$data['transaksi'][0]->id.".pdf";
		$pdf->Output($filename, 'I');
	}
}