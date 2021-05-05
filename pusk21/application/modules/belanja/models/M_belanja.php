<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_belanja extends CI_Model
{

    public function get_belanja($bulan, $jenis)
    {
        $kode_pusk = $this->session->userdata("id_user_pusk");
        $this->db->from('tb_belanja');
        $this->db->where("jenis_belanja", $jenis);
        $this->db->where("kode_pusk", $kode_pusk);
        if ($bulan != "all") {
            $this->db->where("MONTH(tgl_belanja)", $bulan);
        }

        $data = $this->db->get()->result();

        return $data;
    }
}

/* End of file M_belanja.php */
