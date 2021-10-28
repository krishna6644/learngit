<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function list()
    {
        $this->db->select( 'p.*,a.category_name as parent_cat, b.category_name as sub_cate' );
        $this->db->join( 'category a', 'a.cat_id = p.cat_name', 'left' );
        $this->db->join( 'category b', 'b.cat_id = p.sub_cat_name', 'left' );
        $this->db->like('product_name', $this->input->post('filter_news_title'));
        $this->db->like('cat_name', $this->input->post('cat_title'));
        $this->db->like('sub_cat_name', $this->input->post('sub_cat_title'));
        $this->db->like('price', $this->input->post('price_search'));
        
        $query = $this->db->get('product p');
       
        // check the number of rows in the result set
        if ($query->num_rows() > 0) {
            // return the query result as array
            return $query->result_array();
        } else {
            // return the empty array if no row
            return array();
        }
    }
    public function insert($id = null)
    {
        
        $data = array(  
            'cat_name'     => $this->input->post('cat_name'),
            'sub_cat_name'    => $this->input->post('sub_cat_name'),
            'product_name'    => $this->input->post('product_name'),
            'slug'    => $this->input->post('slug'),
            'price'    => $this->input->post('price'),
            'selling_price'    => $this->input->post('selling_price'),
            'stock'    => $this->input->post('stock'),
            'status'    => $this->input->post('status')
            
        );
       
            return $this->db->insert('product', $data);
            
        
    }
    public function update($id) 
    {
        $data=array(
            'cat_name'     => $this->input->post('cat_name'),
            'sub_cat_name'    => $this->input->post('sub_cat_name'),
            'product_name'    => $this->input->post('product_name'),
            'slug'    => $this->input->post('slug'),
            'price'    => $this->input->post('price'),
            'selling_price'    => $this->input->post('selling_price'),
            'stock'    => $this->input->post('stock'),
            'status'    => $this->input->post('status')
        );
        if($id==0){
            return $this->db->insert('product',$data);
        }else{
            $this->db->where('p_id',$id);
            return $this->db->update('product',$data);
        }        
    }
    public function delete($id)
    {
        $this->db->limit(1);
        $this->db->where('p_id', $id);
        $this->db->delete('product');
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    public function productimg()
    {
        $this->db->select('*');
        $this->db->from('files');
        $this->db->where('product_id',$this->input->post('pro_id'));
        $result = $this->db->get()->result_array();
        
        $data = '';
       
        foreach($result as $row){
          
            $data .= '
                        <img src="http://localhost/interior/uploads/admin/'.$row["file_name"].'" width="200px" height="200px">
                    ';
        }
       
        return $data;
        
        // return $this->db->get()->result_array();
    }
   
    var $column_order  = array('p.p_id','p.product_name'); 
    var $column_search = array('p.product_name'); 
    var $order         = array('p.p_id' => 'ASC');   
    private function _get_datatables_query()
    {
        $this->db->from('product p');
        $this->db->select( 'p.*,a.category_name as parent_cat, b.category_name as sub_cate' );
        $this->db->join( 'category a', 'a.cat_id = p.cat_name', 'left' );
        $this->db->join( 'category b', 'b.cat_id = p.sub_cat_name', 'left' );
        $i = 0;
        foreach ($this->column_search as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i)
                    $this->db->group_end();
            }
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    public function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from('product');
        return $this->db->count_all_results();
    }
    public function update_inbulk($id = null)
    {   
        if ($id != 0) {
            $this->db->where( 'p_id', $id );
            $this->db->delete( 'product');
            
            return ( $this->db->affected_rows() > 0 ) ? TRUE : TRUE ;
        }
        return false;   
    }
}
