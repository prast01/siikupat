<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Pengaturan extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_pengaturan');
    }

    public function index()
    {
        redirect("../");
    }

    public function pengguna()
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pengaturan;

        $data = array(
            "data" => $model->get_all_user(),
        );

        $this->template("dashboard_user", $data);
    }

    public function anggaran()
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pengaturan;

        $data = array(
            "data" => $model->get_all_pusk(),
        );

        $this->template("dashboard_anggaran", $data);
    }

    public function anggaran_detail($kode_pusk)
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pengaturan;

        $data = array(
            "kode_pusk" => $kode_pusk,
            "data" => $model->get_sub_kegiatan_by_pusk($kode_pusk),
        );

        $this->template("dashboard_anggaran_detail", $data);
    }

    public function rekening($kode_pusk, $id_sub_kegiatan)
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pengaturan;

        $data = array(
            "kode_pusk" => $kode_pusk,
            "id_sub_kegiatan" => $id_sub_kegiatan,
            "data" => $model->get_rekening_by_pusk($id_sub_kegiatan),
        );

        $this->template("dashboard_rekening", $data);
    }

    public function informasi()
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pengaturan;

        $data = array();

        $this->template("dashboard_info", $data);
    }

    // CRUD
    // USER
    public function tambahUser()
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pengaturan;
        $post = $this->input->post();

        $hasil = $model->save($post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
        }

        redirect("../pengaturan/pengguna");
    }

    public function ubahUser($id_user)
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pengaturan;
        $post = $this->input->post();

        $hasil = $model->edit($post, $id_user);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
        }

        redirect("../pengaturan/pengguna");
    }

    public function ubahSandi($id_user)
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pengaturan;
        $post = $this->input->post();

        $hasil = $model->ubahSandi($post, $id_user);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
        }

        redirect("../pengaturan/pengguna");
    }

    public function hapusUser($id_user)
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pengaturan;

        $hasil = $model->hapus($id_user);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
        }

        redirect("../pengaturan/pengguna");
    }

    // ANGGARAN
    public function tambahSub($kode_pusk)
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pengaturan;
        $post = $this->input->post();

        $hasil = $model->saveSub($post, $kode_pusk);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
        }

        if ($kode_pusk == "super") {
            redirect("../anggaran/" . $kode_pusk);
        } else {
            redirect("../sub-kegiatan/" . $kode_pusk);
        }
    }

    public function ubahSub($kode_pusk)
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pengaturan;
        $post = $this->input->post();

        $hasil = $model->editSub($post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
        }

        if ($kode_pusk == "super") {
            redirect("../anggaran/" . $kode_pusk);
        } else {
            redirect("../sub-kegiatan/" . $kode_pusk);
        }
    }

    public function hapusSub($kode_pusk, $id_sub_kegiatan)
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pengaturan;

        $hasil = $model->hapusSub($id_sub_kegiatan);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
        }

        if ($kode_pusk == "super") {
            redirect("../anggaran/" . $kode_pusk);
        } else {
            redirect("../sub-kegiatan/" . $kode_pusk);
        }
    }

    public function tambahRek($kode_pusk)
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pengaturan;
        $post = $this->input->post();

        $hasil = $model->saveRek($post, $kode_pusk);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
        }

        redirect("../rekening/" . $kode_pusk . "/" . $post["id_sub_kegiatan"]);
    }

    public function ubahRek($kode_pusk)
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pengaturan;
        $post = $this->input->post();

        $hasil = $model->editRek($post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
        }

        redirect("../rekening/" . $kode_pusk . "/" . $post["id_sub_kegiatan"]);
    }

    public function hapusRek($kode_pusk, $id_sub_kegiatan, $id_rekening)
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_pengaturan;

        $hasil = $model->hapusRek($id_rekening);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
        }

        redirect("../rekening/" . $kode_pusk . "/" . $id_sub_kegiatan);
    }
}

/* End of file Pengaturan.php */
