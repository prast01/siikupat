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
        if ($this->session->userdata("id_user") != '') {
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
                $this->session->set_userdata("id_user", $data->id_user);
                $this->session->set_userdata("kode_seksi", $data->kode_seksi);
                $this->session->set_userdata("nama", $data->nama);

                redirect("../dashboard");
            } else {
                $this->session->set_flashdata('gagal', 'Nama Akun atau Kata Sandi Salah.');

                redirect("../");
            }
        } else {
            $this->session->set_flashdata('gagal', 'Nama Akun atau Kata Sandi Tidak Boleh Kosong.');

            redirect("../");
        }
    }

    public function get_autocomplete()
    {
        $model = $this->M_login;
        $result = $model->cari($_GET['term']);
        if (count($result) > 0) {
            foreach ($result as $row)
                $arr_result[] = $row->nama;
            echo json_encode($arr_result);
        }
    }
}

/* End of file Login.php */
