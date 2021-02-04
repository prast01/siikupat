<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_lain extends CI_Model
{

    public function get_pengaturan()
    {
        $data = $this->db->get("tb_pengaturan")->result();

        return $data;
    }

    public function get_spj()
    {
        $this->db->order_by("tgl_daftar", "DESC");
        $data = $this->db->get_where("view_spj_verif_bidang", ["hapus" => 1])->result();

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
            } elseif ($row->jenis_spj == "1") {
                $jenis = "LS";
            } elseif ($row->jenis_spj == "2") {
                $jenis = "TU";
            }

            if ($row->kode_bidang == "DK001") {
                $bd = "1-";
            } elseif ($row->kode_bidang == "DK002") {
                $bd = "2-";
            } elseif ($row->kode_bidang == "DK003") {
                $bd = "3-";
            } elseif ($row->kode_bidang == "DK004") {
                $bd = "4-";
            } elseif ($row->kode_bidang == "DK005") {
                $bd = "5-";
            }


            $hsl[$no++] = array(
                "no_spj" => $jenis . sprintf("%05s", $row->id_spj),
                "no_seksi" => $bd . $jenis . sprintf("%05s", $row->nomor_spj),
                "kode_spj" => $row->kode_spj,
                "tgl_kegiatan" => date("d-m-Y", strtotime($row->tgl_kegiatan)),
                "uraian" => $row->uraian,
                "nominal" => number_format($row->nominal, 0, ",", "."),
                "status_spj" => $row->status_spj,
                "nama_status" => $nama_status,
                "tanggal" => $tgl,
                "verif_spj" => $row->verif_spj,
            );
        }

        return $hsl;
    }

    public function save($post)
    {
        $data = array(
            "nama_pengaturan" => $post["nama_pengaturan"],
            "nilai_pengaturan" => $post["nilai_pengaturan"],
            "satuan_pengaturan" => $post["satuan_pengaturan"],
        );

        if ($post['nama_pengaturan'] == "") {
            return array("res" => 0, "msg" => "Nama Pengaturan Harus Terisi");
        }
        if ($post['nilai_pengaturan'] == "") {
            return array("res" => 0, "msg" => "Nilai Pengaturan Harus Terisi");
        }
        if ($post['satuan_pengaturan'] == "") {
            return array("res" => 0, "msg" => "Satuan Pengaturan Harus Terisi");
        }

        $hasil = $this->db->insert('tb_pengaturan', $data);

        if ($hasil) {
            return array("res" => 1, "msg" => "Pengaturan Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "Pengaturan Gagal Disimpan");
        }
    }

    public function update($id, $post)
    {
        $where = array(
            "id_pengaturan" => $id,
        );
        $data = array(
            "nama_pengaturan" => $post["nama_pengaturan"],
            "nilai_pengaturan" => $post["nilai_pengaturan"],
            "satuan_pengaturan" => $post["satuan_pengaturan"],
        );

        if ($post['nama_pengaturan'] == "") {
            return array("res" => 0, "msg" => "Nama Pengaturan Harus Terisi");
        }
        if ($post['nilai_pengaturan'] == "") {
            return array("res" => 0, "msg" => "Nilai Pengaturan Harus Terisi");
        }
        if ($post['satuan_pengaturan'] == "") {
            return array("res" => 0, "msg" => "Satuan Pengaturan Harus Terisi");
        }

        $hasil = $this->db->update('tb_pengaturan', $data, $where);

        if ($hasil) {
            return array("res" => 1, "msg" => "Pengaturan Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "Pengaturan Gagal Disimpan");
        }
    }

    public function status($id, $post)
    {
        $where = array(
            "id_pengaturan" => $id,
        );
        $data = array(
            "aktif" => $post["aktif"],
        );

        $hasil = $this->db->update('tb_pengaturan', $data, $where);

        if ($hasil) {
            return array("res" => 1, "msg" => "Pengaturan Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "Pengaturan Gagal Disimpan");
        }
    }

    public function delete($id)
    {
        $where = array(
            "id_pengaturan" => $id,
        );

        $hasil = $this->db->delete('tb_pengaturan', $where);

        if ($hasil) {
            return array("res" => 1, "msg" => "Pengaturan Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "Pengaturan Gagal Disimpan");
        }
    }

    public function pulihkan($kode_spj)
    {
        $where = array(
            "kode_spj" => $kode_spj,
        );
        $data = array(
            "hapus" => 0,
            "pulih" => 1,
        );

        $hasil = $this->db->update('tb_spj', $data, $where);

        if ($hasil) {
            return array("res" => 1, "msg" => "Pemulihan SPJ Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "Pemulihan SPJ Gagal Disimpan");
        }
    }
}

/* End of file M_lain.php */
