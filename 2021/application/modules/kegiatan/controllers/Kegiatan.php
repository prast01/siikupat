<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kegiatan extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_kegiatan');
    }


    public function index()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }
        $model = $this->M_kegiatan;

        $data['kegiatan'] = $model->get_kegiatan();

        $this->template("dashboard", $data);
    }

    public function sub($id)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }
        $model = $this->M_kegiatan;

        $data['id'] = $id;
        $data['sub_kegiatan'] = $model->get_sub_kegiatan($id);

        $this->template("dashboardSub", $data);
    }

    public function rekening($id, $id_sub)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }
        $model = $this->M_kegiatan;

        $data['id'] = $id;
        $data['id_sub'] = $id_sub;
        $data['rekening'] = $model->get_rekening($id_sub);

        $this->template("dashboardRek", $data);
    }


    // CRUD
    public function add()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_kegiatan;
        $post = $this->input->post();

        $hasil = $model->save($post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../kegiatan");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../kegiatan");
        }
    }

    public function addSub()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_kegiatan;
        $post = $this->input->post();

        $hasil = $model->saveSub($post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../kegiatan/sub/" . $post["id_kegiatan"]);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../kegiatan/sub/" . $post["id_kegiatan"]);
        }
    }

    public function addRek()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_kegiatan;
        $post = $this->input->post();

        $hasil = $model->saveRek($post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../kegiatan/rekening/" . $post["id_kegiatan"] . "/" . $post["id_sub_kegiatan"]);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../kegiatan/rekening/" . $post["id_kegiatan"] . "/" . $post["id_sub_kegiatan"]);
        }
    }

    public function edit($id)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_kegiatan;
        $post = $this->input->post();

        $hasil = $model->update($id, $post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../kegiatan");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../kegiatan");
        }
    }

    public function editSub($id)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_kegiatan;
        $post = $this->input->post();

        $hasil = $model->updateSub($id, $post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../kegiatan/sub/" . $post['id_kegiatan']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../kegiatan/sub/" . $post['id_kegiatan']);
        }
    }

    public function editRek($id)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_kegiatan;
        $post = $this->input->post();

        $hasil = $model->updateRek($id, $post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../kegiatan/rekening/" . $post["id_kegiatan"] . "/" . $post["id_sub_kegiatan"]);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../kegiatan/rekening/" . $post["id_kegiatan"] . "/" . $post["id_sub_kegiatan"]);
        }
    }

    public function pemutihan($id)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_kegiatan;
        $post = $this->input->post();

        $hasil = $model->pemutihan($id, $post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../kegiatan/rekening/" . $post["id_kegiatan"] . "/" . $post["id_sub_kegiatan"]);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../kegiatan/rekening/" . $post["id_kegiatan"] . "/" . $post["id_sub_kegiatan"]);
        }
    }

    public function hapus($id)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_kegiatan;

        $hasil = $model->delete($id);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../kegiatan");
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../kegiatan");
        }
    }

    public function hapusSub($id, $id_sub)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_kegiatan;

        $hasil = $model->deleteSub($id_sub);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../kegiatan/sub/" . $id);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../kegiatan/sub/" . $id);
        }
    }

    public function hapusRek($id, $id_sub, $id_rek)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_kegiatan;

        $hasil = $model->deleteRek($id_rek);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../kegiatan/rekening/" . $id . "/" . $id_sub);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../kegiatan/rekening/" . $id . "/" . $id_sub);
        }
    }
}

/* End of file Kegiatan.php */
