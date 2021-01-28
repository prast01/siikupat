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

    public function verifikasiSpj()
    {
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
            "00" => "Semua",
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

        $data["spj"] = $model->get_spj(1, $bln, $kode_bidang, $kode_seksi);
        $data["bidang"] = $model->get_bidang();
        $data["seksi"] = $model->get_seksi($kode_bidang);

        $this->template("verifikasiSpj", $data);
    }

    public function pembukuanSpj()
    {
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
            "00" => "Semua",
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

        $data["spj"] = $model->get_spj(2, $bln, $kode_bidang, $kode_seksi);
        $data["bidang"] = $model->get_bidang();
        $data["seksi"] = $model->get_seksi($kode_bidang);
        $this->template("pembukuanSpj", $data);
    }

    public function transferSpj()
    {
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
            "00" => "Semua",
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

        $data["spj"] = $model->get_spj(3, $bln, $kode_bidang, $kode_seksi);
        $data["bidang"] = $model->get_bidang();
        $data["seksi"] = $model->get_seksi($kode_bidang);
        $this->template("transferSpj", $data);
    }

    public function lihat($st, $kode_spj)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_laporan;

        if ($st == 1) {
            $status = "verifikasi-spj";
        } elseif ($st == 2) {
            $status = "pembukuan-spj";
        } elseif ($st == 3) {
            $status = "transfer-spj";
        }

        $data["st"] = $status;
        $data["spj"] = $model->get_spj_by_kode($kode_spj);
        $data["verif"] = $model->get_verif_by_kode($kode_spj);
        $data["sub_kegiatan"] = $model->get_sub_kegiatan_by_id($data["spj"]->id_sub_kegiatan);
        $data["rekening"] = $model->get_rekening_by_id($data["spj"]->id_rekening);
        $data["rok"] = $model->get_rok_by_id($data["spj"]->id_rok);
        $data["pelaksana"] = $model->get_pelaksana($kode_spj);
        $this->template("lihat", $data);
    }
}

/* End of file Laporan.php */
