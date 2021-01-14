<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_login extends CI_Model
{

    public function cari($term)
    {
        $this->db->select("nama");
        $this->db->from("tb_user");
        $this->db->where("kode_seksi != ", "XXXX");
        $this->db->like("nama", $term);

        $data = $this->db->get()->result();

        return $data;
    }

    public function auth($nama, $sandi)
    {
        $data = $this->db->get_where("tb_user", ["nama" => $nama, "sandi" => $sandi])->row();

        return $data;
    }
}

/* End of file M_login.php */
