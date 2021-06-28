<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_item extends CI_Model
{    
    static $table1  = 'm_item';
    static $table2  = 'm_category';
    static $table3  = 'm_uom';
    static $table4  = 'm_type';

    public function __construct() {
        parent::__construct();
        $this->load->helper('database'); // Digunakan untuk memunculkan data Enum
    }
    
    function index(){ 
        //$this->db->select('*');             
        $query  = $this->db->get(self::$table1);
        return $query;          
    }

    function getCategory(){
        $query  = $this->db->get(self::$table2);
        return $query;        
    }

    function getUom(){
        $query  = $this->db->get(self::$table3);
        return $query;        
    }

    function getType(){
        $query  = $this->db->get(self::$table4);
        return $query;        
    }

    function view($myid){        
        $this->db->select('*');
        $this->db->join(self::$table2, 'm_item_category=m_category_id', 'left');
        $this->db->join(self::$table3, 'm_item_uom=m_uom_id', 'left');
        $this->db->join(self::$table4, 'm_item_type=m_type_id', 'left');        
        $this->db->where('m_item_id', $myid);
        $query  = $this->db->get(self::$table1);
        if($query){
            $row = $query->row();
            return json_encode(array(
                'm_item_id'          => $row->m_item_id,  
                'm_item_name'        => $row->m_item_name, 
                'm_item_model'       => $row->m_item_model, 
                'm_item_spesifikasi' => $row->m_item_spesifikasi, 
                'm_item_bq'          => $row->m_item_bq,
                'm_item_kg_sheet'    => $row->m_item_kg_sheet, 
                'm_item_part_no_glc' => $row->m_item_part_no_glc,
                'm_item_job_no'      => $row->m_item_job_no,
                'm_item_part_dlv'    => $row->m_item_part_dlv,
                'm_item_category'    => $row->m_item_category,
                'm_category_name'    => $row->m_category_name,
                'm_item_uom'         => $row->m_item_uom,
                'm_uom_name'         => $row->m_uom_name,
                'm_item_type'        => $row->m_item_type,
                'm_type_name'        => $row->m_type_name
            ));    
        }else{
            $this->session->set_flashdata('warning','Data tidak ditemukan!');
            redirect(site_url("master/Item"));
        }   
    }
        
    function create($m_item_name,$m_item_model,$m_item_spesifikasi,$m_item_bq,$m_item_kg_sheet,$m_item_part_no_glc,$m_item_job_no,$m_item_part_dlv,$m_item_category,$m_item_uom,$m_item_type){
        $this->db->where('m_item_code', $m_item_job_no.'-'.$m_item_part_no_glc);
        $query = $this->db->get(self::$table1);
        $row = $query->num_rows();
        if($row > 0){
            $this->session->set_flashdata('warning','ID Part sudah ada!');
            redirect(site_url("master/Item"));
        }else{
            $query_2 = $this->db->insert(self::$table1,array(
                'm_item_code'        => $m_item_job_no.'-'.$m_item_part_no_glc,
                'm_item_name'        => $m_item_name,
                'm_item_model'       => $m_item_model,
                'm_item_spesifikasi' => $m_item_spesifikasi,
                'm_item_bq'          => $m_item_bq,
                'm_item_kg_sheet'    => $m_item_kg_sheet,
                'm_item_part_no_glc' => $m_item_part_no_glc,
                'm_item_job_no'      => $m_item_job_no,
                'm_item_part_dlv'    => $m_item_part_dlv,
                'm_item_category'    => $m_item_category,
                'm_item_uom'         => $m_item_uom,
                'm_item_type'        => $m_item_type
            ));
            if($query_2){
                $this->session->set_flashdata('success','Input data berhasil!');
                redirect(site_url("master/Item"));
            }else {
                $this->session->set_flashdata('error', $this->db->_error_message());
                redirect(site_url("master/Item"));
            } 
        }
    }
    
    function update($m_item_id,$m_item_name,$m_item_model,$m_item_spesifikasi,$m_item_bq,$m_item_kg_sheet,$m_item_part_no_glc,$m_item_job_no,$m_item_part_dlv,$m_item_category,$m_item_uom,$m_item_type){
        $this->db->where('m_item_id', $m_item_id);
        $query = $this->db->update(self::$table1,array(
            'm_item_code'        => $m_item_job_no.'-'.$m_item_part_no_glc,
            'm_item_name'        => $m_item_name,
            'm_item_model'       => $m_item_model,
            'm_item_spesifikasi' => $m_item_spesifikasi,
            'm_item_bq'          => $m_item_bq,
            'm_item_kg_sheet'    => $m_item_kg_sheet,
            'm_item_part_no_glc' => $m_item_part_no_glc,
            'm_item_job_no'      => $m_item_job_no,
            'm_item_part_dlv'    => $m_item_part_dlv,
            'm_item_category'    => $m_item_category,
            'm_item_uom'         => $m_item_uom,
            'm_item_type'        => $m_item_type
        ));
        if($query){
            $this->session->set_flashdata('success','Update data berhasil!');
            redirect(site_url("master/Item"));
        }else{
            $this->session->set_flashdata('error', $this->db->_error_message());
            redirect(site_url("master/Item"));
        }
    }
    
    function delete($m_item_id){
        $query = $this->db->delete(self::$table1, array('m_item_id' => $m_item_id));
        if($query){
            return json_encode(array('success'=>true));
        }
        else{
            return json_encode(array('success'=>false));
        }
    }
        
}

/* End of file m_item.php */
/* Location: ./application/models/master/m_item.php */