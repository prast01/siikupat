<?php


defined('BASEPATH') or exit('No direct script access allowed');

class M_api extends CI_Model
{

    public function auth($post)
    {
        $hari_ini = date("Y-m-d H:i:s");
        if (!isset($post["akun"]) || !isset($post["sandi"])) {
            return $this->response(502, true, array("message" => "Akun atau Sandi Diwajibkan"));
        }

        if ($post["akun"] == "" || $post["sandi"] == "") {
            return $this->response(502, true, array("message" => "Akun atau Sandi Diwajibkan"));
        }

        $data = $this->db->get_where("tb_akun", ["akun" => $post["akun"], "sandi" => $post["sandi"]]);

        if ($data->num_rows() > 0) {
            $dt = $data->row();
            $kadaluarsa = date("Y-m-d H:i:s", strtotime("+1 days"));
            $token = hash("sha256", $dt->sandi) . "-" . hash("sha256", $kadaluarsa);

            if ($dt->sandi != $post["sandi"]) {
                return $this->response(502, true, array("message" => "Sandi Tidak Sesuai"));
            }
            if ($dt->kadaluarsa != "") {
                if (strtotime($dt->kadaluarsa) > strtotime($hari_ini)) {
                    $this->insert_history($dt->token, "Auth gagal karena token masih aktif");

                    return $this->response(502, true, array("token" => $dt->token, "message" => "Token Masih Aktif Sampai : " . $dt->kadaluarsa));
                }
            }

            $where = array(
                "id_akun" => $dt->id_akun
            );

            $a = array(
                "token" => $token,
                "kadaluarsa" => $kadaluarsa,
            );

            $update = $this->db->update("tb_akun", $a, $where);
            if ($update) {
                $this->insert_history($token, "Auth berhasil dengan token baru : " . $token);

                return $this->response(200, false, array("token" => $token));
            } else {
                return $this->response(502, true, array("message" => "Gagal Mendapat Token"));
            }
        } else {
            return $this->response(502, true, array("message" => "Akun atau Sandi Tidak Sesuai"));
        }
    }

    public function refresh($post)
    {
        $hari_ini = date("Y-m-d H:i:s");

        if (!isset($post["token"])) {
            return $this->response(502, true, array("message" => "Token Diwajibkan"));
        }

        $data = $this->db->get_where("tb_akun", ["token" => $post["token"]]);
        if ($data->num_rows() > 0) {
            $dt = $data->row();
            $kadaluarsa = date("Y-m-d H:i:s", strtotime("+1 days"));
            $token = hash("sha256", $dt->sandi) . "-" . hash("sha256", $kadaluarsa);

            if ($dt->kadaluarsa != "") {
                if (strtotime($dt->kadaluarsa) > strtotime($hari_ini)) {
                    $this->insert_history($dt->token, "Refresh Token gagal karena token masih aktif");

                    return $this->response(502, true, array("token" => $dt->token, "message" => "Token Masih Aktif Sampai : " . $dt->kadaluarsa));
                }
            }

            $where = array(
                "id_akun" => $dt->id_akun
            );

            $a = array(
                "token" => $token,
                "kadaluarsa" => $kadaluarsa,
            );

            $update = $this->db->update("tb_akun", $a, $where);
            if ($update) {
                $this->insert_history($token, "Refresh Token berhasil dengan token baru : " . $token);

                return $this->response(200, false, array("token" => $token));
            } else {
                return $this->response(502, true, array("message" => "Gagal Mendapat Token"));
            }
        } else {
            return $this->response(502, true, array("message" => "Data Tidak Ditemukan"));
        }
    }

    public function cek_token($post)
    {
        $hari_ini = date("Y-m-d H:i:s");

        if (!isset($post["token"])) {
            return 1;
        }

        $data = $this->db->get_where("tb_akun", ["token" => $post["token"]]);
        if ($data->num_rows() > 0) {
            $dt = $data->row();
            if ($dt->kadaluarsa != "") {
                if (strtotime($dt->kadaluarsa) > strtotime($hari_ini)) {
                    return 0;
                } else {
                    return 1;
                }
            } else {
                return 1;
            }
        } else {
            return 1;
        }
    }

    public function insert_history($token, $msg)
    {
        $data = $this->db->get_where("tb_akun", ["token" => $token])->row();
        $akun = $data->akun;
        $msg2 = "Nama Akun : " . $akun . ". " . $msg;

        $data = array(
            "alamat_ip" => $this->input->ip_address(),
            "pesan" => $msg2,
        );

        $this->db->insert("tb_aktifitas", $data);
    }

    public function get_data_tahunan($tahun)
    {
        $data = $this->db->get("tb_kecamatan")->result();

        $no = 0;
        $hsl = array();
        $hsl["tahun"] = $tahun;

        foreach ($data as $key) {
            $hsl["data"][$no++] = array(
                "kode_kecamatan" => $key->kode_kecamatan,
                "nama_kecamatan" => $key->nama_kecamatan,
                "data_kecamatan" => $this->_get_all_data_kecamatan($key->kode_kecamatan, $tahun),
            );
        }

        return $this->response(200, false, $hsl);
    }

    public function get_data_kecamatan($post, $kode_kecamatan)
    {
        $data = $this->db->get("tb_data")->result();
        $dt_kec = $this->db->get_where("tb_kecamatan", ["kode_kecamatan" => $kode_kecamatan])->row();

        $no = 0;
        $hsl = array();
        $hsl["kode_kecamatan"] = $kode_kecamatan;
        $hsl["nama_kecamatan"] = $dt_kec->nama_kecamatan;
        $hsl["tahun"] = $post["tahun"];

        foreach ($data as $key) {
            $where = array(
                "kode_kecamatan" => $kode_kecamatan,
                "id_data" => $key->id_data,
                "tahun" => $post["tahun"],
            );

            $hsl["data"][$no++] = array(
                "nama_data" => $key->nama_data,
                "alias" => $key->alias,
                "nilai" => $this->_get_data($where),
            );
        }

        return $this->response(200, false, $hsl);
    }

    // RESPONSE
    public function response($status, $error, $data)
    {
        $response['status'] = $status;
        $response['error'] = $error;
        $response['response'] = $data;
        return json_encode($response);
    }

    // PRIVATE
    private function _get_all_data_kecamatan($kode_kecamatan, $tahun)
    {
        $no = 0;
        $hsl = array();

        $data = $this->db->get("tb_data")->result();
        foreach ($data as $key) {
            $where = array(
                "kode_kecamatan" => $kode_kecamatan,
                "id_data" => $key->id_data,
                "tahun" => $tahun,
            );

            $hsl[$no++] = array(
                "nama_data" => $key->nama_data,
                "alias" => $key->alias,
                "nilai" => $this->_get_data($where),
            );
        }

        return $hsl;
    }

    private function _get_data($where)
    {
        $nilai = 0;
        $data = $this->db->get_where("tb_riwayat_data", $where);

        if ($data->num_rows() > 0) {
            $dt = $data->row();
            $nilai = $dt->nilai;
        }

        return $nilai;
    }
}

/* End of file M_api.php */
