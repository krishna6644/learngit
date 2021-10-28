<?php  
defined('BASEPATH') OR exit('No direct script access allowed'); 
 
class File extends CI_Model{ 
    function __construct() { 
        $this->tableName = 'files'; 
    } 
     
    /* 
     * Fetch files data from the database 
     * @param id returns a single record if specified, otherwise all records 
     */ 
    public function getRows($id = ''){ 
        $this->db->select('id,product_id,file_name,uploaded_on'); 
        $this->db->from('files');
        
        if($id){ 
            $this->db->where('id',$id); 
            $query = $this->db->get(); 
            $result = $query->row_array(); 
        }else{ 
            $this->db->order_by('uploaded_on','desc'); 
            $query = $this->db->get(); 
            $result = $query->result_array(); 
        } 
        return !empty($result)?$result:false; 
    } 
    public function getproduct()
    {
        $this->db->select('*');
        $this->db->from('product');
        return $this->db->get()->result_array(); 
    }
     
    /* 
     * Insert file data into the database 
     * @param array the data for inserting into the table 
     */ 
    public function insert($data = array()){ 
        
        $insert = $this->db->insert('files',$data); 
        return $insert?true:false; 
    } 
    public function insertmultifile($data = array()){ 
        
        $insert = $this->db->insert_batch('files',$data); 
        return $insert?true:false; 
    } 
    public function delete($id)
    {
        $this->db->limit(1);
        $this->db->where('id', $id);
        $this->db->delete('files');
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
}   