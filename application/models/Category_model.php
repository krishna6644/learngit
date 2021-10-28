<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function list()
    {
        $this->db->select();


        return $this->db->get('category')->result_array();
    }
    public function insert($file_name)
    {


        $data = array(
            'category_id'     => $this->input->post('category_id'),
            'category_name'    => $this->input->post('category_name'),
            'image' => $file_name,
            'status'    => $this->input->post('status')
        );


        return $this->db->insert('category', $data);
    }
    public function update($id, $file_name)
    {
        $data = array(
            'category_id'     => $this->input->post('category_id'),
            'category_name'    => $this->input->post('category_name'),

            'status'    => $this->input->post('status'),

        );
        if (!empty($file_name)) {
            $data['image'] = $file_name;
        }
        if ($id == 0) {
            return $this->db->insert('category', $data);
        } else {
            $this->db->where('cat_id', $id);
            return $this->db->update('category', $data);
        }
    }

    public function delete($id)
    {

        $this->db->limit(1);
        $this->db->where('cat_id', $id);
        $this->db->delete('category');
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
    public function get_cat()
    {

        $this->db->where('category_id', 0);

        return $this->db->get('category')->result_array();
    }

    public function getcategory()
    {

        $this->db->where('category_id', 0);
        $this->db->where('status', 'active');
        return $this->db->get('category')->result_array();
    }
    public function subcategory()
    {
        $this->db->where('category_id !=', 0);
        return $this->db->get('category')->result_array();
    }
    public function catlog($id = array())
    {
        if (isset($id['category_id'])) {

            $this->db->where('category_id', $id['category_id']);
            $query = $this->db->get('category');
            $response = $query->result_array();
        }
        return $response;
    }
    public function parentcat()
    {
        $this->db->select('a.category_id, a.category_name, b.category_name as parent_cat');
        $this->db->join('category b', 'a.category_id=b.cat_id', 'left');

        return $this->db->get('category a')->result_array();
    }
   
   
    var $column_order  = array('a.cat_id','a.category_name'); 
    var $column_search = array('a.category_name','a.status'); 
    var $order         = array('a.cat_id' => 'ASC');   
    private function _get_datatables_query()
    {
        $this->db->from('category a');
        $this->db->select('a.*, b.category_name as parent_cat');
        $this->db->join('category b', 'a.category_id=b.cat_id', 'left');
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
        $this->db->from('category');
        return $this->db->count_all_results();
    }
    public function update_inbulk($id = null)
    {   
        if ($id != 0) {
            $this->db->where( 'cat_id', $id );
            $this->db->delete( 'category');
            
            return ( $this->db->affected_rows() > 0 ) ? TRUE : TRUE ;
        }
        return false;   
    }
}
