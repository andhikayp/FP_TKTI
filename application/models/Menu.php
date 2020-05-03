<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Model
{
    public function getAllMenu($id)
    {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->where('id_mitra', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getMenuById($id)
    {
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->first_row();
    }

    public function getAllMitra()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('role', 'Mitra');
        $this->db->where('is_verif', '1');
        $query = $this->db->get();
        return $query->result();
    }

    public function updateMenu($id, $data = []){
        if(sizeof($data) <= 0){
            return 0;
        }
        $update_data = [
            'nama_menu' => $data['nama'],
            'jumlah' => $data['jumlah'],
            'harga' => $data['harga'],
            'deskripsi' => $data['deskripsi'],
        ];
        $this->db->where('id',$id);
        try{
            $this->db->update('menu', $update_data);
            return true;
        }catch(Exception $e)
        {
            return false;
        }
    }

    public function delMenu($id){
        $this->db->where('id', $id);
        try{
            $this->db->delete('menu');
            return true;
        }catch(Exception $e){
            return false;
        }
    }
}
?>