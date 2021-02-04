<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Up extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_up');
    }


    public function index()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_up;
        $data = array(
            "up" => $model->get_up(),
        );
        $this->template("dashboard", $data);
    }


    // CRUD
    public function add()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_up;
        $post = $this->input->post();

        $hasil = $model->save($post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../up");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../up");
        }
    }

    public function edit($id_up)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_up;
        $post = $this->input->post();

        $hasil = $model->edit($id_up, $post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../up");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../up");
        }
    }
}

/* End of file Up.php */
