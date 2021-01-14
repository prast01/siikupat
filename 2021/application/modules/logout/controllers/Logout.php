<?php 


defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends MY_Controller {

    public function index()
    {
        if ($this->session->userdata("id_user") != '') {
            $this->session->unset_userdata('id_user');            
            $this->session->unset_userdata('nama');
        }

        redirect("../");
    }

}

/* End of file Logout.php */
