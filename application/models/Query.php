<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Query extends CI_Model {

	public function all($db)
	{
		$this->db->select('*');
		$this->db->from($db);
		$query = $this->db->get();
		return $query->result();
	}

	public function find($db, $id)
	{
		$this->db->select('*');
		$this->db->from($db);
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->first_row();
	}

	public function get_donasi_id($id)
	{
		$this->db->select('*');
		$this->db->from('donasi');
		$this->db->where('donatur_id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_request_id($id)
	{
		$this->db->select('*');
		$this->db->from('request');
		$this->db->where('user_id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function getJumlahPesanan($id){
		$sql = "SELECT harga, jumlah, id_mitra FROM menu WHERE id = ?; " ; 
            return $this->db->query($sql, array($id))->first_row();
	}

	public function getDataMitra($id){
		$sql = "SELECT alamat, longitude, latitude FROM user WHERE id = ?; " ; 
            return $this->db->query($sql, array($id))->first_row();
	}
	public function getMitraByID($id){
		$sql = "SELECT * FROM user WHERE id = ?; " ; 
            return $this->db->query($sql, array($id))->first_row();
	}

	public function getPenerima(){
		$sql = "SELECT * FROM user WHERE role = 'Penerima' AND is_verif=1 ORDER BY jmlh_terima_makanan ASC;" ; 
        return $this->db->query($sql)->result();
	}

	public function getPenerimaByID($id){
		$sql = "SELECT * FROM user WHERE id = ?;" ; 
            return $this->db->query($sql, array($id))->first_row();
	}
	public function getIDDonasi($tanggal){
		$sql = "SELECT * FROM donasi WHERE tanggal_donasi = ?;" ; 
            return $this->db->query($sql, array($tanggal))->first_row();
	}
	public function getTambahJumlahTerima($id_donasi){

	}
}

/* End of file Query.php */
/* Location: ./application/models/Query.php */