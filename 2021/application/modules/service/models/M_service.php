<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_service extends CI_Model
{

    public function get_rekening_master($search)
    {
        $this->db->select("*");
        $this->db->from("tb_rekening_master");
        $this->db->like("kode_rekening", $search);
        $this->db->or_like("nama_rekening", $search);
        $data = $this->db->get()->result();

        return $data;
    }

    public function get_rekening_seksi($search, $id_sub_kegiatan)
    {
        $this->db->select("*");
        $this->db->from("tb_rekening");
        $this->db->where("id_sub_kegiatan", $id_sub_kegiatan);
        $this->db->like("kode_rekening", $search);
        $this->db->or_like("nama_rekening", $search);
        $data = $this->db->get()->result();

        return $data;
    }

    public function get_rekening_seksi2($id_sub_kegiatan)
    {
        $kode_seksi = $this->session->userdata("kode_seksi");

        $this->db->select("*");
        $this->db->from("tb_rekening");
        $this->db->where("id_sub_kegiatan", $id_sub_kegiatan);

        if ($kode_seksi != "DJ002" && ($id_sub_kegiatan == 3 || $id_sub_kegiatan == 7)) {
            $this->db->where("cek !=", 0);
        }

        $data = $this->db->get()->result();

        return $data;
    }

    public function get_realisasi()
    {
        $kode_seksi = $this->session->userdata("kode_seksi");
        $kode_bidang = $this->session->userdata("kode_bidang");
        // $this->db->where("kode_seksi", $kode_seksi);
        // if ($kode_bidang == "DK005") {
        //     $this->db->where("kode_seksi", $kode_seksi);
        // } elseif ($kode_seksi != "XXXX" && $kode_bidang != "DK005") {
        //     $this->db->not_like("nama", "PKM");
        // }

        $this->db->order_by("persen_anggaran", "DESC");
        $data = $this->db->get("tb_realisasi_seksi")->result();

        return $data;
    }

    public function get_user()
    {
        $this->db->order_by("persen_anggaran", "DESC");
        $data = $this->db->get("tb_realisasi_seksi")->result();

        return $data;
    }

    public function get_rok($id_sub, $id_rekening, $bln)
    {
        $kode_seksi = $this->session->userdata("kode_seksi");
        $data = $this->db->query("SELECT * FROM tb_rok WHERE id_sub_kegiatan='$id_sub' AND id_rekening='$id_rekening' AND bulan='$bln' AND kode_seksi = '$kode_seksi' AND jenis_spj='0' AND blok='0' AND id_rok NOT IN (SELECT id_rok FROM tb_spj WHERE id_sub_kegiatan='$id_sub')")->result();

        $hsl = array();
        $no = 0;
        foreach ($data as $row) {
            $hsl[$no++] = array(
                "id_rok" => $row->id_rok,
                "uraian" => $row->uraian,
                "nominal" => "Rp" . number_format($row->nominal, 0, ",", "."),
                "valid" => $this->cek_rok_valid($row->id_sub_kegiatan, $row->bulan),
            );
        }

        $data_old = $this->get_rok_old($id_sub, $id_rekening, $bln);
        foreach ($data_old as $row) {
            $hsl[$no++] = array(
                "id_rok" => $row->id_rok,
                "uraian" => $row->uraian,
                "nominal" => "Rp" . number_format($row->nominal, 0, ",", "."),
                "valid" => $this->cek_rok_valid($row->id_sub_kegiatan, $row->bulan),
            );
        }

        $rek = array("24", "25", "26", "41", "46");
        if (in_array($id_rekening, $rek)) {
            $data_surat = $this->get_data_surat($id_sub, $id_rekening, $bln);
            foreach ($data_surat as $row) {
                $hsl[$no++] = array(
                    "id_rok" => $row->id_rok,
                    "uraian" => $row->uraian,
                    "nominal" => "Rp" . number_format($row->nominal, 0, ",", "."),
                    "valid" => 1,
                );
            }
        }

        return $hsl;
    }

    public function get_rok_ubah($id_sub, $id_rekening, $bln, $id_rek, $id_rok)
    {
        $kode_seksi = $this->session->userdata("kode_seksi");
        $data = $this->db->query("SELECT * FROM tb_rok WHERE id_sub_kegiatan='$id_sub' AND id_rekening='$id_rekening' AND bulan='$bln' AND kode_seksi='$kode_seksi' AND jenis_spj='0' AND blok='0' AND id_rok NOT IN (SELECT id_rok FROM tb_spj WHERE id_sub_kegiatan='$id_sub')")->result();

        $rok = $this->get_uraian($id_rok);
        $hsl = array();
        $no = 0;

        if ($id_rekening == $id_rek) {
            $hsl[$no++] = array(
                "id_rok" => $rok->id_rok,
                "uraian" => $rok->uraian,
                "nominal" => "Rp" . number_format($rok->nominal, 0, ",", "."),
                "valid" => $this->cek_rok_valid($rok->id_sub_kegiatan, $rok->bulan),
            );
        }

        foreach ($data as $row) {
            $hsl[$no++] = array(
                "id_rok" => $row->id_rok,
                "uraian" => $row->uraian,
                "nominal" => "Rp" . number_format($row->nominal, 0, ",", "."),
                "valid" => $this->cek_rok_valid($row->id_sub_kegiatan, $row->bulan),
            );
        }

        $data_old = $this->get_rok_old($id_sub, $id_rekening, $bln);
        foreach ($data_old as $row) {
            $hsl[$no++] = array(
                "id_rok" => $row->id_rok,
                "uraian" => $row->uraian,
                "nominal" => "Rp" . number_format($row->nominal, 0, ",", "."),
                "valid" => $this->cek_rok_valid($row->id_sub_kegiatan, $row->bulan),
            );
        }

        return $hsl;
    }

    public function get_rok_old($id_sub, $id_rekening, $bln)
    {
        $kode_seksi = $this->session->userdata("kode_seksi");
        $data = $this->db->query("SELECT * FROM tb_rok WHERE id_sub_kegiatan='$id_sub' AND id_rekening='$id_rekening' AND bulan<'$bln' AND kode_seksi = '$kode_seksi' AND jenis_spj='0' AND blok='0' AND id_rok NOT IN (SELECT id_rok FROM tb_spj WHERE id_sub_kegiatan='$id_sub')")->result();

        return $data;
    }

    public function get_rok_a21($id_sub, $id_rekening, $bln)
    {
        $kode_seksi = $this->session->userdata("kode_seksi");
        $data = $this->db->query("SELECT * FROM tb_rok WHERE id_sub_kegiatan='$id_sub' AND id_rekening='$id_rekening' AND bulan <= '$bln' AND kode_seksi='$kode_seksi' AND blok='0'")->result();

        $hsl = array();
        $no = 0;
        foreach ($data as $row) {
            $hsl[$no++] = array(
                "id_rok" => $row->id_rok,
                "uraian" => $row->uraian,
                "nominal" => "Rp" . number_format($row->nominal, 0, ",", "."),
                "valid" => $this->cek_rok_valid($row->id_sub_kegiatan, $row->bulan),
            );
        }

        return $hsl;
    }

    public function cek_rok_valid($id_sub, $bln)
    {
        $kode_seksi = $this->session->userdata("kode_seksi");
        $tbl = "b" . $bln;
        $data = $this->db->query("SELECT $tbl FROM tb_rok_valid WHERE id_sub_kegiatan='$id_sub' AND kode_seksi='$kode_seksi'")->row();

        return $data->$tbl;
    }

    public function get_uraian($id_rok)
    {
        $data = $this->db->get_where("tb_rok", ["id_rok" => $id_rok])->row();

        return $data;
    }

    public function get_pegawai($id_pegawai)
    {
        $data = $this->db->get_where("tb_pegawai", ["id_pegawai" => $id_pegawai])->row();

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

    public function get_antrian()
    {
        $kode_bidang = $this->session->userdata("kode_bidang");

        $this->db->from("view_spj_verif_bidang");
        $this->db->where("kode_bidang", $kode_bidang);
        $this->db->where("status_spj <=", 2);
        $this->db->where("status_verif", 0);
        $this->db->where("hapus", 0);
        $this->db->order_by("nomor_spj", "ASC");
        $this->db->limit(1);
        $data = $this->db->get()->row();


        if ($data->jenis_spj == "0") {
            $jenis = "GU";
        } else {
            $jenis = "LS";
        }

        if ($data->kode_bidang == "DK001") {
            $bd = "1-";
        } elseif ($data->kode_bidang == "DK002") {
            $bd = "2-";
        } elseif ($data->kode_bidang == "DK003") {
            $bd = "3-";
        } elseif ($data->kode_bidang == "DK004") {
            $bd = "4-";
        }

        $dt = $this->db->get_where("view_spj_verif_bidang", ["kode_bidang" => $kode_bidang, "status_spj <=" => 2, "status_verif" => 0])->num_rows();

        $hsl = array(
            "no_spj" => $bd . $jenis . sprintf("%05s", $data->nomor_spj),
            "total" => $dt - 1
        );

        return $hsl;
    }

    public function get_antrian_verif($status)
    {
        $kode_bidang = $this->session->userdata("kode_bidang");

        $baru = $this->_get_antrian_spj($kode_bidang, 1);
        $revisi = $this->_get_antrian_spj($kode_bidang, 2);
        $acc = $this->_get_antrian_spj($kode_bidang, 3);

        if ($status == "1") {
            $baru = $baru - 1;
        } elseif ($status == "2") {
            $revisi = $revisi - 1;
        }

        $hsl = array(
            "baru" => $baru,
            "revisi" => $revisi,
            "acc" => $acc,
        );

        return $hsl;
    }

    public function get_data_rok($kode_seksi)
    {
        $bulan = date("m");

        // $this->db->select("id_rok");
        // $x = $this->db->get("tb_spj")->row_array();

        // $this->db->join("tb_rekening", "tb_rekening.id_rekening = tb_rok.id_rekening");
        // $this->db->where_not_in("tb_rok.id_rok", $x);
        // $this->db->where("tb_rekening.cek", 1);
        // $this->db->where("tb_rok.kode_seksi", $kode_seksi);
        // $this->db->where("tb_rok.bulan <=", $bulan);
        // $data = $this->db->get("tb_rok")->result();

        // $data = $this->db->query("SELECT tb_rok.uraian, tb_rok.nominal FROM tb_rok INNER JOIN tb_rekening ON tb_rok.id_rekening=tb_rekening.id_rekening WHERE tb_rekening.cek = 1 AND tb_rok.kode_seksi = '$kode_seksi' AND tb_rok.bulan <= '$bulan' AND tb_rok.id_rok NOT IN (SELECT id_rok FROM tb_spj)")->result();
        $data = $this->db->query("SELECT tb_rok.uraian, tb_rok.nominal FROM tb_rok INNER JOIN tb_rekening ON tb_rok.id_rekening=tb_rekening.id_rekening WHERE tb_rekening.cek = 1 AND tb_rok.kode_seksi = '$kode_seksi' AND tb_rok.bulan <= '$bulan'")->result();

        $no = 0;
        $hsl = array();
        foreach ($data as $key) {
            $hsl[$no++] = array(
                "rok" => $key->uraian . " - Rp" . number_format($key->nominal, 0, ",", "."),
            );
        }

        return $hsl;
    }

    public function get_data_kinerja($kode_bidang, $bulan)
    {
        $this->db->from("tb_user");
        if ($kode_bidang != "all") {
            $this->db->where("kode_bidang", $kode_bidang);
        }
        $this->db->where("kode_seksi !=", "XXXX");
        $this->db->order_by('kode_seksi', 'ASC');

        $data_pelaksana = $this->db->get()->result();

        $no = 0;
        $hsl = array();
        foreach ($data_pelaksana as $key) {
            if ($key->kode_bidang != "DK005") {
                $hsl[$no++] = array(
                    "nama" => $key->nama,
                    "persen" => $this->_get_persen_kinerja($key->kode_seksi, $bulan)
                );
            } else {
                $hsl[$no++] = array(
                    "nama" => $key->nama,
                    "persen" => $this->_get_persen_kinerja_faskes($key->kode_seksi, $bulan)
                );
            }
        }

        $sort = $this->array_multi_subsort($hsl, 'persen');

        return $sort;
    }

    public function get_data_kinerja_all($kode_bidang, $bulan)
    {
        $total_real = $this->_get_kinerja_real($kode_bidang, $bulan);
        $total_rak = $this->_get_kinerja_rak($kode_bidang, $bulan);
        $persen = ($total_real / $total_rak) * 100;
        $hsl = array(
            "total_real" => number_format($total_real, 0, ",", "."),
            "total_rak" => number_format($total_rak, 0, ",", "."),
            "total_persen" => number_format($persen, 2, ",", "."),
        );

        return $hsl;
    }

    public function get_data_kinerja_akumulasi($kode_bidang, $bulan)
    {
        $this->db->from("tb_user");
        if ($kode_bidang != "all") {
            $this->db->where("kode_bidang", $kode_bidang);
        }
        $this->db->where("kode_seksi !=", "XXXX");
        $this->db->order_by('kode_seksi', 'ASC');

        $data_pelaksana = $this->db->get()->result();

        $no = 0;
        $hsl = array();
        foreach ($data_pelaksana as $key) {
            if ($key->kode_bidang != "DK005") {
                $hsl[$no++] = array(
                    "nama" => $key->nama,
                    "persen" => $this->_get_persen_kinerja_akumulasi($key->kode_seksi, $bulan)
                );
            } else {
                $hsl[$no++] = array(
                    "nama" => $key->nama,
                    "persen" => $this->_get_persen_kinerja_faskes_akumulasi($key->kode_seksi, $bulan)
                );
            }
        }

        $sort = $this->array_multi_subsort($hsl, 'persen');

        return $sort;
    }

    public function get_data_kinerja_akumulasi_all($kode_bidang, $bulan)
    {
        $total_real = $this->_get_kinerja_akumulasi_real($kode_bidang, $bulan);
        $total_rak = $this->_get_kinerja_akumulasi_rak($kode_bidang, $bulan);
        $persen = ($total_real / $total_rak) * 100;
        $hsl = array(
            "total_real" => number_format($total_real, 0, ",", "."),
            "total_rak" => number_format($total_rak, 0, ",", "."),
            "total_persen" => number_format($persen, 2, ",", "."),
        );

        return $hsl;
    }

    // PRIVATE
    private function _get_antrian_spj($kode_bidang, $status)
    {
        // if ($status == 1) {
        $where = array(
            "kode_bidang" => $kode_bidang,
            "status_spj" => $status,
            "status_verif" => 0,
            "hapus" => 0,
        );
        // } elseif ($status == 2) {
        //     $where = array(
        //         "kode_bidang" => $kode_bidang,
        //         "status_spj" => $status,
        //         "status_verif" => 0,
        //         "hapus" => 0,
        //     );
        // } elseif ($status == 3) {
        //     $where = array(
        //         "kode_bidang" => $kode_bidang,
        //         "status_spj" => $status,
        //         "status_verif" => 0,
        //         "hapus" => 0,
        //     );
        // }

        $data = $this->db->get_where("view_spj_verif_bidang", $where)->num_rows();

        return $data;
    }

    private function get_data_surat($id_sub, $id_rekening, $bln)
    {
        $kode_seksi = $this->session->userdata("kode_seksi");
        $data = $this->db->query("SELECT * FROM tb_rok WHERE id_sub_kegiatan='$id_sub' AND id_rekening='$id_rekening' AND bulan='$bln' AND kode_seksi='$kode_seksi' AND jenis_spj='1' AND id_rok NOT IN (SELECT id_rok FROM tb_spj WHERE id_sub_kegiatan='$id_sub')")->result();

        return $data;
    }

    private function _get_persen_kinerja($kode_seksi, $bulan)
    {
        $data_real = $this->db->get_where("tb_sub_kegiatan", ["kode_seksi" => $kode_seksi])->result();

        $total_real = 0;
        foreach ($data_real as $key) {
            $data2 = $this->db->query("SELECT SUM(nominal) as jumlah FROM tb_spj WHERE MONTH(tgl_transfer)='$bulan' AND status_spj='4' AND id_sub_kegiatan='$key->id_sub_kegiatan'")->row();

            if ($data2->jumlah != "") {
                $total_real = $total_real + $data2->jumlah;
            } else {
                $total_real = $total_real + 0;
            }
        }

        $data_rak = $this->db->get_where("tb_sub_kegiatan", ["kode_seksi" => $kode_seksi])->result();

        $total_rak = 0;
        $kolom = "b" . $bulan;
        foreach ($data_rak as $key) {
            $data2 = $this->db->query("SELECT SUM($kolom) as jumlah FROM tb_rak WHERE id_sub_kegiatan='$key->id_sub_kegiatan'")->row();

            if ($data2->jumlah != "") {
                $total_rak = $total_rak + $data2->jumlah;
            } else {
                $total_rak = $total_rak + 0;
            }
        }

        if ($total_rak > 0 && $total_real >= 0) {
            $persen = ($total_real / $total_rak) * 100;
        } elseif ($total_rak == 0) {
            $persen = 0;
        } else {
            $persen = 100;
        }

        return number_format($persen, 2, ".", ",");
    }

    private function _get_persen_kinerja_faskes($kode_seksi, $bulan)
    {
        $data_real = $this->db->query("SELECT SUM(realisasi) as jumlah FROM tb_realisasi_faskes WHERE bulan='$bulan' AND kode_seksi='$kode_seksi'")->row();

        if ($data_real->jumlah != "") {
            $total_real = $data_real->jumlah;
        } else {
            $total_real = 0;
        }

        $data_rak = $this->db->query("SELECT SUM(rak) as jumlah FROM tb_realisasi_faskes WHERE bulan='$bulan' AND kode_seksi='$kode_seksi'")->row();

        if ($data_rak->jumlah != "") {
            $total_rak = $data_rak->jumlah;
        } else {
            $total_rak = 0;
        }

        if ($total_rak > 0 && $total_real >= 0) {
            $persen = ($total_real / $total_rak) * 100;
        } elseif ($total_rak == 0) {
            $persen = 0;
        } else {
            $persen = 100;
        }

        return number_format($persen, 2, ".", ",");
    }

    private function _get_persen_kinerja_akumulasi($kode_seksi, $bulan)
    {
        $data_real = $this->db->get_where("tb_sub_kegiatan", ["kode_seksi" => $kode_seksi])->result();

        $total_real = 0;
        foreach ($data_real as $key) {
            $data2 = $this->db->query("SELECT SUM(nominal) as jumlah FROM tb_spj WHERE MONTH(tgl_transfer) <= '$bulan' AND status_spj='4' AND id_sub_kegiatan='$key->id_sub_kegiatan'")->row();

            if ($data2->jumlah != "") {
                $total_real = $total_real + $data2->jumlah;
            } else {
                $total_real = $total_real + 0;
            }
        }

        $total_rak = 0;
        for ($i = 1; $i <= $bulan; $i++) {
            $data_rak = $this->db->get_where("tb_sub_kegiatan", ["kode_seksi" => $kode_seksi])->result();

            $kolom = "b" . sprintf("%02s", $i);
            foreach ($data_rak as $key) {
                $data2 = $this->db->query("SELECT SUM($kolom) as jumlah FROM tb_rak WHERE id_sub_kegiatan='$key->id_sub_kegiatan'")->row();

                if ($data2->jumlah != "") {
                    $total_rak = $total_rak + $data2->jumlah;
                } else {
                    $total_rak = $total_rak + 0;
                }
            }
        }

        if ($total_rak > 0 && $total_real >= 0) {
            $persen = ($total_real / $total_rak) * 100;
        } elseif ($total_rak == 0) {
            $persen = 0;
        } else {
            $persen = 100;
        }

        return number_format($persen, 2, ".", ",");
    }

    private function _get_persen_kinerja_faskes_akumulasi($kode_seksi, $bulan)
    {
        $data_real = $this->db->query("SELECT SUM(realisasi) as jumlah FROM tb_realisasi_faskes WHERE bulan <= '$bulan' AND kode_seksi='$kode_seksi'")->row();

        if ($data_real->jumlah != "") {
            $total_real = $data_real->jumlah;
        } else {
            $total_real = 0;
        }

        $data_rak = $this->db->query("SELECT SUM(rak) as jumlah FROM tb_realisasi_faskes WHERE bulan <= '$bulan' AND kode_seksi='$kode_seksi'")->row();

        if ($data_rak->jumlah != "") {
            $total_rak = $data_rak->jumlah;
        } else {
            $total_rak = 0;
        }

        if ($total_rak > 0 && $total_real >= 0) {
            $persen = ($total_real / $total_rak) * 100;
        } elseif ($total_rak == 0) {
            $persen = 0;
        } else {
            $persen = 100;
        }

        return number_format($persen, 2, ".", ",");
    }

    private function _get_kinerja_real($kode_bidang, $bulan)
    {
        if ($kode_bidang == "all") {
            $data = $this->db->query("SELECT SUM(nominal) as jumlah FROM tb_spj WHERE MONTH(tgl_transfer)='$bulan' AND status_spj='4'")->row();

            $data2 = $this->db->query("SELECT SUM(realisasi) as jumlah FROM tb_realisasi_faskes WHERE bulan='$bulan'")->row();

            return $data->jumlah + $data2->jumlah;
        } else {
            $total = 0;
            if ($kode_bidang != "DK005") {
                $data = $this->db->query("SELECT SUM(nominal) as jumlah FROM tb_spj WHERE MONTH(tgl_transfer)='$bulan' AND status_spj='4' AND id_sub_kegiatan IN (SELECT a.id_sub_kegiatan FROM tb_sub_kegiatan a, tb_user b WHERE a.kode_seksi=b.kode_seksi AND b.kode_bidang='$kode_bidang')")->row();

                $total = $data->jumlah;
            } else {
                $data = $this->db->query("SELECT SUM(realisasi) as jumlah FROM tb_realisasi_faskes WHERE bulan='$bulan'")->row();

                $total = $data->jumlah;
            }

            return $total;
        }
    }

    private function _get_kinerja_rak($kode_bidang, $bulan)
    {
        $kolom = "b" . $bulan;
        if ($kode_bidang == "all") {
            $data = $this->db->query("SELECT SUM($kolom) as jumlah FROM tb_rak")->row();
            $data2 = $this->db->query("SELECT SUM(rak) as jumlah FROM tb_realisasi_faskes WHERE bulan='$bulan'")->row();

            return $data->jumlah + $data2->jumlah;
        } else {
            $total = 0;
            if ($kode_bidang != "DK005") {
                $data = $this->db->query("SELECT SUM($kolom) as jumlah FROM tb_rak WHERE id_sub_kegiatan IN (SELECT a.id_sub_kegiatan FROM tb_sub_kegiatan a, tb_user b WHERE a.kode_seksi=b.kode_seksi AND b.kode_bidang='$kode_bidang')")->row();

                $total = $data->jumlah;
            } else {
                $data = $this->db->query("SELECT SUM(rak) as jumlah FROM tb_realisasi_faskes WHERE bulan='$bulan'")->row();

                $total = $data->jumlah;
            }

            return $total;
        }
    }

    private function _get_kinerja_akumulasi_real($kode_bidang, $bulan)
    {
        if ($kode_bidang == "all") {
            $data = $this->db->query("SELECT SUM(nominal) as jumlah FROM tb_spj WHERE MONTH(tgl_transfer) <='$bulan' AND status_spj='4'")->row();

            $data2 = $this->db->query("SELECT SUM(realisasi) as jumlah FROM tb_realisasi_faskes WHERE bulan <='$bulan'")->row();

            return $data->jumlah + $data2->jumlah;
        } else {
            $total = 0;
            if ($kode_bidang != "DK005") {
                $data = $this->db->query("SELECT SUM(nominal) as jumlah FROM tb_spj WHERE MONTH(tgl_transfer)<='$bulan' AND status_spj='4' AND id_sub_kegiatan IN (SELECT a.id_sub_kegiatan FROM tb_sub_kegiatan a, tb_user b WHERE a.kode_seksi=b.kode_seksi AND b.kode_bidang='$kode_bidang')")->row();

                $total = $data->jumlah;
            } else {
                $data = $this->db->query("SELECT SUM(realisasi) as jumlah FROM tb_realisasi_faskes WHERE bulan<='$bulan'")->row();

                $total = $data->jumlah;
            }

            return $total;
        }
    }

    private function _get_kinerja_akumulasi_rak($kode_bidang, $bulan)
    {
        if ($kode_bidang == "all") {
            $total_rak = 0;
            for ($i = 1; $i <= $bulan; $i++) {
                $kolom = "b" . sprintf("%02s", $i);
                $data = $this->db->query("SELECT SUM($kolom) as jumlah FROM tb_rak")->row();
                if ($data->jumlah != "") {
                    $total_rak = $total_rak + $data->jumlah;
                } else {
                    $total_rak = $total_rak + 0;
                }
            }
            $data2 = $this->db->query("SELECT SUM(rak) as jumlah FROM tb_realisasi_faskes WHERE bulan<='$bulan'")->row();

            return $total_rak + $data2->jumlah;
        } else {
            $total = 0;
            if ($kode_bidang != "DK005") {
                $total_rak = 0;
                for ($i = 1; $i <= $bulan; $i++) {
                    $kolom = "b" . sprintf("%02s", $i);
                    $data = $this->db->query("SELECT SUM($kolom) as jumlah FROM tb_rak WHERE id_sub_kegiatan IN (SELECT a.id_sub_kegiatan FROM tb_sub_kegiatan a, tb_user b WHERE a.kode_seksi=b.kode_seksi AND b.kode_bidang='$kode_bidang')")->row();
                    if ($data->jumlah != "") {
                        $total_rak = $total_rak + $data->jumlah;
                    } else {
                        $total_rak = $total_rak + 0;
                    }
                }

                $total = $total_rak;
            } else {
                $data = $this->db->query("SELECT SUM(rak) as jumlah FROM tb_realisasi_faskes WHERE bulan<='$bulan'")->row();

                $total = $data->jumlah;
            }

            return $total;
        }
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
}

/* End of file M_service.php */
