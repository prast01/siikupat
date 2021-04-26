<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_dashboard');
    }

    public function index()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_dashboard;

        $this->template("dashboard");
    }

    public function data($id_data)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }
        $model = $this->M_dashboard;

        $tahun = (isset($_POST["tahun"])) ? $_POST["tahun"] : date("Y");
        $show = (isset($_POST["lihat"])) ? 1 : 0;

        if (isset($_POST["simpan"])) {
            $post = $this->input->post();

            $hasil = $model->save($post);

            if ($hasil['res']) {
                $this->session->set_flashdata('sukses', $hasil['msg']);
            } else {
                $this->session->set_flashdata('gagal', $hasil['msg']);
            }

            $show = 1;
        }

        $data = array(
            "data" => $model->get_data($id_data, $tahun),
            "tahun" => $tahun,
            "show" => $show,
        );

        $this->template("dashboard_data", $data);
    }
}

/* End of file Dashboard.php */
