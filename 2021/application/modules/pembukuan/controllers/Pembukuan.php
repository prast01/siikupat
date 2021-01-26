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
}

/* End of file Pembukuan.php */
