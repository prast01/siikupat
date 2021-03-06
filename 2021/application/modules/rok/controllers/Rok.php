<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Rok extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_rok');
    }

    public function index()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }
        $model = $this->M_rok;
        $kode_seksi = $this->session->userdata("kode_seksi");
        $data["kode_seksi"] = $kode_seksi;
        $data["sub_kegiatan"] = $model->get_sub_kegiatan($kode_seksi);
        $data["sub_kegiatan_2"] = $model->get_sub_kegiatan_bagi();

        $this->template("dashboard", $data);
    }

    public function bulan($id, $seksi)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }
        $model = $this->M_rok;
        $kode_seksi = $this->session->userdata("kode_seksi");
        $data["id"] = $id;
        $data["kode_seksi"] = $kode_seksi;
        $data["seksi"] = $seksi;
        $data["bulan"] = $model->get_bulan($id, $seksi);

        $this->template("daftarBulan", $data);
        // echo json_encode($kode_seksi);
    }

    public function tambahDaftar($id_sub, $bulan, $seksi)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }
        $model = $this->M_rok;
        // $kode_seksi = ($this->session->userdata("kode_seksi") != "DJ001") ? $this->session->userdata("kode_seksi") : $seksi;
        $data["id"] = $id_sub;
        $data["bulan"] = $bulan;
        $data["kode_seksi"] = $seksi;
        $data["rok"] = $model->get_rok($id_sub, $bulan, $seksi);

        $this->template("tambahDaftar", $data);
        // echo json_encode($data["rok"]);
    }

    public function lihatDaftar($id_sub, $bulan, $seksi)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }
        $model = $this->M_rok;
        // $kode_seksi = ($this->session->userdata("kode_seksi") != "DJ001") ? $this->session->userdata("kode_seksi") : $seksi;
        $data["id"] = $id_sub;
        $data["bln"] = $bulan;
        $data["kode_seksi"] = $seksi;
        $data["rok"] = $model->get_rok($id_sub, $bulan, $seksi);
        $data["valid"] = $model->get_valid_bend($id_sub, $seksi, $bulan);
        $data["jml_rok"] = $model->get_jml_rok($id_sub, $seksi, $bulan);
        $data["jml_rak"] = $model->get_jml_rak($id_sub, $bulan);
        $data["jml_sisa"] = $model->get_sisa_bulan_lalu($id_sub, $bulan, $seksi);

        $this->template("lihatDaftar", $data);
        // echo json_encode($data["rok"]);
    }

    public function cetak($id_sub, $bulan, $seksi)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }
        $model = $this->M_rok;
        $data["id"] = $id_sub;
        $data["bln"] = $bulan;
        $data["rok"] = $model->get_rok($id_sub, $bulan, $seksi);
        $data["sisa"] = $model->get_sisa_bulan_lalu($id_sub, $bulan, $seksi);
        $data["rak"] = $model->get_jml_rak($id_sub, $bulan);
        $data["seksi"] = $model->get_seksi($seksi);
        $data["kegiatan"] = $model->get_kegiatan($id_sub);
        $data["rincian"] = $model->get_rincian($id_sub, $bulan);

        $this->load->view("cetak", $data);
        // echo json_encode($data);
    }

    // CRUD
    public function add()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_rok;
        $post = $this->input->post();

        $hasil = $model->save($post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../rok/tambahDaftar/" . $post["id_sub_kegiatan"] . "/" . $post["bulan"] . "/" . $post["kode_seksi"]);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../rok/tambahDaftar/" . $post["id_sub_kegiatan"] . "/" . $post["bulan"] . "/" . $post["kode_seksi"]);
        }
    }

    public function edit($id)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_rok;
        $post = $this->input->post();

        $hasil = $model->update($id, $post);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../rok/tambahDaftar/" . $post["id_sub_kegiatan"] . "/" . $post["bulan"] . "/" . $post["kode_seksi"]);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../rok/tambahDaftar/" . $post["id_sub_kegiatan"] . "/" . $post["bulan"] . "/" . $post["kode_seksi"]);
        }
    }

    public function hapus($id_sub, $bln, $id, $seksi)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_rok;
        $hasil = $model->delete($id);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../rok/tambahDaftar/" . $id_sub . "/" . $bln . "/" . $seksi);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../rok/tambahDaftar/" . $id_sub . "/" . $bln . "/" . $seksi);
        }
    }

    public function valid($id_sub, $bln, $seksi)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_rok;
        $hasil = $model->valid($id_sub, $bln, $seksi);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
        }

        if ($this->session->userdata("kode_seksi") == "XXXX") {
            redirect("../rok/lihatDaftar/" . $id_sub . "/" . $bln . "/" . $seksi);
        } else {
            redirect("../rok/bulan/" . $id_sub . "/" . $seksi);
        }
    }

    public function valid_bend($id_sub, $bln, $seksi)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_rok;
        $hasil = $model->valid_bend($id_sub, $bln, $seksi);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../rok/lihatDaftar/" . $id_sub . "/" . $bln . "/" . $seksi);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../rok/lihatDaftar/" . $id_sub . "/" . $bln . "/" . $seksi);
        }
    }

    public function batal($id_sub, $bln, $seksi)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_rok;
        $hasil = $model->batal($id_sub, $bln, $seksi);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);
        }

        if ($this->session->userdata("kode_seksi") == "XXXX") {
            redirect("../rok/lihatDaftar/" . $id_sub . "/" . $bln . "/" . $seksi);
        } else {
            redirect("../rok/bulan/" . $id_sub . "/" . $seksi);
        }
    }

    public function batal_bend($id_sub, $bln, $seksi)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_rok;
        $hasil = $model->batal($id_sub, $bln, $seksi);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../rok/lihatDaftar/" . $id_sub . "/" . $bln . "/" . $seksi);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../rok/lihatDaftar/" . $id_sub . "/" . $bln . "/" . $seksi);
        }
    }

    public function blok($blok, $id_sub, $bln, $seksi, $id_rok)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }

        $model = $this->M_rok;
        $hasil = $model->blok($blok, $id_rok);

        if ($hasil['res']) {
            $this->session->set_flashdata('sukses', $hasil['msg']);

            redirect("../rok/lihatDaftar/" . $id_sub . "/" . $bln . "/" . $seksi);
        } else {
            $this->session->set_flashdata('gagal', $hasil['msg']);

            redirect("../rok/lihatDaftar/" . $id_sub . "/" . $bln . "/" . $seksi);
        }
    }
}

/* End of file Rok.php */
