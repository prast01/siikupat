<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_modal extends CI_Model
{

    public function get_user_by_id($id_user)
    {
        $data = $this->db->get_where("tb_user", ["id_user" => $id_user])->row();

        return $data;
    }

    public function get_sub_kegiatan_by_id($kode_pusk, $id_sub_kegiatan)
    {
        $data = $this->db->get_where("tb_sub_kegiatan", ["kode_pusk" => $kode_pusk, "id_sub_kegiatan" => $id_sub_kegiatan])->row();

        return $data;
    }

    public function get_rekening_by_id($id_rekening)
    {
        $data = $this->db->get_where("tb_rekening", ["id_rekening" => $id_rekening])->row();

        return $data;
    }

    public function get_jenis_pendapatan_by_id($id_jenis_pendapatan)
    {
        $data = $this->db->get_where("tb_jenis_pendapatan", ["id_jenis_pendapatan" => $id_jenis_pendapatan])->row();

        return $data;
    }

    public function get_jenis_pendapatan($kode_pusk)
    {
        $data = $this->db->get_where("tb_jenis_pendapatan", ["baru" => 0])->result();

        $no = 0;
        $hsl = array();
        foreach ($data as $key) {
            $real = $this->_get_realisasi($kode_pusk, $key->id_jenis_pendapatan);
            $hsl[$no++] = array(
                "id_jenis_pendapatan" => $key->id_jenis_pendapatan,
                "jenis_pendapatan" => $key->jenis_pendapatan,
                "id_realisasi" => $real["id_realisasi"],
                "realisasi" => $real["realisasi"],
            );
        }

        $data2 = $this->db->get_where("tb_jenis_pendapatan", ["baru" => 1, "kode_pusk" => $kode_pusk])->result();
        foreach ($data2 as $key) {
            $real = $this->_get_realisasi($kode_pusk, $key->id_jenis_pendapatan);
            $hsl[$no++] = array(
                "id_jenis_pendapatan" => $key->id_jenis_pendapatan,
                "jenis_pendapatan" => $key->jenis_pendapatan,
                "id_realisasi" => $real["id_realisasi"],
                "realisasi" => $real["realisasi"],
            );
        }

        return $hsl;
    }

    // PRIVATE
    private function _get_realisasi($kode_pusk, $id_jenis_pendapatan)
    {
        $data = $this->db->get_where("tb_real_pendapatan", ["kode_pusk" => $kode_pusk, "id_jenis_pendapatan" => $id_jenis_pendapatan]);

        if ($data->num_rows() > 0) {
            $x = $data->row();

            return array("id_realisasi" => $x->id_real_pendapatan, "realisasi" => $x->real_pendapatan);
        } else {
            return array("id_realisasi" => 0, "realisasi" => 0);
        }
    }
}

/* End of file M_modal.php */
