<?php 
    class Authentikasi extends CI_Model 
    {     
        function check_login($table, $field1, $field2) 
        { 
            $this->db->select('*'); 
            $this->db->from($table); 
            $this->db->where($field1); 
            $this->db->where($field2); 
            $this->db->limit(1); 
            $query = $this->db->get(); 
            if ($query->num_rows() == 0)  
            { 
                return FALSE; 
            }  
            else  
            { 
                return $query->first_row(); 
            } 
        }

        function ganti_password($username,$password_baru)
        {
            $this->db->set('password', $password_baru);
            $this->db->where('email', $username);

            if($this->db->update('user'))
            {
                return true;
            }
            else return false;
        }
    } 
?>