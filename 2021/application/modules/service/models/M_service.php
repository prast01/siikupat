<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_service extends CI_Model
{

    public function get_rekening_master($search)
    {
        $this->db->select("*");
        $this->db->from("tb_rekening_master");
        $this->db->like("kode_rekening", $search);
        $this->db->or_like("nama_rekening", $search);
        $data = $this->db->get()->result();

        return $data;
    }

    public function get_rekening_seksi($search, $id_sub_kegiatan)
    {
        $this->db->select("*");
        $this->db->from("tb_rekening");
        $this->db->where("id_sub_kegiatan", $id_sub_kegiatan);
        $this->db->like("kode_rekening", $search);
        $this->db->or_like("nama_rekening", $search);
        $data = $this->db->get()->result();

        return $data;
    }

    public function get_rekening_seksi2($id_sub_kegiatan)
    {
        $this->db->select("*");
        $this->db->from("tb_rekening");
        $this->db->where("id_sub_kegiatan", $id_sub_kegiatan);
        $data = $this->db->get()->result();

        return $data;
    }

    public function get_realisasi()
    {
        $this->db->order_by("persen_anggaran", "DESC");
        $data = $this->db->get("tb_realisasi_seksi")->result();

        return $data;
    }

    public function get_user()
    {
        $this->db->order_by("persen_anggaran", "DESC");
        $data = $this->db->get("tb_realisasi_seksi")->result();

        return $data;
    }

    public function get_rok($id_sub, $id_rekening, $bln)
    {
        $data = $this->db->query("SELECT * FROM tb_rok WHERE id_sub_kegiatan='$id_sub' AND id_rekening='$id_rekening' AND bulan='$bln' AND id_rok NOT IN (SELECT id_rok FROM tb_spj WHERE id_sub_kegiatan='$id_sub')")->result();

        $hsl = array();
        $no = 0;
        foreach ($data as $row) {
            $hsl[$no++] = array(
                "id_rok" => $row->id_rok,
                "uraian" => $row->uraian,
                "nominal" => "Rp" . number_format($row->nominal, 0, ",", "."),
                "valid" => $this->cek_rok_valid($row->id_sub_kegiatan, $row->bulan),
            );
        }

        $data_old = $this->get_rok_old($id_sub, $id_rekening, $bln);
        foreach ($data_old as $row) {
            $hsl[$no++] = array(
                "id_rok" => $row->id_rok,
                "uraian" => $row->uraian,
                "nominal" => "Rp" . number_format($row->nominal, 0, ",", "."),
                "valid" => $this->cek_rok_valid($row->id_sub_kegiatan, $row->bulan),
            );
        }

        return $hsl;
    }

    public function get_rok_old($id_sub, $id_rekening, $bln)
    {
        $data = $this->db->query("SELECT * FROM tb_rok WHERE id_sub_kegiatan='$id_sub' AND id_rekening='$id_rekening' AND bulan<'$bln' AND id_rok NOT IN (SELECT id_rok FROM tb_spj)")->result();

        return $data;
    }

    public function get_rok_a21($id_sub, $id_rekening, $bln)
    {
        $data = $this->db->query("SELECT * FROM tb_rok WHERE id_sub_kegiatan='$id_sub' AND id_rekening='$id_rekening' AND bulan <= '$bln'")->result();

        $hsl = array();
        $no = 0;
        foreach ($data as $row) {
            $hsl[$no++] = array(
                "id_rok" => $row->id_rok,
                "uraian" => $row->uraian,
                "nominal" => "Rp" . number_format($row->nominal, 0, ",", "."),
                "valid" => $this->cek_rok_valid($row->id_sub_kegiatan, $row->bulan),
            );
        }

        return $hsl;
    }

    public function cek_rok_valid($id_sub, $bln)
    {
        $tbl = "b" . $bln;
        $data = $this->db->query("SELECT $tbl FROM tb_rok_valid WHERE id_sub_kegiatan='$id_sub'")->row();

        return $data->$tbl;
    }

    public function get_uraian($id_rok)
    {
        $data = $this->db->get_where("tb_rok", ["id_rok" => $id_rok])->row();

        return $data;
    }

    public function get_pegawai($id_pegawai)
    {
        $data = $this->db->get_where("tb_pegawai", ["id_pegawai" => $id_pegawai])->row();

        return $data;
    }
}

/* End of file M_service.php */
