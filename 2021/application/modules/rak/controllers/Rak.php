<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Rak extends MY_Controller
{


    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_rak');
    }


    public function index()
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }
        $model = $this->M_rak;

        if (isset($_POST["kode_bidang"])) {
            $kode_bidang = $_POST["kode_bidang"];
        } else {
            $kode_bidang = ($this->session->userdata("kode_bidang") != "XXXX") ? $this->session->userdata("kode_bidang") : "all";
        }
        if (isset($_POST["kode_seksi"])) {
            $kode_seksi = $_POST["kode_seksi"];
        } else {
            $kode_seksi = ($this->session->userdata("kode_seksi") != "XXXX") ? $this->session->userdata("kode_seksi") : "all";
        }

        $data["kode_bidang"] = $kode_bidang;
        $data["kode_seksi"] = $kode_seksi;

        $data["sub_kegiatan"] = $model->get_sub_kegiatan($kode_bidang, $kode_seksi);
        $data["bidang"] = $model->get_bidang();
        $data["seksi"] = $model->get_seksi($kode_bidang);

        $this->template("dashboard", $data);
    }

    public function detail($id_sub_kegiatan)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }
        $model = $this->M_rak;

        if (isset($_POST["id_sub_kegiatan"])) {
            $post = $this->input->post();
            $hasil = $model->save($post);
            if ($hasil['res']) {
                $this->session->set_flashdata('sukses', $hasil['msg']);
            } else {
                $this->session->set_flashdata('gagal', $hasil['msg']);
            }
            // echo json_encode($post);
            redirect("../rak/detail/" . $id_sub_kegiatan);
        }

        $data["detail"] = $model->get_detail($id_sub_kegiatan);
        $data["id_sub_kegiatan"] = $id_sub_kegiatan;

        $lock = $this->db->get_where("tb_pengaturan", ["nama_pengaturan" => "lock_rak"])->row();
        $data["lock"] = $lock->nilai_pengaturan;

        $this->template("detail", $data);
    }

    public function cetak($kode_bidang, $kode_seksi)
    {
        if ($this->session->userdata("id_user") == "") {
            redirect("../");
        }
        $model = $this->M_rak;
        $data["bln"] = array(
            "01" => "Jan",
            "02" => "Feb",
            "03" => "Mar",
            "04" => "Apr",
            "05" => "Mei",
            "06" => "Jun",
            "07" => "Jul",
            "08" => "Ags",
            "09" => "Sep",
            "10" => "Okt",
            "11" => "Nov",
            "12" => "Des"
        );

        $data["sub_kegiatan"] = $model->get_sub_kegiatan_cetak($kode_bidang, $kode_seksi);

        $this->load->view('cetak', $data);
        // echo json_encode($data);
    }
}

/* End of file Rak.php */
