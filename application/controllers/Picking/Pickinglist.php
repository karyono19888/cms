<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pickinglist extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_login');
    }
    
    function index(){
        if($this->auth->is_logged_in() == false){
           $this->login();
        }
        else{
           $this->main();
        }        
    }
         
    function main($id){
        // mencegah user yang belum login untuk mengakses halaman ini
        $this->auth->restrict();
        $x['data']=$this->M_login->getHeader($id);
        $this->load->view('template/v_header', $x);
        $this->load->view('picking/v_main_pl', $x); //content
        $this->load->view('template/v_footer');
    }

    function dlvd($id){
        $this->auth->restrict();
        $x['data']=$this->M_login->getHeader($id);
        $this->load->view('template/v_header', $x);
        $this->load->view('picking/v_dlv_d', $x);
        $this->load->view('template/v_footer');
    }

    function details(){
        $this->auth->restrict();
        if($this->M_login->startList($_POST)->num_rows() > 0){
            $x['data']=$this->M_login->startList($_POST);
            $x['urut']=$this->input->post('filter');
            $this->load->view('template/v_header');
            $this->load->view('picking/v_main_spl', $x);
            $this->load->view('template/v_footer');
        }else{
            $this->session->set_flashdata('error','Data Qty sudah lengkap');
            $id = $this->input->post('id');
            redirect(site_url("Picking/Pickinglist/main/".$id));
        }
        
    }

    function update(){ 
        $this->auth->restrict();
        if($this->M_login->updateList($_POST)->num_rows() > 0){
            $x['data']=$this->M_login->updateList($_POST);
            $x['urut']=$this->input->post('urut');
            $this->load->view('template/v_header');
            $this->load->view('picking/v_main_spl', $x);
            $this->load->view('template/v_footer');
        }else{
            $this->session->set_flashdata('success','Input data selesai');
            $head = $this->input->post('header');
            $this->M_login->delNext($head);
            redirect(site_url("Picking/Pickinglist/main/".$head));
        }
    }

    public function editLot()
    {
        if (!empty($this->input->post('ids'))) { 
            $hd = $this->input->post('hds');
            $data = $this->M_login->cekTph($hd);
            foreach($data->result_array() as $dt){
                $sts = $dt['t_picking_header_prep1'];
            }
            echo json_encode(array(
                'id'=>$this->input->post('ids'), 
                'hd'=>$this->input->post('hds'),
                'lot'=>$this->input->post('lots'),
                'qty'=>$this->input->post('qtys'),
                'box'=>$this->input->post('boxs'),
                'cart'=>$this->input->post('carts'),
                'rd'=>$sts
            ));
        } 
    }

    function updateLot(){
        if($this->M_login->upLot($_POST) > 0){
            $this->session->set_flashdata('success','Input data berhasil');
            $head = $this->input->post('hd');
            redirect(site_url("Picking/Pickinglist/main/".$head));
        }else{
            $this->session->set_flashdata('error','Input data gagal');
            $head = $this->input->post('hd');
            redirect(site_url("Picking/Pickinglist/main/".$head));
        }
    }

    function sendSJ($id){
        $this->auth->restrict();
        if($this->M_login->sendsuja($id)){
            $data = $this->M_login->sendsuja($id);
            foreach($data->result_array() as $dt){
                $jml = $dt['jml'];
                $sts = $dt['sts'];
            }
            if($jml == $sts){
                $this->session->set_flashdata('success','Picking sudah terkirim');
                $this->M_login->upSt($id);
                redirect(site_url(''));
            }else{
                $this->session->set_flashdata('error','Qty belum lengkap');
                redirect(site_url(''));
            }
        }else{
            $this->session->set_flashdata('error','No header tidak ada');
            redirect(site_url(''));
        }
    }

    function sendCS($id){
        $this->auth->restrict();
        if($this->M_login->sendcks($id)){
            $data = $this->M_login->sendcks($id);
            foreach($data->result_array() as $dt){
                $jml = $dt['jml'];
                $sts = $dt['sts'];
            }
            if($jml == $sts){
                $this->session->set_flashdata('success','Picking sudah terkirim');
                $this->M_login->upCS($id);
                redirect(site_url(''));
            }else{
                $this->session->set_flashdata('error','Lot belum lengkap');
                redirect(site_url(''));
            }
        }else{
            $this->session->set_flashdata('error','No header tidak ada');
            redirect(site_url(''));
        }
    }

    function fns($id){
        $this->auth->restrict();
        if($this->M_login->senddlv($id)){
            $this->session->set_flashdata('success','Picking sudah terkirim');
            redirect(site_url(''));
        }else{
            $this->session->set_flashdata('error','No header tidak ada');
            redirect(site_url(''));
        }
    }

    function plh_gd(){
        // mencegah user yang belum login untuk mengakses halaman ini
        $this->auth->restrict();
        $x['data']=$this->M_login->plh_gd();
        $this->load->view('template/v_header');
        $this->load->view('picking/v_plh_gd', $x); //content
        $this->load->view('template/v_footer');
    }

    function plhd_gd($id){
        $this->auth->restrict();
        $x['data']=$this->M_login->plhd_gd($id);
        $this->load->view('template/v_header', $x);
        $this->load->view('picking/v_plhd_gd', $x);
        $this->load->view('template/v_footer');
    }

    function plh_dlv(){
        // mencegah user yang belum login untuk mengakses halaman ini
        $this->auth->restrict();
        $x['data']=$this->M_login->plh_dlv();
        $this->load->view('template/v_header');
        $this->load->view('picking/v_plh_dlv', $x); //content
        $this->load->view('template/v_footer');
    }

    function plhd_dlv($id){
        $this->auth->restrict();
        $x['data']=$this->M_login->plhd_dlv($id);
        $this->load->view('template/v_header', $x);
        $this->load->view('picking/v_plhd_dlv', $x);
        $this->load->view('template/v_footer');
    }

}