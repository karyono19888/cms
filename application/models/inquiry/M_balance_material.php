<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class M_balance_material extends CI_Model
{    
    static $table1 = 't_stok';
    static $table2 = 'm_item';
    
    public function __construct() {
        parent::__construct();
        $this->load->helper('database');
    }

    function index(){ 
        $this->db->select('*, SUM(t_stok_sheet) as qty, SUM(t_stok_pcs) as pcs, SUM(t_stok_kg) as kg' );  
        $this->db->join(self::$table2, 't_stok_item=m_item_id', 'left'); 
        $this->db->order_by('m_item_name','desc');  
        $this->db->group_by('t_stok_item');         
        $query  = $this->db->get(self::$table1);
        return $query;          
    }

    
}

/* End of file M_material_receipt.php */
/* Location: ./application/models/master/M_material_receipt.php */