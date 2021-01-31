<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard extends CI_Model
{

    public function get_seksi()
    {
        $this->update();
        $kode_seksi = $this->session->userdata("kode_seksi");
        $kode_bidang = $this->session->userdata("kode_bidang");
        if ($kode_bidang == "DK005") {
            $this->db->where("kode_seksi", $kode_seksi);
        } elseif ($kode_seksi != "XXXX" && $kode_bidang != "DK005") {
            $this->db->not_like("nama", "PKM");
        }

        $this->db->order_by("persen_anggaran", "DESC");
        $data = $this->db->get("tb_realisasi_seksi")->result();

        return $data;
    }

    public function get_sub_kegiatan($kode_seksi)
    {
        $data = $this->db->get_where("view_sub_kegiatan", ["kode_seksi" => $kode_seksi])->result();

        $no = 0;
        $hsl = array();
        foreach ($data as $key) {
            $real = $this->get_real_by_id($kode_seksi, $key->id_sub_kegiatan);
            $sisa = $this->get_sisa($key->pagu_anggaran, $real);
            $persen = $this->get_persen($key->pagu_anggaran, $real);
            $hsl[$no++] = array(
                "id_sub_kegiatan" => $key->id_sub_kegiatan,
                "kode_seksi" => $key->kode_seksi,
                "nama_sub_kegiatan" => $key->nama_sub_kegiatan,
                "pagu_anggaran" => $key->pagu_anggaran,
                "realisasi" => $real,
                "sisa" => $sisa,
                "persen" => $persen,
            );
        }

        return $hsl;
    }

    public function get_rekening($id_sub_kegiatan)
    {
        $data = $this->db->get_where("tb_rekening", ["id_sub_kegiatan" => $id_sub_kegiatan])->result();

        $no = 0;
        $hsl = array();
        foreach ($data as $key) {
            $real = $this->get_real_by_rek($key->id_rekening);
            $sisa = $this->get_sisa($key->pagu_rekening, $real);
            $persen = $this->get_persen($key->pagu_rekening, $real);
            $hsl[$no++] = array(
                "id_rekening" => $key->id_rekening,
                "id_sub_kegiatan" => $key->id_sub_kegiatan,
                "kode_rekening" => $key->kode_rekening,
                "nama_rekening" => $key->nama_rekening,
                "pagu_rekening" => $key->pagu_rekening,
                "realisasi" => $real,
                "sisa" => $sisa,
                "persen" => $persen,
            );
        }

        return $hsl;
    }

    public function get_detail_rekening($id_rekening)
    {
        $this->db->from("view_spj_verif_bidang");
        $this->db->where("id_rekening", $id_rekening);
        $this->db->where("status_spj", 4);

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

    // PRIVATE
    private function update()
    {
        $data = $this->db->get_where("tb_user", ["kode_seksi !=" => "XXXX"])->result();

        // $this->db->truncate('tb_realisasi_seksi');
        foreach ($data as $row) {
            $pagu_anggaran = $this->get_pagu($row->kode_seksi);
            $real_anggaran = $this->get_real($row->kode_seksi);
            $sisa_anggaran = $this->get_sisa($pagu_anggaran, $real_anggaran);
            $persen_anggaran = $this->get_persen($pagu_anggaran, $real_anggaran);

            $where = array(
                "kode_seksi" => $row->kode_seksi,
            );
            $data = array(
                "kode_seksi" => $row->kode_seksi,
                "nama" => $row->nama,
                "pagu_anggaran" => $pagu_anggaran,
                "real_anggaran" => $real_anggaran,
                "sisa_anggaran" => $sisa_anggaran,
                "persen_anggaran" => number_format($persen_anggaran, 2, ".", ","),
            );

            $cek = $this->db->get_where("tb_realisasi_seksi", $where)->num_rows();
            if ($cek > 0) {
                $this->db->update("tb_realisasi_seksi", $data, $where);
            } else {
                $this->db->insert("tb_realisasi_seksi", $data);
            }
        }
    }

    private function get_pagu($kode_seksi)
    {
        // $data = $this->db->query("SELECT SUM(pagu_anggaran) AS pagu FROM view_sub_kegiatan WHERE kode_seksi='$kode_seksi' GROUP BY kode_seksi")->row();
        $data = $this->db->get_where("tb_sub_kegiatan", ["kode_seksi" => $kode_seksi])->result();

        $total = 0;
        foreach ($data as $key) {
            $dt = $this->_get_pagu_sub_keg($key->id_sub_kegiatan);

            $total = $total + $dt;
        }

        return $total;
    }

    private function get_real($kode_seksi)
    {
        $data = $this->db->query("SELECT * FROM view_sub_kegiatan WHERE kode_seksi='$kode_seksi'")->result();

        $total = 0;
        foreach ($data as $row) {
            $real = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_spj WHERE kode_seksi='$kode_seksi' AND id_sub_kegiatan='$row->id_sub_kegiatan' AND status_spj='4' GROUP BY id_sub_kegiatan");

            if ($real->num_rows() > 0) {
                $r = $real->row();
                $total = $total + $r->nominal;
            }
        }

        return $total;
    }

    private function get_real_by_id($kode_seksi, $id_sub_kegiatan)
    {
        $real = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_spj WHERE kode_seksi='$kode_seksi' AND id_sub_kegiatan='$id_sub_kegiatan' AND status_spj='4' GROUP BY id_sub_kegiatan");

        $total = 0;
        if ($real->num_rows() > 0) {
            $r = $real->row();
            $total = $r->nominal;
        }
        return $total;
    }

    private function get_real_by_rek($id_rekening)
    {
        $real = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_spj WHERE id_rekening='$id_rekening' AND status_spj='4' GROUP BY id_rekening");

        $total = 0;
        if ($real->num_rows() > 0) {
            $r = $real->row();
            $total = $r->nominal;
        }
        return $total;
    }

    private function get_sisa($pagu, $real)
    {
        $hsl = $pagu - $real;
        return $hsl;
    }

    private function get_persen($pagu, $real)
    {
        $hsl = 0;
        if ($pagu > 0) {
            $hsl = ($real / $pagu) * 100;
        }

        return $hsl;
    }

    private function _get_pagu_sub_keg($id_sub_kegiatan)
    {
        $total = 0;
        $dt = $this->db->query("SELECT SUM(pagu_rekening) as total FROM tb_rekening WHERE id_sub_kegiatan='$id_sub_kegiatan'")->row();

        $total = $total + $dt->total;
        return $total;
    }
}

/* End of file M_dashboard.php */
