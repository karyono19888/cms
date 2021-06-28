<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_lkh extends CI_Model
{    
    static $table1 = 't_lkh_head';
    static $table2 = 't_lkh_line';
    static $table3 = 'm_item';
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('database');
    }

    function index(){ 
        $this->db->select('*');  
        $this->db->order_by('t_lkh_head_id','desc');          
        $query  = $this->db->get(self::$table1);
        return $query;          
    }

    function create_head(
            $t_lkh_head_date, 
            $t_lkh_head_line, 
            $t_lkh_head_shift, 
            $t_lkh_head_ket){
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->db->trans_start();               
        $query = $this->db->insert(self::$table1,array(
            't_lkh_head_date'       => $t_lkh_head_date,
            't_lkh_head_line'       => $t_lkh_head_line,
            't_lkh_head_shift'      => $t_lkh_head_shift,
            't_lkh_head_ket'        => $t_lkh_head_ket,
            't_lkh_head_udate'      => $now,
            't_lkh_head_created'    => $this->session->userdata('id')
        ));
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            $this->session->set_flashdata('error','Input data gagal!');
            redirect(site_url("transaksi/Lkh"));
        }else {
            $this->session->set_flashdata('success','Input data berhasil!');
            redirect(site_url("transaksi/Lkh"));
        }   
    }

    function view_head($t_lkh_head_id){        
        $this->db->select('*');       
        $this->db->where('t_lkh_head_id', $t_lkh_head_id);
        $query  = $this->db->get(self::$table1);
        if($query){
            $row = $query->row();
            return json_encode(array(
                't_lkh_head_id'     => $row->t_lkh_head_id,
                't_lkh_head_date'   => $row->t_lkh_head_date,
                't_lkh_head_line'   => $row->t_lkh_head_line,
                't_lkh_head_shift'  => $row->t_lkh_head_shift, 
                't_lkh_head_ket'    => $row->t_lkh_head_ket
            ));    
        }else{
            $this->session->set_flashdata('warning','Data tidak ditemukan!');
            redirect(site_url("transaksi/Lkh"));
        }   
    }

    function update_head(
            $t_lkh_head_id, 
            $t_lkh_head_date, 
            $t_lkh_head_line, 
            $t_lkh_head_shift, 
            $t_lkh_head_ket){
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->db->trans_start();
        $this->db->where('t_lkh_head_id', $t_lkh_head_id);
        $this->db->update(self::$table1,array(
            't_lkh_head_date'      => $t_lkh_head_date,
            't_lkh_head_line'      => $t_lkh_head_line,
            't_lkh_head_shift'     => $t_lkh_head_shift,
            't_lkh_head_ket'       => $t_lkh_head_ket,
            't_lkh_head_udate'     => $now,
            't_lkh_head_created'   => $this->session->userdata('id')
        ));
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            $this->session->set_flashdata('error','Update data gagal!');
            redirect(site_url("transaksi/Lkh"));
        }else {
            $this->session->set_flashdata('success','Update data berhasil!');
            redirect(site_url("transaksi/Lkh"));
        }
    }

    //Line

    function view_line($t_lkh_line_head){
        $this->db->join(self::$table1, 't_lkh_line_head=t_lkh_head_id', 'left');
        $this->db->join(self::$table3, 't_lkh_line_item=m_item_id', 'left');
        $this->db->where('t_lkh_line_head', $t_lkh_line_head);
        $query  = $this->db->get(self::$table2);

        $data = array();
        foreach ( $query->result() as $row ){
            array_push($data, $row); 
        }
 
        $result = array();
        $result['rows']  = $data;
        
        return json_encode($result);
    }

    function Item(){
        $this->db->order_by('m_item_job_no','asc');
        $query  = $this->db->get(self::$table3);

        $data = array();
        foreach ( $query->result() as $row ){
            array_push($data, $row); 
        }
 
        $result = array();
        $result['row']  = $data;
        
        return json_encode($result);        
    }

    function create_line(
            $t_lkh_line_head, 
            $t_lkh_line_item, 
            $t_lkh_line_dct,
            $t_lkh_line_st, 
            $t_lkh_line_tpt,
            $t_lkh_line_working,
            $t_lkh_line_stroke){
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->db->trans_start();               
        $query = $this->db->insert(self::$table2,array(
            't_lkh_line_head'     => $t_lkh_line_head,
            't_lkh_line_item'     => $t_lkh_line_item,
            't_lkh_line_dct'      => $t_lkh_line_dct,
            't_lkh_line_st'       => $t_lkh_line_st,
            't_lkh_line_tpt'      => $t_lkh_line_tpt,
            't_lkh_line_working'  => $t_lkh_line_working,
            't_lkh_line_stroke'   => $t_lkh_line_stroke,
            't_lkh_line_udate'    => $now,
            't_lkh_line_created'  => $this->session->userdata('id')
        ));
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            return json_encode(array('success'=>false));
        }else {
            return json_encode(array('success'=>true));
        }   
    }

    function getItem(){
        $this->db->order_by('m_item_job_no','asc');
        $query  = $this->db->get(self::$table3);
        return $query;        
    }

    function edit_line($t_lkh_line_id){
        $this->db->join(self::$table1, 't_lkh_line_head=t_lkh_head_id', 'left');
        $this->db->join(self::$table3, 't_lkh_line_item=m_item_id', 'left');
        $this->db->where('t_lkh_line_id', $t_lkh_line_id);
        $query  = $this->db->get(self::$table2);

        if($query){
            $row = $query->row();
            return json_encode(array(
                't_lkh_line_id'       => $row->t_lkh_line_id,
                't_lkh_line_dct'      => $row->t_lkh_line_dct,
                't_lkh_line_st'       => $row->t_lkh_line_st,
                't_lkh_line_tpt'      => $row->t_lkh_line_tpt,
                't_lkh_line_working'  => $row->t_lkh_line_working,
                't_lkh_line_stroke'   => $row->t_lkh_line_stroke,
                'm_item_id'           => $row->m_item_id,
                'm_item_part_no_glc'  => $row->m_item_part_no_glc,
                'm_item_job_no'       => $row->m_item_job_no
            ));    
        }else{
            $this->session->set_flashdata('warning','Data tidak ditemukan!');
        }  
    }

    function update_line(
            $t_lkh_line_id, 
            $t_lkh_line_item, 
            $t_lkh_line_dct,
            $t_lkh_line_st,
            $t_lkh_line_tpt,
            $t_lkh_line_working, 
            $t_lkh_line_stroke){
        date_default_timezone_set('Asia/Jakarta');
        $now = date('Y-m-d H:i:s');
        $this->db->trans_start();     
        $this->db->where('t_lkh_line_id', $t_lkh_line_id);          
        $query = $this->db->update(self::$table2,array(
            't_lkh_line_item'     => $t_lkh_line_item,
            't_lkh_line_dct'      => $t_lkh_line_dct,
            't_lkh_line_st'       => $t_lkh_line_st,
            't_lkh_line_tpt'      => $t_lkh_line_tpt,
            't_lkh_line_working'  => $t_lkh_line_working,
            't_lkh_line_stroke'   => $t_lkh_line_stroke,
            't_lkh_line_udate'    => $now,
            't_lkh_line_created'  => $this->session->userdata('id')
        ));
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            return json_encode(array('success'=>false));
        }else {
            return json_encode(array('success'=>true));
        }   
    }

    function delete_line($t_lkh_line_id){
        $this->db->trans_start();
        $this->db->delete(self::$table2, array('t_lkh_line_id' => $t_lkh_line_id));
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            return json_encode(array('success'=>false));
        }else {
            return json_encode(array('success'=>true));
        }
    }
    
}
