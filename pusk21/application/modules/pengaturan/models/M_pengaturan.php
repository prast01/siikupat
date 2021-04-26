<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_pengaturan extends CI_Model
{

    public function get_all_user()
    {
        $data = $this->db->get_where("tb_user", ["kode_pusk !=" => "super"])->result();

        return $data;
    }

    // CRUD
    public function save($post)
    {
        if ($post["kode_pusk"] == "") {
            return array("res" => 0, "msg" => "Kode Puskesmas harus diisi.");
        }

        if ($post["nama"] == "") {
            return array("res" => 0, "msg" => "Nama Puskesmas harus diisi.");
        }

        if ($post["nama_kepala"] == "") {
            return array("res" => 0, "msg" => "Nama Kepala Puskesmas harus diisi.");
        }

        if ($post["nip_kepala"] == "") {
            return array("res" => 0, "msg" => "NIP Kepala Puskesmas harus diisi.");
        }

        $data = array(
            "kode_pusk" => $post["kode_pusk"],
            "nama" => ucwords($post["nama"]),
            "nama_kepala" => $post["nama_kepala"],
            "nip_kepala" => $post["nip_kepala"],
            "sandi" => "123",
        );

        $hsl = $this->db->insert("tb_user", $data);
        if ($hsl) {
            return array("res" => 1, "msg" => "Data Berhasil Disimpan.");
        } else {
            return array("res" => 0, "msg" => "Data Gagal Disimpan.");
        }
    }

    public function edit($post, $id_data)
    {
        if ($post["nama_data"] == "") {
            return array("res" => 0, "msg" => "Nama Data harus diisi.");
        }

        if ($post["alias"] == "") {
            return array("res" => 0, "msg" => "Nama Alias harus diisi.");
        }

        $where = array(
            "id_data" => $id_data
        );

        $data = array(
            "nama_data" => $post["nama_data"],
            "alias" => $post["alias"],
        );

        $hsl = $this->db->update("tb_data", $data, $where);
        if ($hsl) {
            return array("res" => 1, "msg" => "Data Berhasil Disimpan.");
        } else {
            return array("res" => 1, "msg" => "Data Gagal Disimpan.");
        }
    }

    public function hapus($id_data)
    {
        $where = array(
            "id_data" => $id_data
        );

        $hsl = $this->db->delete("tb_data", $where);
        if ($hsl) {
            return array("res" => 1, "msg" => "Data Berhasil Dihapus.");
        } else {
            return array("res" => 1, "msg" => "Data Gagal Dihapus.");
        }
    }
}

/* End of file M_pengaturan.php */
