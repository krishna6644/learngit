<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_model', 'product_model');
        $this->load->model('Category_model', 'category_model');
        $this->load->model('File', 'file');
    }
    public function index()
    {
        $header = array(
            'title' => 'Product',
            'description' => '',
            'page' => 'product_list',
        );

        $data['data'] = $this->product_model->list();

        // $data['prdtimg']=$this->product_model->productimg();


        $data['category'] = $this->category_model->getcategory();
        $data['subcategory'] = $this->category_model->subcategory();

        $this->load->view('includes/header', $header);
        $this->load->view('product/index', $data);
        $this->load->view('includes/footer', $header);
    }
    public function create()
    {
        $header = array(
            'title' => 'Product',
            'description' => '',
            'page' => 'product_list',
        );

        $data['category'] = $this->category_model->getcategory();
        $data['subcategory'] = $this->category_model->subcategory();

        $this->load->view('includes/header', $header);
        $this->load->view('product/create', $data);
        $this->load->view('includes/footer', $header);
    }
    public function store()
    {
       
        $this->form_validation->set_rules('cat_name', 'Category Name', 'required');
        $this->form_validation->set_rules('sub_cat_name', 'Sub Category Name', 'required');
        $this->form_validation->set_rules('product_name', 'Product Name', 'required');
        $this->form_validation->set_rules('slug', 'Slug', 'required|is_unique[product.slug]');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('selling_price', 'Selling Price', 'required');
        $this->form_validation->set_rules('stock', 'Stock', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            return redirect(base_url('product/create'));
        }
        if ($this->product_model->insert()) {
            $this->session->set_flashdata('success', 'Successfully Save ');
            return redirect(base_url('product/index'));
        } else {
            $this->session->set_flashdata('error', 'error accurs ');
            return redirect(base_url('product/create'));
        }
    }
    public function update($id)
    {
       
        $this->form_validation->set_rules('cat_name', 'Category Name', 'required');
        $this->form_validation->set_rules('sub_cat_name', 'Sub Category Name', 'required');
        $this->form_validation->set_rules('product_name', 'Product Name', 'required');
        $this->form_validation->set_rules('slug', 'Slug', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('selling_price', 'Selling Price', 'required');
        $this->form_validation->set_rules('stock', 'Stock', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            
            return redirect(base_url('product/edit/'.$id.''));
        }



        if ($this->product_model->update($id)) {
                
            $this->session->set_flashdata('success', 'Successfully Save ');
            
            return redirect(base_url('product/index'));
        } else {
            $this->session->set_flashdata('error', 'Something went wrong!!.');
            return redirect(base_url('product/edit/'.$id.''));
        }
    }
    public function edit($id)
    {
        $data['category'] = $this->category_model->getcategory();
        $data['subcategory'] = $this->category_model->subcategory();
        $data['product'] = $this->db->get_where('product', array('p_id' => $id))->row();
        $data['imgs'] = $this->db->select('*')->where('product_id',$id)->get('files')->result_array();
        
        $data['files'] = $this->file->getRows();
        $data['products'] = $this->file->getproduct();
        $header = array(
            'title' => 'Product',
            'description' => '',
            'page' => 'product_list',
        );
        $this->load->view('includes/header', $header);
        $this->load->view('product/edit', $data);
        $this->load->view('includes/footer', $header);
    }

    public function delete($id = null)
    {
        if ($this->product_model->delete($id)) {
            $this->session->set_flashdata('success', 'successfully delete Admin');
        } else {
            $this->session->set_flashdata('error', '!opps something is wrong.');
        }
        return redirect(base_url('product/index'));
    }
    public function datalog()
    {
        $id = $this->input->post();
        $data = $this->category_model->catlog($id);
        echo json_encode($data);
    }
    public function get_news_by_filters()
    {

        $news = $this->product_model->list();
        echo json_encode($news);
    }
    public function getname()
    {
        $name =  $this->product_model->productimg();
        echo json_encode($name);
    }
    public function listTable()
    {
        (!$this->input->is_ajax_request()) ? exit('No direct script access allowed') : '';
        $list = $this->product_model->get_datatables();
        $data = array();
        $no   = $_POST['start'];
        foreach ($list as $key) {
            $no++;
            $row = array();
            $row[] = '<button class="btn btn-info probutton" type="button" id="' . $key->p_id . '" >' . $key->product_name . ' </button>';
            $row[] = $key->sub_cate;
            $row[] = $key->parent_cat;
            $row[] = $key->slug;
            $row[] = $key->price;
            $row[] = $key->selling_price;
            $row[] = $key->stock;
            $row[] = $key->status;
            $row[] = '<a class="btn btn-info btn-xs" href="' . base_url('product/edit/' . $key->p_id . '') . '"><i class="fas fa-edit"></i></a>
 						<a class="btn btn-danger btn-xs delete-single" href="" data-id="' . $key->p_id . '"><i class="fas fa-trash"></i></a>';

            $data[] = $row;
        }
        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->product_model->count_all(),
            "recordsFiltered" => $this->product_model->count_filtered(),
            "data"            => $data,
        );
        echo json_encode($output);
    }
    public function update_inbulk()
    {
        (!$this->input->is_ajax_request()) ? exit('No direct script access allowed') : '';
        if ($this->product_model->update_inbulk($this->input->post('id'))) {
            echo TRUE;
        } else {
            echo FALSE;
        }
    }
    public function filedelete($id = null)
    {
        if ($this->file->delete($id)) {
            $this->session->set_flashdata('success', 'successfully delete File');
        } else {
            $this->session->set_flashdata('error', '!opps something is wrong.');
        }
        return redirect($_SERVER['HTTP_REFERER']);
    }
    
}
