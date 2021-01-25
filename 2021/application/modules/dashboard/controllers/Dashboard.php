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

        $data['seksi'] = $model->get_seksi();

        $this->template("dashboard", $data);
        // echo json_encode($data);
    }

    public function error()
    {
        $this->template("error");
    }
}

/* End of file Dashboard.php */
