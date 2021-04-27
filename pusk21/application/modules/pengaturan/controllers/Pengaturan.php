<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_pengaturan');
    }

    public function index()
    {
        redirect("../");
    }

    public function pengguna()
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pengaturan;

        $data = array(
            "data" => $model->get_all_user(),
        );

        $this->template("dashboard_user", $data);
    }

    // CRUD
    public function tambahUser()
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pengaturan;
        $post = $this->input->post();

        $hasil = $model->save($post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
        }

        redirect("../pengaturan/pengguna");
    }

    public function ubahUser($id_user)
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pengaturan;
        $post = $this->input->post();

        $hasil = $model->edit($post, $id_user);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
        }

        redirect("../pengaturan/pengguna");
    }

    public function ubahSandi($id_user)
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pengaturan;
        $post = $this->input->post();

        $hasil = $model->ubahSandi($post, $id_user);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
        }

        redirect("../pengaturan/pengguna");
    }

    public function hapusUser($id_user)
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pengaturan;

        $hasil = $model->hapus($id_user);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
        }

        redirect("../pengaturan/pengguna");
    }
}

/* End of file Pengaturan.php */
