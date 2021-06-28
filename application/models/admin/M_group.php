<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_group extends CI_Model
{    
    static $table1 = 'a_level';
    static $table2 = 'a_mn_grp';
    static $table3 = 'a_mn';
    
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
        $this->db->where('a_level_id', $myid);
        $query  = $this->db->get(self::$table1);
        if($query){
            $row = $query->row();
            return json_encode(array(
                'success'           =>true,
                'a_level_id'        => $row->a_level_id, 
                'a_level_name'      => $row->a_level_name
            ));    
        }else{
            return json_encode(array('success'=>false, 'msg'=>'Data tidak ditemukan!'));
        }   
    }

    function create($a_level_name){
        $this->db->where('a_level_name', $a_level_name);
        $query = $this->db->get(self::$table1);
        $row = $query->num_rows();
        if($row > 0){
            return json_encode(array('success'=>false, 'msg'=>'Data sudah ada!'));
        }else{
            $query_1 = $this->db->insert(self::$table1,array(
                'a_level_name'    => $a_level_name
            ));
            if($query_1){
                $this->db->select_max('a_level_id');
                $query_2    = $this->db->get(self::$table1);
                $row_2      = $query_2->row();
                $row_1      = $query_2->num_rows();
                if($row_1 > 0){
                    $this->db->select('a_mn_id');
                    $query_3    = $this->db->get(self::$table3);
                    foreach ( $query_3->result() as $row_3 ){
                        $this->db->insert(self::$table2,array(
                            'a_mn_grp_lvl'   => $row_2->a_level_id,
                            'a_mn_grp_menu'  => $row_3->a_mn_id,
                            'a_mn_grp_sts'   => 0
                        ));
                    }
                    return json_encode(array('success'=>true, 'msg'=>'Input data berhasil!'));
                }
            }
            else{
                return json_encode(array('success'=>false, 'msg'=>'Input data gagal!'));
            }        
        }
    }

    function update($a_level_id, $a_level_name){
        if($a_level_id == 1){
            return json_encode(array('success'=>false, 'msg'=>'Group Administrator tidak boleh diupdate!'));
        }
        else{
            $this->db->trans_start();
            $this->db->where('a_level_id', $a_level_id);
            $this->db->update(self::$table1,array(
                'a_level_name'    => $a_level_name
            ));
            $this->db->trans_complete();
            if($this->db->trans_status() === FALSE){
                return json_encode(array('success'=>false, 'msg'=>'Update data gagal!'));
            }else {
                return json_encode(array('success'=>true, 'msg'=>'Update data berhasil!'));
            }
        }
    }

    function delete($a_level_id){
        if($a_level_id == 1){
            return json_encode(array('success'=>false, 'msg'=>'Group Administrator tidak boleh dihapus!'));
        }
        else{
            $this->db->trans_start();
            $this->db->delete(self::$table1, array('a_level_id' => $a_level_id));
            $this->db->trans_complete();
            if($this->db->trans_status() === FALSE){
                return json_encode(array('success'=>false, 'msg'=>'Hapus data gagal!'));
            }else {
                $this->db->delete(self::$table2, array('a_mn_grp_lvl' => $a_level_id));
                return json_encode(array('success'=>true, 'msg'=>'Hapus data berhasil!'));
            }
        }
        
    }

    function menu($a_level_id){
        $this->db->join('a_mn_grp', 'a_mn_id=a_mn_grp_menu', 'left');
        $this->db->where('a_mn_grp_lvl', $a_level_id);
        $this->db->group_by('a_mn_grp_menu');
        $query  = $this->db->get('a_mn');

        $data = array();
        foreach ( $query->result() as $row ){
            array_push($data, $row); 
        }
 
        $result = array();
        $result['rows']  = $data;
        
        return json_encode($result);  
    }

    function akses($a_mn_grp_id, $a_mn_grp_sts, $a_mn_grp_lvl){
        if($a_mn_grp_sts == 1){
            $sts = 0;
        }else{
            $sts = 1;
        }
        $this->db->where('a_mn_grp_id', $a_mn_grp_id);
        $query = $this->db->update(self::$table2,array(
            'a_mn_grp_sts'    => $sts
        ));
        if($query){
            $this->db->join('a_mn_grp', 'a_mn_id=a_mn_grp_menu', 'left');
            $this->db->where('a_mn_grp_lvl', $a_mn_grp_lvl);
            $this->db->group_by('a_mn_grp_menu');
            $query  = $this->db->get('a_mn');

            $data = array();
            foreach ( $query->result() as $row ){
                array_push($data, $row); 
            }
    
            $result = array();
            $result['rows']  = $data;
            
            return json_encode($result);  
        }else {
            return json_encode(array('success'=>false));
        }
    }
    
}

/* End of file m_group.php */
/* Location: ./application/models/admin/m_group.php */