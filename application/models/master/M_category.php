<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_category extends CI_Model
{    
    static $table1 = 'm_category';
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('database');
    }

    function index(){ 
        $this->db->select('*');             
        $query  = $this->db->get(self::$table1);
        return $query;          
    }

    function view($myid){        
        $this->db->select('*');       
        $this->db->where('m_category_id', $myid);
        $query  = $this->db->get(self::$table1);
        if($query){
            $row = $query->row();
            return json_encode(array(
                'success'              =>true,
                'm_category_id'        => $row->m_category_id, 
                'm_category_name'      => $row->m_category_name
            ));    
        }else{
            return json_encode(array('success'=>false, 'msg'=>'Data tidak ditemukan!'));
        }   
    }

    function create($m_category_name){
        $this->db->where('m_category_name', $m_category_name);
        $query = $this->db->get(self::$table1);
        $row = $query->num_rows();
        if($row > 0){
            return json_encode(array('success'=>false, 'msg'=>'Data sudah ada!'));
        }else{
            $query_1 = $this->db->insert(self::$table1,array(
                'm_category_name'    => $m_category_name
            ));
            if($query_1){
                return json_encode(array('success'=>true, 'msg'=>'Input data berhasil!'));
            }else{
                return json_encode(array('success'=>false, 'msg'=>'Input data gagal!'));
            }        
        }
    }

    function update($m_category_id, $m_category_name){
        $this->db->trans_start();
        $this->db->where('m_category_id', $m_category_id);
        $this->db->update(self::$table1,array(
            'm_category_name'    => $m_category_name
        ));
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            return json_encode(array('success'=>false, 'msg'=>'Update data gagal!'));
        }else {
            return json_encode(array('success'=>true, 'msg'=>'Update data berhasil!'));
        }
    }

    function delete($m_category_id){
        $this->db->trans_start();
        $this->db->delete(self::$table1, array('m_category_id' => $m_category_id));
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            return json_encode(array('success'=>false, 'msg'=>'Hapus data gagal!'));
        }else {
            return json_encode(array('success'=>true, 'msg'=>'Hapus data berhasil!'));
        }
    }
    
}

/* End of file m_category.php */
/* Location: ./application/models/master/m_category.php */