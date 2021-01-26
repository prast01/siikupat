<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Transfer extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_transfer');
    }

    public function index()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }
        $model = $this->M_transfer;
        $data["spj"] = $model->get_spj();

        $this->template("dashboard", $data);
    }

    public function pembukuan($kode_spj)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_transfer;

        $data["spj"] = $model->get_spj_by_kode($kode_spj);
        $this->template("buku", $data);
    }

    // CRUD
    public function add($kode_spj)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_transfer;

        $hasil = $model->save($kode_spj);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../transfer");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../transfer");
        }
    }
    public function add_buku($kode_spj)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_transfer;
        $post = $this->input->post();

        $hasil = $model->save_buku($kode_spj, $post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../transfer");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../transfer/pembukuan/" . $kode_spj);
        }
    }
}

/* End of file Transfer.php */
