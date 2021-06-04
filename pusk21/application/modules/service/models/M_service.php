<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_service extends CI_Model
{

    public function get_rekening_master($search)
    {
        $this->db->select("*");
        $this->db->from("tb_rekening_master");
        $this->db->like("kode_rekening", $search);
        $this->db->or_like("nama_rekening", $search);
        $data = $this->db->get()->result();

        return $data;
    }

    public function get_rekening($id_sub_kegiatan)
    {
        $this->db->select("*");
        $this->db->from("tb_rekening");
        $this->db->where("id_sub_kegiatan", $id_sub_kegiatan);

        $data = $this->db->get()->result();

        return $data;
    }
}

/* End of file M_service.php */
