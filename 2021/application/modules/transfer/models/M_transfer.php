<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_transfer extends CI_Model
{


    public function get_spj()
    {
        $this->db->order_by("tgl_daftar", "DESC");
        $data = $this->db->get_where("tb_spj", ["status_spj" => 2])->result();

        // sprintf("%05s", $id)
        $no = 0;
        $hsl = array();
        foreach ($data as $row) {
            if ($row->status_spj == "1") {
                $nama_status = "BARU";
                $tgl = $row->tgl_daftar;
            } elseif ($row->status_spj == "2") {
                $nama_status = "ACC";
                $tgl = $row->tgl_acc;
            } elseif ($row->status_spj == "3") {
                $nama_status = "REVISI";
                $tgl = $row->tgl_tolak;
            } elseif ($row->status_spj == "4") {
                $nama_status = "TRANSFER";
                $tgl = $row->tgl_transfer;
            }

            if ($row->jenis_spj == "0") {
                $jenis = "GU";
            } else {
                $jenis = "LS";
            }


            $hsl[$no++] = array(
                "no_spj" => $jenis . sprintf("%05s", $row->id_spj),
                "kode_spj" => $row->kode_spj,
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

    public function save($kode_spj)
    {
        $tgl = date("Y-m-d H:i:s");
        $where = array(
            "kode_spj" => $kode_spj
        );

        $data = array(
            "tgl_transfer" => $tgl,
            "status_spj" => 4,
        );

        $data_riwayat = array(
            "kode_spj" => $kode_spj,
            "tgl_riwayat" => $tgl,
            "status_spj" => 2,
            "riwayat_spj" => "Transfer",
        );

        $hasil = $this->db->update("tb_spj", $data, $where);
        if ($hasil) {
            $this->db->insert("tb_riwayat_spj", $data_riwayat);

            return array("res" => 1, "msg" => "Transfer Berhasil");
        } else {
            return array("res" => 0, "msg" => "Transfer Gagal");
        }
    }
}

/* End of file M_transfer.php */