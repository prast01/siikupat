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
        if ($this->session->userdata("id_user") == "") {
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

    public function data_rekening_seksi($id_sub_kegiatan)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_service;

        $search = $_GET["search"];
        $data = $model->get_rekening_seksi($search, $id_sub_kegiatan);

        $no = 0;
        foreach ($data as $row) {
            $hsl[$no++] = array(
                "id_rekening" => $row->id_rekening,
                "kode_rekening" => $row->kode_rekening,
                "nama_rekening" => $row->nama_rekening,
            );
        }

        echo json_encode($hsl);
    }

    public function data_realisasi()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_service;

        $data = $model->get_realisasi();

        echo json_encode($data);
    }

    public function get_rekening($id_sub_kegiatan)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_service;

        $data = $model->get_rekening_seksi2($id_sub_kegiatan);

        $no = 0;
        $hsl = array();
        foreach ($data as $row) {
            $hsl[$no++] = array(
                "id_rekening" => $row->id_rekening,
                "kode_rekening" => $row->kode_rekening,
                "nama_rekening" => $row->nama_rekening,
            );
        }

        echo json_encode($hsl);
    }

    public function get_rok($id_sub, $id_rekening, $tgl)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_service;

        $bln = date("m", strtotime($tgl));
        $data = $model->get_rok($id_sub, $id_rekening, $bln);

        echo json_encode($data);
    }

    public function get_rok_a21($id_sub, $id_rekening)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_service;

        $bln = date("m");
        $data = $model->get_rok_a21($id_sub, $id_rekening, $bln);

        echo json_encode($data);
    }

    public function get_rok_ubah($id_sub, $id_rekening, $tgl)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_service;
        $id_rok = $_POST["id_rok"];
        $id_rek = $_POST["id_rek"];

        $bln = date("m", strtotime($tgl));
        $data = $model->get_rok_ubah($id_sub, $id_rekening, $bln, $id_rek, $id_rok);

        echo json_encode($data);
    }

    public function get_uraian($id_rok)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_service;

        $data = $model->get_uraian($id_rok);

        echo json_encode($data);
    }

    public function set_pelaksana($id_pegawai, $nominal)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_service;

        $data = $model->get_pegawai($id_pegawai);
        $hsl = array(
            "id_row" => uniqid(),
            "id_pegawai" => $id_pegawai,
            "nama_pegawai" => $data->nama_pegawai,
            "nominal" => number_format($nominal, 0, ",", "."),
        );

        echo json_encode($hsl);
    }

    public function get_seksi($kode_bidang = "")
    {
        $model = $this->M_service;
        $data = $model->get_seksi($kode_bidang);

        echo json_encode($data);
    }

    public function get_antrian()
    {
        $model = $this->M_service;
        $data = $model->get_antrian();

        echo json_encode($data);
    }

    public function get_antrian_verif($status)
    {
        $model = $this->M_service;
        $data = $model->get_antrian_verif($status);

        echo json_encode($data);
    }
}

/* End of file Service.php */
