<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_kegiatan extends CI_Model
{

    public function get_kegiatan()
    {
        if ($this->session->userdata("kode_bidang") == "DK005") {
            $kode_seksi = $this->session->userdata("kode_seksi");
            $data = $this->db->query("SELECT * FROM tb_kegiatan WHERE id_kegiatan IN (SELECT id_kegiatan FROM tb_sub_kegiatan WHERE kode_seksi='$kode_seksi')")->result();
        } else {
            $data = $this->db->get('tb_kegiatan')->result();
        }

        // $data = $this->db->get_where("view_kegiatan")->result();
        $hsl = array();
        $no = 0;
        foreach ($data as $key) {
            $hsl[$no++] = array(
                "id_kegiatan" => $key->id_kegiatan,
                "kode_kegiatan" => $key->kode_kegiatan,
                "nama_kegiatan" => $key->nama_kegiatan,
                "pagu_anggaran" => $this->_get_pagu_keg($key->id_kegiatan),
            );
        }

        return $hsl;
    }

    public function get_sub_kegiatan($id)
    {
        $this->db->select("*");
        $this->db->from('tb_sub_kegiatan');
        $this->db->join('tb_kegiatan', 'tb_kegiatan.id_kegiatan = tb_sub_kegiatan.id_kegiatan');
        $this->db->join('tb_user', 'tb_user.kode_seksi = tb_sub_kegiatan.kode_seksi');
        $this->db->where('tb_sub_kegiatan.id_kegiatan', $id);

        if ($this->session->userdata("kode_bidang") == "DK005") {
            $kode_seksi = $this->session->userdata("kode_seksi");
            $this->db->where('tb_sub_kegiatan.kode_seksi', $kode_seksi);
        }

        $data = $this->db->get()->result();

        // $data = $this->db->get_where("view_sub_kegiatan", ["id_kegiatan" => $id])->result();

        $hsl = array();
        $no = 0;
        foreach ($data as $key) {
            $hsl[$no++] = array(
                "id_kegiatan" => $key->id_kegiatan,
                "id_sub_kegiatan" => $key->id_sub_kegiatan,
                "kode_sub_kegiatan" => $key->kode_sub_kegiatan,
                "nama_sub_kegiatan" => $key->nama_sub_kegiatan,
                "nama" => $key->nama,
                "pagu_anggaran" => $this->_get_pagu_sub_keg($key->id_sub_kegiatan),
            );
        }

        return $hsl;
    }

    public function get_rekening($id)
    {
        $this->db->select("*");
        $this->db->from('tb_rekening');
        $this->db->join('tb_sub_kegiatan', 'tb_sub_kegiatan.id_sub_kegiatan = tb_rekening.id_sub_kegiatan');
        $this->db->where('tb_rekening.id_sub_kegiatan', $id);

        $data = $this->db->get()->result();

        return $data;
    }

    // CRUD
    public function save($post)
    {
        $data = array(
            "kode_kegiatan" => $post["kode_kegiatan"],
            "nama_kegiatan" => $post["nama_kegiatan"],
        );

        if ($post['kode_kegiatan'] == "") {
            return array("res" => 0, "msg" => "Kode Kegiatan Harus Terisi");
        }
        if ($post['nama_kegiatan'] == "") {
            return array("res" => 0, "msg" => "Nama Kegiatan Harus Terisi");
        }

        $hasil = $this->db->insert('tb_kegiatan', $data);
        if ($hasil) {
            return array("res" => 1, "msg" => "Kegiatan Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "Kegiatan Gagal Disimpan");
        }
    }

    public function saveSub($post)
    {
        $data = array(
            "kode_sub_kegiatan" => $post["kode_sub_kegiatan"],
            "nama_sub_kegiatan" => $post["nama_sub_kegiatan"],
            "id_kegiatan" => $post["id_kegiatan"],
            "kode_seksi" => $post["kode_seksi"],
        );

        if ($post['kode_sub_kegiatan'] == "") {
            return array("res" => 0, "msg" => "Kode Sub Kegiatan Harus Terisi");
        }
        if ($post['nama_sub_kegiatan'] == "") {
            return array("res" => 0, "msg" => "Nama Sub Kegiatan Harus Terisi");
        }
        if ($post['kode_seksi'] == "") {
            return array("res" => 0, "msg" => "Subbag/Seksi/UPT Harus Terisi");
        }

        $hasil = $this->db->insert('tb_sub_kegiatan', $data);
        if ($hasil) {
            $this->_save_valid($post["kode_seksi"], $post["kode_sub_kegiatan"]);
            return array("res" => 1, "msg" => "Kegiatan Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "Kegiatan Gagal Disimpan");
        }
    }

    public function saveRek($post)
    {
        $data = array(
            "kode_rekening" => $post["kode_rekening"],
            "nama_rekening" => $post["nama_rekening"],
            "id_sub_kegiatan" => $post["id_sub_kegiatan"],
            "pagu_rekening" => $post["pagu_rekening"],
        );

        if ($post['kode_rekening'] == "") {
            return array("res" => 0, "msg" => "Kode Rekening Harus Terisi");
        }
        if ($post['nama_rekening'] == "") {
            return array("res" => 0, "msg" => "Nama Rekening Harus Terisi");
        }
        if ($post['pagu_rekening'] == "") {
            return array("res" => 0, "msg" => "Pagu Rekening Harus Terisi");
        }

        $hasil = $this->db->insert('tb_rekening', $data);
        if ($hasil) {
            return array("res" => 1, "msg" => "Rekening Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "Rekening Gagal Disimpan");
        }
    }

    public function update($id, $post)
    {
        $where = array(
            "id_kegiatan" => $id,
        );

        $data = array(
            "kode_kegiatan" => $post["kode_kegiatan"],
            "nama_kegiatan" => $post["nama_kegiatan"],
        );

        if ($post['kode_kegiatan'] == "") {
            return array("res" => 0, "msg" => "Kode Kegiatan Harus Terisi");
        }
        if ($post['nama_kegiatan'] == "") {
            return array("res" => 0, "msg" => "Nama Kegiatan Harus Terisi");
        }

        $hasil = $this->db->update('tb_kegiatan', $data, $where);

        if ($hasil) {
            return array("res" => 1, "msg" => "Kegiatan Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "Kegiatan Gagal Disimpan");
        }
    }

    public function updateSub($id, $post)
    {
        $where = array(
            "id_sub_kegiatan" => $id,
        );

        $data = array(
            "kode_sub_kegiatan" => $post["kode_sub_kegiatan"],
            "nama_sub_kegiatan" => $post["nama_sub_kegiatan"],
            "kode_seksi" => $post["kode_seksi"],
        );

        if ($post['kode_sub_kegiatan'] == "") {
            return array("res" => 0, "msg" => "Kode Kegiatan Harus Terisi");
        }
        if ($post['nama_sub_kegiatan'] == "") {
            return array("res" => 0, "msg" => "Nama Kegiatan Harus Terisi");
        }
        if ($post['kode_seksi'] == "") {
            return array("res" => 0, "msg" => "Subbag/Seksi/UPT Harus Terisi");
        }

        $hasil = $this->db->update('tb_sub_kegiatan', $data, $where);

        if ($hasil) {
            $this->_update_valid($post["kode_seksi"], $id);
            return array("res" => 1, "msg" => "Sub Kegiatan Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "Sub Kegiatan Gagal Disimpan");
        }
    }

    public function updateRek($id, $post)
    {
        $where = array(
            "id_rekening" => $id,
        );

        $data = array(
            "kode_rekening" => $post["kode_rekening"],
            "nama_rekening" => $post["nama_rekening"],
            "pagu_rekening" => $post["pagu_rekening"],
        );

        if ($post['kode_rekening'] == "") {
            return array("res" => 0, "msg" => "Kode Rekening Harus Terisi");
        }
        if ($post['nama_rekening'] == "") {
            return array("res" => 0, "msg" => "Nama Rekening Harus Terisi");
        }
        if ($post['pagu_rekening'] == "") {
            return array("res" => 0, "msg" => "Pagu Rekening Harus Terisi");
        }

        $hasil = $this->db->update('tb_rekening', $data, $where);

        if ($hasil) {
            return array("res" => 1, "msg" => "Rekening Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "Rekening Gagal Disimpan");
        }
    }

    public function pemutihan($id, $post)
    {
        $where = array(
            "id_rekening" => $id,
        );

        $data = array(
            "tgl_pemutihan" => $post["tgl_pemutihan"],
            "realisasi_pemutihan" => $post["realisasi_pemutihan"],
        );

        if ($post['tgl_pemutihan'] == "") {
            return array("res" => 0, "msg" => "Tanggal Pemutihan Harus Terisi");
        }
        if ($post['realisasi_pemutihan'] == "") {
            return array("res" => 0, "msg" => "Realisasi Harus Terisi");
        }

        $cek = $this->cek_pagu($id, $post["realisasi_pemutihan"]);
        if ($cek) {
            return array("res" => 0, "msg" => "Realisasi Melebihi Pagu!! Sub Kegiatan Gagal Dihapus.");
        }

        $hasil = $this->db->update('tb_rekening', $data, $where);

        if ($hasil) {
            return array("res" => 1, "msg" => "Rekening Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "Rekening Gagal Disimpan");
        }
    }

    public function delete($id)
    {
        $where = array(
            "id_kegiatan" => $id,
        );

        $cek = $this->cek_sub($id);
        if ($cek) {
            return array("res" => 0, "msg" => "Ada Sub Kegiatan!! Kegiatan Gagal Dihapus.");
        }
        $hasil = $this->db->delete('tb_kegiatan', $where);

        if ($hasil) {
            return array("res" => 1, "msg" => "Kegiatan Berhasil Dihapus");
        } else {
            return array("res" => 0, "msg" => "Kegiatan Gagal Dihapus");
        }
    }

    public function deleteSub($id)
    {
        $where = array(
            "id_sub_kegiatan" => $id,
        );

        $cek = $this->cek_rek($id);
        if ($cek) {
            return array("res" => 0, "msg" => "Ada Rekening!! Sub Kegiatan Gagal Dihapus.");
        }

        $hasil = $this->db->delete('tb_sub_kegiatan', $where);

        if ($hasil) {
            $this->db->delete("tb_rok_valid", $where);
            return array("res" => 1, "msg" => "Sub Kegiatan Berhasil Dihapus");
        } else {
            return array("res" => 0, "msg" => "Sub Kegiatan Gagal Dihapus");
        }
    }

    public function deleteRek($id)
    {
        $where = array(
            "id_rekening" => $id,
        );

        $hasil = $this->db->delete('tb_rekening', $where);

        if ($hasil) {
            return array("res" => 1, "msg" => "Rekening Berhasil Dihapus");
        } else {
            return array("res" => 0, "msg" => "Rekening Gagal Dihapus");
        }
    }


    // PRIVATE
    private function cek_sub($id)
    {
        $data = $this->db->get_where("tb_sub_kegiatan", ["id_kegiatan" => $id])->num_rows();

        if ($data > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    private function cek_rek($id)
    {
        $data = $this->db->get_where("tb_rekening", ["id_sub_kegiatan" => $id])->num_rows();

        if ($data > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    private function cek_pagu($id, $real)
    {
        $data = $this->db->get_where("tb_rekening", ["id_rekening" => $id])->row();

        if ($real > $data->pagu_rekening) {
            return 1;
        } else {
            return 0;
        }
    }

    private function _save_valid($kode_seksi, $kode_sub)
    {
        $data = $this->db->get_where("tb_sub_kegiatan", ["kode_sub_kegiatan" => $kode_sub, "kode_seksi" => $kode_seksi])->row();

        $data_r = array(
            "id_sub_kegiatan" => $data->id_sub_kegiatan,
            "kode_seksi" => $kode_seksi,
        );

        $this->db->insert("tb_rok_valid", $data_r);
    }

    private function _update_valid($kode_seksi, $id_sub)
    {
        $where = array(
            "id_sub_kegiatan" => $id_sub,
        );

        $data_r = array(
            "kode_seksi" => $kode_seksi,
        );

        $this->db->update("tb_rok_valid", $data_r, $where);
    }

    private function _get_pagu_keg($id_kegiatan)
    {
        if ($this->session->userdata("kode_bidang") == "DK005") {
            $kode_seksi = $this->session->userdata("kode_seksi");
            $data = $this->db->get_where("tb_sub_kegiatan", ["id_kegiatan" => $id_kegiatan, "kode_seksi" => $kode_seksi])->result();
        } else {
            $data = $this->db->get_where("tb_sub_kegiatan", ["id_kegiatan" => $id_kegiatan])->result();
        }
        $total = 0;
        foreach ($data as $key) {
            $id_sub = $key->id_sub_kegiatan;
            $dt = $this->db->query("SELECT SUM(pagu_rekening) as total FROM tb_rekening WHERE id_sub_kegiatan='$id_sub'")->row();

            $total = $total + $dt->total;
        }

        return $total;
    }

    private function _get_pagu_sub_keg($id_sub_kegiatan)
    {
        $total = 0;
        $dt = $this->db->query("SELECT SUM(pagu_rekening) as total FROM tb_rekening WHERE id_sub_kegiatan='$id_sub_kegiatan'")->row();

        $total = $total + $dt->total;
        return $total;
    }
}

/* End of file M_kegiatan.php */
