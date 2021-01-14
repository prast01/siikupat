<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_bidang extends CI_Model
{

    public function get_bidang()
    {
        $this->db->select("*");
        $this->db->from("tb_bidang");
        $this->db->join("tb_pegawai", "tb_bidang.nip_kepala = tb_pegawai.nip_pegawai");

        $data = $this->db->get()->result();

        return $data;
    }
}

/* End of file M_bidang.php */
