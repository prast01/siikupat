<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Modal extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_modal');
    }

    // User
    public function tambahUser()
    {
        if ($this->session->userdata('id_user_pusk') == '') {
            redirect('../', 'refresh');
        }

        $this->load->view('tambahUser');
    }

    public function ubahUser($id_user)
    {
        if ($this->session->userdata('id_user_pusk') == '') {
            redirect('../', 'refresh');
        }
        $model = $this->M_modal;
        $data = array(
            "data" => $model->get_user_by_id($id_user)
        );

        $this->load->view('ubahUser', $data);
    }

    public function ubahSandi($id_user)
    {
        if ($this->session->userdata('id_user_pusk') == '') {
            redirect('../', 'refresh');
        }
        $data = array(
            "id_user" => $id_user
        );

        $this->load->view('ubahSandi', $data);
    }

    // belanja
    public function tambahBelanja($jenis)
    {
        if ($this->session->userdata('id_user_pusk') == '') {
            redirect('../', 'refresh');
        }

        $data = array(
            "jenis" => $jenis,
        );

        $this->load->view('tambahBelanja', $data);
    }
}

/* End of file Modal.php */
