<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_user extends CI_Model
{

    public function get_user()
    {
        $this->db->select("*");
        $this->db->from("tb_user");
        $this->db->join("tb_pegawai", "tb_user.nip_kepala = tb_pegawai.nip_pegawai");
        $this->db->where("kode_seksi !=", "XXXX");
        $this->db->order_by('kesempatan', 'desc');

        $data = $this->db->get()->result();

        return $data;
    }

    public function update($id, $post)
    {
        $where = array(
            "id_user" => $id,
        );

        $data = array(
            "kode_bidang" => $post["kode_bidang"],
            "nama" => $post["nama"],
            "nip_kepala" => $post["nip_kepala"],
        );

        if ($post['nama'] == "") {
            return array("res" => 0, "msg" => "Nama Subbag/Seksi/UPT Harus Terisi");
        }
        if ($post['nip_kepala'] == "") {
            return array("res" => 0, "msg" => "Kepala Subbag/Seksi/UPT Harus Dipilih");
        }

        $hasil = $this->db->update('tb_user', $data, $where);

        if ($hasil) {
            return array("res" => 1, "msg" => "User Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "User Gagal Disimpan");
        }
    }

    public function updateBidang($id, $post)
    {
        $where = array(
            "id_bidang" => $id,
        );

        $data = array(
            "nama_bidang" => $post["nama_bidang"],
            "nip_kepala" => $post["nip_kepala"],
        );

        if ($post['nama_bidang'] == "") {
            return array("res" => 0, "msg" => "Nama Bidang Harus Terisi");
        }
        if ($post['nip_kepala'] == "") {
            return array("res" => 0, "msg" => "Kepala Bidang Harus Dipilih");
        }

        $hasil = $this->db->update('tb_bidang', $data, $where);

        if ($hasil) {
            return array("res" => 1, "msg" => "Bidang Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "Bidang Gagal Disimpan");
        }
    }

    public function kesempatan($id, $post)
    {
        $where = array(
            "id_user" => $id,
        );

        $data = array(
            "kesempatan" => $post["kesempatan"],
        );

        if ($post['kesempatan'] == "") {
            return array("res" => 0, "msg" => "Kesempatan Harus Terisi");
        }

        $hasil = $this->db->update('tb_user', $data, $where);

        if ($hasil) {
            return array("res" => 1, "msg" => "Kesempatan Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "Kesempatan Gagal Disimpan");
        }
    }

    public function reset($id, $post)
    {
        $where = array(
            "id_user" => $id,
        );

        $data = array(
            "sandi" => $post["sandi2"],
        );

        if ($post['sandi'] != $post['sandi2']) {
            return array("res" => 0, "msg" => "Ulangi Sandi Salah !");
        }

        $hasil = $this->db->update('tb_user', $data, $where);

        if ($hasil) {
            return array("res" => 1, "msg" => "Ubah Kata Sandi Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "Ubah Kata Sandi Gagal Disimpan");
        }
    }
}

/* End of file M_user.php */
