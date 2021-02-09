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
        $data["antrian"] = $model->get_antrian($kode_bidang);
        $this->template("dashboard", $data);
        // echo json_encode($data["antrian"]);
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

    public function pembukuan($kode_spj)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_verifikasi;

        $data["spj"] = $model->get_spj_by_kode($kode_spj);
        $this->template("buku", $data);
    }

    public function add($kode_spj)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_verifikasi;
        $post = $this->input->post();

        if (isset($_POST["rekom"])) {
            $status = 1;
        } elseif (isset($_POST["setuju"])) {
            $status = 2;
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

    public function add_buku($kode_spj)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_verifikasi;
        $post = $this->input->post();

        $hasil = $model->save_buku($kode_spj, $post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../verifikasi");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../verifikasi/pembukuan/" . $kode_spj);
        }
    }

    public function batal($kode_spj)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_verifikasi;

        $hasil = $model->batal($kode_spj);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../verifikasi");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../verifikasi");
        }
    }
}

/* End of file Verifikasi.php */
