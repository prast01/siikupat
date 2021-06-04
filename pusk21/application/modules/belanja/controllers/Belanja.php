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

        $model = $this->M_belanja;

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
            "belanja" => $model->get_belanja($bln, $jenis),
        );

        $this->template("dashboard", $data);
        // echo json_encode($data);
    }

    // CRUD
    public function tambahBelanja($jenis)
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_belanja;
        $kode_pusk = $this->session->userdata("kode_pusk");
        $post = $this->input->post();

        $hasil = $model->saveBelanja($post, $kode_pusk, $jenis);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
        }

        redirect("../belanja-" . strtolower($jenis));
    }

    public function ubahBelanja($jenis)
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_belanja;
        $kode_pusk = $this->session->userdata("kode_pusk");
        $post = $this->input->post();

        $hasil = $model->editBelanja($post, $kode_pusk, $jenis);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
        }

        redirect("../belanja-" . strtolower($jenis));
    }

    public function hapusBelanja($id_belanja, $jenis)
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_belanja;

        $hasil = $model->hapusBelanja($id_belanja, $jenis);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
        }

        redirect("../belanja-" . strtolower($jenis));
    }
}

/* End of file Belanja.php */
