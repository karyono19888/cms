<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_menu extends CI_Model
{    
    static $table1 = 'a_mn';
    static $table2 = 'a_mn_grp';
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('database');
    }

    function index(){ 
        $this->db->select('
            b.a_mn_name as menu, 
            a.a_mn_name as submenu, 
            a.a_mn_link as link, 
            a.a_mn_icon as icon, 
            a.a_mn_id as a_mn_id');       
        $this->db->join(self::$table1.' b', 'a.a_mn_parentId = b.a_mn_id', 'left');       
        $query  = $this->db->get(self::$table1.' a');
        return $query;          
    }

    function getMenu(){
        $this->db->select('a_mn_id,a_mn_name');
        $this->db->where('a_mn_parentId', 0);
        $query  = $this->db->get(self::$table1);
        return $query;        
    }

    function create($a_mn_parentId, $a_mn_name, $a_mn_link, $a_mn_icon){
        $query = $this->db->insert(self::$table1,array(
            'a_mn_parentId'     => $a_mn_parentId,
            'a_mn_name'         => $a_mn_name,
            'a_mn_link'         => $a_mn_link,
            'a_mn_icon'         => $a_mn_icon
        ));
        if($query){
            $this->db->select_max('a_mn_id');
            $query_2    = $this->db->get(self::$table1);
            $row_2      = $query_2->row();
            $row_1      = $query_2->num_rows();
            if($row_1 > 0){
                $this->db->select('a_mn_grp_lvl');
                $this->db->group_by('a_mn_grp_lvl');
                $query_3    = $this->db->get(self::$table2);
                foreach ( $query_3->result() as $row_3 ){
                    if($row_3->a_mn_grp_lvl == 1){
                        $this->db->insert(self::$table2,array(
                            'a_mn_grp_lvl'   => $row_3->a_mn_grp_lvl,
                            'a_mn_grp_menu'  => $row_2->a_mn_id,
                            'a_mn_grp_sts'   => 1
                        ));
                    }else{
                        $this->db->insert(self::$table2,array(
                            'a_mn_grp_lvl'   => $row_3->a_mn_grp_lvl,
                            'a_mn_grp_menu'  => $row_2->a_mn_id,
                            'a_mn_grp_sts'   => 0
                        ));
                    }
                }
                return json_encode(array('success'=>true, 'msg'=>'Input data berhasil!'));
            }else{
                return json_encode(array('success'=>false, 'msg'=>'Input data menu group gagal!'));
            }
        }else{
            return json_encode(array('success'=>false, 'msg'=>'Input data gagal!'));
        }
    }

    function view($myid){        
        $this->db->select('
            a.a_mn_id as a_mn_id, 
            b.a_mn_id as parentMenuId, 
            b.a_mn_name as parentMenu, 
            a.a_mn_name as a_mn_name, 
            a.a_mn_link as a_mn_link, 
            a.a_mn_icon as a_mn_icon');       
        $this->db->join(self::$table1.' b', 'a.a_mn_parentId = b.a_mn_id', 'left'); 
        $this->db->where('a.a_mn_id', $myid);
        $query  = $this->db->get(self::$table1.' a');
        if($query){
            $row = $query->row();
            if($row->parentMenuId == NULL){
                $parentMenuId ='';
            }else{
                $parentMenuId =$row->parentMenuId;
            }
            if($row->parentMenu == NULL){
                $parentMenu ='';
            }else{
                $parentMenu =$row->parentMenu;
            }
            return json_encode(array(
                'success'           =>true,
                'a_mn_id'           => $row->a_mn_id, 
                'parentMenuId'      => $parentMenuId,
                'parentMenu'        => $parentMenu,
                'a_mn_name'         => $row->a_mn_name,
                'a_mn_link'         => $row->a_mn_link,
                'a_mn_icon'         => $row->a_mn_icon
            ));    
        }else{
            return json_encode(array('success'=>false, 'msg'=>'Data tidak ditemukan!'));
        }   
    }

    function update($a_mn_id, $a_mn_parentId, $a_mn_name, $a_mn_link, $a_mn_icon){        
        $this->db->trans_start();
        $this->db->where('a_mn_id', $a_mn_id);
        $this->db->update(self::$table1,array(
            'a_mn_parentId'     => $a_mn_parentId,
            'a_mn_name'         => $a_mn_name,
            'a_mn_link'         => $a_mn_link,
            'a_mn_icon'         => $a_mn_icon
        ));
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            return json_encode(array('success'=>false, 'msg'=>'Update data gagal!'));
        }else {
            return json_encode(array('success'=>true, 'msg'=>'Update data berhasil!'));
        }
    }

    function delete($a_mn_id){
        $this->db->trans_start();
        $this->db->delete(self::$table1, array('a_mn_id' => $a_mn_id));
        $this->db->trans_complete();
        if($this->db->trans_status() === FALSE){
            return json_encode(array('success'=>false, 'msg'=>'Hapus data gagal!'));
        }else {
            $this->db->delete(self::$table2, array('a_mn_grp_menu' => $a_mn_id));
            return json_encode(array('success'=>true, 'msg'=>'Hapus data berhasil!'));
        }
    }
    
}

/* End of file m_menu.php */
/* Location: ./application/models/admin/m_menu.php */