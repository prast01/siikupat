<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_pembukuan extends CI_Model
{


    public function get_spj()
    {
        $this->db->order_by("tgl_daftar", "DESC");
        $data = $this->db->get_where("view_spj_verif_bidang", ["status_spj" => 4])->result();

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

    public function get_buku_by_kode($kode_spj)
    {
        $data = $this->db->get_where("tb_buku", ["kode_spj" => $kode_spj])->row();

        return $data;
    }
}

/* End of file M_transfer.php */
