<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_belanja extends CI_Model
{

    public function get_belanja($bulan, $jenis)
    {
        $kode_pusk = $this->session->userdata("kode_pusk");
        $this->db->select("*");
        $this->db->from('tb_belanja');
        $this->db->where("jenis_sumber", $jenis);
        $this->db->where("kode_pusk", $kode_pusk);
        if ($bulan != "all") {
            $this->db->where("MONTH(tgl_belanja)", $bulan);
        }

        $data = $this->db->get()->result();

        $no = 0;
        $i = 1;
        $hsl = array();
        foreach ($data as $key) {
            $hsl[$no++] = array(
                "no_spj" => $jenis . "-" . sprintf("%03s", $i++),
                "id_belanja" => $key->id_belanja,
                "tgl_belanja" => $key->tgl_belanja,
                "uraian" => $key->uraian_belanja,
                "nominal" => $key->nominal_belanja,
            );
        }

        return $hsl;
    }

    // CRUD
    public function saveBelanja($post, $kode_pusk, $jenis)
    {
        if ($post["tgl_belanja"] == "") {
            return array("res" => 0, "msg" => "Tanggal Belanja Belum diisi.");
        }

        if ($post["kode_rekening"] == "") {
            return array("res" => 0, "msg" => "Rekening Belum diisi.");
        }

        if ($post["uraian_belanja"] == "") {
            return array("res" => 0, "msg" => "Uraian Belanja Belum diisi.");
        }

        if ($post["nominal_belanja"] == "") {
            return array("res" => 0, "msg" => "Nominal Belanja Belum diisi.");
        }

        if (empty($_FILES['dok_belanja']['name'])) {
            return array("res" => 0, "msg" => "Wajib Melampirkan Dokumen SPJ");
        } else {
            $hasil = json_decode($this->_uploadFile($jenis), true);

            if ($hasil["res"]) {
                $dokumen = $hasil["name_file"];
            } else {
                return array("res" => 0, "msg" => "File tidak Dijinkan. Error : " . $hasil["msg"]);
            }
        }

        if ($jenis == "BLUD") {
            if ($post["id_jenis_pendapatan"] == "") {
                return array("res" => 0, "msg" => "Jenis Pendapatan Belum diisi.");
            }

            $dt = array(
                "kode_pusk" => $kode_pusk,
                "jenis_sumber" => $jenis,
                "id_jenis_pendapatan" => $post["id_jenis_pendapatan"],
                "kode_rekening" => $post["kode_rekening"],
                "uraian_belanja" => $post["uraian_belanja"],
                "nominal_belanja" => $post["nominal_belanja"],
                "tgl_belanja" => $post["tgl_belanja"],
                "dok_belanja" => $dokumen,
            );
        } else {
            if ($post["id_sub_kegiatan"] == "") {
                return array("res" => 0, "msg" => "Sub Kegiatan Belum diisi.");
            }

            $dt = array(
                "kode_pusk" => $kode_pusk,
                "jenis_sumber" => $jenis,
                "id_sub_kegiatan" => $post["id_sub_kegiatan"],
                "kode_rekening" => $post["kode_rekening"],
                "uraian_belanja" => $post["uraian_belanja"],
                "nominal_belanja" => $post["nominal_belanja"],
                "tgl_belanja" => $post["tgl_belanja"],
                "dok_belanja" => $dokumen,
            );
        }

        $hsl = $this->db->insert("tb_belanja", $dt);

        if ($hsl) {
            return array("res" => 1, "msg" => "Data Berhasil Disimpan.");
        } else {
            return array("res" => 0, "msg" => "Data Gagal Disimpan");
        }
    }

    public function editBelanja($post, $kode_pusk, $jenis)
    {
        $where = array(
            "id_belanja" => $post["id_belanja"],
        );

        if ($post["tgl_belanja"] == "") {
            return array("res" => 0, "msg" => "Tanggal Belanja Belum diisi.");
        }

        if ($post["kode_rekening"] == "") {
            return array("res" => 0, "msg" => "Rekening Belum diisi.");
        }

        if ($post["uraian_belanja"] == "") {
            return array("res" => 0, "msg" => "Uraian Belanja Belum diisi.");
        }

        if ($post["nominal_belanja"] == "") {
            return array("res" => 0, "msg" => "Nominal Belanja Belum diisi.");
        }

        if ($post["upload"] == 1) {
            if (empty($_FILES['dok_belanja']['name'])) {
                return array("res" => 0, "msg" => "Wajib Melampirkan Dokumen SPJ");
            } else {
                $hasil = json_decode($this->_uploadFile($jenis), true);

                if ($hasil["res"]) {
                    $dokumen = $hasil["name_file"];
                    $this->_deleteFile($post["dok_old"], $jenis);
                } else {
                    return array("res" => 0, "msg" => "File tidak Dijinkan. Error : " . $hasil["msg"]);
                }
            }
        } else {
            $dokumen = $post["dok_old"];
        }


        if ($jenis == "BLUD") {
            if ($post["id_jenis_pendapatan"] == "") {
                return array("res" => 0, "msg" => "Jenis Pendapatan Belum diisi.");
            }

            $dt = array(
                "kode_pusk" => $kode_pusk,
                "jenis_sumber" => $jenis,
                "id_jenis_pendapatan" => $post["id_jenis_pendapatan"],
                "kode_rekening" => $post["kode_rekening"],
                "uraian_belanja" => $post["uraian_belanja"],
                "nominal_belanja" => $post["nominal_belanja"],
                "tgl_belanja" => $post["tgl_belanja"],
                "dok_belanja" => $dokumen,
            );
        } else {
            if ($post["id_sub_kegiatan"] == "") {
                return array("res" => 0, "msg" => "Sub Kegiatan Belum diisi.");
            }

            $dt = array(
                "kode_pusk" => $kode_pusk,
                "jenis_sumber" => $jenis,
                "id_sub_kegiatan" => $post["id_sub_kegiatan"],
                "kode_rekening" => $post["kode_rekening"],
                "uraian_belanja" => $post["uraian_belanja"],
                "nominal_belanja" => $post["nominal_belanja"],
                "tgl_belanja" => $post["tgl_belanja"],
                "dok_belanja" => $dokumen,
            );
        }

        $hsl = $this->db->update("tb_belanja", $dt, $where);

        if ($hsl) {
            return array("res" => 1, "msg" => "Data Berhasil Disimpan.");
        } else {
            return array("res" => 0, "msg" => "Data Gagal Disimpan");
        }
    }

    public function hapusBelanja($id_belanja, $jenis)
    {
        $where = array(
            "id_belanja" => $id_belanja,
        );

        $dt = $this->db->get_where("tb_belanja", $where)->row();

        $hsl = $this->_deleteFile($dt->dok_belanja, $jenis);

        if ($hsl) {
            $this->db->delete("tb_belanja", $where);
            return array("res" => 1, "msg" => "Data Berhasil Dihapus.");
        } else {
            return array("res" => 1, "msg" => "Data Gagal Dihapus.");
        }
    }

    // PRIVATE
    private function _uploadFile($name)
    {
        $kode_pusk = $this->session->userdata("kode_pusk");
        $config['upload_path'] = './upload/' . strtolower($name) . "/";
        $config['file_name'] = $name . '-' . $kode_pusk . '-' . date("Ymd His");
        $config['allowed_types'] = 'pdf';
        $config['max_size']  = '10000';

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('dok_belanja')) {
            $msg = array("res" => 0, "msg" => $this->upload->display_errors());
        } else {
            $msg = array("res" => 1, "name_file" => $this->upload->data('file_name'));
        }

        return json_encode($msg);
    }

    private function _deleteFile($name, $jenis)
    {
        return unlink("./upload/" . strtolower($jenis) . "/" . $name);
    }
}

/* End of file M_belanja.php */
