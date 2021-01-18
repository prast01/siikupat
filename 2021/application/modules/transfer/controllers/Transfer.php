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
}

/* End of file Transfer.php */
