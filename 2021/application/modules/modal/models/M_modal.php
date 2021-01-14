<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_modal extends CI_Model
{

    public function get_kegiatan_by_id($id)
    {
        $data = $this->db->get_where("tb_kegiatan", ["id_kegiatan" => $id])->row();

        return $data;
    }

    public function get_sub_kegiatan_by_id($id)
    {
        $data = $this->db->get_where("tb_sub_kegiatan", ["id_sub_kegiatan" => $id])->row();

        return $data;
    }

    public function get_rekening_by_id($id)
    {
        $data = $this->db->get_where("tb_rekening", ["id_rekening" => $id])->row();

        return $data;
    }

    public function get_user_by_id($id)
    {
        $data = $this->db->get_where("tb_user", ["id_user" => $id])->row();

        return $data;
    }

    public function get_bidang_by_id($id)
    {
        $data = $this->db->get_where("tb_bidang", ["id_bidang" => $id])->row();

        return $data;
    }

    public function get_pegawai_by_id($id)
    {
        $data = $this->db->get_where("tb_pegawai", ["id_pegawai" => $id])->row();

        return $data;
    }

    public function get_pengaturan_by_id($id)
    {
        $data = $this->db->get_where("tb_pengaturan", ["id_pengaturan" => $id])->row();

        return $data;
    }

    public function get_rok_by_id($id)
    {
        $data = $this->db->get_where("tb_rok", ["id_rok" => $id])->row();

        return $data;
    }

    public function get_seksi()
    {
        $data = $this->db->get_where("tb_user", ["kode_seksi != " => "XXXX"])->result();

        return $data;
    }

    public function get_pegawai()
    {
        $data = $this->db->get_where("tb_pegawai", ["status_pegawai" => 1, "aktif" => 1])->result();

        return $data;
    }

    public function get_semua_pegawai()
    {
        $data = $this->db->get_where("tb_pegawai", ["aktif" => 1])->result();

        return $data;
    }

    public function get_bidang()
    {
        $data = $this->db->get("tb_bidang")->result();

        return $data;
    }

    public function get_rekening_master()
    {
        $data = $this->db->get("tb_rekening_master")->result();

        return $data;
    }

    public function get_rekening($id_sub)
    {
        $data = $this->db->get_where("tb_rekening", ["id_sub_kegiatan" => $id_sub])->result();

        return $data;
    }
}

/* End of file M_modal.php */
