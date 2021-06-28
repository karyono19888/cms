<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MaterialReceipt extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('transaksi/M_material_receipt','record');
        $this->auth->restrict(); //mencegah user yang belum login untuk mengakses halaman ini
    }
    
    function index(){
        $data['title']      = 'Material Receipt';
        $data['data']       = $this->record->index();
        $data['bp']         = $this->record->getBp();
        $data['item']       = $this->record->getItem();
        $this->load->view('transaksi/v_material_receipt', $data); 
    } 

    function getDocNo(){
        echo $this->record->getDocNo();
    } 

    function create_head(){
        if(!isset($_POST))	
            show_404();
        $t_mrc_head_doc_no         = addslashes($_POST['t_mrc_head_doc_no']);
        $t_mrc_head_bp             = addslashes($_POST['t_mrc_head_bp']);
        $t_mrc_head_date           = addslashes($_POST['t_mrc_head_date']);
        echo $this->record->create_head($t_mrc_head_doc_no, $t_mrc_head_bp, $t_mrc_head_date);
    }    

    function view_head(){
        if(!isset($_POST))	
            show_404();
        $myid           = addslashes($_POST['myid']);
        echo $this->record->view_head($myid);
    } 

    function update_head(){
        if(!isset($_POST))	
            show_404();
        $t_mrc_head_id             = addslashes($_POST['t_mrc_head_id']);
        $t_mrc_head_doc_no         = addslashes($_POST['t_mrc_head_doc_no']);
        $t_mrc_head_bp             = addslashes($_POST['t_mrc_head_bp']);
        $t_mrc_head_date           = addslashes($_POST['t_mrc_head_date']);
        echo $this->record->update_head($t_mrc_head_id, $t_mrc_head_doc_no, $t_mrc_head_bp, $t_mrc_head_date);
    }   

    function delete_head(){
        if(!isset($_POST))	
            show_404();
        $t_mrc_head_id            = addslashes($_POST['Id']);
        echo $this->record->delete_head($t_mrc_head_id);
    }

    // Line 
    function view_line(){
        if(!isset($_POST))	
            show_404();
        $t_mrc_line_head           = addslashes($_POST['id']);
        echo $this->record->view_line($t_mrc_line_head);
    } 

    function getItem(){
        echo $this->record->Item();
    } 

    function getBarcode(){
        if(!isset($_POST))	
            show_404();
        $m_item_id           = addslashes($_POST['id']);
        echo $this->record->getBarcode($m_item_id);
    } 

    function create_line(){
        if(!isset($_POST))	
            show_404();
        $t_mrc_line_head          = addslashes($_POST['t_mrc_line_head']);
        $t_mrc_line_item          = addslashes($_POST['t_mrc_line_item']);
        $t_mrc_line_qty           = addslashes($_POST['t_mrc_line_qty']);
        $t_mrc_line_pcs           = addslashes($_POST['t_mrc_line_pcs']);
        $t_mrc_line_kg            = addslashes($_POST['t_mrc_line_kg']);
        echo $this->record->create_line($t_mrc_line_head, $t_mrc_line_item, $t_mrc_line_qty, $t_mrc_line_pcs, $t_mrc_line_kg);
    }  
    
    function edit_line(){
        if(!isset($_POST))	
            show_404();
        $t_mrc_line_id           = addslashes($_POST['id']);
        echo $this->record->edit_line($t_mrc_line_id);
    } 

    function update_line(){
        if(!isset($_POST))	
            show_404();
        $t_mrc_line_id            = addslashes($_POST['t_mrc_line_id']);
        $t_mrc_line_item          = addslashes($_POST['t_mrc_line_item']);
        $t_mrc_line_qty           = addslashes($_POST['t_mrc_line_qty']);
        $t_mrc_line_pcs           = addslashes($_POST['t_mrc_line_pcs']);
        $t_mrc_line_kg            = addslashes($_POST['t_mrc_line_kg']);
        echo $this->record->update_line($t_mrc_line_id, $t_mrc_line_item, $t_mrc_line_qty, $t_mrc_line_pcs, $t_mrc_line_kg);
    }  
    
    function delete_line(){
        if(!isset($_POST))	
            show_404();
        $t_mrc_line_id            = addslashes($_POST['Id']);
        echo $this->record->delete_line($t_mrc_line_id);
    }

}