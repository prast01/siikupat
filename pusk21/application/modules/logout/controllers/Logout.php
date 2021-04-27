<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends MY_Controller
{

    public function index()
    {
        if ($this->session->userdata("id_user_pusk") != '') {
            $this->session->unset_userdata('id_user_pusk');
            $this->session->unset_userdata('nama');
            $this->session->unset_userdata('nama_kepala');
            $this->session->unset_userdata('nip_kepala');
        }

        redirect("../");
    }
}

/* End of file Logout.php */
