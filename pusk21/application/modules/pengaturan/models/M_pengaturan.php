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
            $pagu = $this->_get_pagu_pusk($key->kode_pusk);
            $hsl[$no++] = array(
                "id_user" => $key->id_user,
                "nama" => $key->nama,
                "kode_pusk" => $key->kode_pusk,
                "pagu" => number_format($pagu, 0, ",", ".")
            );
        }

        return $hsl;
    }

    public function get_sub_kegiatan_by_pusk($kode_pusk)
    {
        $this->db->order_by("kode_sub_kegiatan", "ASC");
        $data = $this->db->get_where("tb_sub_kegiatan", ["kode_pusk" => $kode_pusk])->result();

        $hsl = array();
        $no = 0;
        foreach ($data as $key) {
            $pagu = $this->_get_pagu_sub($key->id_sub_kegiatan);
            $hsl[$no++] = array(
                "id_sub_kegiatan" => $key->id_sub_kegiatan,
                "kode_sub_kegiatan" => $key->kode_sub_kegiatan,
                "nama_sub_kegiatan" => $key->nama_sub_kegiatan,
                "jenis_sumber" => $key->jenis_sumber,
                "kode_pusk" => $kode_pusk,
                "pagu" => number_format($pagu, 0, ",", ".")
            );
        }

        return $hsl;
    }

    public function get_rekening_by_pusk($id_sub_kegiatan)
    {
        $this->db->order_by("kode_rekening", "ASC");
        $data = $this->db->get_where("tb_rekening", ["id_sub_kegiatan" => $id_sub_kegiatan])->result();

        $hsl = array();
        $no = 0;
        foreach ($data as $key) {
            $hsl[$no++] = array(
                "id_sub_kegiatan" => $key->id_sub_kegiatan,
                "id_rekening" => $key->id_rekening,
                "kode_rekening" => $key->kode_rekening,
                "nama_rekening" => $key->nama_rekening,
                "pagu_rekening" => number_format($key->pagu_rekening, 0, ",", "."),
                "realisasi_rekening" => number_format($key->realisasi_rekening, 0, ",", "."),
            );
        }

        return $hsl;
    }

    // CRUD
    // USER
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

    // ANGGARAN
    public function saveSub($post, $kode_pusk)
    {
        if ($post["kode_sub_kegiatan"] == "") {
            return array("res" => 0, "msg" => "Kode Sub Kegiatan harus diisi.");
        }

        if ($post["nama_sub_kegiatan"] == "") {
            return array("res" => 0, "msg" => "Nama Sub Kegiatan harus diisi.");
        }

        if ($post["jenis_sumber"] == "") {
            return array("res" => 0, "msg" => "Jenis Sumber Sub Kegiatan harus diisi.");
        }

        $data = array(
            "kode_pusk" => $kode_pusk,
            "kode_sub_kegiatan" => $post["kode_sub_kegiatan"],
            "nama_sub_kegiatan" => $post["nama_sub_kegiatan"],
            "jenis_sumber" => $post["jenis_sumber"],
        );

        $hsl = $this->db->insert("tb_sub_kegiatan", $data);
        if ($hsl) {
            return array("res" => 1, "msg" => "Data Berhasil Disimpan.");
        } else {
            return array("res" => 0, "msg" => "Data Gagal Disimpan.");
        }
    }

    public function editSub($post)
    {
        if ($post["kode_sub_kegiatan"] == "") {
            return array("res" => 0, "msg" => "Kode Sub Kegiatan harus diisi.");
        }

        if ($post["nama_sub_kegiatan"] == "") {
            return array("res" => 0, "msg" => "Nama Sub Kegiatan harus diisi.");
        }

        if ($post["jenis_sumber"] == "") {
            return array("res" => 0, "msg" => "Jenis Sumber Sub Kegiatan harus diisi.");
        }

        $where = array(
            "id_sub_kegiatan" => $post["id_sub_kegiatan"],
        );

        $data = array(
            "kode_sub_kegiatan" => $post["kode_sub_kegiatan"],
            "nama_sub_kegiatan" => $post["nama_sub_kegiatan"],
            "jenis_sumber" => $post["jenis_sumber"],
        );

        $hsl = $this->db->update("tb_sub_kegiatan", $data, $where);
        if ($hsl) {
            return array("res" => 1, "msg" => "Data Berhasil Disimpan.");
        } else {
            return array("res" => 0, "msg" => "Data Gagal Disimpan.");
        }
    }

    public function hapusSub($id_sub_kegiatan)
    {
        $where = array(
            "id_sub_kegiatan" => $id_sub_kegiatan
        );

        $hsl = $this->db->delete("tb_sub_kegiatan", $where);
        if ($hsl) {
            return array("res" => 1, "msg" => "Data Berhasil Dihapus.");
        } else {
            return array("res" => 1, "msg" => "Data Gagal Dihapus.");
        }
    }

    public function saveRek($post)
    {
        if ($post["kode_rekening"] == "") {
            return array("res" => 0, "msg" => "Kode Rekening harus diisi.");
        }

        if ($post["nama_rekening"] == "") {
            return array("res" => 0, "msg" => "Nama Rekening harus diisi.");
        }

        if ($post["pagu_rekening"] == "") {
            return array("res" => 0, "msg" => "Pagu Rekening harus diisi.");
        }

        if ($post["realisasi_rekening"] == "") {
            $real = 0;
        } else {
            $real = $post["realisasi_rekening"];
        }

        $data = array(
            "id_sub_kegiatan" => $post["id_sub_kegiatan"],
            "kode_rekening" => $post["kode_rekening"],
            "nama_rekening" => $post["nama_rekening"],
            "pagu_rekening" => $post["pagu_rekening"],
            "realisasi_rekening" => $real,
        );

        $hsl = $this->db->insert("tb_rekening", $data);
        if ($hsl) {
            return array("res" => 1, "msg" => "Data Berhasil Disimpan.");
        } else {
            return array("res" => 0, "msg" => "Data Gagal Disimpan.");
        }
    }

    public function editRek($post)
    {
        if ($post["kode_rekening"] == "") {
            return array("res" => 0, "msg" => "Kode Rekening harus diisi.");
        }

        if ($post["nama_rekening"] == "") {
            return array("res" => 0, "msg" => "Nama Rekening harus diisi.");
        }

        if ($post["pagu_rekening"] == "") {
            return array("res" => 0, "msg" => "Pagu Rekening harus diisi.");
        }

        $where = array(
            "id_rekening" => $post["id_rekening"],
        );
        $data = array(
            "kode_rekening" => $post["kode_rekening"],
            "nama_rekening" => $post["nama_rekening"],
            "pagu_rekening" => $post["pagu_rekening"],
            "realisasi_rekening" => $post["realisasi_rekening"],
        );

        $hsl = $this->db->update("tb_rekening", $data, $where);
        if ($hsl) {
            return array("res" => 1, "msg" => "Data Berhasil Disimpan.");
        } else {
            return array("res" => 0, "msg" => "Data Gagal Disimpan.");
        }
    }

    public function hapusRek($id_rekening)
    {
        $where = array(
            "id_rekening" => $id_rekening
        );

        $hsl = $this->db->delete("tb_rekening", $where);
        if ($hsl) {
            return array("res" => 1, "msg" => "Data Berhasil Dihapus.");
        } else {
            return array("res" => 1, "msg" => "Data Gagal Dihapus.");
        }
    }

    // PRIVATE
    private function _get_pagu_pusk($kode_pusk)
    {
        $data = $this->db->get_where("tb_sub_kegiatan", ["kode_pusk" => $kode_pusk])->result();

        $total = 0;
        foreach ($data as $key) {
            $x = $this->_get_pagu_sub($key->id_sub_kegiatan);

            $total = $total + $x;
        }

        return $total;
    }

    private function _get_pagu_sub($id_sub_kegiatan)
    {
        $data = $this->db->query("SELECT SUM(pagu_rekening) as pagu FROM tb_rekening WHERE id_sub_kegiatan='$id_sub_kegiatan'")->row();

        if ($data->pagu != "") {
            return $data->pagu;
        } else {
            return 0;
        }
    }

    private function _cek_realisasi($id_rekening)
    {
    }
}

/* End of file M_pengaturan.php */
