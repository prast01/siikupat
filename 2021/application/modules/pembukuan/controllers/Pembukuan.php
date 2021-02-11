<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pembukuan extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_pembukuan');
    }

    public function index()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }
        $model = $this->M_pembukuan;
        $data["spj"] = $model->get_spj();

        $this->template("dashboard", $data);
    }

    public function lihat($kode_spj)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_pembukuan;

        $data["spj"] = $model->get_spj_by_kode($kode_spj);
        $data["buku"] = $model->get_buku_by_kode($kode_spj);
        $this->template("buku", $data);
    }

    public function tambah($kode_spj)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_pembukuan;

        $data["spj"] = $model->get_spj_by_kode($kode_spj);
        $data["buku"] = $model->get_buku_by_kode($kode_spj);
        $this->template("tambahBuku", $data);
    }

    // CRUD
    public function add_buku($kode_spj)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_pembukuan;
        $post = $this->input->post();

        if (isset($_POST["tolak"])) {
            $status = 0;
        } else {
            $status = 1;
        }


        $hasil = $model->save_buku($kode_spj, $post, $status);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../pembukuan");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../pembukuan/tambah/" . $kode_spj);
        }
    }

    public function transfer($kode_spj)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_pembukuan;
        $hasil = $model->transfer($kode_spj);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../pembukuan");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../pembukuan/tambah/" . $kode_spj);
        }
    }
}

/* End of file Pembukuan.php */
