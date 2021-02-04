<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_pembukuan extends CI_Model
{


    public function get_spj()
    {
        $this->db->order_by("tgl_daftar", "DESC");
        $data = $this->db->get_where("view_spj_verif_bidang", ["status_spj" => 5])->result();

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
            } elseif ($row->status_spj == "4") {
                $nama_status = "TRANSFER";
                $tgl = $row->tgl_transfer;
            } elseif ($row->status_spj == "5") {
                $nama_status = "DIBUKUKAN";
                $tgl = $row->tgl_buku;
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
                "tgl_kegiatan" => date("d-m-Y", strtotime($row->tgl_kegiatan)),
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

    public function get_buku_by_kode($kode_spj)
    {
        $data = $this->db->get_where("tb_buku", ["kode_spj" => $kode_spj])->row();

        return $data;
    }

    // CRUD
    public function save_buku($kode_spj, $post, $status)
    {
        $tgl = date("Y-m-d H:i:s");
        $where = array(
            "kode_spj" => $kode_spj
        );

        $data_spj = array(
            "tgl_transfer" => $tgl,
            "status_spj" => 4,
        );

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
            "ntpn_ppn" => $post["ntpn_ppn"],
            "ntpn_pph21" => $post["ntpn_pph21"],
            "ntpn_pph22" => $post["ntpn_pph22"],
            "ntpn_pph23" => $post["ntpn_pph23"],
            "ntpn_pph_final" => $post["ntpn_pph_final"],
            "bill_ppn" => $post["bill_ppn"],
            "bill_pph21" => $post["bill_pph21"],
            "bill_pph22" => $post["bill_pph22"],
            "bill_pph23" => $post["bill_pph23"],
            "bill_pph_final" => $post["bill_pph_final"],
        );


        if ($status) {
            $hasil = $this->db->insert("tb_buku", $data);
            if ($hasil) {
                $this->_update_spj($data_spj, $where);
                return array("res" => 1, "msg" => "SPJ Berhasil Disimpan");
            } else {
                return array("res" => 0, "msg" => "SPJ Gagal Disimpan");
            }
        } else {
            $data_spj = array(
                "tgl_tolak" => $tgl,
                "status_spj" => 2,
                "status_verif" => 1,
                "verif_spj" => $post["verif_spj"],
            );
            $data = array(
                "kode_spj" => $kode_spj,
                "status_spj" => $status,
                "tgl_riwayat" => $tgl,
                "riwayat_spj" => $post["verif_spj"],
            );

            $hasil = $this->db->insert('tb_riwayat_spj', $data);
            if ($hasil) {
                $this->_update_spj($data_spj, $where);
                return array("res" => 1, "msg" => "SPJ Berhasil Ditolak");
            } else {
                return array("res" => 0, "msg" => "SPJ Gagal Ditolak");
            }
        }
    }

    // PRIVATE
    private function _update_spj($data, $where)
    {
        $this->db->update("tb_spj", $data, $where);
    }
}

/* End of file M_transfer.php */
