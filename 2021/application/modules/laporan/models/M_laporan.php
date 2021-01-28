<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_laporan extends CI_Model
{

    public function get_sub_kegiatan($bulan, $kode_bidang, $kode_seksi)
    {
        $this->db->from("tb_sub_kegiatan");
        $this->db->join("tb_user", "tb_sub_kegiatan.kode_seksi = tb_user.kode_seksi");
        if ($kode_bidang != "") {
            $this->db->where("tb_user.kode_bidang", $kode_bidang);
        }
        if ($kode_seksi != "") {
            $this->db->where("tb_user.kode_seksi", $kode_seksi);
        }
        $data_sub = $this->db->get()->result();

        if ($bulan > 1) {
            $bln_sblm = $bulan - 1;
        } else {
            $bln_sblm = 0;
        }

        $hsl = array();
        $no = 0;
        foreach ($data_sub as $row) {
            $hsl[$no++] = array(
                "id_sub_kegiatan" => $row->id_sub_kegiatan,
                "kode_seksi" => $row->kode_seksi,
                "nama_sub_kegiatan" => $row->nama_sub_kegiatan,
                "nama" => $row->nama,
                "sisa" => $this->_get_sisa_bulan_lalu($row->id_sub_kegiatan, $bln_sblm, $row->kode_seksi),
                "rok" => $this->_get_rok($row->id_sub_kegiatan, $bulan, $row->kode_seksi),
                "realisasi" => $this->_get_real($row->id_sub_kegiatan, $bulan, $row->kode_seksi),
                "valid" => $this->_get_valid($row->id_sub_kegiatan, $bulan, $row->kode_seksi),
            );
        }

        $sort = $this->array_multi_subsort($hsl, 'rok');

        return $sort;
    }

    public function get_bidang()
    {
        $data = $this->db->get("tb_bidang")->result();

        return $data;
    }

    public function get_seksi($kode_bidang)
    {
        if ($kode_bidang == "") {
            $data = $this->db->get_where("tb_user", ["kode_seksi !=" => "XXXX"])->result();
        } else {
            $data = $this->db->get_where("tb_user", ["kode_seksi !=" => "XXXX", "kode_bidang" => $kode_bidang])->result();
        }

        return $data;
    }

    public function get_spj($st, $bln, $kode_bidang, $kode_seksi)
    {
        $this->db->from("view_spj_verif_bidang");

        if ($kode_bidang != "") {
            $this->db->where("kode_bidang", $kode_bidang);
        }
        if ($kode_seksi != "") {
            $this->db->where("kode_seksi", $kode_seksi);
        }
        if ($bln != "00") {
            $this->db->where("MONTH(tgl_kegiatan)", $bln);
        }

        if ($st == 1) {
            $this->db->where("status_spj <=", 3);
        } elseif ($st == 2) {
            $this->db->where("status_spj", 5);
        } elseif ($st == 3) {
            $this->db->where("status_spj", 4);
        }

        $this->db->where("status_verif", 0);
        $this->db->order_by("nomor_spj", "ASC");
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
                "nominal_real" => $row->nominal,
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

    // PRIVATE
    private function _get_sisa_bulan_lalu($id_sub, $bln_sblm, $kode_seksi)
    {
        if ($bln_sblm > 0) {
            $total = 0;
            for ($i = 1; $i <= $bln_sblm; $i++) {

                $s = date("Y") . "-" . $i . "-01";
                $bln = date("m", strtotime($s));
                $tbl = "b" . $bln;

                $valid = $this->db->query("SELECT $tbl as cek FROM tb_rok_valid WHERE id_sub_kegiatan='$id_sub' AND kode_seksi='$kode_seksi'")->row();

                if ($valid->cek == 1) {
                    $rok = $this->db->query("SELECT SUM(nominal) as nom FROM tb_rok WHERE id_sub_kegiatan='$id_sub' AND kode_seksi='$kode_seksi' AND bulan='$bln' AND id_rok NOT IN (SELECT id_rok FROM tb_spj WHERE status_spj='4')")->row();

                    $total = $total + $rok->nom;
                }
            }

            return number_format($total, 0, ",", ".");
        } else {
            return 0;
        }
    }

    private function _get_rok($id_sub, $bln, $kode_seksi)
    {
        $data = $this->db->query("SELECT SUM(nominal) as nom FROM tb_rok WHERE id_sub_kegiatan='$id_sub' AND kode_seksi='$kode_seksi' AND bulan='$bln'")->row();

        return number_format($data->nom, 0, ",", ".");
    }

    private function _get_real($id_sub, $bln, $kode_seksi)
    {
        $data = $this->db->query("SELECT SUM(nominal) as nom FROM tb_spj WHERE id_sub_kegiatan='$id_sub' AND kode_seksi='$kode_seksi' AND MONTH(tgl_transfer)='$bln' AND status_spj='4'")->row();

        return number_format($data->nom, 0, ",", ".");
    }

    private function array_multi_subsort($array, $subkey)
    {
        $b = array();
        $c = array();

        foreach ($array as $k => $v) {
            $b[$k] = strtolower($v[$subkey]);
        }

        arsort($b);
        foreach ($b as $key => $val) {
            $c[] = $array[$key];
        }

        return $c;
    }

    private function _get_valid($id_sub, $bln)
    {
        $tbl = "b" . $bln;
        $data = $this->db->query("SELECT $tbl FROM tb_rok_valid WHERE id_sub_kegiatan='$id_sub'")->row();

        return $data->$tbl;
    }
}

/* End of file M_laporan.php */
