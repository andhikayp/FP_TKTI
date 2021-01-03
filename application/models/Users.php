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
            $config['upload_path'] = './img/user';
            $config['allowed_types'] = 'pdf|docx|doc|jpg|jpeg|png';
            $config['max_size'] = 100000;
            $config['overwrite'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            $files = $_FILES;
            $cpt = count ( $_FILES ['file'] ['name'] );
            for($i = 0; $i < $cpt; $i ++) {

                $_FILES ['file'] ['name'] = $files ['file'] ['name'] [$i];
                $_FILES ['file'] ['type'] = $files ['file'] ['type'] [$i];
                $_FILES ['file'] ['tmp_name'] = $files ['file'] ['tmp_name'] [$i];
                $_FILES ['file'] ['error'] = $files ['file'] ['error'] [$i];
                $_FILES ['file'] ['size'] = $files ['file'] ['size'] [$i];

                $this->upload->do_upload ('file');
            }
            $this->db->select('*');
            $this->db->from('user');
            $this->db->where('id', $id);
            $baris = $this->db->get()->first_row();

            if($files['file']['name'][0] == NULL) $foto_ktp = $baris->foto_ktp;
            else $foto_ktp = $files['file']['name'][0];

            if($files['file']['name'][1] == NULL) $foto_kk = $baris->foto_kk;
            else $foto_kk = $files['file']['name'][1];

            if($files['file']['name'][2] == NULL) $foto_depan_rumah = $baris->foto_depan_rumah;
            else $foto_depan_rumah = $files['file']['name'][2];
		
            $update_data = [
                'nama' => $data['nama'],
                'email' => $data['email'],
                'no_telp' => $data['telp'],
                'alamat' => $data['alamat'],
                'jmlh_anggota_keluarga' => $data['jmlh_anggota_keluarga'],
                'foto_kk' => $foto_kk,
                'foto_ktp' => $foto_ktp,
                'foto_depan_rumah' => $foto_depan_rumah,
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
            $sql = "SELECT * FROM penerima_donasi WHERE id_donasi = ?" ; 
            return $this->db->query($sql, array($id))->result();
        }

        public function getPenerimaDone($id)
        {
            $sql = "SELECT COUNT(*) as done FROM penerima_donasi WHERE id_donasi = ? AND bukti IS NOT NULL" ; 
            return $this->db->query($sql, array($id))->first_row();
        }

        public function getPenerimaAll()
        {
            $sql = "SELECT * FROM penerima_donasi" ; 
            return $this->db->query($sql)->result();
        }
    }
