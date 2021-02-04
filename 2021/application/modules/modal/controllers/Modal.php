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

    // TAMBAH DATA
    public function addKegiatan()
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }
        $this->load->view('addKegiatan');
    }

    public function addSubKegiatan($id)
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }
        $model = $this->M_modal;

        $data['id'] = $id;
        $data["seksi"] = $model->get_seksi();
        $this->load->view('addSubKegiatan', $data);
    }

    public function addRekening($id)
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }
        $model = $this->M_modal;

        $data['id'] = $id;
        $data['sub'] = $model->get_sub_kegiatan_by_id($id);
        $data['rekening'] = $model->get_rekening_master();

        $this->load->view('addRekening', $data);
    }

    public function addPegawai()
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }
        $this->load->view('addPegawai');
    }

    public function addPengaturan()
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }
        $this->load->view('addPengaturan');
    }

    public function addRok($id_sub, $bln, $kode_seksi)
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }
        $model = $this->M_modal;
        // $kode_seksi = $this->session->userdata("kode_seksi");

        $data["id_sub"] = $id_sub;
        $data["bln"] = $bln;
        $data["kode_seksi"] = $kode_seksi;
        $data["rek"] = $model->get_rekening($id_sub);

        $this->load->view('addRok', $data);
    }

    public function addPelaksana()
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }
        $model = $this->M_modal;
        $data["pegawai"] = $model->get_semua_pegawai();

        $this->load->view('addPelaksana', $data);
    }

    public function addUp()
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }
        $this->load->view('addUp');
    }


    // UBAH DATA
    public function ubahSandi()
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }
        $this->load->view('ubahSandi');
    }

    public function ubahBidang($id)
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }
        $model = $this->M_modal;

        $data['bidang'] = $model->get_bidang_by_id($id);
        $data['pegawai'] = $model->get_pegawai();

        $this->load->view('ubahBidang', $data);
    }

    public function ubahUser($id)
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }
        $model = $this->M_modal;

        $data['user'] = $model->get_user_by_id($id);
        $data['bidang'] = $model->get_bidang();
        $data['pegawai'] = $model->get_pegawai();

        $this->load->view('ubahUser', $data);
    }

    public function passwordUser($id)
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }
        $model = $this->M_modal;

        $data['user'] = $model->get_user_by_id($id);

        $this->load->view('passwordUser', $data);
    }

    public function kesempatan($id)
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }
        $model = $this->M_modal;

        $data['user'] = $model->get_user_by_id($id);

        $this->load->view('kesempatan', $data);
    }

    public function ubahKegiatan($id)
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }
        $model = $this->M_modal;

        $data['id'] = $id;
        $data['kegiatan'] = $model->get_kegiatan_by_id($id);

        $this->load->view('ubahKegiatan', $data);
    }

    public function ubahSubKegiatan($id)
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }
        $model = $this->M_modal;

        $data['sub'] = $model->get_sub_kegiatan_by_id($id);
        $data["seksi"] = $model->get_seksi();

        $this->load->view('ubahSubKegiatan', $data);
    }

    public function ubahRekening($id)
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }
        $model = $this->M_modal;

        $data['rekening'] = $model->get_rekening_by_id($id);
        $data['sub'] = $model->get_sub_kegiatan_by_id($data['rekening']->id_sub_kegiatan);

        $this->load->view('ubahRekening', $data);
    }

    public function pemutihan($id)
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }
        $model = $this->M_modal;

        $data['rekening'] = $model->get_rekening_by_id($id);
        $data['sub'] = $model->get_sub_kegiatan_by_id($data['rekening']->id_sub_kegiatan);

        $this->load->view('pemutihan', $data);
    }

    public function ubahPegawai($id)
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }
        $model = $this->M_modal;

        $data['pegawai'] = $model->get_pegawai_by_id($id);

        $this->load->view('ubahPegawai', $data);
    }

    public function statusPegawai($id)
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }
        $model = $this->M_modal;

        $data['pegawai'] = $model->get_pegawai_by_id($id);

        $this->load->view('statusPegawai', $data);
    }

    public function ubahPengaturan($id)
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }
        $model = $this->M_modal;

        $data['pengaturan'] = $model->get_pengaturan_by_id($id);

        $this->load->view('ubahPengaturan', $data);
    }

    public function statusPengaturan($id)
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }
        $model = $this->M_modal;

        $data['pengaturan'] = $model->get_pengaturan_by_id($id);

        $this->load->view('statusPengaturan', $data);
    }

    public function ubahRok($id, $kode_seksi)
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }
        $model = $this->M_modal;
        // $kode_seksi = $this->session->userdata("kode_seksi");
        $data["kode_seksi"] = $kode_seksi;
        $data["rok"] = $model->get_rok_by_id($id);
        $data["rek"] = $model->get_rekening($data["rok"]->id_sub_kegiatan);

        $this->load->view('ubahRok', $data);
    }

    public function ubahUp($id)
    {
        if ($this->session->userdata('id_user') == '') {
            redirect('../', 'refresh');
        }
        $model = $this->M_modal;

        $data['up'] = $model->get_up_by_id($id);

        $this->load->view('ubahUp', $data);
    }
}

/* End of file Modal.php */
