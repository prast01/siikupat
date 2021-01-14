<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_pegawai extends CI_Model
{

    public function get_pegawai()
    {
        $data = $this->db->get("tb_pegawai")->result();

        return $data;
    }

    public function save($post)
    {
        $data = array(
            "status_pegawai" => $post["status_pegawai"],
            "nip_pegawai" => $post["nip_pegawai"],
            "nama_pegawai" => $post["nama_pegawai"],
        );

        if ($post['status_pegawai'] == "") {
            return array("res" => 0, "msg" => "Status Pegawai Harus Terisi");
        }
        if ($post['nip_pegawai'] == "") {
            return array("res" => 0, "msg" => "NIP/Kode Pegawai Non ASN Harus Terisi");
        }
        if ($post['nama_pegawai'] == "") {
            return array("res" => 0, "msg" => "Nama Pegawai Harus Terisi");
        }

        $cek = $this->cek_nip($post['nip_pegawai']);
        if ($cek) {
            return array("res" => 0, "msg" => "NIP atau Nomor Pegawai Non ASN sudah ada !");
        }

        $hasil = $this->db->insert('tb_pegawai', $data);

        if ($hasil) {
            return array("res" => 1, "msg" => "Pegawai Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "Pegawai Gagal Disimpan");
        }
    }

    public function update($id, $post)
    {
        $where = array(
            "id_pegawai" => $id,
        );
        $data = array(
            "status_pegawai" => $post["status_pegawai"],
            "nip_pegawai" => $post["nip_pegawai"],
            "nama_pegawai" => $post["nama_pegawai"],
        );

        if ($post['status_pegawai'] == "") {
            return array("res" => 0, "msg" => "Status Pegawai Harus Terisi");
        }
        if ($post['nip_pegawai'] == "") {
            return array("res" => 0, "msg" => "NIP/Kode Pegawai Non ASN Harus Terisi");
        }
        if ($post['nama_pegawai'] == "") {
            return array("res" => 0, "msg" => "Nama Pegawai Harus Terisi");
        }

        $cek = $this->cek_nip($post['nip_pegawai']);
        if ($cek && $post["nip_pegawai"] != $post["nip_pegawai_lama"]) {
            return array("res" => 0, "msg" => "NIP atau Nomor Pegawai Non ASN sudah ada !");
        }

        $hasil = $this->db->update('tb_pegawai', $data, $where);

        if ($hasil) {
            return array("res" => 1, "msg" => "Pegawai Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "Pegawai Gagal Disimpan");
        }
    }

    public function statusPegawai($id, $post)
    {
        $where = array(
            "id_pegawai" => $id,
        );
        $data = array(
            "aktif" => $post["aktif"],
        );

        $hasil = $this->db->update('tb_pegawai', $data, $where);

        if ($hasil) {
            return array("res" => 1, "msg" => "Pegawai Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "Pegawai Gagal Disimpan");
        }
    }

    public function delete($id)
    {
        $where = array(
            "id_pegawai" => $id,
        );

        // $cek = $this->cek_pegawai($id);
        // if ($cek) {
        //     return array("res" => 0, "msg" => "Kode Pegawai Sudah Digunakan pada pendaftaran SPJ ! Hubungi Admin SI KUPAT untuk NON AKTIFKAN Pegawai");
        // }

        $hasil = $this->db->delete('tb_pegawai', $where);

        if ($hasil) {
            return array("res" => 1, "msg" => "Pegawai Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "Pegawai Gagal Disimpan");
        }
    }

    private function cek_nip($nip)
    {
        $data = $this->db->get_where("tb_pegawai", ["nip_pegawai" => $nip])->num_rows();

        if ($data > 0) {
            return 1;
        } else {
            return 0;
        }
    }
}

/* End of file M_pegawai.php */
