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

    // Anggaran
    public function tambahSubKegiatan($kode_pusk)
    {
        if ($this->session->userdata('id_user_pusk') == '') {
            redirect('../', 'refresh');
        }

        $data = array(
            "kode_pusk" => $kode_pusk
        );

        $this->load->view('tambahSub', $data);
    }

    public function ubahSubKegiatan($kode_pusk, $id_sub_kegiatan)
    {
        if ($this->session->userdata('id_user_pusk') == '') {
            redirect('../', 'refresh');
        }
        $model = $this->M_modal;
        $data = array(
            "data" => $model->get_sub_kegiatan_by_id($kode_pusk, $id_sub_kegiatan)
        );

        $this->load->view('ubahSub', $data);
    }

    public function tambahRekening($kode_pusk, $id_sub_kegiatan)
    {
        if ($this->session->userdata('id_user_pusk') == '') {
            redirect('../', 'refresh');
        }

        $data = array(
            "kode_pusk" => $kode_pusk,
            "id_sub_kegiatan" => $id_sub_kegiatan,
        );

        $this->load->view('tambahRek', $data);
    }

    public function ubahRekening($kode_pusk, $id_rekening)
    {
        if ($this->session->userdata('id_user_pusk') == '') {
            redirect('../', 'refresh');
        }
        $model = $this->M_modal;
        $data = array(
            "kode_pusk" => $kode_pusk,
            "data" => $model->get_rekening_by_id($id_rekening)
        );

        $this->load->view('ubahRek', $data);
    }


    // PENDAPATAN
    public function tambahJenisPendapatan($kode_pusk)
    {
        if ($this->session->userdata('id_user_pusk') == '') {
            redirect('../', 'refresh');
        }

        $data = array(
            "kode_pusk" => $kode_pusk
        );

        $this->load->view('tambahJenisPendapatan', $data);
    }

    public function ubahJenisPendapatan($id_jenis_pendapatan)
    {
        if ($this->session->userdata('id_user_pusk') == '') {
            redirect('../', 'refresh');
        }

        $model = $this->M_modal;
        $data = array(
            "data" => $model->get_jenis_pendapatan_by_id($id_jenis_pendapatan)
        );

        $this->load->view('ubahJenisPendapatan', $data);
    }

    public function tambahPendapatan($kode_pusk)
    {
        if ($this->session->userdata('id_user_pusk') == '') {
            redirect('../', 'refresh');
        }
        $model = $this->M_modal;

        $bulan = array(
            "01" => "Januari",
            "02" => "Februari",
            "03" => "Maret",
            "04" => "April",
            "05" => "Mei",
            "06" => "Juni",
            "07" => "Juli",
            "08" => "Agustus",
            "09" => "September",
            "10" => "Oktober",
            "11" => "November",
            "12" => "Desember"
        );

        $data = array(
            "kode_pusk" => $kode_pusk,
            "bulan" => $bulan,
            "pendapatan" => $model->get_jenis_pendapatan($kode_pusk),
        );

        $this->load->view('tambahPendapatan', $data);
    }

    public function ubahPendapatan($kode_pusk, $kode_bulan)
    {
        if ($this->session->userdata('id_user_pusk') == '') {
            redirect('../', 'refresh');
        }
        $model = $this->M_modal;

        $bulan = array(
            "01" => "Januari",
            "02" => "Februari",
            "03" => "Maret",
            "04" => "April",
            "05" => "Mei",
            "06" => "Juni",
            "07" => "Juli",
            "08" => "Agustus",
            "09" => "September",
            "10" => "Oktober",
            "11" => "November",
            "12" => "Desember"
        );

        $data = array(
            "kode_pusk" => $kode_pusk,
            "kode_bulan" => $kode_bulan,
            "bulan" => $bulan,
            "pendapatan" => $model->get_jenis_pendapatan($kode_pusk),
        );

        $this->load->view('ubahPendapatan', $data);
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
