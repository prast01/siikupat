<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Belanja extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_belanja');
    }

    public function beranda($jenis)
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $bln = (isset($_POST["bulan"])) ? $_POST["bulan"] : date("m");

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

        $data = array(
            "judul" => strtoupper($jenis),
            "bln" => $bln,
            "arr_bln" => $bulan,
        );

        $this->template("dashboard", $data);
    }
}

/* End of file Belanja.php */
