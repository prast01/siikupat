<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_login extends CI_Model
{

    public function auth($nama, $sandi)
    {
        $data = $this->db->get_where("tb_user", ["kode_pusk" => $nama, "sandi" => $sandi])->row();

        return $data;
    }

    // CRUD

    public function ubahSandi($post, $id_user)
    {
        if ($post["sandi"] != $post["sandi2"]) {
            return array("res" => 0, "msg" => "Sandi tidak sama.");
        }

        if ($post["sandi"] == "") {
            return array("res" => 0, "msg" => "Sandi Baru harus diisi.");
        }

        if ($post["sandi2"] == "") {
            return array("res" => 0, "msg" => "Ulangi Sandi Baru harus diisi.");
        }

        if ($post["sandi2"] == "123") {
            return array("res" => 0, "msg" => "Sandi tidak boleh '123'.");
        }

        $data = array(
            "sandi" => $post["sandi2"],
        );

        $where = array(
            "kode_pusk" => $id_user
        );

        $hsl = $this->db->update("tb_user", $data, $where);

        if ($hsl) {
            return array("res" => 1, "msg" => "Selamat Datang di Aplikasi Si Kupat - Dinas Kesehatan Kabupaten Jepara.");
        } else {
            return array("res" => 1, "msg" => "Data Gagal Disimpan.");
        }
    }
}

/* End of file M_login.php */
