<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_verifikasi');
    }


    public function index()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_verifikasi;
        $kode_bidang = $this->session->userdata("kode_bidang");
        $data["spj"] = $model->get_spj($kode_bidang, 1);
        $data["acc"] = $model->get_spj($kode_bidang, 2);
        $this->template("dashboard", $data);
    }

    public function lihat($kode_spj)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_verifikasi;

        $data["spj"] = $model->get_spj_by_kode($kode_spj);
        $data["verif"] = $model->get_verif_by_kode($kode_spj);
        $data["sub_kegiatan"] = $model->get_sub_kegiatan_by_id($data["spj"]->id_sub_kegiatan);
        $data["rekening"] = $model->get_rekening_by_id($data["spj"]->id_rekening);
        $data["rok"] = $model->get_rok_by_id($data["spj"]->id_rok);
        $data["pelaksana"] = $model->get_pelaksana($kode_spj);
        $this->template("lihat", $data);
    }

    public function add($kode_spj)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_verifikasi;
        $post = $this->input->post();

        if (isset($_POST["setuju"])) {
            $status = 1;
        } else {
            $status = 0;
        }

        $hasil = $model->save($kode_spj, $post, $status);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../verifikasi");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../verifikasi/lihat/" . $kode_spj);
        }
    }
}

/* End of file Verifikasi.php */
