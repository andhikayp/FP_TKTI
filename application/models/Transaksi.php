<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends CI_Model {
	public function getTransaksiAll()
	{
		$sql = "SELECT t.*, u.nama FROM transaksi t, user u WHERE u.id = t.id_kasir; " ; 
            return $this->db->query($sql)->result();
	}
	
	public function getTransaksi($id)
	{
		$sql = "SELECT t.*, u.nama FROM transaksi t, user u WHERE t.id=? AND u.id = t.id_kasir; " ; 
            return $this->db->query($sql, array($id))->result();
	}

	public function getTransaksiUser($id_user)
	{
		$this->db->select('*');
		$this->db->from('transaksi');
		$this->db->where('id_kasir', $id_user);
		$query = $this->db->get();
		return $query->result();
	}

	public function getDetailTransaksi($id_transaksi)
	{
		$sql = "SELECT j.*, b.* FROM jumlah_transaksi j JOIN barang b ON j.id_barang = b.id WHERE j.id_transaksi = ?; " ; 
            return $this->db->query($sql, array($id_transaksi))->result();
	}
}