<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Model {

	public function getAllBarang()
	{
		$this->db->select('*');
		$this->db->from('barang');
		$query = $this->db->get();
		return $query->result();
	}

	public function getBarangID($id)
	{
		$this->db->select('*');
		$this->db->from('barang');
		$this->db->where('id', $id);
		$query = $this->db->get();
		return $query->first_row();
	}

	public function getKategori()
	{
		$this->db->select('*');
		$this->db->from('kategori');
		$query = $this->db->get();
		return $query->result();
	}

	public function delbarang($id)
	{
		$this->db->where('id', $id);
        try{
            $this->db->delete('barang');
            return true;
        }catch(Exception $e){
            return false;
        }
	}
}