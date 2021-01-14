<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_pegawai');
    }

    public function index()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_pegawai;
        $data["pegawai"] = $model->get_pegawai();

        $this->template("dashboard", $data);
    }

    // CRUD
    public function add()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_pegawai;
        $post = $this->input->post();

        $hasil = $model->save($post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../pegawai");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../pegawai");
        }
    }

    public function edit($id)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_pegawai;
        $post = $this->input->post();

        $hasil = $model->update($id, $post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../pegawai");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../pegawai");
        }
    }

    public function hapus($id)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_pegawai;
        $hasil = $model->delete($id);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../pegawai");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../pegawai");
        }
    }

    public function statusPegawai($id)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_pegawai;
        $post = $this->input->post();

        $hasil = $model->statusPegawai($id, $post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../pegawai");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../pegawai");
        }
    }
}

/* End of file Pegawai.php */
