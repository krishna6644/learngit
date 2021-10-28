<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ItemModel extends CI_Model
{

    public function get_item()
    {
        $query = $this->db->get("items");
        return $query->result();
    }

    public function insert_item($data)
    {
        $data = array(
            'title' =>  $this->db->escape($data->title),
            'description' => $this->db->escape($data->description),
           
        );
        return $this->db->insert('items', $data);
    }

    public function edit_item($id)
    {
        $this->db->where('id',$id);
        $query = $this->db->get('items');
        return $query->row();
    }

    public function update_item($data, $id)
    {
        $this->db->where('id', $id);
        return $this->db->update('items', $data);
    }

    public function delete_item($id)
    {
        return $this->db->delete('items', ['id' => $id]);
    }
    
}

?>