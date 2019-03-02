<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

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
				'Jumlah_model',
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
		$this->data['dummy'] = "";
	}

	public function index()
	{
		$data1 = $this->Jumlah_model->jumlah_inventory();
		$data2 = $this->Jumlah_model->jumlah_kategori();
		$data = array(
			'jumlahinventory' => $data1,
			'jumlahkategori' => $data2,
		);
		// $this->data['summary']         = $this->inventory_model->get_inventory_by_category_summary();
		// print_r($this->data['summary']->result());

		$this->load->view('partials/_alte_header', $this->data);
		$this->load->view('partials/_alte_menu');
		$this->load->view('welcome/welcome_message', $data);
		$this->load->view('partials/_alte_footer');
		$this->load->view('welcome/js');
	}
}
