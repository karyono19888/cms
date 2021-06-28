<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_material_receipt extends CI_Model
{    
    static $table1 = 't_mrc_head';
    static $table2 = 't_mrc_line';
    static $table3 = 'm_bp';
    static $table4 = 'm_item';
    static $table5 = 'm_doc_type';
    static $table6 = 'm_priority';
    static $table7 = 't_stok';
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('database');
    }

    function index(){ 
        $this->db->select('*');  
        $this->db->join(self::$table3, 't_mrc_head_bp=m_bp_id', 'left'); 
        $this->db->join(self::$table5, 't_mrc_head_doc_type=m_doc_type_id', 'left'); 
        $this->db->join(self::$table6, 't_mrc_head_priority=m_priority_id', 'left'); 
        $this->db->order_by('t_mrc_head_id','desc');          
        $query  = $this->db->get(self::$table1);
        return $query;          
    }

    function getDocNo(){ 
        $array_bln = array(1=>"I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
        $bln = $array_bln[date('n')];
        $this->db->select_max('t_mrc_head_id');
        //$this->db->order_by('t_mrc_head_id','desc');          
        $query  = $this->db->get(self::$table1);
        $row = $query->row();  
        return json_encode(array(
            'doc_no'     => '0'.$row->t_mrc_head_id+1 .'/'.'MR/'.$bln.'/'.date('y')
        ));           
    }

    function getBp(){
        $this->db->where('m_bp_jns', 2);
        $query  = $this->db->get(self::$table3);
        return $query;        
    }

    function getItem(){
        $this->db->order_by('m_item_name','asc');
        $query  = $this->db->get(self::$table4);
        return $query;        
    }

    function Item(){
        $this->db->order_by('m_item_name','asc');
        $query  = $this->db->get(self::$table4);

        $data = array();
        foreach ( $query->result() as $row ){
            array_push($data, $row); 
        }
 
        $result = array();
        $result['row']  = $data;
        
        return json_encode($result);        
    }

    function getBarcode($m_item_id){
        $this->db->where('m_item_id', $m_item_id);
        $query  = $this->db->get(self::$table4);
        if($query){
            $row = $query->row();
            return json_encode(array(
                'm_item_bq'         => $row->m_item_bq,
                'm_item_kg_sheet'   => $row->m_item_kg_sheet
            ));    
        }else{
            $this->session->set_flashdata('warning','Data tidak ditemukan!');
        }           
    }

    function create_head(
            $t_mrc_head_doc_no, 
            $t_mrc_head_bp,
            $t_mrc_head_date){
        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $now = date('Y-m-d H:i:s');
        $this->db->trans_start();               
        $query = $this->db->insert(self::$table1,array(
            't_mrc_head_doc_no'       => $t_mrc_head_doc_no,
            't_mrc_head_bp'           => $t_mrc_head_bp,
            't_mrc_head_date'         => $t_mrc_head_date,
            't_mrc_head_udate'        => $now,
            't_mrc_head_created'      => $this->session->userdata('id')
        ));
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            $this->session->set_flashdata('error','Input data gagal!');
            redirect(site_url("transaksi/MaterialReceipt"));
        }else {
            $this->session->set_flashdata('success','Input data berhasil!');
            redirect(site_url("transaksi/MaterialReceipt"));
        }   
    }

    function view_head($myid){        
        $this->db->select('*');     
        $this->db->join(self::$table3, 't_mrc_head_bp=m_bp_id', 'left');  
        $this->db->where('t_mrc_head_id', $myid);
        $query  = $this->db->get(self::$table1);
        if($query){
            $row = $query->row();
            return json_encode(array(
                't_mrc_head_id'          => $row->t_mrc_head_id,
                't_mrc_head_date'        => $row->t_mrc_head_date,
                't_mrc_head_doc_no'      => $row->t_mrc_head_doc_no, 
                'm_bp_id'                => $row->m_bp_id,
                'm_bp_name'              => $row->m_bp_name
            ));    
        }else{
            $this->session->set_flashdata('warning','Data tidak ditemukan!');
            redirect(site_url("transaksi/MaterialReceipt"));
        }   
    }

    function update_head($t_mrc_head_id, $t_mrc_head_doc_no, $t_mrc_head_bp, $t_mrc_head_date){
        $this->db->trans_start();
        $this->db->where('t_mrc_head_id', $t_mrc_head_id);
        $this->db->update(self::$table1,array(
            't_mrc_head_doc_no'       => $t_mrc_head_doc_no,
            't_mrc_head_bp'           => $t_mrc_head_bp,
            't_mrc_head_udate'        => $now,
            't_mrc_head_created'      => $this->session->userdata('id'),
            't_mrc_head_date'        => $t_mrc_head_date
        ));
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            $this->session->set_flashdata('error','Update data gagal!');
            redirect(site_url("transaksi/MaterialReceipt"));
        }else {
            $this->session->set_flashdata('success','Update data berhasil!');
            redirect(site_url("transaksi/MaterialReceipt"));
        }
    }

    function delete_head($t_mrc_head_id){
        $this->db->trans_start();
        $this->db->delete(self::$table1, array('t_mrc_head_id' => $t_mrc_head_id));
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            return json_encode(array('success'=>false));
        }else {
            $this->db->delete(self::$table2, array('t_mrc_line_head' => $t_mrc_head_id));
            return json_encode(array('success'=>true));
        }
    }

    //Line

    function view_line($t_mrc_line_head){
        $this->db->join(self::$table1, 't_mrc_line_head=t_mrc_head_id', 'left');
        $this->db->join(self::$table4, 't_mrc_line_item=m_item_id', 'left');
        $this->db->where('t_mrc_line_head', $t_mrc_line_head);
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
        $t_mrc_line_head, $t_mrc_line_item, $t_mrc_line_qty, $t_mrc_line_pcs, $t_mrc_line_kg){
        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $now = date('Y-m-d H:i:s');
        $this->db->trans_start();               
        $this->db->insert(self::$table2,array(
            't_mrc_line_head'       => $t_mrc_line_head,
            't_mrc_line_item'       => $t_mrc_line_item,
            't_mrc_line_qty'        => $t_mrc_line_qty,
            't_mrc_line_pcs'        => $t_mrc_line_pcs,
            't_mrc_line_kg'         => $t_mrc_line_kg,
            't_mrc_line_udate'      => $now,
            't_mrc_line_created'    => $this->session->userdata('id')
        ));
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            return json_encode(array('success'=>false));
        }else {
            $this->db->select_max('t_mrc_line_id');          
            $query  = $this->db->get(self::$table2);
            $row = $query->row(); 
            $this->db->insert(self::$table7,array(
                't_stok_item'   => $t_mrc_line_item,
                't_stok_sheet'  => $t_mrc_line_qty,
                't_stok_pcs'    => $t_mrc_line_pcs,
                't_stok_kg'     => $t_mrc_line_kg,
                't_stok_sts'    => 'In',
                't_stok_idt'    => $row->t_mrc_line_id
            ));
            return json_encode(array('success'=>true));
        }   
    }

    function edit_line($t_mrc_line_id){
        $this->db->join(self::$table1, 't_mrc_line_head=t_mrc_head_id', 'left');
        $this->db->join(self::$table4, 't_mrc_line_item=m_item_id', 'left');
        $this->db->where('t_mrc_line_id', $t_mrc_line_id);
        $query  = $this->db->get(self::$table2);

        if($query){
            $row = $query->row();
            return json_encode(array(
                't_mrc_line_id'        => $row->t_mrc_line_id,
                't_mrc_line_item'      => $row->t_mrc_line_item,
                't_mrc_line_qty'       => $row->t_mrc_line_qty,
                't_mrc_line_pcs'       => $row->t_mrc_line_pcs,
                't_mrc_line_kg'        => $row->t_mrc_line_kg,
                'm_item_id'            => $row->m_item_id,
                'm_item_spesifikasi'   => $row->m_item_spesifikasi,
                'm_item_code'          => $row->m_item_code,
                'm_item_bq'            => $row->m_item_bq,
                'm_item_kg_sheet'      => $row->m_item_kg_sheet
            ));    
        }else{
            $this->session->set_flashdata('warning','Data tidak ditemukan!');
        }  
    }

    function update_line(
        $t_mrc_line_id, $t_mrc_line_item, $t_mrc_line_qty, $t_mrc_line_pcs, $t_mrc_line_kg){
        date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
        $now = date('Y-m-d H:i:s');
        $this->db->trans_start();     
        $this->db->where('t_mrc_line_id', $t_mrc_line_id);          
        $query = $this->db->update(self::$table2,array(
            't_mrc_line_item'       => $t_mrc_line_item,
            't_mrc_line_qty'        => $t_mrc_line_qty,
            't_mrc_line_pcs'        => $t_mrc_line_pcs,
            't_mrc_line_kg'         => $t_mrc_line_kg,
            't_mrc_line_udate'      => $now,
            't_mrc_line_created'    => $this->session->userdata('id')
        ));
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            return json_encode(array('success'=>false));
        }else {
            $this->db->where('t_stok_sts', 'In')
                     ->where('t_stok_idt', $t_mrc_line_id); 
            $this->db->update(self::$table7,array(
                't_stok_item'   => $t_mrc_line_item,
                't_stok_sheet'  => $t_mrc_line_qty,
                't_stok_pcs'    => $t_mrc_line_pcs,
                't_stok_kg'     => $t_mrc_line_kg,
                't_stok_sts'    => 'In'
            ));
            return json_encode(array('success'=>true));
        }   
    }

    function delete_line($t_mrc_line_id){
        $this->db->trans_start();
        $this->db->delete(self::$table2, array('t_mrc_line_id' => $t_mrc_line_id));
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            return json_encode(array('success'=>false));
        }else {
            $this->db->delete(self::$table7, array('t_stok_idt' => $t_mrc_line_id, 't_stok_sts' => 'In'));
            return json_encode(array('success'=>true));
        }
    }
    
}

/* End of file m_type.php */
/* Location: ./application/models/master/m_type.php */