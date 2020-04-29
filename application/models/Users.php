<?php 
    class Users extends CI_Model{

        public function getUser($id){ 
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('id', $id);
            $query = $this->db->get(); 
            return $query->first_row();
        }

        public function getUserID($id){ 
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('id', $id);
            $query = $this->db->get(); 
            return $query->first_row();
        }

        public function getUserKasir(){ 
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('role', 2);
            $query = $this->db->get();
            return $query->result();
        }

        public function delUser($id){
            $this->db->where('id', $id);
            try{
                $this->db->delete('user');
                return true;
            }catch(Exception $e){
                return false;
            }
        }

        public function updateProfil($id, $data = []){
            if(sizeof($data) <= 0){
                return 0;
            }
            $update_data = [
                'nama' => $data['nama'],
                'email' => $data['email'],
                'no_telp' => $data['telp'],
                'alamat' => $data['alamat'],
                // 'foto_kk' => $data['foto_kk'],
                // 'foto_ktp' => $data['foto_ktp'],
                // 'foto_depan_rumah' => $data['foto_depan_rumah'],
                'longitude' => $data['longitude'],
                'latitude' => $data['latitude'],
            ];
            $this->db->where('email',$id);
            try{
                $this->db->update('user', $update_data);
                return true;
            }catch(Exception $e)
            {
                return false;
            }
        }

        public function countUser($role)
        {
            $sql = "SELECT COUNT(*) as jumlah FROM user WHERE role = ? " ; 
            return $this->db->query($sql, array($role))->first_row();
        }

        public function getPenerima($id)
        {
            $sql = "SELECT * FROM user WHERE id IN (SELECT id_user FROM penerima_donasi WHERE id_donasi = ?)" ; 
            return $this->db->query($sql, array($id))->result();
        }

        public function getAllPenerima()
        {
            
        }
    }
?>   