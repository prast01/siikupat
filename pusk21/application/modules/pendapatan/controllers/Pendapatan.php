<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Pendapatan extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_pendapatan');
    }

    public function pagu()
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $kode_pusk = $this->session->userdata("kode_pusk");
        $model = $this->M_pendapatan;

        if (isset($_POST["kode_pusk"])) {
            $post = $this->input->post();

            $hasil = $model->savePagu($post);

            if ($hasil['res']) {
                $this->session->set_flashdata('sukses', $hasil['msg']);
            } else {
                $this->session->set_flashdata('gagal', $hasil['msg']);
            }

            redirect("../pendapatan");
        }

        $data = array(
            "kode_pusk" => $kode_pusk,
            "pendapatan_def" => $model->get_jenis_pendapatan_def(),
            "pendapatan_pusk" => $model->get_jenis_pendapatan_pusk($kode_pusk),
        );

        $this->template("dashboard", $data);
    }

    public function realisasi()
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pendapatan;
        $kode_pusk = $this->session->userdata("kode_pusk");

        $data = array(
            "kode_pusk" => $kode_pusk,
            "realisasi" => $model->get_realisasi($kode_pusk),
        );

        $this->template("realisasi", $data);
    }

    // CRUD
    public function tambahJenis($kode_pusk)
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pendapatan;
        $post = $this->input->post();

        $hasil = $model->save($post, $kode_pusk);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
        }

        redirect("../pagu-pendapatan");
    }

    public function ubahJenis($kode_pusk)
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pendapatan;
        $post = $this->input->post();

        $hasil = $model->edit($post, $kode_pusk);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
        }

        redirect("../pagu-pendapatan");
    }

    public function hapusJenis($kode_pusk, $id_jenis_pendapatan)
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pendapatan;

        $hasil = $model->hapus($id_jenis_pendapatan, $kode_pusk);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
        }

        redirect("../pagu-pendapatan");
    }

    public function tambahPendapatan($kode_pusk)
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pendapatan;
        $post = $this->input->post();

        $hasil = $model->savePendapatan($post, $kode_pusk);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
        }

        redirect("../realisasi-pendapatan");
    }

    public function ubahPendapatan($kode_pusk)
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pendapatan;
        $post = $this->input->post();

        $hasil = $model->editPendapatan($post, $kode_pusk);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
        }

        redirect("../realisasi-pendapatan");
    }

    public function hapusPendapatan($kode_pusk, $kode_bulan)
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pendapatan;

        $hasil = $model->hapusPendapatan($kode_pusk, $kode_bulan);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
        }

        redirect("../realisasi-pendapatan");
    }
}

/* End of file Pendapatan.php */
