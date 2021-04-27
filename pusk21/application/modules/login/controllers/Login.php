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

                redirect("../dashboard");
            } else {
                $this->session->set_flashdata('gagal', 'Kode Puskesmas atau Kata Sandi Salah.');

                redirect("../");
            }
        } else {
            $this->session->set_flashdata('gagal', 'Kode Puskesmas atau Kata Sandi Tidak Boleh Kosong.');

            redirect("../");
        }
    }
}

/* End of file Login.php */
