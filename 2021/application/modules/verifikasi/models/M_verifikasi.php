<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_verifikasi extends CI_Model
{

    public function get_spj($kode_bidang, $st)
    {
        $this->db->from("view_spj_verif_bidang");
        $this->db->where("kode_bidang", $kode_bidang);

        if ($st == 1) {
            $this->db->where("status_spj <=", 2);
        } elseif ($st == 2) {
            $this->db->where("status_spj", 3);
        }

        $this->db->where("status_verif", 0);
        $this->db->order_by("nomor_spj", "ASC");
        if ($st == 1) {
            $this->db->limit(1);
        }
        $data = $this->db->get()->result();

        // sprintf("%05s", $id)
        $no = 0;
        $hsl = array();
        foreach ($data as $row) {
            if ($row->status_spj == "1") {
                $nama_status = "BARU";
                $tgl = $row->tgl_daftar;
            } elseif ($row->status_spj == "2") {
                $nama_status = "REVISI";
                $tgl = $row->tgl_tolak;
            } elseif ($row->status_spj == "3") {
                $nama_status = "ACC";
                $tgl = $row->tgl_acc;
            } elseif ($row->status_spj == "5") {
                $nama_status = "DIBUKUKAN";
                $tgl = $row->tgl_buku;
            } elseif ($row->status_spj == "4") {
                $nama_status = "TRANSFER";
                $tgl = $row->tgl_transfer;
            }

            if ($row->jenis_spj == "0") {
                $jenis = "GU";
            } else {
                $jenis = "LS";
            }

            if ($row->kode_bidang == "DK001") {
                $bd = "1-";
            } elseif ($row->kode_bidang == "DK002") {
                $bd = "2-";
            } elseif ($row->kode_bidang == "DK003") {
                $bd = "3-";
            } elseif ($row->kode_bidang == "DK004") {
                $bd = "4-";
            }

            $hsl[$no++] = array(
                "no_spj" => $jenis . sprintf("%05s", $row->id_spj),
                "no_seksi" => $bd . $jenis . sprintf("%05s", $row->nomor_spj),
                "kode_spj" => $row->kode_spj,
                "tgl_kegiatan" => $row->tgl_kegiatan,
                "uraian" => $row->uraian,
                "nominal" => number_format($row->nominal, 0, ",", "."),
                "pelaksana" => $this->get_pelaksana($row->kode_spj),
                "status_spj" => $row->status_spj,
                "nama_status" => $nama_status,
                "tanggal" => $tgl,
                "verif_spj" => $row->verif_spj,
            );
        }

        return $hsl;
    }

    public function get_pelaksana($kode_spj)
    {
        $data = $this->db->get_where("view_spj_rekening", ["kode_spj" => $kode_spj])->result();

        return $data;
    }

    public function get_spj_by_kode($kode_spj)
    {
        $data = $this->db->get_where("tb_spj", ["kode_spj" => $kode_spj])->row();

        return $data;
    }

    public function get_sub_kegiatan_by_id($id_sub_kegiatan)
    {
        $data = $this->db->get_where("tb_sub_kegiatan", ["id_sub_kegiatan" => $id_sub_kegiatan])->row();

        return $data;
    }

    public function get_rekening_by_id($id_rekening)
    {
        $data = $this->db->get_where("tb_rekening", ["id_rekening" => $id_rekening])->row();

        return $data;
    }

    public function get_rok_by_id($id_rok)
    {
        $data = $this->db->get_where("tb_rok", ["id_rok" => $id_rok])->row();

        return $data;
    }

    public function get_verif_by_kode($kode_spj)
    {
        $data = $this->db->get_where("tb_riwayat_spj", ["kode_spj" => $kode_spj])->result();

        return $data;
    }


    // CRUD
    public function save($kode_spj, $post, $status)
    {
        $tgl = date("Y-m-d H:i:s");
        $where = array(
            "kode_spj" => $kode_spj
        );

        $data = array(
            "kode_spj" => $kode_spj,
            "status_spj" => $status,
            "tgl_riwayat" => $tgl,
            "riwayat_spj" => $post["verif_spj"],
        );

        if ($status == 1) {
            $data_spj = array(
                "tgl_acc" => $tgl,
                "status_spj" => 3,
                "status_verif" => 0,
                "verif_spj" => $post["verif_spj"],
            );
        } else {
            $data_spj = array(
                "tgl_tolak" => $tgl,
                "status_spj" => 2,
                "status_verif" => 1,
                "verif_spj" => $post["verif_spj"],
            );
        }

        if ($post["verif_spj"] == "") {
            return array("res" => 0, "msg" => "Hasil verifikasi harus terisi");
        }


        $hasil = $this->db->insert('tb_riwayat_spj', $data);
        if ($hasil) {
            $this->_update_spj($data_spj, $where);
            return array("res" => 1, "msg" => "SPJ Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "SPJ Gagal Disimpan");
        }
    }

    public function save_buku($kode_spj, $post)
    {
        $tgl = date("Y-m-d H:i:s");
        $where = array(
            "kode_spj" => $kode_spj
        );

        $data_spj = array(
            "tgl_buku" => $tgl,
            "status_spj" => 5,
        );

        if ($post["ppn"] == "") {
            return array("res" => 0, "msg" => "PPN harus terisi");
        }

        if ($post["pph21"] == "") {
            return array("res" => 0, "msg" => "PPh Ps. 21 harus terisi");
        }

        if ($post["pph22"] == "") {
            return array("res" => 0, "msg" => "PPh Ps. 22 harus terisi");
        }

        if ($post["pph23"] == "") {
            return array("res" => 0, "msg" => "PPh Ps. 23 harus terisi");
        }

        if ($post["pph_final"] == "") {
            return array("res" => 0, "msg" => "PPh Final harus terisi");
        }

        $data = array(
            "kode_spj" => $kode_spj,
            "tgl_buku" => $tgl,
            "uraian" => $post["uraian"],
            "nominal" => $post["nominal"],
            "ppn" => $post["ppn"],
            "pph21" => $post["pph21"],
            "pph22" => $post["pph22"],
            "pph23" => $post["pph23"],
            "pph_final" => $post["pph_final"],
        );


        $hasil = $this->db->insert("tb_buku", $data);
        if ($hasil) {
            $this->_update_spj($data_spj, $where);
            return array("res" => 1, "msg" => "SPJ Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "SPJ Gagal Disimpan");
        }
    }

    private function _update_spj($data, $where)
    {
        $this->db->update("tb_spj", $data, $where);
    }
}

/* End of file M_verifikasi.php */
