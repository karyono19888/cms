<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_material_outgoing extends CI_Model
{    
    static $table1 = 't_mo_head';
    static $table2 = 't_mo_line';
    static $table3 = 'm_line';
    static $table4 = 'm_item';
    static $table5 = 't_stok';
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('database');
    }

    function index(){ 
        $this->db->select('*');  
        $this->db->join(self::$table3, 't_mo_head_line=m_line_id', 'left'); 
        $this->db->order_by('t_mo_head_id','desc');          
        $query  = $this->db->get(self::$table1);
        return $query;          
    }

    function getDocNo(){ 
        $array_bln = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $bln = $array_bln[date('n')];
        $this->db->select_max('t_mo_head_id');       
        $query  = $this->db->get(self::$table1);
        $row = $query->row();  
        return json_encode(array(
            'doc_no'     => '0'.$row->t_mo_head_id+1 .'/'.'MO/'.$bln.'/'.date('y')
        ));           
    }

    function getLine(){
        $query  = $this->db->get(self::$table3);
        return $query;        
    }

    function getItem(){
        $this->db->order_by('m_item_name','asc');
        $query  = $this->db->get(self::$table4);
        return $query;        
    }

    function Item(){
        $this->db->join(self::$table4, 't_stok_item=m_item_id', 'left');
        $this->db->order_by('m_item_name','asc');
        $this->db->group_by('t_stok_item');
        $query  = $this->db->get(self::$table5);

        $data = array();
        foreach ( $query->result() as $row ){
            array_push($data, $row); 
        }
 
        $result = array();
        $result['row']  = $data;
        
        return json_encode($result);        
    }

    function getBarcode($m_item_id){
        $this->db->select('*, SUM(t_stok_sheet) as sheet, SUM(t_stok_pcs) as pcs, SUM(t_stok_kg) as kg' ); 
        $this->db->join(self::$table4, 't_stok_item=m_item_id', 'left');
        $this->db->where('m_item_id', $m_item_id);
        $this->db->group_by('t_stok_item');
        $query  = $this->db->get(self::$table5);
        if($query){
            $row = $query->row();
            return json_encode(array(
                'm_item_bq'       => $row->m_item_bq,
                'm_item_kg_sheet' => $row->m_item_kg_sheet,
                'sheet'           => $row->sheet,
                'pcs'             => $row->pcs,
                'kg'              => $row->kg
            ));    
        }else{
            $this->session->set_flashdata('warning','Data tidak ditemukan!');
        }           
    }

    function create_head(
            $t_mo_head_doc_no, 
            $t_mo_head_line,
            $t_mo_head_date){
        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $now = date('Y-m-d H:i:s');
        $this->db->trans_start();               
        $query = $this->db->insert(self::$table1,array(
            't_mo_head_doc_no'       => $t_mo_head_doc_no,
            't_mo_head_line'         => $t_mo_head_line,
            't_mo_head_date'         => $t_mo_head_date,
            't_mo_head_udate'        => $now,
            't_mo_head_created'      => $this->session->userdata('id')
        ));
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            $this->session->set_flashdata('error','Input data gagal!');
            redirect(site_url("transaksi/Materialoutgoing"));
        }else {
            $this->session->set_flashdata('success','Input data berhasil!');
            redirect(site_url("transaksi/Materialoutgoing"));
        }   
    }

    function view_head($myid){        
        $this->db->select('*');     
        $this->db->join(self::$table3, 't_mo_head_line=m_line_id', 'left');  
        $this->db->where('t_mo_head_id', $myid);
        $query  = $this->db->get(self::$table1);
        if($query){
            $row = $query->row();
            return json_encode(array(
                't_mo_head_id'          => $row->t_mo_head_id,
                't_mo_head_date'        => $row->t_mo_head_date,
                't_mo_head_doc_no'      => $row->t_mo_head_doc_no, 
                'm_line_id'             => $row->m_line_id,
                'm_line_name'           => $row->m_line_name
            ));    
        }else{
            $this->session->set_flashdata('warning','Data tidak ditemukan!');
            redirect(site_url("transaksi/Materialoutgoing"));
        }   
    }

    function update_head($t_mo_head_id, $t_mo_head_doc_no, $t_mo_head_line, $t_mo_head_date){
        $this->db->trans_start();
        $this->db->where('t_mo_head_id', $t_mo_head_id);
        $this->db->update(self::$table1,array(
            't_mo_head_doc_no'       => $t_mo_head_doc_no,
            't_mo_head_line'         => $t_mo_head_line,
            't_mo_head_udate'        => $now,
            't_mo_head_created'      => $this->session->userdata('id'),
            't_mo_head_date'         => $t_mo_head_date
        ));
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            $this->session->set_flashdata('error','Update data gagal!');
            redirect(site_url("transaksi/Materialoutgoing"));
        }else {
            $this->session->set_flashdata('success','Update data berhasil!');
            redirect(site_url("transaksi/Materialoutgoing"));
        }
    }

    function delete_head($t_mo_head_id){
        $this->db->trans_start();
        $this->db->delete(self::$table1, array('t_mo_head_id' => $t_mo_head_id));
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            return json_encode(array('success'=>false));
        }else {
            $this->db->delete(self::$table2, array('t_mo_line_head' => $t_mo_head_id));
            return json_encode(array('success'=>true));
        }
    }

    //Line

    function view_line($t_mo_line_head){
        $this->db->join(self::$table1, 't_mo_line_head=t_mo_head_id', 'left');
        $this->db->join(self::$table4, 't_mo_line_item=m_item_id', 'left');
        $this->db->where('t_mo_line_head', $t_mo_line_head);
        $query  = $this->db->get(self::$table2);

        $data = array();
        foreach ( $query->result() as $row ){
            array_push($data, $row); 
        }
 
        $result = array();
        $result['rows']  = $data;
        
        return json_encode($result);
    }

    function create_line(
        $t_mo_line_head, $t_mo_line_item, $t_mo_line_sheet, $t_mo_line_pcs, $t_mo_line_kg){
        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $now = date('Y-m-d H:i:s');
        $this->db->trans_start();               
        $query = $this->db->insert(self::$table2,array(
            't_mo_line_head'       => $t_mo_line_head,
            't_mo_line_item'       => $t_mo_line_item,
            't_mo_line_sheet'      => $t_mo_line_sheet,
            't_mo_line_pcs'        => $t_mo_line_pcs,
            't_mo_line_kg'         => $t_mo_line_kg,
            't_mo_line_udate'      => $now,
            't_mo_line_created'    => $this->session->userdata('id')
        ));
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            return json_encode(array('success'=>false));
        }else {
            $this->db->select_max('t_mo_line_id');          
            $query  = $this->db->get(self::$table2);
            $row = $query->row(); 
            $this->db->insert(self::$table5,array(
                't_stok_item'   => $t_mo_line_item,
                't_stok_sheet'  => -$t_mo_line_sheet,
                't_stok_pcs'    => -$t_mo_line_pcs,
                't_stok_kg'     => -$t_mo_line_kg,
                't_stok_sts'    => 'Out',
                't_stok_idt'    => $row->t_mo_line_id
            ));
            return json_encode(array('success'=>true));
        }   
    }

    function edit_line($t_mo_line_id){
        $this->db->join(self::$table1, 't_mo_line_head=t_mo_head_id', 'left');
        $this->db->join(self::$table4, 't_mo_line_item=m_item_id', 'left');
        $this->db->where('t_mo_line_id', $t_mo_line_id);
        $query  = $this->db->get(self::$table2);

        if($query){
            $row = $query->row();
            $this->db->select('SUM(t_stok_sheet) as sheet, SUM(t_stok_pcs) as pcs, SUM(t_stok_kg) as kg' );
            $this->db->group_by('t_stok_item');
            $query_1  = $this->db->get(self::$table5);
            $row_1 = $query_1->row();
            return json_encode(array(
                't_mo_line_id'        => $row->t_mo_line_id,
                't_mo_line_item'      => $row->t_mo_line_item,
                't_mo_line_sheet'     => $row->t_mo_line_sheet,
                't_mo_line_pcs'       => $row->t_mo_line_pcs,
                't_mo_line_kg'        => $row->t_mo_line_kg,
                'm_item_id'           => $row->m_item_id,
                'm_item_spesifikasi'  => $row->m_item_spesifikasi,
                'm_item_code'         => $row->m_item_code,
                'm_item_bq'           => $row->m_item_bq,
                'm_item_kg_sheet'     => $row->m_item_kg_sheet,
                'sheet'               => $row_1->sheet,
                'pcs'                 => $row_1->pcs,
                'kg'                  => $row_1->kg
            ));    
        }else{
            $this->session->set_flashdata('warning','Data tidak ditemukan!');
        }  
    }

    function update_line(
        $t_mo_line_id, $t_mo_line_item, $t_mo_line_sheet, $t_mo_line_pcs, $t_mo_line_kg){
        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $now = date('Y-m-d H:i:s');
        $this->db->trans_start();     
        $this->db->where('t_mo_line_id', $t_mo_line_id);          
        $query = $this->db->update(self::$table2,array(
            't_mo_line_item'       => $t_mo_line_item,
            't_mo_line_sheet'      => $t_mo_line_sheet,
            't_mo_line_pcs'        => $t_mo_line_pcs,
            't_mo_line_kg'         => $t_mo_line_kg,
            't_mo_line_udate'      => $now,
            't_mo_line_created'    => $this->session->userdata('id')
        ));
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            return json_encode(array('success'=>false));
        }else {
            $this->db->where('t_stok_sts', 'Out')
                     ->where('t_stok_idt', $t_mo_line_id); 
            $this->db->update(self::$table5,array(
                't_stok_item'   => $t_mo_line_item,
                't_stok_sheet'  => -$t_mo_line_sheet,
                't_stok_pcs'    => -$t_mo_line_pcs,
                't_stok_kg'     => -$t_mo_line_kg,
                't_stok_sts'    => 'In'
            ));
            return json_encode(array('success'=>true));
        }   
    }

    function delete_line($t_mo_line_id){
        $this->db->trans_start();
        $this->db->delete(self::$table2, array('t_mo_line_id' => $t_mo_line_id));
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            return json_encode(array('success'=>false));
        }else {
            $this->db->delete(self::$table5, array('t_stok_idt' => $t_mo_line_id, 't_stok_sts' => 'Out'));
            return json_encode(array('success'=>true));
        }
    }
    
}

/* End of file m_type.php */
/* Location: ./application/models/master/m_type.php */