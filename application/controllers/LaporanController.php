<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanController extends CI_Controller {
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
		$data['transaksi'] = $this->transaksi->getTransaksiAll();
        require_once APPPATH.'/third_party/Phpexcel/Bootstrap.php';     
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

        $spreadsheet->setActiveSheetIndex();
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(22);
       
        $spreadsheet->getActiveSheet()->setCellValue('A1','No');
        $spreadsheet->getActiveSheet()->setCellValue('B1','ID Transaksi');
        $spreadsheet->getActiveSheet()->setCellValue('C1','Nama Petugas');
        $spreadsheet->getActiveSheet()->setCellValue('D1','Tanggal');
        $spreadsheet->getActiveSheet()->setCellValue('E1','Total Harga');
        $spreadsheet->getActiveSheet()->setCellValue('F1','Keuntungan');

        $spreadsheet->getActiveSheet()->setCellValue('G1','Nama Barang');
        $spreadsheet->getActiveSheet()->setCellValue('H1','Jumlah');
        $spreadsheet->getActiveSheet()->setCellValue('I1','Harga Satuan');
        $spreadsheet->getActiveSheet()->setCellValue('J1','Total Per Barang');
        $spreadsheet->getActiveSheet()->setCellValue('K1','Harga Beli');
        $spreadsheet->getActiveSheet()->setCellValue('L1','Keuntungan Per Barang');

        $nomor=1;
        $z=0;
        for ($i=2, $j=0; $i < sizeof($data['transaksi'])+2 ; $i++, $j++) { 
        	$index = $i+$z;
            $spreadsheet->getActiveSheet()->setCellValue('A'.$index,$nomor,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $nomor++;
            $spreadsheet->getActiveSheet()->setCellValue('B'.$index,$data['transaksi'][$j]->id,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $spreadsheet->getActiveSheet()->setCellValue('C'.$index,$data['transaksi'][$j]->nama,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
            $spreadsheet->getActiveSheet()->setCellValue('D'.$index,$data['transaksi'][$j]->tanggal,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $spreadsheet->getActiveSheet()->setCellValue('E'.$index,$data['transaksi'][$j]->total,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);

			$data['detail'] = $this->transaksi->getDetailTransaksi($data['transaksi'][$j]->id);
			$keuntungan_transaksi = 0;
            for ($k=$i+$z, $l=0; $k < sizeof($data['detail'])+$i+$z ; $k++, $l++) {
            	$index_detail = $k+1; 
                $spreadsheet->getActiveSheet()->setCellValue('G'.$index_detail,$data['detail'][$l]->nama,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $spreadsheet->getActiveSheet()->setCellValue('H'.$index_detail,$data['detail'][$l]->jumlah,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $spreadsheet->getActiveSheet()->setCellValue('I'.$index_detail,$data['detail'][$l]->harga_satuan,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC);
                $spreadsheet->getActiveSheet()->setCellValue('J'.$index_detail,$data['detail'][$l]->harga_total,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $spreadsheet->getActiveSheet()->setCellValue('K'.$index_detail,$data['detail'][$l]->harga_beli_satuan,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $untung = $data['detail'][$l]->harga_satuan - $data['detail'][$l]->harga_beli_satuan;
                $spreadsheet->getActiveSheet()->setCellValue('L'.$index_detail,$untung,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
                $keuntungan_transaksi += $untung;
            }
            $spreadsheet->getActiveSheet()->setCellValue('F'.$index,$keuntungan_transaksi,\PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
			$z += sizeof($data['detail']);
        }

        $filename='Laporan_Transaksi.xls'; 
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'"'); 
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        ob_end_clean();
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Excel5');
        $writer->save('php://output','xls');
    }
}