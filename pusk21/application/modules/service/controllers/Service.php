<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Service extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_service');
    }

    public function data_rekening()
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_service;

        $search = $_GET["search"];
        $data = $model->get_rekening_master($search);

        $no = 0;
        foreach ($data as $row) {
            $hsl[$no++] = array(
                "kode_rekening" => $row->kode_rekening,
                "nama_rekening" => $row->nama_rekening,
            );
        }

        echo json_encode($hsl);
    }
}

/* End of file Service.php */
