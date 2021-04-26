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

    // Data
    public function tambahUser()
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }

        $this->load->view('tambahUser');
    }

    public function ubahUser($id_user)
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }
        $model = $this->M_modal;
        $data = array(
            "data" => $model->get_user_by_id($id_user)
        );

        $this->load->view('ubahUser', $data);
    }
}

/* End of file Modal.php */
