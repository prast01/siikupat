<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UbahSandi extends MY_Controller
{

    public function index()
    {
        $post = $this->input->post();
        $id_user = $this->session->userdata("id_user");

        if ($post['sandi'] == $post['sandi2']) {
            $data = array(
                "sandi" => $post['sandi2']
            );
            $where = array(
                "id_user" => $id_user
            );

            $this->db->update("tb_user", $data, $where);

            $this->session->set_flashdata('sukses', 'Kata Sandi Berhasil Diubah');

            redirect("../dashboard");
        } else {
            $this->session->set_flashdata('gagal', 'Kata Sandi Gagal Diubah');

            redirect("../dashboard");
        }
    }
}

/* End of file UbahSandi.php */
