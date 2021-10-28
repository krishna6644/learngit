<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library("session");
		$this->load->model('Category_model', 'category_model');
	}
	public function index()
	{
		 $header = array(
			'title' => 'Category',
			'description' => '',
			'page' => 'category_list',
		);
		$data['data'] = $this->category_model->list();
		$data['cat'] = $this->category_model->parentcat();

		$this->load->view('includes/header',$header);
		$this->load->view('category/index', $data);
		$this->load->view('includes/footer',$header);
	}
	public function create()
	{
		$data['subcategory'] = $this->category_model->get_cat();
		$header = array(
			'title' => 'Category',
			'description' => '',
			'page' => 'category_list',
		);
		$this->load->view('includes/header',$header);
		$this->load->view('category/create', $data);
		$this->load->view('includes/footer',$header);
	}
	public function store()
	{
		
		$this->form_validation->set_rules('category_name', 'Category Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('errorcat', validation_errors());
			return redirect(base_url('category/create'));
		}
		$file_name = null;
		if (!empty($_FILES['image']['name'])) {
			$config['upload_path'] = './uploads/admin';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = 2000;
			$config['max_width'] = 1500;
			$config['max_height'] = 1500;
			$config['file_name'] = $_FILES['image']['name'];
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('image')) {
				$error = array('error' => $this->upload->display_errors());

				return redirect(base_url('category/create'));
			} else {
				$data = array('image_metadata' => $this->upload->data());
				$file_name = $data['image_metadata']['file_name'];
			}
		}

		if ($this->category_model->insert($file_name)) {

			$this->session->set_flashdata('successcat', 'Successfully Save ');
			return redirect(base_url('category/index'));
		} else {
			$this->session->set_flashdata('errorcat', 'Something went wrong!!.');
			return redirect(base_url('category/create'));
		}
	}

	public function edit($id)
	{
		$header = array(
			'title' => 'Category',
			'description' => '',
			'page' => 'category_list',
		);
		$data['subcategory'] = $this->category_model->get_cat();
		$data['category'] = $this->db->get_where('category', array('cat_id' => $id))->row();
		$this->load->view('includes/header',$header);
		$this->load->view('category/edit', $data);
		$this->load->view('includes/footer',$header);
	}
	public function update($id)
	{
		
		$this->form_validation->set_rules('category_name', 'Category Name', 'required');


		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('errorcat', validation_errors());
			return redirect(base_url('category/edit/' . $id . ''));
		}
		$file_name = null;



		if (!empty($_FILES['image']['name'])) {
			$config['upload_path'] = './uploads/admin';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size'] = 2000;
			$config['max_width'] = 1500;
			$config['max_height'] = 1500;
			$config['file_name'] = $_FILES['image']['name'];
			$this->load->library('upload', $config);
			$this->upload->initialize($config);
			if (!$this->upload->do_upload('image')) {
				$error = array('error' => $this->upload->display_errors());
				return redirect(base_url('category/create'));
			} else {
				$data = array('image_metadata' => $this->upload->data());
				$file_name = $data['image_metadata']['file_name'];
			}
		}

		if ($this->category_model->update($id, $file_name)) {
			$this->session->set_flashdata('successcat', 'Successfully Save ');
			return redirect(base_url('category/index'));
		} else {
			$this->session->set_flashdata('errorcat', 'Something went wrong!!.');
			return redirect(base_url('category/create'));
		}
	}
	public function delete($id = null)
	{
		if ($this->category_model->delete($id)) {
			$this->session->set_flashdata('successcat', 'successfully delete Admin');
		} else {
			$this->session->set_flashdata('errorcat', '!opps something is wrong.');
		}
		return redirect(base_url('category/index'));
	}
	public function list()
	{

		(!$this->input->is_ajax_request()) ? exit('No direct script access allowed') : '';
		$list = $this->category_model->get_datatables();

		$data = array();
		$no   = $_POST['start'];



		foreach ($list as $key) {
			$no++;
			$row = array();
			$row[] = '<img class="img-avatar" src="' . base_url('uploads/admin/' . $key->image . ' ') . '" height="100px" width="100px" />';
			$row[] = $key->category_name;
			$row[] = $key->parent_cat;
			$row[] = $key->status;
			$row[] = '<a class="btn btn-info btn-xs" href="' . base_url('category/edit/' . $key->cat_id . '') . '"><i class="fas fa-edit"></i></a>
 						<a class="btn btn-danger btn-xs delete-single" href="" data-id="'.$key->cat_id.'"><i class="fas fa-trash"></i></a>';

			$data[] = $row;
		}
		$output = array(
			"draw"            => $_POST['draw'],
			"recordsTotal"    => $this->category_model->count_all(),
			"recordsFiltered" => $this->category_model->count_filtered(),
			"data"            => $data,
		);
		echo json_encode($output);
	}
	public function update_inbulk()
	{

		(!$this->input->is_ajax_request()) ? exit('No direct script access allowed') : '';
		if ($this->category_model->update_inbulk($this->input->post('id'))) {
			echo TRUE;
		} else {
			echo FALSE;
		}
	}
}
