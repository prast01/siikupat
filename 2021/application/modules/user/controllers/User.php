<?php


defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_user');
    }

    public function index()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }
        $model = $this->M_user;
        $data["user"] = $model->get_user();

        $this->template("dashboard", $data);
    }

    // CRUD
    public function edit($id)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_user;
        $post = $this->input->post();

        $hasil = $model->update($id, $post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../user");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../user");
        }
    }

    public function editBidang($id)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_user;
        $post = $this->input->post();

        $hasil = $model->updateBidang($id, $post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../bidang");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../bidang");
        }
    }

    public function kesempatan($id)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_user;
        $post = $this->input->post();

        $hasil = $model->kesempatan($id, $post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../user");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../user");
        }
    }

    public function reset($id)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_user;
        $post = $this->input->post();

        $hasil = $model->reset($id, $post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../user");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../user");
        }
    }
}

/* End of file User.php */
