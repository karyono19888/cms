<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lkh extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('transaksi/M_lkh','record');
        $this->auth->restrict(); //mencegah user yang belum login untuk mengakses halaman ini
    }
    
    function index(){
        $data['title']      = 'Daily Work Report';
        $data['item']       = $this->record->getItem();
        $data['data']       = $this->record->index();
        $this->load->view('transaksi/v_lkh', $data); 
    } 

    function create_head(){
        if(!isset($_POST))	
            show_404();
        $t_lkh_head_date      = addslashes($_POST['t_lkh_head_date']);
        $t_lkh_head_line      = addslashes($_POST['t_lkh_head_line']);
        $t_lkh_head_shift     = addslashes($_POST['t_lkh_head_shift']);
        $t_lkh_head_ket       = addslashes($_POST['t_lkh_head_ket']);
        echo $this->record->create_head(
            $t_lkh_head_date, 
            $t_lkh_head_line, 
            $t_lkh_head_shift, 
            $t_lkh_head_ket);
    }   

    function view_head(){
        if(!isset($_POST))	
            show_404();
        $t_lkh_head_id        = addslashes($_POST['myid']);
        echo $this->record->view_head($t_lkh_head_id);
    } 

    function update_head(){
        if(!isset($_POST))	
            show_404();
        $t_lkh_head_id        = addslashes($_POST['t_lkh_head_id']);
        $t_lkh_head_date      = addslashes($_POST['t_lkh_head_date']);
        $t_lkh_head_line      = addslashes($_POST['t_lkh_head_line']);
        $t_lkh_head_shift     = addslashes($_POST['t_lkh_head_shift']);
        $t_lkh_head_ket       = addslashes($_POST['t_lkh_head_ket']);
        echo $this->record->update_head(
            $t_lkh_head_id, 
            $t_lkh_head_date, 
            $t_lkh_head_line, 
            $t_lkh_head_shift, 
            $t_lkh_head_ket);
    } 

    //Line

    function view_line(){
        if(!isset($_POST))	
            show_404();
        $t_lkh_line_head      = addslashes($_POST['id']);
        echo $this->record->view_line($t_lkh_line_head);
    } 

    function getItem(){
        echo $this->record->Item();
    } 

    function create_line(){
        if(!isset($_POST))	
            show_404();
        $t_lkh_line_head      = addslashes($_POST['t_lkh_line_head']);
        $t_lkh_line_item      = addslashes($_POST['t_lkh_line_item']);
        $t_lkh_line_dct       = addslashes($_POST['t_lkh_line_dct']);
        $t_lkh_line_st        = addslashes($_POST['t_lkh_line_st']);
        $t_lkh_line_tpt       = addslashes($_POST['t_lkh_line_tpt']);
        $t_lkh_line_working   = addslashes($_POST['t_lkh_line_working']);
        $t_lkh_line_stroke    = addslashes($_POST['t_lkh_line_stroke']);
        echo $this->record->create_line(
            $t_lkh_line_head, 
            $t_lkh_line_item, 
            $t_lkh_line_dct,
            $t_lkh_line_st, 
            $t_lkh_line_tpt,
            $t_lkh_line_working,
            $t_lkh_line_stroke);
    }  

    function edit_line(){
        if(!isset($_POST))	
            show_404();
        $t_lkh_line_id           = addslashes($_POST['id']);
        echo $this->record->edit_line($t_lkh_line_id);
    } 

    function update_line(){
        if(!isset($_POST))	
            show_404();
        $t_lkh_line_id        = addslashes($_POST['t_lkh_line_id']);
        $t_lkh_line_item      = addslashes($_POST['t_lkh_line_item']);
        $t_lkh_line_dct       = addslashes($_POST['t_lkh_line_dct']);
        $t_lkh_line_st        = addslashes($_POST['t_lkh_line_st']);
        $t_lkh_line_tpt       = addslashes($_POST['t_lkh_line_tpt']);
        $t_lkh_line_working   = addslashes($_POST['t_lkh_line_working']);
        $t_lkh_line_stroke    = addslashes($_POST['t_lkh_line_stroke']);
        echo $this->record->update_line(
            $t_lkh_line_id, 
            $t_lkh_line_item, 
            $t_lkh_line_dct,
            $t_lkh_line_st,
            $t_lkh_line_tpt,
            $t_lkh_line_working, 
            $t_lkh_line_stroke);
    }  

    function delete_line(){
        if(!isset($_POST))	
            show_404();
        $t_lkh_line_id       = addslashes($_POST['Id']);
        echo $this->record->delete_line($t_lkh_line_id);
    }

}