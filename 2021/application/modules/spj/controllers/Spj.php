<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Spj extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_spj');
    }

    public function index()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_spj;
        $kode_seksi = $this->session->userdata("kode_seksi");
        $kode_bidang = $this->session->userdata("kode_bidang");
        $data["spj"] = $model->get_spj($kode_seksi);
        $data["kode_bidang"] = $kode_bidang;
        $this->template("dashboard", $data);

        // echo json_encode($data["spj"]);
    }

    public function tambahGu()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_spj;
        $kode_seksi = $this->session->userdata("kode_seksi");

        $min = $model->get_min_tgl();
        $data["min_tgl"] = date('Y-m-d', strtotime($min));
        $data["id_unik"] = uniqid();
        $data["sub_kegiatan"] = $model->get_sub_kegiatan($kode_seksi);
        $this->template("tambahGu", $data);
    }

    public function tambahLs()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_spj;
        $kode_seksi = $this->session->userdata("kode_seksi");

        $min = $model->get_min_tgl();
        $data["min_tgl"] = date('Y-m-d', strtotime($min));
        $data["id_unik"] = uniqid();
        $data["sub_kegiatan"] = $model->get_sub_kegiatan($kode_seksi);
        $this->template("tambahLs", $data);
    }

    public function lihat($kode_spj)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_spj;
        $kode_seksi = $this->session->userdata("kode_seksi");

        $data["spj"] = $model->get_spj_by_kode($kode_spj);
        $data["verif"] = $model->get_verif_by_kode($kode_spj);
        $data["sub_kegiatan"] = $model->get_sub_kegiatan_by_id($data["spj"]->id_sub_kegiatan);
        $data["rekening"] = $model->get_rekening_by_id($data["spj"]->id_rekening);
        $data["rok"] = $model->get_rok_by_id($data["spj"]->id_rok);
        $data["pelaksana"] = $model->get_pelaksana($kode_spj);
        $this->template("lihat", $data);
    }

    public function ubah($kode_spj)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_spj;
        $kode_seksi = $this->session->userdata("kode_seksi");

        $data["spj"] = $model->get_spj_by_kode($kode_spj);

        $data["sub_kegiatan"] = $model->get_sub_kegiatan($kode_seksi);
        $data["list_rekening"] = $model->get_rekening($data["spj"]->id_sub_kegiatan);
        $data["list_rok"] = $model->get_rok($data["spj"]->id_rekening);

        $data["rekening"] = $model->get_rekening_by_id($data["spj"]->id_rekening);
        $data["rok"] = $model->get_rok_by_id($data["spj"]->id_rok);
        $data["pelaksana"] = $model->get_pelaksana($kode_spj);
        $this->template("ubah", $data);
    }

    public function a21()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_spj;
        $kode_seksi = $this->session->userdata("kode_seksi");

        $min = $model->get_min_tgl();
        $data["min_tgl"] = date('Y-m-d', strtotime($min));
        $data["id_unik"] = uniqid();
        $data["sub_kegiatan"] = $model->get_sub_kegiatan($kode_seksi);
        $this->template("a21", $data);

        // echo date('N', strtotime($min));
    }

    public function addGu()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_spj;
        $kode_seksi = $this->session->userdata("kode_seksi");

        $data["jenis"] = 0;
        $data["id_unik"] = uniqid();
        $data["sub_kegiatan"] = $model->get_sub_kegiatan($kode_seksi);
        $this->template("addSpj", $data);
    }

    public function addTu()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_spj;
        $kode_seksi = $this->session->userdata("kode_seksi");

        $data["jenis"] = 2;
        $data["id_unik"] = uniqid();
        $data["sub_kegiatan"] = $model->get_sub_kegiatan($kode_seksi);
        $this->template("addSpj", $data);
    }

    public function addLs()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_spj;
        $kode_seksi = $this->session->userdata("kode_seksi");

        $data["jenis"] = 1;
        $data["id_unik"] = uniqid();
        $data["sub_kegiatan"] = $model->get_sub_kegiatan($kode_seksi);
        $this->template("addSpj", $data);
    }

    // CRUD
    public function add()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        // perdin 5.1.02.04.01.0001 dan 5.1.02.04.01.0003
        $model = $this->M_spj;
        $post = $this->input->post();

        $hasil = $model->save($post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../spj");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            if ($post["jenis_spj"] == "0") {
                redirect("../spj/tambahGu");
            } elseif ($post["jenis_spj"] == "1") {
                redirect("../spj/tambahLs");
            } elseif ($post["jenis_spj"] == "2") {
                redirect("../spj/tambahTu");
            }
        }
    }

    public function addSpj()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        // perdin 5.1.02.04.01.0001 dan 5.1.02.04.01.0003
        $model = $this->M_spj;
        $post = $this->input->post();

        $hasil = $model->saveSpj($post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../spj");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            if ($post["jenis_spj"] == "0") {
                redirect("../spj/addGu");
            } elseif ($post["jenis_spj"] == "1") {
                redirect("../spj/addLs");
            } elseif ($post["jenis_spj"] == "2") {
                redirect("../spj/addTu");
            }
        }
    }

    public function edit($kode_spj)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        // perdin 5.1.02.04.01.0001 dan 5.1.02.04.01.0003
        $model = $this->M_spj;
        $post = $this->input->post();

        $hasil = $model->edit($kode_spj, $post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../spj");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../spj/ubah/" . $kode_spj);
        }
    }

    public function hapus($kode_spj)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        // perdin 5.1.02.04.01.0001 dan 5.1.02.04.01.0003
        $model = $this->M_spj;

        $hasil = $model->delete($kode_spj);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../spj");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../spj");
        }
    }

    public function create_a21()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        // perdin 5.1.02.04.01.0001 dan 5.1.02.04.01.0003
        $model = $this->M_spj;
        $post = $this->input->post();
        $data["sub_kegiatan"] = $model->get_sub_kegiatan_by_id($post["id_sub_kegiatan"]);
        $data["rekening"] = $model->get_rekening_by_id($post["id_rekening"]);

        $this->load->view('cetak_a21', $data);
    }
}

/* End of file Spj.php */
