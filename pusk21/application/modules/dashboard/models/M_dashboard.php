<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard extends CI_Model
{

    public function get_all_data($tahun)
    {
        $data = $this->db->get("tb_data")->result();

        $no = 0;
        $hsl = array();
        foreach ($data as $key) {
            $hsl[$no++] = array(
                "id_data" => $key->id_data,
                "nama_data" => $key->nama_data,
                "alias" => $key->alias,
                "cek" => $this->_cek_data($key->id_data, $tahun),
            );
        }

        return $hsl;
        return $data;
    }

    public function get_data($id_data, $tahun)
    {
        $a = $this->db->get_where("tb_data", ["id_data" => $id_data])->row();
        $data = $this->db->get("tb_kecamatan")->result();

        $no = 0;
        $hsl = array();
        $hsl["id_data"] = $a->id_data;
        $hsl["nama_data"] = $a->nama_data;
        foreach ($data as $key) {
            $hsl["data"][$no++] = array(
                "kode_kecamatan" => $key->kode_kecamatan,
                "nama_kecamatan" => $key->nama_kecamatan,
                "nilai" => $this->_get_data_kecamatan($key->kode_kecamatan, $id_data, $tahun),
            );
        }

        return $hsl;
    }

    // CRUD
    public function save($post)
    {
        $count = count($post["kode_kecamatan"]);

        for ($i = 0; $i < $count; $i++) {
            $where = array(
                "kode_kecamatan" => $post["kode_kecamatan"][$i],
                "id_data" => $post["id_data"],
                "tahun" => $post["tahun"],
            );


            $cek = $this->db->get_where("tb_riwayat_data", $where)->num_rows();
            if ($cek > 0) {
                $data = array(
                    "nilai" => $post["nilai"][$i],
                );
                $hasil = $this->db->update('tb_riwayat_data', $data, $where);
            } else {
                $data = array(
                    "kode_kecamatan" => $post["kode_kecamatan"][$i],
                    "nilai" => $post["nilai"][$i],
                    "id_data" => $post["id_data"],
                    "tahun" => $post["tahun"],
                );
                $hasil = $this->db->insert('tb_riwayat_data', $data);
            }
        }

        if ($hasil) {
            return array("res" => 1, "msg" => "Data Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "Data Gagal Disimpan");
        }
    }


    // PRIVATE
    private function _get_data_kecamatan($kode_kecamatan, $id_data, $tahun)
    {
        $where = array(
            "kode_kecamatan" => $kode_kecamatan,
            "id_data" => $id_data,
            "tahun" => $tahun,
        );
        $nilai = 0;
        $data = $this->db->get_where("tb_riwayat_data", $where);

        if ($data->num_rows() > 0) {
            $dt = $data->row();
            $nilai = $dt->nilai;
        }

        return $nilai;
    }

    private function _cek_data($id_data, $tahun)
    {
        $where = array(
            "id_data" => $id_data,
            "tahun" => $tahun,
        );

        $out = "BELUM DIISI SEMUA";
        $data = $this->db->get_where("tb_riwayat_data", $where);
        $jml_kec = $this->db->get("tb_kecamatan")->num_rows();

        if ($data->num_rows() == $jml_kec) {
            $out = "SUDAH DIISI SEMUA";
        } elseif ($data->num_rows() > 0 && $data->num_rows() < $jml_kec) {
            $out = "ADA DATA YANG BELUM DIISI";
        }

        return $out;
    }
}

/* End of file M_dashboard.php */
