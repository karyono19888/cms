<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_line extends CI_Model
{    
    static $table1 = 'm_line';
    
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
        $this->db->where('m_line_id', $myid);
        $query  = $this->db->get(self::$table1);
        if($query){
            $row = $query->row();
            return json_encode(array(
                'm_line_id'         => $row->m_line_id, 
                'm_line_name'       => $row->m_line_name,
                'm_line_leader'     => $row->m_line_leader,
                'm_line_keterangan' => $row->m_line_keterangan
            ));    
        }else{
            $this->session->set_flashdata('warning','Data tidak ditemukan!');
            redirect(site_url("master/Line"));
        }   
    }

    function create($m_line_name, $m_line_leader, $m_line_keterangan){
        $this->db->where('m_line_name', $m_line_name);
        $query = $this->db->get(self::$table1);
        $row = $query->num_rows();
        if($row > 0){
            $this->session->set_flashdata('warning','Data sudah ada!');
            redirect(site_url("master/Line"));
        }else{
            $query_1 = $this->db->insert(self::$table1,array(
                'm_line_name'       => $m_line_name,
                'm_line_leader'     => $m_line_leader,
                'm_line_keterangan' => $m_line_keterangan
            ));
            if($query_1){
                $this->session->set_flashdata('success','Input data berhasil!');
                redirect(site_url("master/Line"));
            }else{
                $this->session->set_flashdata('error','Input data gagal!');
                redirect(site_url("master/Line"));
            }        
        }
    }

    function update($m_line_id, $m_line_name, $m_line_leader, $m_line_keterangan){
        $this->db->trans_start();
        $this->db->where('m_line_id', $m_line_id);
        $this->db->update(self::$table1,array(
            'm_line_name'       => $m_line_name,
            'm_line_leader'     => $m_line_leader,
            'm_line_keterangan' => $m_line_keterangan
        ));
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            $this->session->set_flashdata('error','Update data gagal!');
            redirect(site_url("master/Line"));
        }else {
            $this->session->set_flashdata('success','Update data berhasil!');
            redirect(site_url("master/Line"));
        }
    }

    function delete($m_line_id){
        $this->db->trans_start();
        $this->db->delete(self::$table1, array('m_line_id' => $m_line_id));
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            return json_encode(array('success'=>false));
        }else {
            return json_encode(array('success'=>true));
        }
    }
    
}

/* End of file m_line.php */
/* Location: ./application/models/master/m_line.php */