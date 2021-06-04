<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_login');
    }

    public function index()
    {
        if ($this->session->userdata("id_user_pusk") != '') {
            redirect("../dashboard");
        }
        // $this->load->view('home');
        $this->load->view('home2');
    }

    public function auth()
    {
        $model = $this->M_login;
        $post = $this->input->post();

        if ($post['nama'] != '' || $post['sandi'] != '') {
            $data = $model->auth($post['nama'], $post['sandi']);

            if ($data->sandi == $post['sandi']) {
                $this->session->set_userdata("id_user_pusk", $data->id_user);
                $this->session->set_userdata("nama", $data->nama);
                $this->session->set_userdata("kode_pusk", $data->kode_pusk);

                if ($data->sandi == "123") {
                    $this->session->set_flashdata('gagal', 'Silahkan Ubah Kata Sandi Anda terlebih dahulu !');
                    redirect("../ubah-sandi");
                } else {
                    $this->session->set_flashdata('sukses', 'Selamat Datang di Aplikasi Si Kupat - Dinas Kesehatan Kabupaten Jepara.');
                    redirect("../dashboard");
                }
            } else {
                $this->session->set_flashdata('gagal', 'Kode Puskesmas atau Kata Sandi Salah.');

                redirect("../");
            }
        } else {
            $this->session->set_flashdata('gagal', 'Kode Puskesmas atau Kata Sandi Tidak Boleh Kosong.');

            redirect("../");
        }
    }

    public function ubahSandi()
    {
        if ($this->session->userdata("id_user_pusk") == '') {
            redirect("../");
        }

        $kode_pusk = $this->session->userdata("kode_pusk");

        $data = array(
            "kode_pusk" => $kode_pusk,
        );

        $cek = $this->db->get_where("tb_user", $data)->row();
        if ($cek->sandi != "123") {
            redirect("../");
        }

        $this->load->view('password', $data);
    }


    public function ubah($id_user)
    {
        if ($this->session->userdata("id_user_pusk") == "") {
            redirect("../");
        }

        $model = $this->M_login;
        $post = $this->input->post();

        $hasil = $model->ubahSandi($post, $id_user);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
            redirect("../dashboard");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
            redirect("../ubah-sandi");
        }
    }
}

/* End of file Login.php */
