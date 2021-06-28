<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_user extends CI_Model
{    
    static $table1 = 'a_user';
    static $table2 = 'a_level';
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('security');
    }

    function index(){        
        $this->db->select('a_user_id, a_user_name, a_user_username, a_user_level, a_level_name');
        $this->db->join(self::$table2, 'a_user_level=a_level_id', 'left');
        $query  = $this->db->get(self::$table1);
        return $query;          
    }
    
    function getLevel(){
        $query  = $this->db->get(self::$table2);
        return $query;        
    }

    function create($a_user_name, $a_user_username, $a_user_password, $a_user_level){
        $this->db->select('a_user_username');
        $this->db->where('a_user_username', $a_user_username);
        $query  = $this->db->get(self::$table1);
        $row = $query->num_rows();
        if($row > 0){
            return json_encode(array('success'=>false, 'msg'=>'Input data gagal, Username sudah ada!'));
        }else{
            $this->db->trans_start();
            $this->db->insert(self::$table1,array(
                'a_user_name'       => $a_user_name,
                'a_user_username'   => $a_user_username,
                'a_user_password'   => password_hash($a_user_password,PASSWORD_DEFAULT),
                'a_user_level'      => $a_user_level
            ));
            $this->db->trans_complete();
            if($this->db->trans_status() === FALSE){
                return json_encode(array('success'=>false, 'msg'=>'Input data gagal!'));
            }else {
                return json_encode(array('success'=>true, 'msg'=>'Input data berhasil!'));
            }
        }
    }

    function view($myid){        
        $this->db->select('*');
        $this->db->join(self::$table2, 'a_user_level=a_level_id', 'left');
        $this->db->where('a_user_id', $myid);
        $query  = $this->db->get(self::$table1);
        if($query){
            $row = $query->row();
            return json_encode(array(
                'success'           =>true,
                'a_user_id'         => $row->a_user_id, 
                'a_user_name'       => $row->a_user_name,
                'a_user_username'   => $row->a_user_username,
                'a_user_password'   => $row->a_user_password,
                'a_level_id'        => $row->a_level_id,
                'a_level_name'      => $row->a_level_name
            ));    
        }else{
            return json_encode(array('success'=>false, 'msg'=>'Data tidak ditemukan!'));
        }   
    }

    function update($a_user_id, $a_user_name, $a_user_username, $a_user_password, $a_user_level){     
        if($a_user_id == 1){
            return json_encode(array('success'=>false, 'msg'=>'Administrator tidak bisa diedit!'));
        }else{
            if($a_user_password==''){
                $this->db->trans_start();
                $this->db->where('a_user_id', $a_user_id);
                $this->db->update(self::$table1,array(
                    'a_user_name'       => $a_user_name,
                    'a_user_username'   => $a_user_username,
                    'a_user_level'      => $a_user_level
                ));
                $this->db->trans_complete();
                if($this->db->trans_status() === FALSE){
                    return json_encode(array('success'=>false, 'msg'=>'Update data gagal!'));
                }
                else {
                    return json_encode(array('success'=>true, 'msg'=>'Update data berhasil!'));
                }
            }else{
                $this->db->trans_start();
                $this->db->where('a_user_id', $a_user_id);
                $this->db->update(self::$table1,array(
                    'a_user_name'       => $a_user_name,
                    'a_user_username'   => $a_user_username,
                    'a_user_password'   => password_hash($a_user_password,PASSWORD_DEFAULT),
                    'a_user_level'      => $a_user_level
                ));
                $this->db->trans_complete();
                if($this->db->trans_status() === FALSE){
                    return json_encode(array('success'=>false, 'msg'=>'Update data gagal!'));
                }else {
                    return json_encode(array('success'=>true, 'msg'=>'Update data berhasil!'));
                }
            }
        }   
    }

    function delete($a_user_id){
        if($a_user_id == 1){
            return json_encode(array('success'=>false, 'msg'=>'Administrator tidak bisa dihapus!'));
        }else{
            $this->db->trans_start();
            $this->db->delete(self::$table1, array('a_user_id' => $a_user_id));
            $this->db->trans_complete();
            if($this->db->trans_status() === FALSE){
                return json_encode(array('success'=>false, 'msg'=>'Update data gagal!'));
            }else {
                return json_encode(array('success'=>true, 'msg'=>'Hapus data berhasil!'));
            }
        }
    }
}

/* End of file m_user.php */
/* Location: ./application/models/admin/m_user.php */