<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_rok extends CI_Model
{

    public function get_sub_kegiatan($kode_seksi)
    {
        // if ($kode_seksi != "DJ001") {
        $data = $this->db->get_where("tb_sub_kegiatan", ["kode_seksi" => $kode_seksi])->result();
        // } else {
        //     $data = $this->db->get_where("tb_sub_kegiatan")->result();
        // }

        return $data;
    }

    public function get_sub_kegiatan_bagi()
    {
        $data = $this->db->get_where("tb_sub_kegiatan", ["bagi" => 1])->result();

        return $data;
    }

    public function get_bulan($id, $kode_seksi)
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
        foreach ($bulan as $key => $val) {
            $hsl[$no++] = array(
                "kode_bulan" => $key,
                "nama_bulan" => $val,
                "realisasi" => $this->get_nom_realisasi($id, $key, $kode_seksi),
                "rok" => $this->get_nom_rok($id, $kode_seksi, $key),
                "valid" => $this->get_rok_valid($id, $kode_seksi, $key),
            );
        }

        return $hsl;
    }

    public function get_rok($id_sub, $bulan, $kode_seksi)
    {
        if (($id_sub == 3 || $id_sub == 7) && $kode_seksi != "DJ002") {
            $rekening = $this->db->get_where("tb_rekening", ["id_sub_kegiatan" => $id_sub, "cek >=" => 1])->result();
        } else {
            $rekening = $this->db->get_where("tb_rekening", ["id_sub_kegiatan" => $id_sub])->result();
        }

        $no = 0;
        foreach ($rekening as $row) {
            $hsl[$no++] = array(
                "kode_rekening" => $row->kode_rekening,
                "nama_rekening" => $row->nama_rekening,
                "total_rok" => $this->get_nom_rok_data($id_sub, $row->id_rekening, $bulan, $kode_seksi),
                "rok" => $this->get_rok_data($id_sub, $row->id_rekening, $bulan, $kode_seksi),
            );
        }
        return $hsl;
    }

    public function get_kegiatan($id_sub)
    {
        $this->db->select("*");
        $this->db->from("tb_sub_kegiatan");
        $this->db->join("tb_kegiatan", "tb_sub_kegiatan.id_kegiatan = tb_kegiatan.id_kegiatan");
        $this->db->where("tb_sub_kegiatan.id_sub_kegiatan", $id_sub);

        $data = $this->db->get()->row();

        return $data;
    }

    public function get_seksi($kode_seksi)
    {
        $data = $this->db->get_where("tb_user", ["kode_seksi" => $kode_seksi])->row();

        return $data;
    }

    public function get_valid_bend($id_sub_kegiatan, $kode_seksi, $bln)
    {
        $bulan = "b" . $bln;
        $data = $this->db->get_where("tb_rok_valid", ["id_sub_kegiatan" => $id_sub_kegiatan, "kode_seksi" => $kode_seksi])->row();

        return $data->$bulan;
    }

    public function get_jml_rok($id_sub_kegiatan, $kode_seksi, $bln)
    {
        $data = $this->db->query("SELECT SUM(nominal) as total FROM tb_rok WHERE id_sub_kegiatan='$id_sub_kegiatan' AND kode_seksi='$kode_seksi' AND bulan='$bln'")->row();
        if ($data->total != "") {
            return $data->total;
        } else {
            return 0;
        }
    }

    public function get_jml_rak($id_sub_kegiatan, $bln)
    {
        $bulan = "b" . $bln;
        $data = $this->db->get_where("tb_rak", ["id_sub_kegiatan" => $id_sub_kegiatan]);
        if ($data->num_rows() > 0) {
            $x = $data->row();

            return $x->$bulan;
        } else {
            return 0;
        }
    }


    public function get_sisa_bulan_lalu($id_sub, $bln_sblm, $kode_seksi)
    {
        if ($bln_sblm > 0) {
            $total = 0;
            for ($i = 1; $i < $bln_sblm; $i++) {
                $bln = sprintf("%02s", $i);
                $tbl = "b" . $bln;

                $valid = $this->db->query("SELECT $tbl as cek FROM tb_rok_valid WHERE id_sub_kegiatan='$id_sub' AND kode_seksi='$kode_seksi'")->row();

                if ($valid->cek == 1) {
                    $rok = $this->db->query("SELECT SUM(nominal) as nom FROM tb_rok WHERE id_sub_kegiatan='$id_sub' AND kode_seksi='$kode_seksi' AND bulan='$bln' AND id_rok NOT IN (SELECT id_rok FROM tb_spj WHERE status_spj='4')")->row();

                    $total = $total + $rok->nom;
                }
            }

            return $total;
        } else {
            return 0;
        }
    }

    // CRUD
    public function save($post)
    {
        $data = array(
            "id_sub_kegiatan" => $post["id_sub_kegiatan"],
            "id_rekening" => $post["id_rekening"],
            "kode_seksi" => $post["kode_seksi"],
            "bulan" => $post["bulan"],
            "uraian" => $post["uraian"],
            "nominal" => $post["nominal"],
            "keterangan" => $post["keterangan"],
        );

        if ($post["id_rekening"] == "") {
            return array("res" => 0, "msg" => "Kode Rekening Tidak Boleh Kosong");
        }
        if ($post["uraian"] == "") {
            return array("res" => 0, "msg" => "Uraian Kegiatan Tidak Boleh Kosong");
        }
        if ($post["nominal"] == "") {
            return array("res" => 0, "msg" => "Nominal Kegiatan Tidak Boleh Kosong");
        }

        $cek = $this->cek_pagu($post["id_rekening"], $post["nominal"], $post["bulan"]);
        if ($cek) {
            return array("res" => 0, "msg" => "Nominal Melebihi Sisa Pagu Anggaran");
        }

        $hasil = $this->db->insert("tb_rok", $data);

        if ($hasil) {
            return array("res" => 1, "msg" => "Data ROK Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "Data ROK Gagal Disimpan");
        }
    }

    public function update($id, $post)
    {
        $where = array(
            "id_rok" => $id
        );
        $data = array(
            "id_rekening" => $post["id_rekening"],
            "uraian" => $post["uraian"],
            "nominal" => $post["nominal"],
            "keterangan" => $post["keterangan"],
        );

        if ($post["id_rekening"] == "") {
            return array("res" => 0, "msg" => "Kode Rekening Tidak Boleh Kosong");
        }
        if ($post["uraian"] == "") {
            return array("res" => 0, "msg" => "Uraian Kegiatan Tidak Boleh Kosong");
        }
        if ($post["nominal"] == "") {
            return array("res" => 0, "msg" => "Nominal Kegiatan Tidak Boleh Kosong");
        }

        $cek = $this->cek_pagu($post["id_rekening"], $post["nominal"], $post["bulan"], $post["nominal_lama"]);
        if ($cek) {
            return array("res" => 0, "msg" => "Nominal Melebihi Sisa Pagu Anggaran");
        }

        $hasil = $this->db->update("tb_rok", $data, $where);

        if ($hasil) {
            return array("res" => 1, "msg" => "Data ROK Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "Data ROK Gagal Disimpan");
        }
    }

    public function delete($id)
    {
        $where = array(
            "id_rok" => $id,
        );

        $hasil = $this->db->delete('tb_rok', $where);

        if ($hasil) {
            return array("res" => 1, "msg" => "Data ROK Berhasil Dihapus");
        } else {
            return array("res" => 0, "msg" => "Data ROK Gagal Dihapus");
        }
    }

    public function valid($id_sub, $bulan, $kode_seksi)
    {
        $tbl = "b" . $bulan;
        $hasil = $this->db->query("UPDATE tb_rok_valid SET $tbl='1' WHERE id_sub_kegiatan='$id_sub' AND kode_seksi='$kode_seksi'");

        if ($hasil) {
            return array("res" => 1, "msg" => "Data ROK Berhasil Divalidasi");
        } else {
            return array("res" => 0, "msg" => "Data ROK Gagal Divalidasi");
        }
    }

    public function valid_bend($id_sub, $bulan, $kode_seksi)
    {
        $tbl = "b" . $bulan;
        $hasil = $this->db->query("UPDATE tb_rok_valid SET $tbl='2' WHERE id_sub_kegiatan='$id_sub' AND kode_seksi='$kode_seksi'");

        if ($hasil) {
            return array("res" => 1, "msg" => "Data ROK Berhasil Divalidasi");
        } else {
            return array("res" => 0, "msg" => "Data ROK Gagal Divalidasi");
        }
    }

    public function batal($id_sub, $bulan, $kode_seksi)
    {
        $tbl = "b" . $bulan;
        $hasil = $this->db->query("UPDATE tb_rok_valid SET $tbl='0' WHERE id_sub_kegiatan='$id_sub' AND kode_seksi='$kode_seksi'");

        if ($hasil) {
            return array("res" => 1, "msg" => "Data ROK Berhasil Dibatalkan");
        } else {
            return array("res" => 0, "msg" => "Data ROK Gagal Dibatalkan");
        }
    }

    public function blok($blok, $id_rok)
    {
        $bl = ($blok) ? "Diblokir" : "Dibuka";

        $data = array(
            "blok" => $blok
        );

        $where = array(
            "id_rok" => $id_rok
        );

        $hasil = $this->db->update("tb_rok", $data, $where);

        if ($hasil) {
            return array("res" => 1, "msg" => "Data ROK Berhasil " . $bl);
        } else {
            return array("res" => 0, "msg" => "Data ROK Gagal " . $bl);
        }
    }

    // PRIVATE
    private function get_nom_realisasi($id_sub, $bulan, $kode_seksi)
    {
        $this->db->select("SUM(nominal) as nominal");
        $this->db->from("tb_spj");
        $this->db->where("id_sub_kegiatan", $id_sub);
        $this->db->where("kode_seksi", $kode_seksi);
        $this->db->where("MONTH(tgl_kegiatan)", $bulan);
        $this->db->where("status_spj", 4);
        $data = $this->db->get()->row();

        if ($data->nominal != "") {
            return $data->nominal;
        } else {
            return 0;
        }
    }

    private function get_nom_rok($id_sub, $kode_seksi, $bulan)
    {
        $this->db->select("SUM(nominal) as nominal");
        $this->db->from("tb_rok");
        $this->db->where("id_sub_kegiatan", $id_sub);
        $this->db->where("kode_seksi", $kode_seksi);
        $this->db->where("bulan", $bulan);
        $data = $this->db->get()->row();

        if ($data->nominal != "") {
            return $data->nominal;
        } else {
            return 0;
        }
    }

    private function get_rok_data($id_sub, $id_rekening, $bulan, $kode_seksi)
    {
        $data = $this->db->get_where("tb_rok", ["id_sub_kegiatan" => $id_sub, "bulan" => $bulan, "kode_seksi" => $kode_seksi, "id_rekening" => $id_rekening, "jenis_spj" => 0])->result();

        return $data;
    }

    private function get_nom_rok_data($id_sub, $id_rekening, $bulan, $kode_seksi)
    {
        $this->db->select("SUM(nominal) as nominal");
        $this->db->from("tb_rok");
        $this->db->where("id_sub_kegiatan", $id_sub);
        $this->db->where("kode_seksi", $kode_seksi);
        $this->db->where("bulan", $bulan);
        $this->db->where("id_rekening", $id_rekening);
        $this->db->where("jenis_spj", 0);
        $data = $this->db->get()->row();

        if ($data->nominal != "") {
            return $data->nominal;
        } else {
            return 0;
        }
    }

    private function get_rok_valid($id_sub, $kode_seksi, $bulan)
    {
        $tbl = "b" . $bulan;
        $data = $this->db->query("SELECT $tbl AS bulan FROM tb_rok_valid WHERE id_sub_kegiatan='$id_sub' AND kode_seksi='$kode_seksi'")->row();

        return $data->bulan;
    }

    private function cek_pagu($id_rekening, $nominal, $bln, $nominal_lama = 0)
    {
        $rekening = $this->db->get_where("tb_rekening", ["id_rekening" => $id_rekening])->row();

        $this->db->select("SUM(nominal) as nominal");
        $this->db->from("tb_spj");
        $this->db->where("id_rekening", $id_rekening);
        $this->db->where("status_spj", 4);
        $real = $this->db->get()->row();

        $this->db->select("SUM(nominal) as nominal");
        $this->db->from("tb_rok");
        $this->db->where("id_rekening", $id_rekening);
        $this->db->where("bulan", $bln);
        $rok = $this->db->get()->row();

        $sisa = $rekening->pagu_rekening - (($real->nominal + $rok->nominal) - $nominal_lama);

        if ($sisa < $nominal) {
            return 1;
        } else {
            return 0;
        }
    }
}

/* End of file M_rok.php */
