<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_pendapatan extends CI_Model
{

    public function get_jenis_pendapatan_def()
    {
        $kode_pusk = $this->session->userdata("kode_pusk");
        $data = $this->db->get_where("tb_jenis_pendapatan", ["baru" => 0])->result();

        $no = 0;
        $hsl = array();
        foreach ($data as $key) {
            $hsl[$no++] = array(
                "id_jenis_pendapatan" => $key->id_jenis_pendapatan,
                "jenis_pendapatan" => $key->jenis_pendapatan,
                "pagu_pendapatan" => $this->_get_pagu_pendapatan($key->id_jenis_pendapatan, $kode_pusk),
            );
        }

        return $hsl;
    }

    public function get_jenis_pendapatan_pusk($kode_pusk)
    {
        $data = $this->db->get_where("tb_jenis_pendapatan", ["baru" => 1, "kode_pusk" => $kode_pusk])->result();

        $no = 0;
        $hsl = array();
        foreach ($data as $key) {
            $hsl[$no++] = array(
                "id_jenis_pendapatan" => $key->id_jenis_pendapatan,
                "jenis_pendapatan" => $key->jenis_pendapatan,
                "pagu_pendapatan" => $this->_get_pagu_pendapatan($key->id_jenis_pendapatan, $kode_pusk),
            );
        }

        return $hsl;
    }

    public function get_realisasi($kode_pusk)
    {
        $bulan = array(
            "01" => "Januari",
            "02" => "Februari",
            "03" => "Maret",
            "04" => "April",
            "05" => "Mei",
            "06" => "Juni",
            "07" => "Juli",
            "08" => "Agustus",
            "09" => "September",
            "10" => "Oktober",
            "11" => "November",
            "12" => "Desember"
        );

        $no = 0;
        $hsl = array();

        foreach ($bulan as $key => $val) {
            $real = $this->_get_realisasi($kode_pusk, $key);
            if ($real != "") {
                $hsl[$no++] = array(
                    "kode_bulan" => $key,
                    "bulan" => $val,
                    "realisasi" => $real,
                );
            }
        }

        return $hsl;
    }

    // CRUD
    public function save($post, $kode_pusk)
    {
        if ($post["jenis_pendapatan"] == "") {
            return array("res" => 0, "msg" => "Jenis Pendapatan harus diisi.");
        }

        $data = array(
            "kode_pusk" => $kode_pusk,
            "jenis_pendapatan" => $post["jenis_pendapatan"],
            "baru" => 1,
        );

        $hsl = $this->db->insert("tb_jenis_pendapatan", $data);
        if ($hsl) {
            return array("res" => 1, "msg" => "Data Berhasil Disimpan.");
        } else {
            return array("res" => 0, "msg" => "Data Gagal Disimpan.");
        }
    }

    public function edit($post, $kode_pusk)
    {
        if ($post["jenis_pendapatan"] == "") {
            return array("res" => 0, "msg" => "Jenis Pendapatan harus diisi.");
        }

        $where = array(
            "kode_pusk" => $kode_pusk,
            "id_jenis_pendapatan" => $post["id_jenis_pendapatan"],
        );

        $data = array(
            "jenis_pendapatan" => $post["jenis_pendapatan"],
        );

        $hsl = $this->db->update("tb_jenis_pendapatan", $data, $where);
        if ($hsl) {
            return array("res" => 1, "msg" => "Data Berhasil Disimpan.");
        } else {
            return array("res" => 0, "msg" => "Data Gagal Disimpan.");
        }
    }

    public function hapus($id_jenis_pendapatan, $kode_pusk)
    {
        $where = array(
            "id_jenis_pendapatan" => $id_jenis_pendapatan,
            "kode_pusk" => $kode_pusk,
        );

        $hsl = $this->db->delete("tb_jenis_pendapatan", $where);
        if ($hsl) {
            $this->db->delete("tb_pagu_pendapatan", $where);
            return array("res" => 1, "msg" => "Data Berhasil Dihapus.");
        } else {
            return array("res" => 1, "msg" => "Data Gagal Dihapus.");
        }
    }

    public function savePagu($post)
    {
        $jml = count($post["id_jenis_pendapatan"]);

        $data = $this->db->get_where("tb_pagu_pendapatan", ["kode_pusk" => $post["kode_pusk"]])->num_rows();
        if ($data > 0) {
            $this->db->delete("tb_pagu_pendapatan", ["kode_pusk" => $post["kode_pusk"]]);
        }

        for ($i = 0; $i < $jml; $i++) {
            $datax = array(
                "kode_pusk" => $post["kode_pusk"],
                "id_jenis_pendapatan" => $post["id_jenis_pendapatan"][$i],
                "pagu_pendapatan" => $post["pagu_pendapatan"][$i],
            );

            $this->db->insert("tb_pagu_pendapatan", $datax);
        }

        return array("res" => 1, "msg" => "Data Berhasil Disimpan.");
    }

    public function savePendapatan($post, $kode_pusk)
    {
        $jml = count($post["id_jenis_pendapatan"]);

        $cek = $this->_cek_pendapatan($kode_pusk, $post["bulan"]);

        if ($cek) {
            for ($i = 0; $i < $jml; $i++) {
                $datax = array(
                    "kode_pusk" => $kode_pusk,
                    "bulan" => $post["bulan"],
                    "id_jenis_pendapatan" => $post["id_jenis_pendapatan"][$i],
                    "real_pendapatan" => $post["real_pendapatan"][$i],
                );

                $this->db->insert("tb_real_pendapatan", $datax);
            }

            return array("res" => 1, "msg" => "Data Berhasil Disimpan.");
        } else {
            return array("res" => 0, "msg" => "Realisasi bulan yang dipilih sudah terdaftar.");
        }
    }

    public function editPendapatan($post, $kode_pusk)
    {
        $jml = count($post["id_realisasi"]);

        for ($i = 0; $i < $jml; $i++) {
            $where = array(
                "kode_pusk" => $kode_pusk,
                "id_real_pendapatan" => $post["id_realisasi"][$i],
            );
            $datax = array(
                "real_pendapatan" => $post["real_pendapatan"][$i],
            );

            $this->db->update("tb_real_pendapatan", $datax, $where);
        }

        return array("res" => 1, "msg" => "Data Berhasil Disimpan.");
    }

    public function hapusPendapatan($kode_pusk, $bulan)
    {
        $where = array(
            "bulan" => $bulan,
            "kode_pusk" => $kode_pusk,
        );

        $hsl = $this->db->delete("tb_real_pendapatan", $where);
        if ($hsl) {
            return array("res" => 1, "msg" => "Data Berhasil Dihapus.");
        } else {
            return array("res" => 1, "msg" => "Data Gagal Dihapus.");
        }
    }

    // PRIVATE
    private function _get_pagu_pendapatan($id_jenis_pendapatan, $kode_pusk)
    {
        $data = $this->db->get_where("tb_pagu_pendapatan", ["id_jenis_pendapatan" => $id_jenis_pendapatan, "kode_pusk" => $kode_pusk]);

        if ($data->num_rows() > 0) {
            $x = $data->row();

            return $x->pagu_pendapatan;
        } else {
            return 0;
        }
    }

    private function _get_realisasi($kode_pusk, $bulan)
    {
        $data = $this->db->query("SELECT SUM(real_pendapatan) as total FROM tb_real_pendapatan WHERE kode_pusk='$kode_pusk' AND bulan='$bulan'")->row();

        return $data->total;
    }

    private function _cek_pendapatan($kode_pusk, $kode_bulan)
    {
        $data = $this->db->get_where("tb_real_pendapatan", ["kode_pusk" => $kode_pusk, "bulan" => $kode_bulan])->num_rows();

        if ($data > 0) {
            return 0;
        } else {
            return 1;
        }
    }
}

/* End of file M_pendapatan.php */
