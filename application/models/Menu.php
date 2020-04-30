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
}
?>