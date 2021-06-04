<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_modal extends CI_Model
{

    public function get_user_by_id($id_user)
    {
        $data = $this->db->get_where("tb_user", ["id_user" => $id_user])->row();

        return $data;
    }

    public function get_sub_kegiatan($kode_pusk, $jenis)
    {
        $data = $this->db->get_where("tb_sub_kegiatan", ["kode_pusk" => $kode_pusk, "jenis_sumber" => $jenis])->result();

        // $no = 0;
        // $hsl = array();
        // foreach ($data as $key) {
        //     $hsl[$no++] = array(
        //         "id_sub_kegiatan" => $key->id_sub_kegiatan,
        //         "kode_sub_kegiatan" => $key->kode_sub_kegiatan,
        //         "nama_sub_kegiatan" => $key->nama_sub_kegiatan,
        //     );
        // }

        return $data;
    }

    public function get_sub_kegiatan_by_id($kode_pusk, $id_sub_kegiatan)
    {
        $data = $this->db->get_where("tb_sub_kegiatan", ["kode_pusk" => $kode_pusk, "id_sub_kegiatan" => $id_sub_kegiatan])->row();

        return $data;
    }

    public function get_rekening_by_id($id_rekening)
    {
        $data = $this->db->get_where("tb_rekening", ["id_rekening" => $id_rekening])->row();

        return $data;
    }

    public function get_jenis_pendapatan_by_id($id_jenis_pendapatan)
    {
        $data = $this->db->get_where("tb_jenis_pendapatan", ["id_jenis_pendapatan" => $id_jenis_pendapatan])->row();

        return $data;
    }

    public function get_jenis_pendapatan($kode_pusk)
    {
        $data = $this->db->get_where("tb_jenis_pendapatan", ["baru" => 0])->result();

        $no = 0;
        $hsl = array();
        foreach ($data as $key) {
            $real = $this->_get_realisasi($kode_pusk, $key->id_jenis_pendapatan);
            $hsl[$no++] = array(
                "id_jenis_pendapatan" => $key->id_jenis_pendapatan,
                "jenis_pendapatan" => $key->jenis_pendapatan,
                "id_realisasi" => $real["id_realisasi"],
                "realisasi" => $real["realisasi"],
            );
        }

        $data2 = $this->db->get_where("tb_jenis_pendapatan", ["baru" => 1, "kode_pusk" => $kode_pusk])->result();
        foreach ($data2 as $key) {
            $real = $this->_get_realisasi($kode_pusk, $key->id_jenis_pendapatan);
            $hsl[$no++] = array(
                "id_jenis_pendapatan" => $key->id_jenis_pendapatan,
                "jenis_pendapatan" => $key->jenis_pendapatan,
                "id_realisasi" => $real["id_realisasi"],
                "realisasi" => $real["realisasi"],
            );
        }

        return $hsl;
    }

    public function get_rek_koran($kode_pusk, $kode_bulan)
    {
        $data = $this->db->get_where("tb_real_pendapatan", ["kode_pusk" => $kode_pusk, "bulan" => $kode_bulan])->row();

        return $data->rek_koran;
    }

    public function get_rekening_blud($kode_pusk, $jenis)
    {
        $no = 0;
        $hsl = array();
        $data = $this->db->get_where("tb_sub_kegiatan", ["kode_pusk" => $kode_pusk, "jenis_sumber" => $jenis]);

        if ($data->num_rows() > 0) {
            $x = $data->row();
            $this->db->select("*");
            $this->db->from("tb_rekening");
            $this->db->where("id_sub_kegiatan", $x->id_sub_kegiatan);

            $data2 = $this->db->get()->result();

            foreach ($data2 as $key) {
                $hsl[$no++] = array(
                    "id_rekening" => $key->id_rekening,
                    "kode_rekening" => $key->kode_rekening,
                    "nama_rekening" => $key->nama_rekening,
                );
            }
        }

        return $hsl;
    }

    public function get_rekening($id_sub_kegiatan, $jenis)
    {
        $no = 0;
        $hsl = array();
        $data = $this->db->get_where("tb_sub_kegiatan", ["id_sub_kegiatan" => $id_sub_kegiatan, "jenis_sumber" => $jenis]);

        if ($data->num_rows() > 0) {
            $x = $data->row();
            $this->db->select("*");
            $this->db->from("tb_rekening");
            $this->db->where("id_sub_kegiatan", $x->id_sub_kegiatan);

            $data2 = $this->db->get()->result();

            foreach ($data2 as $key) {
                $hsl[$no++] = array(
                    "id_rekening" => $key->id_rekening,
                    "kode_rekening" => $key->kode_rekening,
                    "nama_rekening" => $key->nama_rekening,
                );
            }
        }

        return $hsl;
    }

    public function get_belanja($id_belanja)
    {
        $data = $this->db->get_where("tb_belanja", ["id_belanja" => $id_belanja])->row();

        return $data;
    }

    // PRIVATE
    private function _get_realisasi($kode_pusk, $id_jenis_pendapatan)
    {
        $data = $this->db->get_where("tb_real_pendapatan_detail", ["kode_pusk" => $kode_pusk, "id_jenis_pendapatan" => $id_jenis_pendapatan]);

        if ($data->num_rows() > 0) {
            $x = $data->row();

            return array("id_realisasi" => $x->id_real_pendapatan, "realisasi" => $x->real_pendapatan);
        } else {
            return array("id_realisasi" => 0, "realisasi" => 0);
        }
    }
}

/* End of file M_modal.php */
