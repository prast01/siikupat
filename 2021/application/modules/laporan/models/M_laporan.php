<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_laporan extends CI_Model
{

    public function get_sub_kegiatan($bulan)
    {
        $kode_bidang = $this->session->userdata("kode_bidang");
        $this->db->from("tb_sub_kegiatan");
        $this->db->join("tb_user", "tb_sub_kegiatan.kode_seksi = tb_user.kode_seksi");
        $this->db->where("tb_user.kode_bidang", $kode_bidang);
        $data_sub = $this->db->get()->result();

        if ($bulan > 1) {
            $bln_sblm = $bulan - 1;
        } else {
            $bln_sblm = 0;
        }

        $hsl = array();
        $no = 0;
        foreach ($data_sub as $row) {
            $hsl[$no++] = array(
                "id_sub_kegiatan" => $row->id_sub_kegiatan,
                "kode_seksi" => $row->kode_seksi,
                "nama_sub_kegiatan" => $row->nama_sub_kegiatan,
                "nama" => $row->nama,
                "sisa" => $this->_get_sisa_bulan_lalu($row->id_sub_kegiatan, $bln_sblm, $row->kode_seksi),
                "rok" => $this->_get_rok($row->id_sub_kegiatan, $bulan, $row->kode_seksi),
                "realisasi" => $this->_get_real($row->id_sub_kegiatan, $bulan, $row->kode_seksi),
            );
        }

        $sort = $this->array_multi_subsort($hsl, 'rok');

        return $sort;
    }

    // PRIVATE
    private function _get_sisa_bulan_lalu($id_sub, $bln_sblm, $kode_seksi)
    {
        if ($bln_sblm > 0) {
            $total = 0;
            for ($i = 1; $i <= $bln_sblm; $i++) {

                $s = date("Y") . "-" . $i . "-01";
                $bln = date("m", strtotime($s));
                $tbl = "b" . $bln;

                $valid = $this->db->query("SELECT $tbl as cek FROM tb_rok_valid WHERE id_sub_kegiatan='$id_sub' AND kode_seksi='$kode_seksi'")->row();

                if ($valid->cek == 1) {
                    $rok = $this->db->query("SELECT SUM(nominal) as nom FROM tb_rok WHERE id_sub_kegiatan='$id_sub' AND kode_seksi='$kode_seksi' AND bulan='$bln' AND id_rok NOT IN (SELECT id_rok FROM tb_spj WHERE status_spj='4')")->row();

                    $total = $total + $rok->nom;
                }
            }

            return number_format($total, 0, ",", ".");
        } else {
            return 0;
        }
    }

    private function _get_rok($id_sub, $bln, $kode_seksi)
    {
        $data = $this->db->query("SELECT SUM(nominal) as nom FROM tb_rok WHERE id_sub_kegiatan='$id_sub' AND kode_seksi='$kode_seksi' AND bulan='$bln'")->row();

        return number_format($data->nom, 0, ",", ".");
    }

    private function _get_real($id_sub, $bln, $kode_seksi)
    {
        $data = $this->db->query("SELECT SUM(nominal) as nom FROM tb_spj WHERE id_sub_kegiatan='$id_sub' AND kode_seksi='$kode_seksi' AND MONTH(tgl_transfer)='$bln' AND status_spj='4'")->row();

        return number_format($data->nom, 0, ",", ".");
    }

    private function array_multi_subsort($array, $subkey)
    {
        $b = array();
        $c = array();

        foreach ($array as $k => $v) {
            $b[$k] = strtolower($v[$subkey]);
        }

        arsort($b);
        foreach ($b as $key => $val) {
            $c[] = $array[$key];
        }

        return $c;
    }
}

/* End of file M_laporan.php */
