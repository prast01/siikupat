<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Api extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        //Do your magic here
        $this->load->model('M_api');
    }

    public function auth()
    {
        $model = $this->M_api;
        $post = $this->input->post();

        $hsl = $model->auth($post);

        echo $hsl;
    }

    public function refresh()
    {
        $model = $this->M_api;
        $post = $this->input->post();

        $hsl = $model->refresh($post);

        echo $hsl;
    }

    public function data_tahunan()
    {
        $model = $this->M_api;
        $post = $this->input->post();

        if (!isset($post["tahun"]) || $post["tahun"] == "") {
            echo $model->response(502, true, array("message" => "Tahun Wajib di sertakan"));
        } else {
            $hsl = $model->cek_token($post);
            if ($hsl) {
                echo $model->response(502, true, array("message" => "Token Tidak Sesuai atau Sudah Kadaluarsa. Silahkan Melakukan Auth Kembali"));
            } else {
                $model->insert_history($post["token"], "Pengambilan data tahun : " . $post["tahun"]);
                $data = $model->get_data_tahunan($post["tahun"]);

                echo $data;
            }
        }
    }

    public function data_kecamatan($kode_kecamatan)
    {
        $model = $this->M_api;
        $post = $this->input->post();

        if ($kode_kecamatan == "") {
            echo $model->response(502, true, array("message" => "Kode Kecamatan Wajib di sertakan"));
        } elseif (!isset($post["tahun"]) || $post["tahun"] == "") {
            echo $model->response(502, true, array("message" => "Tahun Wajib di sertakan"));
        } else {
            $hsl = $model->cek_token($post);
            if ($hsl) {
                echo $model->response(502, true, array("message" => "Token Tidak Sesuai atau Sudah Kadaluarsa. Silahkan Melakukan Auth Kembali"));
            } else {
                $model->insert_history($post["token"], "Pengambilan data Kode Kec. " . $kode_kecamatan . " tahun : " . $post["tahun"]);
                $data = $model->get_data_kecamatan($post, $kode_kecamatan);

                echo $data;
            }
        }
    }
}

/* End of file Api.php */
