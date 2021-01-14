<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Bidang extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_bidang');
    }

    public function index()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }
        $model = $this->M_bidang;
        $data["bidang"] = $model->get_bidang();

        $this->template("dashboard", $data);
    }
}

/* End of file Bidang.php */
