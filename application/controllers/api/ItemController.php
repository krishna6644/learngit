<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/RestController.php';

use chriskacerguis\RestServer\RestController;

class ItemController extends RestController
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ItemModel');
    }

    public function indexItem_get()
    {
        
        $item = $this->ItemModel->get_item();
        $this->response($item, 200);
    }

    public function storeItem_post()
    {
        $postdatas = json_decode( file_get_contents('php://input') );        
        $result = $this->ItemModel->insert_item($postdatas);
        if($result == true)
        {
            $array = array("status"=>true,"message"=>"data save successfully..");
        }
        else
        {
            $array = array("status"=>false,"message"=>"error accurs..");
        }
        echo json_encode($array);
    }

    public function editItem_get($id)
    {
        $item = $this->ItemModel->edit_item($id);
        $this->response($item, 200);
    }

    public function updateItem_put($id)
    {
        $data = [
            'title' =>  $this->put('title'),
            'description' => $this->put('description'),
            ];
        $result = $this->ItemModel->update_item($id, $data);
        if($result > 0)
        {
            $this->response([
                'status' => true,
                'message' => 'ITEM UPDATED'
            ], RestController::HTTP_OK); 
        }
        else
        {
            $this->response([
                'status' => false,
                'message' => 'FAILED TO UPDATE ITEM'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }

    public function deleteItem_delete($id)
    {
        $result = $this->ItemModel->delete_item($id);
        if($result > 0)
        {
            $this->response([
                'status' => true,
                'message' => 'ITEM DELETED'
            ], RestController::HTTP_OK); 
        }
        else
        {   
            $this->response([
                'status' => false,
                'message' => 'FAILED TO DELETE ITEM'
            ], RestController::HTTP_BAD_REQUEST);
        }
    }
}

?>