<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_lain extends CI_Model
{

    public function get_pengaturan()
    {
        $data = $this->db->get("tb_pengaturan")->result();

        return $data;
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
}

/* End of file M_lain.php */
