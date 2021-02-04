<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_up extends CI_Model
{

    public function get_up()
    {
        $this->db->order_by("tgl_up", "DESC");
        $data = $this->db->get("tb_up")->result();

        return $data;
    }

    // CRUD
    public function save($post)
    {
        $data = array(
            "tgl_up" => $post["tgl_up"],
            "nominal" => $post["nominal"],
        );

        if ($post["tgl_up"] == "") {
            return array("res" => 0, "msg" => "Tanggal Pengajuan UP harus diisi");
        }

        if ($post["nominal"] == "" || $post["nominal"] == 0) {
            return array("res" => 0, "msg" => "Nominal harus diisi");
        }

        $data_up = array(
            "aktif" => 0
        );

        $where_up = array(
            "aktif" => 1
        );

        $ubah = $this->db->update("tb_up", $data_up, $where_up);
        if ($ubah) {
            $hasil = $this->db->insert("tb_up", $data);
            if ($hasil) {
                return array("res" => 1, "msg" => "UP berhasil ditambahkan");
            } else {
                return array("res" => 0, "msg" => "UP Gagal ditambahkan");
            }
        } else {
            return array("res" => 0, "msg" => "Gagal Update Status UP");
        }
    }

    public function edit($id_up, $post)
    {
        $where = array(
            "id_up" => $id_up
        );
        $data = array(
            "tgl_up" => $post["tgl_up"],
            "nominal" => $post["nominal"],
        );

        if ($post["tgl_up"] == "") {
            return array("res" => 0, "msg" => "Tanggal Pengajuan UP harus diisi");
        }

        if ($post["nominal"] == "" || $post["nominal"] == 0) {
            return array("res" => 0, "msg" => "Nominal harus diisi");
        }

        $hasil = $this->db->update("tb_up", $data, $where);
        if ($hasil) {
            return array("res" => 1, "msg" => "UP berhasil diubah");
        } else {
            return array("res" => 0, "msg" => "UP Gagal diubah");
        }
    }
}

/* End of file M_up.php */
