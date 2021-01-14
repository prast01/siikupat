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

        $no = 0;
        foreach ($data as $row) {
            $label[$no++] = $row->nama;
        };

        $hsl["label"] = $label;

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
        $valid = $model->cek_rok_valid($id_sub, $bln);
        $data = $model->get_rok($id_sub, $id_rekening, $bln);

        $no = 0;
        $hsl["valid"] = $valid;
        $hsl["count"] = count($data);
        foreach ($data as $row) {
            $hsl["rok"][$no++] = array(
                "id_rok" => $row->id_rok,
                "uraian" => $row->uraian,
                "nominal" => "Rp" . number_format($row->nominal, 0, ",", "."),
            );
        }

        echo json_encode($hsl);
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
        $valid = $model->cek_rok_valid($id_sub, $bln);
        $data = $model->get_rok($id_sub, $id_rekening, $bln);
        $rok = $model->get_uraian($id_rok);

        $no = 0;
        $hsl["valid"] = $valid;
        if ($id_rek == $id_rekening) {
            $hsl["count"] = count($data) + 1;
            $hsl["rok"][$no++] = array(
                "id_rok" => $rok->id_rok,
                "uraian" => $rok->uraian,
                "nominal" => "Rp" . number_format($rok->nominal, 0, ",", "."),
            );
        } else {
            $hsl["count"] = count($data);
        }

        foreach ($data as $row) {
            $hsl["rok"][$no++] = array(
                "id_rok" => $row->id_rok,
                "uraian" => $row->uraian,
                "nominal" => "Rp" . number_format($row->nominal, 0, ",", "."),
            );
        }

        echo json_encode($hsl);
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
}

/* End of file Service.php */
