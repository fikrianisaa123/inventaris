<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Excel_model extends CI_Model
{
    public function data_inventory()
    {
        $this->db->order_by('kode', 'ASC');
        return $this->db->get('inventaris')->result_array();
    }
}