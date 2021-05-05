<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_pengaturan extends CI_Model
{

    public function get_all_user()
    {
        $data = $this->db->get_where("tb_user", ["kode_pusk !=" => "super"])->result();

        return $data;
    }

    public function get_all_pusk()
    {
        $data = $this->db->get_where("tb_user", ["kode_pusk !=" => "super"])->result();

        $hsl = array();
        $no = 0;
        foreach ($data as $key) {
            $hsl[$no++] = array(
                "id_user" => $key->id_user,
                "nama" => $key->nama,
                "kode_pusk" => $key->kode_pusk,
                "pagu" => number_format(0, 0, ",", ".")
            );
        }

        return $hsl;
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

    public function edit($post, $id_user)
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
        );

        $where = array(
            "id_user" => $id_user
        );

        $hsl = $this->db->update("tb_user", $data, $where);
        if ($hsl) {
            return array("res" => 1, "msg" => "Data Berhasil Disimpan.");
        } else {
            return array("res" => 1, "msg" => "Data Gagal Disimpan.");
        }
    }

    public function ubahSandi($post, $id_user)
    {
        if ($post["sandi"] == "") {
            return array("res" => 0, "msg" => "Sandi Baru harus diisi.");
        }

        $data = array(
            "sandi" => $post["sandi"],
        );

        $where = array(
            "id_user" => $id_user
        );

        $hsl = $this->db->update("tb_user", $data, $where);
        if ($hsl) {
            return array("res" => 1, "msg" => "Data Berhasil Disimpan.");
        } else {
            return array("res" => 1, "msg" => "Data Gagal Disimpan.");
        }
    }

    public function hapus($id_user)
    {
        $where = array(
            "id_user" => $id_user
        );

        $hsl = $this->db->delete("tb_user", $where);
        if ($hsl) {
            return array("res" => 1, "msg" => "Data Berhasil Dihapus.");
        } else {
            return array("res" => 1, "msg" => "Data Gagal Dihapus.");
        }
    }
}

/* End of file M_pengaturan.php */
