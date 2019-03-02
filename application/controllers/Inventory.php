<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*	Inventory Controller
*
*	@author Noerman Agustiyan
* 				noerman.agustiyan@gmail.com
*					@anoerman
*
*	@link 	https://github.com/anoerman
*		 			https://gitlab.com/anoerman
*
*	Accessible for admin and member user group
*
*/
class Inventory extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		// set error delimeters
		$this->form_validation->set_error_delimiters(
			$this->config->item('error_start_delimiter', 'ion_auth'),
			$this->config->item('error_end_delimiter', 'ion_auth')
		);

		// model
		$this->load->model(
			array(
				'profile_model',
				'inventory_model',
				'categories_model',
				'locations_model',
				'status_model',
				'color_model',
				'logs_model',
			)
		);

		// default datas
		// used in every pages
		if ($this->ion_auth->logged_in()) {
			// user detail
			$loggedinuser = $this->ion_auth->user()->row();
			$this->data['user_full_name'] = $loggedinuser->first_name . " " . $loggedinuser->last_name;
			$this->data['user_photo']     = $this->profile_model->get_user_photo($loggedinuser->username)->row();
		}
	}

	public function index()
	{
		// Not logged in, redirect to home
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login/inventory', 'refresh');
		}
		// Logged in
		else{
			// set the flash data error message if there is one\
			$data1 = $this->inventory_model->data_peralatan();
			$data = array(
				'peralatan' => $data1,
			);

			$this->load->view('partials/_alte_header', $this->data);
			$this->load->view('partials/_alte_menu');
			$this->load->view('inv_data/index', $data);
			$this->load->view('partials/_alte_footer');
			$this->load->view('inv_data/js');
			$this->load->view('js_script');
		}
	}

	public function tambahdata()
	{
		$this->form_validation->set_rules('jenisperalatan', 'Jenis Peralatan', 'trim|required|is_unique[inventaris.jenis_peralatan]');
		$this->form_validation->set_rules('kategori', 'Kategori Peralatan', 'trim|required|xss_clean');
		$this->form_validation->set_rules('baik', 'Jumlah Baik', 'trim|required|xss_clean');
		$this->form_validation->set_rules('rusak', 'Jumlah Rusak', 'trim|required|xss_clean');
		$this->form_validation->set_rules('jumlah', 'Jumlah Barang', 'trim|required|xss_clean');
		$this->form_validation->set_message('required', 'Maaf <b>%s</b> Tidak Boleh Kosong!');
		$this->form_validation->set_message('is_unique', 'Maaf <b>%s</b> Sudah Digunakan!');
		if($this->form_validation->run() == FALSE)
		{
			$data1 = $this->inventory_model->data_peralatan();
			$data = array(
				'peralatan' => $data1,
			);
			$this->load->view('partials/_alte_header', $this->data);
			$this->load->view('partials/_alte_menu');
			$this->load->view('inv_data/index', $data);
			$this->load->view('partials/_alte_footer');
			$this->load->view('inv_data/js');
			$this->load->view('js_script');
		}
		else
		{
			// $this->inventory_model->tambah_peralatan();
			$config['upload_path']          = './assets/uploads/images/inventory/';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['max_size']             = 10240;
			$config['file_name']			= time();
			$config['overwrite']			= TRUE;
			$config['remove_space']			= TRUE;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);

			if (!$this->upload->do_upload('gambar'))
			{
				$error = array('error' => $this->upload->display_errors());
				print_r($error);
			}
			else
			{
				$data = array(
					'kode' => $this->input->post('kode'),
					'kategori' => $this->input->post('kategori'),
					'jenis_peralatan' => $this->input->post('jenisperalatan'),
					'jumlah' => $this->input->post('jumlah'),
					'baik' => $this->input->post('baik'),
					'rusak' => $this->input->post('rusak'),
					'apbn' => $this->input->post('apbn'),
					'apbd_satu' => $this->input->post('apbd_satu'),
					'apbd_dua' => $this->input->post('apbd_dua'),
					'swasta' => $this->input->post('swasta'),
					'keterangan' => $this->input->post('keterangan'),
					'nama_file' => $this->upload->data('file_name'),
				);
				// print_r($data);
				$this->db->insert('inventaris', $data);
				$this->session->set_flashdata('sukses', 'Berhasil Menambahkan Data');
				redirect(base_url('inventory'));
			}
		}
	}
	
	public function all($page="")
	{
		// Not logged in, redirect to home
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login/inventory', 'refresh');
		}
		// Logged in
		else{
			$data1 = $this->inventory_model->data_inventaris();
			$data = array(
				'inventaris' => $data1,
			);

			$this->load->view('partials/_alte_header', $this->data);
			$this->load->view('partials/_alte_menu');
			$this->load->view('inv_data/all_data', $data);
			$this->load->view('partials/_alte_footer');
			$this->load->view('inv_data/js');
			// $this->load->view('js_script');
		}
	}
	
	public function by_category($code="", $page="")
	{
		// Not logged in, redirect to home
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login/inventory', 'refresh');
		}
		// Logged in
		else{
			// If code is provided, show data based on code
			if ($code!="") {
				// Get category detail
				$category_detail = $this->categories_model->get_categories_by_code($code);
				// If exists, set detailed data. Else redirect back because invalid code
				if (count($category_detail->result())>0) {
					foreach ($category_detail->result() as $cat_data) {
						$this->data['category_name'] = $cat_data->name;
						$this->data['category_desc'] = $cat_data->description;
					}
				}
				else {
					redirect('inventory/by_category', 'refresh');
				}

				// Show all data based on code
				$this->data['data_list']  = $this->inventory_model->get_inventory_by_category_code(
					$code
				);

				// Set pagination
				$config['base_url']         = base_url('inventory/by_category/'.$code);
				$config['use_page_numbers'] = TRUE;
				$config['total_rows']       = count($this->data['data_list']->result());
				$config['per_page']         = 15;
				$this->pagination->initialize($config);

				// Get datas and limit based on pagination settings
				if ($page=="") { $page = 1; }
				$this->data['data_list'] = $this->inventory_model->get_inventory_by_category_code(
					$code,
					$config['per_page'],
					( $page - 1 ) * $config['per_page']
				);
				// $this->data['last_query'] = $this->db->last_query();
				$this->data['pagination'] = $this->pagination->create_links();

				// set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors()
				: $this->session->flashdata('message');

				$this->load->view('partials/_alte_header', $this->data);
				$this->load->view('partials/_alte_menu');
				$this->load->view('inv_data/by_category_data');
				$this->load->view('partials/_alte_footer');
				$this->load->view('inv_data/js');
				// $this->load->view('js_script');
			}
			// Summary
			else {
				// inventory by category summary
				$this->data['summary'] = $this->inventory_model->get_inventory_by_category_summary();

				// set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors()
				: $this->session->flashdata('message');

				$this->load->view('partials/_alte_header', $this->data);
				$this->load->view('partials/_alte_menu');
				$this->load->view('inv_data/by_category_index');
				$this->load->view('partials/_alte_footer');
				$this->load->view('inv_data/js');
				$this->load->view('js_script');
			}
		}
	}
	
	public function detail($kode)
	{
		// Not logged in, redirect to home
		if (!$this->ion_auth->logged_in()){
			redirect('auth/login/inventory', 'refresh');
		}
		// Logged in
		else{
			$data1 = $this->inventory_model->detail_peralatan($kode);
			$data = array(
				'detail' => $data1,
			);
			$this->load->view('partials/_alte_header', $this->data);
			$this->load->view('partials/_alte_menu');
			$this->load->view('inv_data/detail', $data);
			$this->load->view('partials/_alte_footer');
			$this->load->view('inv_data/js');
			// $this->load->view('js_script');
		}
	}

	public function edit($kode)
	{
		// Not logged in, redirect to home
		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login/inventory', 'refresh');
		}
		// Logged in
		else {
			$data1 = $this->inventory_model->detail_peralatan($kode);
			$data2 = $this->inventory_model->data_kategori();
			$data3 = $this->inventory_model->data_peralatan();
			$data = array(
				'detail' => $data1,
				'kategori' => $data2,
				'peralatan' => $data3,
			);
			$this->load->view('partials/_alte_header', $this->data);
			$this->load->view('partials/_alte_menu');
			$this->load->view('inv_data/edit', $data);
			$this->load->view('partials/_alte_footer');
			$this->load->view('inv_data/js');
			$this->load->view('js_script');
		}
	}

	public function editdata()
	{
		$this->form_validation->set_rules('jenisperalatan', 'Jenis Peralatan', 'trim');
		if($this->form_validation->run() == FALSE)
		{
			$data1 = $this->inventory_model->detail_peralatan($kode);
			$data2 = $this->inventory_model->data_kategori();
			$data3 = $this->inventory_model->data_peralatan();
			$data = array(
				'detail' => $data1,
				'kategori' => $data2,
				'peralatan' => $data3,
			);
			$this->load->view('partials/_alte_header', $this->data);
			$this->load->view('partials/_alte_menu');
			$this->load->view('inv_data/edit', $data);
			$this->load->view('partials/_alte_footer');
			$this->load->view('inv_data/js');
			$this->load->view('js_script');
		}
		else
		{
			$this->inventory_model->ubah_peralatan();
			$this->session->set_flashdata('sukses', 'Berhasil Mengubah Data');
			redirect(base_url('inventory/all'));
		}
	}
	
	public function delete($kode)
	{
		$this->inventory_model->hapus_peralatan($kode);
		$this->session->set_flashdata('sukses', 'Berhasil Menghapus Data');
			redirect(base_url('inventory/all'));
	}
	// Delete data end
	
	public function cektransportasi()
	{
		$this->db->where('category_id', 1);
		$query = $this->db->get('inv_datas')->result_array();
		echo "Alat Transportasi <br>";
		foreach($query as $row)
		{
			echo $row['color']."<br>";
		}
	}

	public function detailkategori()
	{
		$this->load->model('Inventory_model');
		$data = $this->Inventory_model->detailkategori(1);
		$data = array(
			'data' => $data,
		); 
		$this->load->view('inv_data/detailkategori', $data);
		
	}
	
	public function test()
	{
		$this->db->select_sum('jumlah');
		$this->db->where('kategori', 'Alat Komunikasi dan Informasi');
		$this->db->count_all();
		$query = $this->db->get('inventaris')->result_array();
		$total = 0;
		foreach($query as $row)
		{
			echo $row['jumlah'];
		}
	}
}

/* End of Inventory.php */
