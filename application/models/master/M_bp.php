<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_bp extends CI_Model
{    
    static $table1  = 'm_bp';
    static $table2  = 'm_sts';

    public function __construct() {
        parent::__construct();
        $this->load->helper('database'); // Digunakan untuk memunculkan data Enum
    }
    
    function index(){ 
        $this->db->select('*');
        $this->db->join(self::$table2, 'm_bp_active = m_sts_id', 'left');             
        $query  = $this->db->get(self::$table1);
        return $query;          
    }

    function view($myid){        
        $this->db->select('*');        
        $this->db->where('m_bp_id', $myid);
        $query  = $this->db->get(self::$table1);
        if($query){
            $row = $query->row();
            return json_encode(array(
                'success'         =>true,
                'm_bp_id'         => $row->m_bp_id, 
                'm_bp_code'       => $row->m_bp_code, 
                'm_bp_name'       => $row->m_bp_name, 
                'm_bp_ctc'        => $row->m_bp_ctc, 
                'm_bp_alt'        => $row->m_bp_alt, 
                'm_bp_tlp'        => $row->m_bp_tlp,
                'm_bp_fax'        => $row->m_bp_fax, 
                'm_bp_active'     => $row->m_bp_active,
                'm_bp_jns'        => $row->m_bp_jns
            ));    
        }else{
            return json_encode(array('success'=>false, 'msg'=>'Data tidak ditemukan!'));
        }   
    }
        
    function create($m_bp_code,$m_bp_name,$m_bp_ctc,$m_bp_alt,$m_bp_tlp,$m_bp_fax,$m_bp_active,$m_bp_jns){
        $query = $this->db->insert(self::$table1,array(
            'm_bp_code'       => $m_bp_code,
            'm_bp_name'       => $m_bp_name,
            'm_bp_ctc'        => $m_bp_ctc,
            'm_bp_alt'        => $m_bp_alt,
            'm_bp_tlp'        => $m_bp_tlp,
            'm_bp_fax'        => $m_bp_fax,
            'm_bp_active'     => $m_bp_active,
            'm_bp_jns'        => $m_bp_jns
        ));
        if($query){
            return json_encode(array('success'=>true, 'msg'=>'Input data berhasil!'));
        }else{
            return json_encode(array('success'=>false, 'msg'=>'Input data gagal!'));
        } 
        
    }
    
    function update($m_bp_id,$m_bp_code,$m_bp_name,$m_bp_ctc,$m_bp_alt,$m_bp_tlp,$m_bp_fax,$m_bp_active,$m_bp_jns){
        $this->db->where('m_bp_id', $m_bp_id);
        $query = $this->db->update(self::$table1,array(
            'm_bp_code'       => $m_bp_code,
            'm_bp_name'       => $m_bp_name,
            'm_bp_ctc'        => $m_bp_ctc,
            'm_bp_alt'        => $m_bp_alt,
            'm_bp_tlp'        => $m_bp_tlp,
            'm_bp_fax'        => $m_bp_fax,
            'm_bp_active'     => $m_bp_active,
            'm_bp_jns'        => $m_bp_jns
        ));
        if($query){
            return json_encode(array('success'=>true, 'msg'=>'Update data berhasil!'));
        }
        else{
            return json_encode(array('success'=>false, 'msg'=>'Update data gagal!'));
        }
    }
    
    function delete($m_bp_id){
        $query = $this->db->delete(self::$table1, array('m_bp_id' => $m_bp_id));
        if($query){
            return json_encode(array('success'=>true, 'msg'=>'Hapus data berhasil!'));
        }else{
            return json_encode(array('success'=>false, 'msg'=>'Hapus data gagal!'));
        }
    }
        
}

/* End of file m_bp.php */
/* Location: ./application/models/master/m_bp.php */