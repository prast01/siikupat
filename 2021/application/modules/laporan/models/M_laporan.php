<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_laporan extends CI_Model
{

    public function get_sub_kegiatan($bulan, $kode_bidang, $kode_seksi)
    {
        $this->db->from("tb_sub_kegiatan");
        $this->db->join("tb_user", "tb_sub_kegiatan.kode_seksi = tb_user.kode_seksi");
        if ($kode_bidang != "all") {
            $this->db->where("tb_user.kode_bidang", $kode_bidang);
        }
        if ($kode_seksi != "all") {
            $this->db->where("tb_user.kode_seksi", $kode_seksi);
        }
        $this->db->where("tb_user.kode_bidang !=", "DK005");
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
                "rak" => $this->_get_data_rak($row->id_sub_kegiatan, sprintf("%02s", $bulan)),
                "rok" => $this->_get_rok($row->id_sub_kegiatan, $bulan, $row->kode_seksi),
                "realisasi" => $this->_get_real($row->id_sub_kegiatan, $bulan, $row->kode_seksi),
                "valid" => $this->_get_valid($row->id_sub_kegiatan, $bulan, $row->kode_seksi),
            );
        }

        if ($kode_seksi != "DJ002") {
            $data_sub_2 = $this->_get_sub_kegiatan_bagi();
            $seksi = $this->_get_seksi($kode_bidang, $kode_seksi);

            foreach ($data_sub_2 as $row) {
                foreach ($seksi as $row2) {
                    $hsl[$no++] = array(
                        "id_sub_kegiatan" => $row->id_sub_kegiatan,
                        "kode_seksi" => $row2->kode_seksi,
                        "nama_sub_kegiatan" => $row->nama_sub_kegiatan,
                        "nama" => $row2->nama,
                        "sisa" => $this->_get_sisa_bulan_lalu($row->id_sub_kegiatan, $bln_sblm, $row2->kode_seksi),
                        "rak" => $this->_get_data_rak($row->id_sub_kegiatan, sprintf("%02s", $bulan)),
                        "rok" => $this->_get_rok($row->id_sub_kegiatan, $bulan, $row2->kode_seksi),
                        "realisasi" => $this->_get_real($row->id_sub_kegiatan, $bulan, $row2->kode_seksi),
                        "valid" => $this->_get_valid($row->id_sub_kegiatan, $bulan, $row2->kode_seksi),
                    );
                }
            }
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
        if ($kode_bidang == "all") {
            if ($this->uri->segment(1) != "laporan-kinerja") {
                $data = $this->db->get_where("tb_user", ["kode_seksi !=" => "XXXX", "kode_bidang !=" => "DK005"])->result();
            } else {
                $data = $this->db->get_where("tb_user", ["kode_seksi !=" => "XXXX"])->result();
            }
        } else {
            $data = $this->db->get_where("tb_user", ["kode_seksi !=" => "XXXX", "kode_bidang" => $kode_bidang])->result();
        }

        return $data;
    }

    public function get_spj($st, $bln, $kode_bidang, $kode_seksi)
    {
        $this->db->from("view_spj_verif_bidang");

        if ($kode_bidang != "all") {
            $this->db->where("kode_bidang", $kode_bidang);
        }
        if ($kode_seksi != "all") {
            $this->db->where("kode_seksi", $kode_seksi);
        }
        if ($bln != "00" && $st != 3) {
            $this->db->where("MONTH(tgl_kegiatan)", $bln);
        }

        if ($st == 1) {
            $this->db->where("status_spj <=", 3);
        } elseif ($st == 2) {
            $this->db->where("status_spj", 5);
        } elseif ($st == 3) {
            if ($bln != "00") {
                $this->db->where("MONTH(tgl_transfer)", $bln);
            }
            $this->db->where("status_spj", 4);
        }

        // $this->db->where("status_verif", 0);
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
                $nama_status = "REKOM VERIFIKATOR";
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

    public function get_all_sub()
    {
        $data = $this->db->get("tb_sub_kegiatan")->result();

        return $data;
    }

    public function get_bk_1($id_sub_kegiatan, $dari, $sampai)
    {
        $data = $this->db->get_where("tb_rekening", ["id_sub_kegiatan" => $id_sub_kegiatan])->result();

        $no = 0;
        $hsl = array();

        foreach ($data as $key) {
            $realisasi_sblm = $this->_get_real_sblm($key->id_rekening, $dari);
            $gu = $this->_get_gu($key->id_rekening, $dari, $sampai);
            $ls = $this->_get_ls($key->id_rekening, $dari, $sampai);
            $total = $realisasi_sblm + $gu + $ls;
            $sisa = $key->pagu_rekening - $total;
            $hsl[$no++] = array(
                "id_rekening" => $key->id_rekening,
                "kode_rekening" => $key->kode_rekening,
                "nama_rekening" => $key->nama_rekening,
                "pagu_rekening" => $key->pagu_rekening,
                "realisasi_sblm" => $realisasi_sblm,
                "gu" => $gu,
                "ls" => $ls,
                "total" => $total,
                "sisa" => $sisa,
            );
        }

        return $hsl;
    }

    public function get_rek_by_id($id_sub_kegiatan)
    {
        $data = $this->db->get_where("tb_rekening", ["id_sub_kegiatan" => $id_sub_kegiatan])->result();

        return $data;
    }

    public function get_bk_2($id_rekening, $dari, $sampai)
    {
        $data = $this->db->query("SELECT * FROM tb_spj WHERE id_rekening='$id_rekening' AND status_spj='4' AND tgl_transfer >= '$dari' AND tgl_transfer <= '$sampai'")->result();

        $no = 0;
        $hsl = array();
        foreach ($data as $key) {
            if ($key->jenis_spj == 0) {
                $gu = $key->nominal;
                $ls = 0;
            } else {
                $gu = 0;
                $ls = $key->nominal;
            }

            $hsl[$no++] = array(
                "tgl_kegiatan" => date("d-m-Y", strtotime($key->tgl_kegiatan)),
                "tgl_transfer" => date("d-m-Y", strtotime($key->tgl_transfer)),
                "uraian" => $key->uraian,
                "pelaksana" => $this->get_pelaksana($key->kode_spj),
                "gu" => $gu,
                "ls" => $ls,
            );
        }

        return $hsl;
    }

    public function get_bk_0($dari, $sampai)
    {
        $no = 0;
        $hsl = array();

        // SALDO TERAKHIR
        $hsl[$no++] = array(
            "tanggal" => "-",
            "uraian" => "<b>Saldo Awal</b>",
            "debet" => $this->_get_saldo_akhir($dari),
            "kredit" => 0,
        );
        while (strtotime($dari) <= strtotime($sampai)) {
            $debet = 0;
            $kredit = 0;

            // UP
            $up = $this->db->get_where("tb_up", ["tgl_up" => $dari]);
            if ($up->num_rows() > 0) {
                $x = $up->row();
                $debet = $x->nominal;
                $kredit = 0;
                $hsl[$no++] = array(
                    "tanggal" => date("d-m-Y", strtotime($dari)),
                    "uraian" => "Pengajuan Uang Persediaan",
                    "debet" => $debet,
                    "kredit" => $kredit,
                );
            }

            // REALISASI
            $real = $this->db->get_where("tb_spj", ["status_spj" => 4, "jenis_spj" => 0, "tgl_transfer" => $dari]);
            if ($real->num_rows() > 0) {
                $x = $real->result();
                foreach ($x as $key) {
                    $debet = 0;
                    $kredit = $key->nominal;
                    $hsl[$no++] = array(
                        "tanggal" => date("d-m-Y", strtotime($dari)),
                        "uraian" => $key->uraian,
                        "debet" => $debet,
                        "kredit" => $kredit,
                    );
                }
            }


            $dari = date("Y-m-d", strtotime("+1 day", strtotime($dari))); //looping tambah 1 date
        }

        return $hsl;
    }

    public function get_sub_kegiatan_rak($kode_bidang, $kode_seksi)
    {
        $this->db->from("tb_sub_kegiatan");
        $this->db->join("tb_user", "tb_sub_kegiatan.kode_seksi = tb_user.kode_seksi");
        if ($kode_bidang != "") {
            $this->db->where("tb_user.kode_bidang", $kode_bidang);
        }
        if ($kode_seksi != "") {
            $this->db->where("tb_user.kode_seksi", $kode_seksi);
        }
        $this->db->where("tb_user.kode_bidang !=", "DK005");
        $this->db->order_by('tb_sub_kegiatan.kode_sub_kegiatan', 'ASC');
        $this->db->order_by('tb_sub_kegiatan.id_sub_kegiatan', 'ASC');

        $data_sub = $this->db->get()->result();

        $hsl = array();
        $no = 0;
        foreach ($data_sub as $key) {
            $hsl[$no++] = array(
                "kode_sub_kegiatan" => $key->kode_sub_kegiatan,
                "nama_sub_kegiatan" => $key->nama_sub_kegiatan,
                "nama" => $key->nama,
                "01" => $this->_get_data_rak($key->id_sub_kegiatan, "01"),
                "02" => $this->_get_data_rak($key->id_sub_kegiatan, "02"),
                "03" => $this->_get_data_rak($key->id_sub_kegiatan, "03"),
                "04" => $this->_get_data_rak($key->id_sub_kegiatan, "04"),
                "05" => $this->_get_data_rak($key->id_sub_kegiatan, "05"),
                "06" => $this->_get_data_rak($key->id_sub_kegiatan, "06"),
                "07" => $this->_get_data_rak($key->id_sub_kegiatan, "07"),
                "08" => $this->_get_data_rak($key->id_sub_kegiatan, "08"),
                "09" => $this->_get_data_rak($key->id_sub_kegiatan, "09"),
                "10" => $this->_get_data_rak($key->id_sub_kegiatan, "10"),
                "11" => $this->_get_data_rak($key->id_sub_kegiatan, "11"),
                "12" => $this->_get_data_rak($key->id_sub_kegiatan, "12")
            );
        }

        return $hsl;
    }

    public function get_sub_kegiatan_rok($kode_bidang, $kode_seksi)
    {
        $this->db->from("tb_sub_kegiatan");
        $this->db->join("tb_user", "tb_sub_kegiatan.kode_seksi = tb_user.kode_seksi");
        if ($kode_bidang != "") {
            $this->db->where("tb_user.kode_bidang", $kode_bidang);
        }
        if ($kode_seksi != "") {
            $this->db->where("tb_user.kode_seksi", $kode_seksi);
        }
        $this->db->where("tb_user.kode_bidang !=", "DK005");
        $this->db->order_by('tb_sub_kegiatan.kode_sub_kegiatan', 'ASC');
        $this->db->order_by('tb_sub_kegiatan.id_sub_kegiatan', 'ASC');

        $data_sub = $this->db->get()->result();

        $hsl = array();
        $no = 0;
        foreach ($data_sub as $key) {
            $hsl[$no++] = array(
                "kode_sub_kegiatan" => $key->kode_sub_kegiatan,
                "nama_sub_kegiatan" => $key->nama_sub_kegiatan,
                "nama" => $key->nama,
                "01" => $this->_get_data_rok($key->id_sub_kegiatan, "01", $key->kode_seksi),
                "02" => $this->_get_data_rok($key->id_sub_kegiatan, "02", $key->kode_seksi),
                "03" => $this->_get_data_rok($key->id_sub_kegiatan, "03", $key->kode_seksi),
                "04" => $this->_get_data_rok($key->id_sub_kegiatan, "04", $key->kode_seksi),
                "05" => $this->_get_data_rok($key->id_sub_kegiatan, "05", $key->kode_seksi),
                "06" => $this->_get_data_rok($key->id_sub_kegiatan, "06", $key->kode_seksi),
                "07" => $this->_get_data_rok($key->id_sub_kegiatan, "07", $key->kode_seksi),
                "08" => $this->_get_data_rok($key->id_sub_kegiatan, "08", $key->kode_seksi),
                "09" => $this->_get_data_rok($key->id_sub_kegiatan, "09", $key->kode_seksi),
                "10" => $this->_get_data_rok($key->id_sub_kegiatan, "10", $key->kode_seksi),
                "11" => $this->_get_data_rok($key->id_sub_kegiatan, "11", $key->kode_seksi),
                "12" => $this->_get_data_rok($key->id_sub_kegiatan, "12", $key->kode_seksi)
            );
        }

        return $hsl;
    }

    public function get_kinerja_all()
    {
        $hsl[0] = array(
            "skpd" => "Kesehatan",
            "01" => $this->_get_data_realisasi("01"),
            "02" => $this->_get_data_realisasi("02"),
            "03" => $this->_get_data_realisasi("03"),
            "04" => $this->_get_data_realisasi("04"),
            "05" => $this->_get_data_realisasi("05"),
            "06" => $this->_get_data_realisasi("06"),
            "07" => $this->_get_data_realisasi("07"),
            "08" => $this->_get_data_realisasi("08"),
            "09" => $this->_get_data_realisasi("09"),
            "10" => $this->_get_data_realisasi("10"),
            "11" => $this->_get_data_realisasi("11"),
            "12" => $this->_get_data_realisasi("12"),
            "rak01" => $this->_get_data_rak_all("01"),
            "rak02" => $this->_get_data_rak_all("02"),
            "rak03" => $this->_get_data_rak_all("03"),
            "rak04" => $this->_get_data_rak_all("04"),
            "rak05" => $this->_get_data_rak_all("05"),
            "rak06" => $this->_get_data_rak_all("06"),
            "rak07" => $this->_get_data_rak_all("07"),
            "rak08" => $this->_get_data_rak_all("08"),
            "rak09" => $this->_get_data_rak_all("09"),
            "rak10" => $this->_get_data_rak_all("10"),
            "rak11" => $this->_get_data_rak_all("11"),
            "rak12" => $this->_get_data_rak_all("12"),
        );

        return $hsl;
    }

    public function get_kinerja($kode_bidang, $kode_seksi)
    {
        $this->db->from("tb_user");
        if ($kode_bidang != "all") {
            $this->db->where("kode_bidang", $kode_bidang);
        }

        if ($kode_seksi != "all") {
            $this->db->where("kode_seksi", $kode_seksi);
        } else {
            $this->db->where("kode_seksi !=", "XXXX");
        }
        $this->db->order_by('kode_seksi', 'DESC');

        $data_pelaksana = $this->db->get()->result();

        $no = 0;
        $hsl = array();
        foreach ($data_pelaksana as $key) {
            if ($key->kode_bidang != "DK005") {
                $hsl[$no] = array(
                    "skpd" => $key->nama,
                    "kode_seksi" => $key->kode_seksi,
                    "01" => $this->_get_data_realisasi_seksi($key->kode_seksi, "01"),
                    "02" => $this->_get_data_realisasi_seksi($key->kode_seksi, "02"),
                    "03" => $this->_get_data_realisasi_seksi($key->kode_seksi, "03"),
                    "04" => $this->_get_data_realisasi_seksi($key->kode_seksi, "04"),
                    "05" => $this->_get_data_realisasi_seksi($key->kode_seksi, "05"),
                    "06" => $this->_get_data_realisasi_seksi($key->kode_seksi, "06"),
                    "07" => $this->_get_data_realisasi_seksi($key->kode_seksi, "07"),
                    "08" => $this->_get_data_realisasi_seksi($key->kode_seksi, "08"),
                    "09" => $this->_get_data_realisasi_seksi($key->kode_seksi, "09"),
                    "10" => $this->_get_data_realisasi_seksi($key->kode_seksi, "10"),
                    "11" => $this->_get_data_realisasi_seksi($key->kode_seksi, "11"),
                    "12" => $this->_get_data_realisasi_seksi($key->kode_seksi, "12"),
                    "rak01" => $this->_get_data_rak_all_seksi($key->kode_seksi, "01"),
                    "rak02" => $this->_get_data_rak_all_seksi($key->kode_seksi, "02"),
                    "rak03" => $this->_get_data_rak_all_seksi($key->kode_seksi, "03"),
                    "rak04" => $this->_get_data_rak_all_seksi($key->kode_seksi, "04"),
                    "rak05" => $this->_get_data_rak_all_seksi($key->kode_seksi, "05"),
                    "rak06" => $this->_get_data_rak_all_seksi($key->kode_seksi, "06"),
                    "rak07" => $this->_get_data_rak_all_seksi($key->kode_seksi, "07"),
                    "rak08" => $this->_get_data_rak_all_seksi($key->kode_seksi, "08"),
                    "rak09" => $this->_get_data_rak_all_seksi($key->kode_seksi, "09"),
                    "rak10" => $this->_get_data_rak_all_seksi($key->kode_seksi, "10"),
                    "rak11" => $this->_get_data_rak_all_seksi($key->kode_seksi, "11"),
                    "rak12" => $this->_get_data_rak_all_seksi($key->kode_seksi, "12"),
                );
            } else {
                // $hsl[$no] = array(
                //     "skpd" => $key->nama,
                //     "01" => $this->_get_data_realisasi_faskes($key->kode_seksi, "01"),
                //     "02" => $this->_get_data_realisasi_faskes($key->kode_seksi, "02"),
                //     "03" => $this->_get_data_realisasi_faskes($key->kode_seksi, "03"),
                //     "04" => $this->_get_data_realisasi_faskes($key->kode_seksi, "04"),
                //     "05" => $this->_get_data_realisasi_faskes($key->kode_seksi, "05"),
                //     "06" => $this->_get_data_realisasi_faskes($key->kode_seksi, "06"),
                //     "07" => $this->_get_data_realisasi_faskes($key->kode_seksi, "07"),
                //     "08" => $this->_get_data_realisasi_faskes($key->kode_seksi, "08"),
                //     "09" => $this->_get_data_realisasi_faskes($key->kode_seksi, "09"),
                //     "10" => $this->_get_data_realisasi_faskes($key->kode_seksi, "10"),
                //     "11" => $this->_get_data_realisasi_faskes($key->kode_seksi, "11"),
                //     "12" => $this->_get_data_realisasi_faskes($key->kode_seksi, "12"),
                //     "rak01" => $this->_get_data_rak_all_faskes($key->kode_seksi, "01"),
                //     "rak02" => $this->_get_data_rak_all_faskes($key->kode_seksi, "02"),
                //     "rak03" => $this->_get_data_rak_all_faskes($key->kode_seksi, "03"),
                //     "rak04" => $this->_get_data_rak_all_faskes($key->kode_seksi, "04"),
                //     "rak05" => $this->_get_data_rak_all_faskes($key->kode_seksi, "05"),
                //     "rak06" => $this->_get_data_rak_all_faskes($key->kode_seksi, "06"),
                //     "rak07" => $this->_get_data_rak_all_faskes($key->kode_seksi, "07"),
                //     "rak08" => $this->_get_data_rak_all_faskes($key->kode_seksi, "08"),
                //     "rak09" => $this->_get_data_rak_all_faskes($key->kode_seksi, "09"),
                //     "rak10" => $this->_get_data_rak_all_faskes($key->kode_seksi, "10"),
                //     "rak11" => $this->_get_data_rak_all_faskes($key->kode_seksi, "11"),
                //     "rak12" => $this->_get_data_rak_all_faskes($key->kode_seksi, "12"),
                // );
            }
            $no++;
        }

        return $hsl;
    }

    public function get_lap_sub_kegiatan($kode_bidang, $kode_seksi)
    {
        $this->db->from("view_sub_kegiatan");
        if ($kode_bidang != "all") {
            $this->db->where("kode_bidang", $kode_bidang);
        }
        if ($kode_seksi != "all") {
            $this->db->where("kode_seksi", $kode_seksi);
        }
        $data_sub = $this->db->get()->result();

        $hsl = array();
        $no = 0;
        foreach ($data_sub as $row) {
            $real = $this->_get_real_by_id($row->id_sub_kegiatan);
            $sisa = $this->_get_sisa($row->pagu_anggaran, $real);
            $persen = $this->_get_persen($row->pagu_anggaran, $real);
            $hsl[$no++] = array(
                "id_sub_kegiatan" => $row->id_sub_kegiatan,
                "nama_sub_kegiatan" => $row->nama_sub_kegiatan,
                "nama" => $row->nama,
                "pagu_anggaran" => $row->pagu_anggaran,
                "realisasi" => $real,
                "sisa" => $sisa,
                "persen" => $persen,
            );
        }

        return $hsl;
    }

    public function get_kinerja_sub_kegiatan($kode_seksi)
    {
        $sub = $this->db->get_where("tb_sub_kegiatan", ["kode_seksi" => $kode_seksi])->result();
        $no = 0;
        $hsl = array();
        foreach ($sub as $key) {
            $hsl[$no++] = array(
                "nama_sub" => $key->nama_sub_kegiatan,
                "01" => $this->_get_real_sub($key->id_sub_kegiatan, "01"),
                "02" => $this->_get_real_sub($key->id_sub_kegiatan, "02"),
                "03" => $this->_get_real_sub($key->id_sub_kegiatan, "03"),
                "04" => $this->_get_real_sub($key->id_sub_kegiatan, "04"),
                "05" => $this->_get_real_sub($key->id_sub_kegiatan, "05"),
                "06" => $this->_get_real_sub($key->id_sub_kegiatan, "06"),
                "07" => $this->_get_real_sub($key->id_sub_kegiatan, "07"),
                "08" => $this->_get_real_sub($key->id_sub_kegiatan, "08"),
                "09" => $this->_get_real_sub($key->id_sub_kegiatan, "09"),
                "10" => $this->_get_real_sub($key->id_sub_kegiatan, "10"),
                "11" => $this->_get_real_sub($key->id_sub_kegiatan, "11"),
                "12" => $this->_get_real_sub($key->id_sub_kegiatan, "12"),
                "rak01" => $this->_get_data_rak($key->id_sub_kegiatan, "01"),
                "rak02" => $this->_get_data_rak($key->id_sub_kegiatan, "02"),
                "rak03" => $this->_get_data_rak($key->id_sub_kegiatan, "03"),
                "rak04" => $this->_get_data_rak($key->id_sub_kegiatan, "04"),
                "rak05" => $this->_get_data_rak($key->id_sub_kegiatan, "05"),
                "rak06" => $this->_get_data_rak($key->id_sub_kegiatan, "06"),
                "rak07" => $this->_get_data_rak($key->id_sub_kegiatan, "07"),
                "rak08" => $this->_get_data_rak($key->id_sub_kegiatan, "08"),
                "rak09" => $this->_get_data_rak($key->id_sub_kegiatan, "09"),
                "rak10" => $this->_get_data_rak($key->id_sub_kegiatan, "10"),
                "rak11" => $this->_get_data_rak($key->id_sub_kegiatan, "11"),
                "rak12" => $this->_get_data_rak($key->id_sub_kegiatan, "12"),
            );
        }

        return $hsl;
    }

    public function get_kinerja_bulan($bulan)
    {
        $sub = $this->db->get_where("view_sub_kegiatan")->result();
        $no = 0;
        $hsl = array();
        foreach ($sub as $key) {
            $hsl[$no++] = array(
                "nama_sub" => $key->nama_sub_kegiatan,
                "nama" => $key->nama,
                "realisasi" => $this->_get_real_sub($key->id_sub_kegiatan, $bulan),
                "rak" => $this->_get_data_rak($key->id_sub_kegiatan, $bulan),
            );
        }

        return $hsl;
    }

    // CRUD
    public function simpan_realisasi_faskes($post)
    {
        for ($i = 0; $i < count($post["bulan"]); $i++) {
            $where = array(
                "kode_seksi" => $post["kode_seksi"],
                "bulan" => $post["bulan"][$i],
            );

            $cek = $this->db->get_where("tb_realisasi_faskes", $where)->num_rows();
            if ($cek == 0) {
                $data = array(
                    "kode_seksi" => $post["kode_seksi"],
                    "bulan" => $post["bulan"][$i],
                    "rak" => $post["rak"][$i],
                    "realisasi" => $post["realisasi"][$i],
                );
                $hsl = $this->db->insert("tb_realisasi_faskes", $data);
            } else {
                $data = array(
                    "rak" => $post["rak"][$i],
                    "realisasi" => $post["realisasi"][$i],
                );
                $hsl = $this->db->update("tb_realisasi_faskes", $data, $where);
            }
        }

        if ($hsl) {
            return array("res" => 1, "msg" => "Data Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "Data Gagal Disimpan");
        }
    }

    // PRIVATE

    private function _get_real_by_id($id_sub_kegiatan)
    {
        $real = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_spj WHERE id_sub_kegiatan='$id_sub_kegiatan' AND status_spj='4' GROUP BY id_sub_kegiatan");

        $total = 0;
        if ($real->num_rows() > 0) {
            $r = $real->row();
            $total = $r->nominal;
        }
        return $total;
    }

    private function _get_sisa($pagu, $real)
    {
        $hsl = $pagu - $real;
        return $hsl;
    }

    private function _get_persen($pagu, $real)
    {
        $hsl = 0;
        if ($pagu > 0) {
            $hsl = ($real / $pagu) * 100;
        }

        return $hsl;
    }

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

    private function _get_valid($id_sub, $bln, $kode_seksi)
    {
        $tbl = "b" . $bln;
        $data = $this->db->query("SELECT $tbl FROM tb_rok_valid WHERE id_sub_kegiatan='$id_sub' AND kode_seksi='$kode_seksi'")->row();

        return $data->$tbl;
    }

    private function _get_real_sblm($id_rekening, $dari)
    {
        $data = $this->db->query("SELECT SUM(nominal) as total FROM tb_spj WHERE id_rekening='$id_rekening' AND status_spj='4' AND tgl_transfer < '$dari'")->row();

        $total = 0;
        $total = $total + $data->total;
        return $total;
    }

    private function _get_gu($id_rekening, $dari, $sampai)
    {
        $data = $this->db->query("SELECT SUM(nominal) as total FROM tb_spj WHERE id_rekening='$id_rekening' AND status_spj='4' AND tgl_transfer >= '$dari' AND tgl_transfer <= '$sampai' AND jenis_spj='0'")->row();

        $total = 0;
        $total = $total + $data->total;
        return $total;
    }

    private function _get_ls($id_rekening, $dari, $sampai)
    {
        $data = $this->db->query("SELECT SUM(nominal) as total FROM tb_spj WHERE id_rekening='$id_rekening' AND status_spj='4' AND tgl_transfer >= '$dari' AND tgl_transfer <= '$sampai' AND jenis_spj='1'")->row();

        $total = 0;
        $total = $total + $data->total;
        return $total;
    }

    private function _get_saldo_akhir($dari)
    {
        $up = $this->db->query("SELECT SUM(nominal) as nominal FROM tb_up WHERE tgl_up < '$dari'")->row();
        $real = $this->db->query("SELECT SUM(nominal) as nominal FROM tb_spj WHERE tgl_transfer < '$dari' AND status_spj='4'")->row();

        $saldo = $up->nominal - $real->nominal;

        return $saldo;
    }

    private function _get_sub_kegiatan_bagi()
    {
        $data = $this->db->get_where("tb_sub_kegiatan", ["bagi" => 1])->result();

        return $data;
    }

    private function _get_seksi($kode_bidang, $kode_seksi)
    {
        if ($kode_bidang != "all") {
            $this->db->where("kode_bidang", $kode_bidang);
        }
        if ($kode_seksi != "all") {
            $this->db->where("kode_seksi", $kode_seksi);
        }
        $this->db->where("kode_bidang !=", "DK005");
        $this->db->where("kode_seksi !=", "XXXX");
        $this->db->where("kode_seksi !=", "DJ002");
        $data = $this->db->get("tb_user")->result();

        return $data;
    }

    private function _get_data_rak($id_sub_kegiatan, $bln)
    {
        $data = $this->db->get_where("tb_rak", ["id_sub_kegiatan" => $id_sub_kegiatan]);
        $kolom = "b" . $bln;

        if ($data->num_rows() > 0) {
            $hsl = $data->row();
            return $hsl->$kolom;
        } else {
            return 0;
        }
    }

    private function _get_data_rok($id_sub_kegiatan, $bln, $kode_seksi)
    {
        $data = $this->db->query("SELECT SUM(nominal) as total FROM tb_rok WHERE id_sub_kegiatan='$id_sub_kegiatan' AND kode_seksi='$kode_seksi' AND bulan='$bln'");

        if ($data->num_rows() > 0) {
            $hsl = $data->row();
            return $hsl->total;
        } else {
            return 0;
        }
    }

    private function _get_data_realisasi($bln)
    {
        $data = $this->db->query("SELECT SUM(nominal) as jumlah FROM tb_spj WHERE MONTH(tgl_transfer)='$bln' AND status_spj='4'")->row();

        // $data2 = $this->db->query("SELECT SUM(realisasi) as jumlah FROM tb_realisasi_faskes WHERE bulan='$bln'")->row();

        // return $data->jumlah + $data2->jumlah;
        return $data->jumlah;
    }

    private function _get_data_rak_all($bln)
    {
        $kolom = "b" . $bln;

        $data = $this->db->query("SELECT SUM($kolom) as jumlah FROM tb_rak")->row();
        // $data2 = $this->db->query("SELECT SUM(rak) as jumlah FROM tb_realisasi_faskes WHERE bulan='$bln'")->row();

        // return $data->jumlah + $data2->jumlah;
        return $data->jumlah;
    }

    private function _get_data_realisasi_seksi($kode_seksi, $bln)
    {
        $data = $this->db->get_where("tb_sub_kegiatan", ["kode_seksi" => $kode_seksi])->result();

        $total = 0;
        foreach ($data as $key) {
            $data2 = $this->db->query("SELECT SUM(nominal) as jumlah FROM tb_spj WHERE MONTH(tgl_transfer)='$bln' AND status_spj='4' AND id_sub_kegiatan='$key->id_sub_kegiatan'")->row();

            if ($data2->jumlah != "") {
                $total = $total + $data2->jumlah;
            } else {
                $total = $total + 0;
            }
        }

        return $total;
    }

    private function _get_data_rak_all_seksi($kode_seksi, $bln)
    {
        $data = $this->db->get_where("tb_sub_kegiatan", ["kode_seksi" => $kode_seksi])->result();

        $total = 0;
        $kolom = "b" . $bln;
        foreach ($data as $key) {
            $data2 = $this->db->query("SELECT SUM($kolom) as jumlah FROM tb_rak WHERE id_sub_kegiatan='$key->id_sub_kegiatan'")->row();

            if ($data2->jumlah != "") {
                $total = $total + $data2->jumlah;
            } else {
                $total = $total + 0;
            }
        }

        return $total;
    }

    private function _get_data_realisasi_faskes($kode_seksi, $bln)
    {
        $data2 = $this->db->query("SELECT SUM(realisasi) as jumlah FROM tb_realisasi_faskes WHERE bulan='$bln' AND kode_seksi='$kode_seksi'")->row();

        if ($data2->jumlah != "") {
            return $data2->jumlah;
        } else {
            return 0;
        }
    }

    private function _get_data_rak_all_faskes($kode_seksi, $bln)
    {
        $data2 = $this->db->query("SELECT SUM(rak) as jumlah FROM tb_realisasi_faskes WHERE bulan='$bln' AND kode_seksi='$kode_seksi'")->row();

        if ($data2->jumlah != "") {
            return $data2->jumlah;
        } else {
            return 0;
        }
    }

    private function _get_real_sub($id_sub_kegiatan, $bln)
    {
        $real = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_spj WHERE id_sub_kegiatan='$id_sub_kegiatan' AND status_spj='4' AND MONTH(tgl_transfer)='$bln' GROUP BY id_sub_kegiatan");

        $total = 0;
        if ($real->num_rows() > 0) {
            $r = $real->row();
            $total = $r->nominal;
        }
        return $total;
    }
}

/* End of file M_laporan.php */
