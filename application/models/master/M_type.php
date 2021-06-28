<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_type extends CI_Model
{    
    static $table1 = 'm_type';
    
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
        $this->db->where('m_type_id', $myid);
        $query  = $this->db->get(self::$table1);
        if($query){
            $row = $query->row();
            return json_encode(array(
                'm_type_id'        => $row->m_type_id, 
                'm_type_name'      => $row->m_type_name
            ));    
        }else{
            $this->session->set_flashdata('warning','Data tidak ditemukan!');
            redirect(site_url("master/type"));
        }   
    }

    function create($m_type_name){
        $this->db->where('m_type_name', $m_type_name);
        $query = $this->db->get(self::$table1);
        $row = $query->num_rows();
        if($row > 0){
            $this->session->set_flashdata('warning','Data sudah ada!');
            redirect(site_url("admin/Group"));
        }else{
            $query_1 = $this->db->insert(self::$table1,array(
                'm_type_name'    => $m_type_name
            ));
            if($query_1){
                $this->session->set_flashdata('success','Input data berhasil!');
                redirect(site_url("master/type"));
            }else{
                $this->session->set_flashdata('error','Input data gagal!');
                redirect(site_url("master/type"));
            }        
        }
    }

    function update($m_type_id, $m_type_name){
        $this->db->trans_start();
        $this->db->where('m_type_id', $m_type_id);
        $this->db->update(self::$table1,array(
            'm_type_name'    => $m_type_name
        ));
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            $this->session->set_flashdata('error','Update data gagal!');
            redirect(site_url("master/type"));
        }else {
            $this->session->set_flashdata('success','Update data berhasil!');
            redirect(site_url("master/type"));
        }
    }

    function delete($m_type_id){
        $this->db->trans_start();
        $this->db->delete(self::$table1, array('m_type_id' => $m_type_id));
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            return json_encode(array('success'=>false));
        }else {
            return json_encode(array('success'=>true));
        }
    }
    
}

/* End of file m_type.php */
/* Location: ./application/models/master/m_type.php */