<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Lain extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_lain');
    }

    public function index()
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }

        $model = $this->M_lain;
        $data['pengaturan'] = $model->get_pengaturan();

        $this->template("dashboard", $data);
    }


    // CRUD
    public function add()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_lain;
        $post = $this->input->post();

        $hasil = $model->save($post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../lain");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../lain");
        }
    }

    public function edit($id)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_lain;
        $post = $this->input->post();

        $hasil = $model->update($id, $post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../lain");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../lain");
        }
    }

    public function hapus($id)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_lain;
        $hasil = $model->delete($id);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../lain");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../lain");
        }
    }

    public function status($id)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_lain;
        $post = $this->input->post();

        $hasil = $model->status($id, $post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../lain");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../lain");
        }
    }
}

/* End of file Lain.php */
