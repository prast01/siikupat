<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_rak extends CI_Model
{
    public function get_sub_kegiatan($kode_bidang, $kode_seksi)
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

        $hsl = array();
        $no = 0;
        foreach ($data_sub as $row) {
            $id_sub_kegiatan = $row->id_sub_kegiatan;
            $hsl[$no++] = array(
                "id_sub_kegiatan" => $row->id_sub_kegiatan,
                "nama_sub_kegiatan" => $row->nama_sub_kegiatan,
                "nama" => $row->nama,
                "tw1" => $this->_get_tw(1, $id_sub_kegiatan),
                "tw2" => $this->_get_tw(2, $id_sub_kegiatan),
                "tw3" => $this->_get_tw(3, $id_sub_kegiatan),
                "tw4" => $this->_get_tw(4, $id_sub_kegiatan),
            );
        }

        return $hsl;
    }

    public function get_bidang()
    {
        $data = $this->db->get("tb_bidang")->result();

        return $data;
    }

    public function get_seksi($kode_bidang)
    {
        if ($kode_bidang == "all") {
            $data = $this->db->get_where("tb_user", ["kode_seksi !=" => "XXXX", "kode_bidang !=" => "DK005"])->result();
        } else {
            $data = $this->db->get_where("tb_user", ["kode_seksi !=" => "XXXX", "kode_bidang" => $kode_bidang])->result();
        }

        return $data;
    }

    public function get_detail($id_sub_kegiatan)
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
                "rak" => $this->_get_rak($id_sub_kegiatan, $key),
            );
        }

        return $hsl;
    }

    public function get_sub_kegiatan_cetak($kode_bidang, $kode_seksi)
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
        $this->db->order_by('tb_sub_kegiatan.kode_sub_kegiatan', 'ASC');

        $data_sub = $this->db->get()->result();

        $hsl = array();
        $no = 0;
        foreach ($data_sub as $row) {
            $id_sub_kegiatan = $row->id_sub_kegiatan;
            $hsl[$no++] = array(
                "id_sub_kegiatan" => $row->id_sub_kegiatan,
                "nama_sub_kegiatan" => $row->nama_sub_kegiatan,
                "nama" => $row->nama,
                "01" => $this->_get_data_rak($id_sub_kegiatan, "01"),
                "02" => $this->_get_data_rak($id_sub_kegiatan, "02"),
                "03" => $this->_get_data_rak($id_sub_kegiatan, "03"),
                "04" => $this->_get_data_rak($id_sub_kegiatan, "04"),
                "05" => $this->_get_data_rak($id_sub_kegiatan, "05"),
                "06" => $this->_get_data_rak($id_sub_kegiatan, "06"),
                "07" => $this->_get_data_rak($id_sub_kegiatan, "07"),
                "08" => $this->_get_data_rak($id_sub_kegiatan, "08"),
                "09" => $this->_get_data_rak($id_sub_kegiatan, "09"),
                "10" => $this->_get_data_rak($id_sub_kegiatan, "10"),
                "11" => $this->_get_data_rak($id_sub_kegiatan, "11"),
                "12" => $this->_get_data_rak($id_sub_kegiatan, "12")
            );
        }

        return $hsl;
    }

    // CRUD
    public function save($post)
    {
        $cek = $this->db->get_where("tb_rak", ["id_sub_kegiatan" => $post["id_sub_kegiatan"]])->num_rows();
        if ($cek > 0) {
            $where = array(
                "id_sub_kegiatan" => $post["id_sub_kegiatan"]
            );

            $data = $this->db->update("tb_rak", $post, $where);
        } else {
            $data = $this->db->insert("tb_rak", $post);
        }

        if ($data) {
            return array("res" => 1, "msg" => "Data RAK Berhasil Disimpan");
        } else {
            return array("res" => 0, "msg" => "Data RAK Gagal Disimpan");
        }
    }

    // PRIVATE
    private function _get_tw($tw, $id_sub_kegiatan)
    {
        if ($tw == 1) {
            $bln_1 = 1;
            $bln_2 = 3;
        } elseif ($tw == 2) {
            $bln_1 = 4;
            $bln_2 = 6;
        } elseif ($tw == 3) {
            $bln_1 = 7;
            $bln_2 = 9;
        } elseif ($tw == 4) {
            $bln_1 = 10;
            $bln_2 = 12;
        }

        $total = 0;
        for ($i = $bln_1; $i <= $bln_2; $i++) {
            $kolom = "b" . sprintf("%02s", $i);
            $data = $this->db->get_where("tb_rak", ["id_sub_kegiatan" => $id_sub_kegiatan]);

            if ($data->num_rows() > 0) {
                $x = $data->row();

                $total = $total + $x->$kolom;
            } else {
                $total = $total + 0;
            }
        }

        return $total;
    }

    private function _get_rak($id_sub_kegiatan, $bln)
    {
        $kolom = "b" . $bln;

        $data = $this->db->get_where("tb_rak", ["id_sub_kegiatan" => $id_sub_kegiatan]);

        if ($data->num_rows() > 0) {
            $x = $data->row();

            return $x->$kolom;
        } else {
            return 0;
        }
    }

    private function _get_data_rak($id_sub_kegiatan, $bln)
    {
        $data = $this->db->get_where("tb_rak", ["id_sub_kegiatan" => $id_sub_kegiatan]);
        $kolom = "b" . $bln;

        if ($data->num_rows() > 0) {
            $hsl = $data->row();
            return number_format($hsl->$kolom, 0, ",", ".");
        } else {
            return 0;
        }
    }
}

/* End of file M_rak.php */
