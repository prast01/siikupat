<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_dashboard extends CI_Model
{

    public function get_seksi()
    {
        $this->update();

        $this->db->order_by("persen_anggaran", "DESC");
        $data = $this->db->get("tb_realisasi_seksi")->result();

        return $data;
    }

    private function update()
    {
        $data = $this->db->get_where("tb_user", ["kode_seksi !=" => "XXXX"])->result();

        $this->db->truncate('tb_realisasi_seksi');
        foreach ($data as $row) {
            $pagu_anggaran = $this->get_pagu($row->kode_seksi);
            $real_anggaran = $this->get_real($row->kode_seksi);
            $sisa_anggaran = $this->get_sisa($pagu_anggaran, $real_anggaran);
            $persen_anggaran = $this->get_persen($pagu_anggaran, $real_anggaran);

            $data = array(
                "kode_seksi" => $row->kode_seksi,
                "nama" => $row->nama,
                "pagu_anggaran" => $pagu_anggaran,
                "real_anggaran" => $real_anggaran,
                "sisa_anggaran" => $sisa_anggaran,
                "persen_anggaran" => number_format($persen_anggaran, 2, ".", ","),
            );

            $this->db->insert("tb_realisasi_seksi", $data);
        }
    }

    private function get_pagu($kode_seksi)
    {
        $data = $this->db->query("SELECT SUM(pagu_anggaran) AS pagu FROM view_sub_kegiatan WHERE kode_seksi='$kode_seksi' GROUP BY kode_seksi")->row();

        return $data->pagu;
    }

    private function get_real($kode_seksi)
    {
        $data = $this->db->query("SELECT * FROM view_sub_kegiatan WHERE kode_seksi='$kode_seksi'")->result();

        $total = 0;
        foreach ($data as $row) {
            $real = $this->db->query("SELECT SUM(nominal) AS nominal FROM tb_spj WHERE kode_seksi='$kode_seksi' AND id_sub_kegiatan='$row->id_sub_kegiatan' AND status_spj='4' GROUP BY id_sub_kegiatan");

            if ($real->num_rows() > 0) {
                $r = $real->row();
                $total = $total + $r->nominal;
            }
        }

        return $total;
    }

    private function get_sisa($pagu, $real)
    {
        $hsl = $pagu - $real;
        return $hsl;
    }

    private function get_persen($pagu, $real)
    {
        $hsl = ($real / $pagu) * 100;
        return $hsl;
    }
}

/* End of file M_dashboard.php */
