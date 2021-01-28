<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_laporan');
    }


    public function realisasiRok()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }
        $model = $this->M_laporan;

        $bln = (isset($_POST["lihat"])) ? $_POST["bulan"] : date("m");

        if (isset($_POST["kode_bidang"])) {
            $kode_bidang = $_POST["kode_bidang"];
        } else {
            $kode_bidang = ($this->session->userdata("kode_bidang") != "XXXX") ? $this->session->userdata("kode_bidang") : "";
        }
        if (isset($_POST["kode_seksi"])) {
            $kode_seksi = $_POST["kode_seksi"];
        } else {
            $kode_seksi = ($this->session->userdata("kode_seksi") != "XXXX") ? $this->session->userdata("kode_seksi") : "";
        }


        $data["bulan"] = $bln;
        $data["kode_bidang"] = $kode_bidang;
        $data["kode_seksi"] = $kode_seksi;
        $data["bln"] = array(
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

        $data["sub_kegiatan"] = $model->get_sub_kegiatan($bln, $kode_bidang, $kode_seksi);
        $data["bidang"] = $model->get_bidang();
        $data["seksi"] = $model->get_seksi($kode_bidang);

        $this->template("realisasiRok", $data);
        // echo json_encode($data["sub_kegiatan"]);
    }
}

/* End of file Laporan.php */
