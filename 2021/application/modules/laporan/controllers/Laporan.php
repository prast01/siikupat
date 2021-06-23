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
            $kode_bidang = ($this->session->userdata("kode_bidang") != "XXXX") ? $this->session->userdata("kode_bidang") : "all";
        }
        if (isset($_POST["kode_seksi"])) {
            $kode_seksi = $_POST["kode_seksi"];
        } else {
            $kode_seksi = ($this->session->userdata("kode_seksi") != "XXXX") ? $this->session->userdata("kode_seksi") : "all";
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
            $kode_bidang = ($this->session->userdata("kode_bidang") != "XXXX") ? $this->session->userdata("kode_bidang") : "all";
        }
        if (isset($_POST["kode_seksi"])) {
            $kode_seksi = $_POST["kode_seksi"];
        } else {
            $kode_seksi = ($this->session->userdata("kode_seksi") != "XXXX") ? $this->session->userdata("kode_seksi") : "all";
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
            $kode_bidang = ($this->session->userdata("kode_bidang") != "XXXX") ? $this->session->userdata("kode_bidang") : "all";
        }
        if (isset($_POST["kode_seksi"])) {
            $kode_seksi = $_POST["kode_seksi"];
        } else {
            $kode_seksi = ($this->session->userdata("kode_seksi") != "XXXX") ? $this->session->userdata("kode_seksi") : "all";
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
            $kode_bidang = ($this->session->userdata("kode_bidang") != "XXXX") ? $this->session->userdata("kode_bidang") : "all";
        }
        if (isset($_POST["kode_seksi"])) {
            $kode_seksi = $_POST["kode_seksi"];
        } else {
            $kode_seksi = ($this->session->userdata("kode_seksi") != "XXXX") ? $this->session->userdata("kode_seksi") : "all";
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

    public function bk_1()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }
        $model = $this->M_laporan;

        $id_sub_kegiatan = (isset($_POST["id_sub_kegiatan"])) ? $_POST["id_sub_kegiatan"] : "";
        $hide = (isset($_POST["id_sub_kegiatan"])) ? 1 : 0;
        $dari = (isset($_POST["dari"])) ? $_POST["dari"] : date('Y-m-01');
        $sampai = (isset($_POST["sampai"])) ? $_POST["sampai"] : date("Y-m-t");

        $data = array(
            "hide" => $hide,
            "id_sub_kegiatan" => $id_sub_kegiatan,
            "dari" => $dari,
            "sampai" => $sampai,
            "sub_kegiatan" => $model->get_all_sub(),
            "bk1" => $model->get_bk_1($id_sub_kegiatan, $dari, $sampai),
        );

        $this->template("bk_1", $data);
    }

    public function bk_2()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }
        $model = $this->M_laporan;

        $data = array(
            "hide" => 0,
            "id_sub_kegiatan" => "",
            "id_rekening" => "",
            "dari" => date("Y-m-01"),
            "sampai" => date("Y-m-t"),
            "sub_kegiatan" => $model->get_all_sub(),
        );

        if (isset($_POST["id_sub_kegiatan"])) {
            $id_sub_kegiatan = (isset($_POST["id_sub_kegiatan"])) ? $_POST["id_sub_kegiatan"] : "";
            $id_rekening = (isset($_POST["id_rekening"])) ? $_POST["id_rekening"] : "";
            $dari = (isset($_POST["dari"])) ? $_POST["dari"] : date('Y-m-01');
            $sampai = (isset($_POST["sampai"])) ? $_POST["sampai"] : date("Y-m-t");
            redirect("../bk-2/" . $id_sub_kegiatan . "/" . $id_rekening . "/" . $dari . "/" . $sampai);
        } else {
            $this->template("bk_2", $data);
        }
    }

    public function bk_2_2($id_sub_kegiatan, $id_rekening, $dari, $sampai)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }
        $model = $this->M_laporan;

        $data = array(
            "hide" => 1,
            "id_sub_kegiatan" => $id_sub_kegiatan,
            "id_rekening" => $id_rekening,
            "dari" => $dari,
            "sampai" => $sampai,
            "sub_kegiatan" => $model->get_all_sub(),
            "rekening" => $model->get_rek_by_id($id_sub_kegiatan),
            "bk2" => $model->get_bk_2($id_rekening, $dari, $sampai),
        );

        if (isset($_POST["id_sub_kegiatan"])) {
            $id_sub_kegiatan = (isset($_POST["id_sub_kegiatan"])) ? $_POST["id_sub_kegiatan"] : "";
            $id_rekening = (isset($_POST["id_rekening"])) ? $_POST["id_rekening"] : "";
            $dari = (isset($_POST["dari"])) ? $_POST["dari"] : date('Y-m-01');
            $sampai = (isset($_POST["sampai"])) ? $_POST["sampai"] : date("Y-m-t");
            redirect("../bk-2/" . $id_sub_kegiatan . "/" . $id_rekening . "/" . $dari . "/" . $sampai);
        } else {
            $this->template("bk_2", $data);
        }
    }

    public function bk_0()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }
        $model = $this->M_laporan;

        $hide = (isset($_POST["dari"])) ? 1 : 0;
        $dari = (isset($_POST["dari"])) ? $_POST["dari"] : date('Y-m-01');
        $sampai = (isset($_POST["sampai"])) ? $_POST["sampai"] : date("Y-m-t");

        $data = array(
            "hide" => $hide,
            "dari" => $dari,
            "sampai" => $sampai,
            "sub_kegiatan" => $model->get_all_sub(),
            "bk0" => $model->get_bk_0($dari, $sampai),
        );

        $this->template("bk_0", $data);
    }

    public function rak()
    {
        error_reporting(E_NOTICE ^ E_ALL);
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }
        $model = $this->M_laporan;
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

        $data["kode_bidang"] = $kode_bidang;
        $data["kode_seksi"] = $kode_seksi;
        $data["bln"] = array(
            "01" => "Jan",
            "02" => "Feb",
            "03" => "Mar",
            "04" => "Apr",
            "05" => "Mei",
            "06" => "Jun",
            "07" => "Jul",
            "08" => "Ags",
            "09" => "Sep",
            "10" => "Okt",
            "11" => "Nov",
            "12" => "Des"
        );

        $data["sub_kegiatan"] = $model->get_sub_kegiatan_rak($kode_bidang, $kode_seksi);
        $data["bidang"] = $model->get_bidang();
        $data["seksi"] = $model->get_seksi($kode_bidang);
        $data["laporan"] = "Laporan RAK";

        $this->template("lap_rak_rok", $data);
        // echo json_encode($data);
    }

    public function rok()
    {
        error_reporting(E_NOTICE ^ E_ALL);
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }
        $model = $this->M_laporan;
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

        $data["kode_bidang"] = $kode_bidang;
        $data["kode_seksi"] = $kode_seksi;
        $data["bln"] = array(
            "01" => "Jan",
            "02" => "Feb",
            "03" => "Mar",
            "04" => "Apr",
            "05" => "Mei",
            "06" => "Jun",
            "07" => "Jul",
            "08" => "Ags",
            "09" => "Sep",
            "10" => "Okt",
            "11" => "Nov",
            "12" => "Des"
        );

        $data["sub_kegiatan"] = $model->get_sub_kegiatan_rok($kode_bidang, $kode_seksi);
        $data["bidang"] = $model->get_bidang();
        $data["seksi"] = $model->get_seksi($kode_bidang);
        $data["laporan"] = "Laporan ROK";

        $this->template("lap_rak_rok", $data);
        // echo json_encode($data);
    }

    public function kinerja($detail = "")
    {
        error_reporting(E_NOTICE ^ E_ALL);
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_laporan;
        if (isset($_POST["kode_bidang"])) {
            $kode_bidang = $_POST["kode_bidang"];
        } else {
            $kode_bidang = ($this->session->userdata("kode_bidang") != "XXXX") ? $this->session->userdata("kode_bidang") : "all";
        }
        if (isset($_POST["kode_seksi"])) {
            $kode_seksi = $_POST["kode_seksi"];
        } else {
            $kode_seksi = ($this->session->userdata("kode_seksi") != "XXXX") ? $this->session->userdata("kode_seksi") : "all";
        }

        if (isset($_POST["simpan"])) {
            $post = $this->input->post();
            $hasil = $model->simpan_realisasi_faskes($post);
            if ($hasil['res']) {
                $this->session->set_flashdata('sukses', $hasil['msg']);
            } else {
                $this->session->set_flashdata('gagal', $hasil['msg']);
            }
        }

        $data["detail"] = ($detail == "") ? 0 : 1;
        $data["show"] = (isset($_POST["cari"]) || isset($_POST["simpan"])) ? 1 : 0;
        $data["kode_bidang"] = $kode_bidang;
        $data["kode_seksi"] = $kode_seksi;
        $data["bln"] = array(
            "01" => "Jan",
            "02" => "Feb",
            "03" => "Mar",
            "04" => "Apr",
            "05" => "Mei",
            "06" => "Jun",
            "07" => "Jul",
            "08" => "Ags",
            "09" => "Sep",
            "10" => "Okt",
            "11" => "Nov",
            "12" => "Des"
        );

        if ($data["detail"]) {
            $data["judul"] = "Pelaksana";
            $data["kinerja"] = $model->get_kinerja($kode_bidang, $kode_seksi);
        } else {
            $data["judul"] = "SKPD";
            $data["kinerja"] = $model->get_kinerja_all();
        }

        $data["bidang"] = $model->get_bidang();
        $data["seksi"] = $model->get_seksi($kode_bidang);

        if ($detail == "faskes") {
            $this->template("lap_kinerja_faskes", $data);
        } else {
            $this->template("lap_kinerja", $data);
        }

        // echo json_encode($data["bln"]);
    }

    public function grafik_kinerja()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_laporan;
        $data["bidang"] = $model->get_bidang();
        $data["bulan"] = date("m");
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

        $this->template("grafik_kinerja", $data);
    }

    public function grafik_kinerja_akumulasi()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_laporan;
        $data["bidang"] = $model->get_bidang();
        $data["bulan"] = date("m");
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

        $this->template("grafik_kinerja_akumulasi", $data);
    }

    public function sub_kegiatan()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_laporan;
        if (isset($_POST["kode_bidang"])) {
            $kode_bidang = $_POST["kode_bidang"];
        } else {
            $kode_bidang = ($this->session->userdata("kode_bidang") != "XXXX") ? $this->session->userdata("kode_bidang") : "all";
        }
        if (isset($_POST["kode_seksi"])) {
            $kode_seksi = $_POST["kode_seksi"];
        } else {
            $kode_seksi = ($this->session->userdata("kode_seksi") != "XXXX") ? $this->session->userdata("kode_seksi") : "all";
        }

        $data["kode_bidang"] = $kode_bidang;
        $data["kode_seksi"] = $kode_seksi;
        $data["bln"] = array(
            "01" => "Jan",
            "02" => "Feb",
            "03" => "Mar",
            "04" => "Apr",
            "05" => "Mei",
            "06" => "Jun",
            "07" => "Jul",
            "08" => "Ags",
            "09" => "Sep",
            "10" => "Okt",
            "11" => "Nov",
            "12" => "Des"
        );

        $data["sub_kegiatan"] = $model->get_lap_sub_kegiatan($kode_bidang, $kode_seksi);
        $data["bidang"] = $model->get_bidang();
        $data["seksi"] = $model->get_seksi($kode_bidang);

        $this->template("lap_sub_kegiatan", $data);
        // echo json_encode($data["sub_kegiatan"]);
    }

    public function kinerja_sub_kegiatan($kode_seksi)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_laporan;
        $data["sub_kegiatan"] = $model->get_kinerja_sub_kegiatan($kode_seksi);
        $data["bln"] = array(
            "01" => "Jan",
            "02" => "Feb",
            "03" => "Mar",
            "04" => "Apr",
            "05" => "Mei",
            "06" => "Jun",
            "07" => "Jul",
            "08" => "Ags",
            "09" => "Sep",
            "10" => "Okt",
            "11" => "Nov",
            "12" => "Des"
        );

        $this->template("lap_kinerja_sub_kegiatan", $data);
        // echo json_encode($data["sub_kegiatan"]);
    }
}

/* End of file Laporan.php */
