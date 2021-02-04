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
        $model->cek_spj_revisi();
        $data['seksi'] = $model->get_seksi();

        $this->template("dashboard", $data);

        // $tgl_min = date("Y-m-d H:i:s", strtotime($model->get_min_tgl()));
        // echo json_encode($tgl_min);
    }

    public function sub_kegiatan($kode_seksi)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_dashboard;

        $data['sub_kegiatan'] = $model->get_sub_kegiatan($kode_seksi);

        $this->template("sub_kegiatan", $data);
    }

    public function rekening($kode_seksi, $id_sub_kegiatan)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_dashboard;

        $data['rekening'] = $model->get_rekening($id_sub_kegiatan);
        $data['kode_seksi'] = $kode_seksi;

        $this->template("rekening", $data);
    }

    public function detail_rekening($kode_seksi, $id_sub_kegiatan, $id_rekening)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_dashboard;

        $data['spj'] = $model->get_detail_rekening($id_rekening);
        $data['id_sub_kegiatan'] = $id_sub_kegiatan;
        $data['kode_seksi'] = $kode_seksi;

        $this->template("detail_rekening", $data);
    }

    public function error()
    {
        $this->template("error");
    }
}

/* End of file Dashboard.php */
