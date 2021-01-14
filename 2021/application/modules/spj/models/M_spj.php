<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_spj extends CI_Model
{

    public function get_min_tgl()
    {
        $data = $this->db->get_where("tb_pengaturan", ["nama_pengaturan" => "setor"])->row();

        $min = $data->nilai_pengaturan . " " . $data->satuan_pengaturan;

        return $min;
    }

    public function get_sub_kegiatan($kode_seksi)
    {
        $data = $this->db->get_where("tb_sub_kegiatan", ["kode_seksi" => $kode_seksi])->result();

        return $data;
    }

    public function get_rekening($id_sub_kegiatan)
    {
        $data = $this->db->get_where("tb_rekening", ["id_sub_kegiatan" => $id_sub_kegiatan])->result();

        return $data;
    }

    public function get_rok($id_rekening)
    {
        $data = $this->db->get_where("tb_rok", ["id_rekening" => $id_rekening])->result();

        return $data;
    }

    public function get_spj($kode_seksi)
    {
        $this->db->order_by("tgl_daftar", "DESC");
        $data = $this->db->get_where("tb_spj", ["kode_seksi" => $kode_seksi])->result();

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

    // CRUD
    public function save($post)
    {
        $jml_pelaksana = count($post["id_pelaksana"]);
        if ($jml_pelaksana <= 0) {
            return array("res" => 0, "msg" => "Pelaksana Harus Dipilih");
        }

        $cek_pl = $this->cek_pelaksana_2($post["id_pelaksana"]);
        if ($cek_pl) {
            return array("res" => 0, "msg" => "Cek Nama Pelaksana. Nama Pelaksana duplikat");
        }

        $cek_pelaksana = $this->cek_pelaksana($post["id_pelaksana"], $post["id_rekening"], $post["tgl_kegiatan"]);
        if ($cek_pelaksana) {
            return array("res" => 0, "msg" => "Cek Nama Pelaksana. Nama Pelaksana Sudah digunakan pada tanggal " . $post["tgl_kegiatan"]);
        }

        $total = 0;
        foreach ($post["nominal_pelaksana"] as $key => $val) {
            $total = $total + $val;
        }
        if ($total != $post["nominal"]) {
            return array("res" => 0, "msg" => "Total Nominal Pelaksana TIDAK SAMA dengan Total Nominal Kegiatan");
        }

        $min = $this->get_min_tgl();
        $min_tgl = date('Y-m-d', strtotime($min));
        if (strtotime($min_tgl) > strtotime($post["tgl_kegiatan"])) {
            return array("res" => 0, "msg" => "Tanggal Kegiatan Melebihi batas waktu pendaftaran SPJ");
        }

        if (empty($_FILES['dokumen_spj']['name'])) {
            return array("res" => 0, "msg" => "Wajib Melampirkan Dokumen SPJ");
        } else {
            $nama_file = ($post["jenis_spj"] == "0") ? "SPJ-GU" : "SPJ-LS";
            $hasil = json_decode($this->_uploadFile($nama_file), true);

            if ($hasil["res"]) {
                $dokumen_spj = $hasil["name_file"];
            } else {
                return array("res" => 0, "msg" => "File tidak Dijinkan. Error : " . $hasil["msg"]);
            }
        }

        $kode_seksi = $this->session->userdata("kode_seksi");
        $data = array(
            "kode_spj" => $post["id_unik"],
            "id_sub_kegiatan" => $post["id_sub_kegiatan"],
            "id_rekening" => $post["id_rekening"],
            "id_rok" => $post["id_rok"],
            "kode_seksi" => $kode_seksi,
            "jenis_spj" => $post["jenis_spj"],
            "tgl_kegiatan" => $post["tgl_kegiatan"],
            "uraian" => $post["uraian"],
            "nominal" => $post["nominal"],
            "dokumen_spj" => $dokumen_spj,
            "tgl_daftar" => date("Y-m-d H:i:s"),
        );

        $hasil = $this->db->insert('tb_spj', $data);
        if ($hasil) {
            $this->_insert_pelaksana($post["id_pelaksana"], $post["nominal_pelaksana"], $post["pihak_ketiga"], $post["id_unik"]);
            return array("res" => 1, "msg" => "SPJ Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "SPJ Gagal Disimpan");
        }
    }

    public function edit($kode_spj, $post)
    {
        $jml_pelaksana = count($post["id_pelaksana"]);
        if ($jml_pelaksana <= 0) {
            return array("res" => 0, "msg" => "Pelaksana Harus Dipilih");
        }

        $cek_pl = $this->cek_pelaksana_2($post["id_pelaksana"]);
        if ($cek_pl) {
            return array("res" => 0, "msg" => "Cek Nama Pelaksana. Nama Pelaksana duplikat");
        }

        $cek_pelaksana = $this->cek_pelaksana($post["id_pelaksana"], $post["id_rekening"], $post["tgl_kegiatan"]);
        if ($cek_pelaksana) {
            return array("res" => 0, "msg" => "Cek Nama Pelaksana. Nama Pelaksana Sudah digunakan pada tanggal " . $post["tgl_kegiatan"]);
        }

        $total = 0;
        foreach ($post["nominal_pelaksana"] as $key => $val) {
            $total = $total + $val;
        }
        if ($total != $post["nominal"]) {
            return array("res" => 0, "msg" => "Total Nominal Pelaksana TIDAK SAMA dengan Total Nominal Kegiatan");
        }

        $min = $this->get_min_tgl();
        $min_tgl = date('Y-m-d', strtotime($min));
        if (strtotime($min_tgl) > strtotime($post["tgl_kegiatan"])) {
            return array("res" => 0, "msg" => "Tanggal Kegiatan Melebihi batas waktu pendaftaran SPJ");
        }

        if ($post["dokumen_up"] == "1") {
            if (empty($_FILES['dokumen_spj']['name'])) {
                return array("res" => 0, "msg" => "Wajib Melampirkan Dokumen SPJ");
            } else {
                $nama_file = ($post["jenis_spj"] == "0") ? "SPJ-GU" : "SPJ-LS";
                $hasil = json_decode($this->_uploadFile($nama_file), true);

                if ($hasil["res"]) {
                    $dokumen_spj = $hasil["name_file"];
                    $this->_deleteFile($post["dokumen_old"]);
                } else {
                    return array("res" => 0, "msg" => "File tidak Dijinkan. Error : " . $hasil["msg"]);
                }
            }
        } else {
            $dokumen_spj = $post["dokumen_old"];
        }

        $kode_seksi = $this->session->userdata("kode_seksi");
        $where = array(
            "kode_spj" => $kode_spj
        );
        $data = array(
            "id_sub_kegiatan" => $post["id_sub_kegiatan"],
            "id_rekening" => $post["id_rekening"],
            "id_rok" => $post["id_rok"],
            "kode_seksi" => $kode_seksi,
            "jenis_spj" => $post["jenis_spj"],
            "tgl_kegiatan" => $post["tgl_kegiatan"],
            "uraian" => $post["uraian"],
            "nominal" => $post["nominal"],
            "dokumen_spj" => $dokumen_spj,
            "tgl_daftar" => date("Y-m-d H:i:s"),
        );

        $hasil = $this->db->update('tb_spj', $data, $where);
        if ($hasil) {
            $this->db->delete("tb_spj_detail", $where);
            $this->_insert_pelaksana($post["id_pelaksana"], $post["nominal_pelaksana"], $post["pihak_ketiga"], $kode_spj);
            return array("res" => 1, "msg" => "SPJ Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "SPJ Gagal Disimpan");
        }
    }

    public function delete($kode_spj)
    {
        $where = array(
            "kode_spj" => $kode_spj
        );

        $data = $this->db->get_where("tb_spj", ["kode_spj" => $kode_spj])->row();
        $this->_deleteFile($data->dokumen_spj);

        $hasil = $this->db->delete('tb_spj', $where);
        if ($hasil) {
            $this->db->delete("tb_spj_detail", $where);
            return array("res" => 1, "msg" => "SPJ Berhasil Dihapus");
        } else {
            return array("res" => 0, "msg" => "SPJ Gagal Dihapus");
        }
    }

    private function _uploadFile($name)
    {
        $config['upload_path'] = './assets/upload/';
        $config['file_name'] = $name . '-' . date("Ymd His");
        $config['allowed_types'] = 'pdf';
        $config['max_size']  = '10000';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('dokumen_spj')) {
            $msg = array("res" => 0, "msg" => $this->upload->display_errors());
        } else {
            $msg = array("res" => 1, "name_file" => $this->upload->data('file_name'));
        }

        return json_encode($msg);
    }

    private function _deleteFile($name)
    {
        return unlink("./assets/upload/" . $name);
    }

    private function cek_pelaksana($pelaksana, $id_rekening, $tgl_kegiatan)
    {
        $data = $this->db->get_where("tb_rekening", ["id_rekening" => $id_rekening])->row();

        if ($data->cek) {
            $kode_rekening = $data->kode_rekening;
            foreach ($pelaksana as $key => $val) {
                $data2 = $this->db->get_where("view_spj_rekening", ["id_pegawai" => $val, "kode_rekening" => $kode_rekening, "tgl_kegiatan" => $tgl_kegiatan]);
                if ($data2->num_rows() > 0) {
                    return 1;
                    break;
                } else {
                    return 0;
                    continue;
                }
            }
        } else {
            return 0;
        }
    }

    private function cek_pelaksana_2($pelaksana)
    {
        $jml = count($pelaksana);
        for ($i = 0; $i < $jml; $i++) {
            if ($i > 0) {
                $ii = $i - 1;
                if ($pelaksana[$i] == $pelaksana[$ii]) {
                    return 1;
                    break;
                } else {
                    return 0;
                    continue;
                }
            }
        }
    }

    private function _insert_pelaksana($id_pelaksana, $nominal, $pihak_ketiga, $id_unik)
    {
        $jml = count($id_pelaksana);
        if ($jml > 0) {
            for ($i = 0; $i < $jml; $i++) {
                $data = array(
                    "kode_spj" => $id_unik,
                    "id_pegawai" => $id_pelaksana[$i],
                    "nominal" => $nominal[$i],
                    "pihak_ketiga" => $pihak_ketiga[$i],
                );

                $this->db->insert("tb_spj_detail", $data);
            }
        }
    }

    public function get_pelaksana($kode_spj)
    {
        $data = $this->db->get_where("view_spj_rekening", ["kode_spj" => $kode_spj])->result();

        return $data;
    }
}

/* End of file M_spj.php */