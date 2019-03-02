<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Jumlah_model extends CI_Model {

    public function jumlah_inventory()
    {
        return $this->db->get('inventaris')->num_rows();
    }

    public function jumlah_kategori()
    {
        return $this->db->get('inv_categories')->num_rows();
    }
}



