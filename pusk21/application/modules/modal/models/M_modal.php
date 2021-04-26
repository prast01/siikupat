<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_modal extends CI_Model
{

    public function get_user_by_id($id_user)
    {
        $data = $this->db->get_where("tb_user", ["id_user" => $id_user])->row();

        return $data;
    }
}

/* End of file M_modal.php */
