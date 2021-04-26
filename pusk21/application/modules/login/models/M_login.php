<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_login extends CI_Model
{

    public function auth($nama, $sandi)
    {
        $data = $this->db->get_where("tb_user", ["kode_pusk" => $nama, "sandi" => $sandi])->row();

        return $data;
    }
}

/* End of file M_login.php */
