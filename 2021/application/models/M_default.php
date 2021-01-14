<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_default extends CI_Model {

    public function getDataLevel()
    {
        return $this->db->get('tb_level_user');
    }

    public function getDataPosisi()
    {
        return $this->db->get('tb_posisi');
    }

    public function getDataPegawai()
    {
        return $this->db->query('SELECT * FROM tb_pegawai a, tb_pangkat b, tb_posisi c, tb_level_user d WHERE a.pangkat_pegawai=b.id_pangkat AND a.posisi_user=c.id_posisi AND a.level_user=d.id_level_user');
    }

    public function getDataUser()
    {
        return $this->db->query('SELECT * FROM tb_user a, tb_pegawai b, tb_posisi c, tb_level_user d WHERE a.id_pegawai=b.id_pegawai AND a.posisi_user=c.id_posisi AND a.level_user=d.id_level_user');
    }

    public function getDataPangkat()
    {
        return $this->db->get('tb_pangkat');
    }

    public function getDataSurat()
    {
        return $this->db->get('tb_jenis_surat');
    }
    
    public function getDispo($posisi, $slc, $nomor = NULL)
    {
        if ($posisi == '1') {
            $q = $this->db->get('tb_posisi')->result();
        } elseif($posisi == '19') {
            $q = $this->db->get_where('tb_posisi', ['level'=>$posisi])->result();
        } elseif ($posisi > '1' && $posisi < '5') {
            $q = $this->db->get_where('tb_posisi', ['level'=>$posisi])->result();
        } else {
            $q = $this->db->get_where('tb_pegawai', ['posisi_user'=>$posisi])->result();
        }
        
        $no = 0;
        $msg = array();
        $sel = '';
        foreach ($q as $row) {
            if ($slc == '1') {
                if ($posisi == '1') {
                    $msg[$no]['id_posisi'] = $row->id_posisi;
                    $msg[$no]['posisi'] = $row->posisi;
                    $msg[$no]['selected'] = $sel;
                }
            } else {
                if ($posisi == '1') {
                    $where = array(
                        'nomor_dinas' => $nomor,
                        'posisi_kadin' => $row->id_posisi
                    );
                    $cek = $this->db->get_where('tb_dispo_kadin', $where)->num_rows();
                } elseif ($posisi == '19') {
                    $where = array(
                        'nomor_dinas' => $nomor,
                        'posisi_sekdin' => $row->id_posisi
                    );
                    $cek = $this->db->get_where('tb_dispo_sekdin', $where)->num_rows();
                } elseif ($posisi > '1' && $posisi < '5') {
                    $where = array(
                        'nomor_dinas' => $nomor,
                        'posisi_bidang' => $row->id_posisi
                    );
                    $cek = $this->db->get_where('tb_dispo_bidang', $where)->num_rows();
                } else {
                    $where = array(
                        'nomor_dinas' => $nomor,
                        'id_pegawai' => $row->id_pegawai
                    );
                    $cek = $this->db->get_where('tb_dispo_pegawai', $where)->num_rows();
                }

                if ($cek > 0) {
                    $sel = "selected";
                } else {
                    $sel = "";
                }
                
                if ($posisi == '1' || $posisi == '19' || ($posisi > '1' && $posisi < '5')) {
                    $msg[$no]['id_posisi'] = $row->id_posisi;
                    $msg[$no]['posisi'] = $row->posisi;
                    $msg[$no]['selected'] = $sel;
                } else {
                    $msg[$no]['id_pegawai'] = $row->id_pegawai;
                    $msg[$no]['nama_pegawai'] = $row->nama_pegawai;
                    $msg[$no]['selected'] = $sel;
                }
                
            }
            
            $no++;
        }

        return $msg;
    }

    public function getSuratMasukAll($posisi, $bln, $thn)
    {
        if ($bln != 'all') {
            if ($posisi == '1') {
                $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND MONTH(a.tgl_surat)='$bln' AND YEAR(a.tgl_surat)='$thn' ORDER BY a.nomor_dinas DESC";
            } elseif($posisi == '19') {
                $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND MONTH(a.tgl_surat)='$bln' AND YEAR(a.tgl_surat)='$thn' AND a.arsipkan_2='0' AND a.nomor_dinas NOT IN (SELECT nomor_dinas FROM tb_dispo_sekdin GROUP BY nomor_dinas) ORDER BY a.nomor_dinas DESC";
            } elseif ($posisi > '1' && $posisi < '5') {
                $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND MONTH(a.tgl_surat)='$bln' AND YEAR(a.tgl_surat)='$thn' AND a.arsipkan_2='0' AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_sekdin WHERE posisi_sekdin='$posisi' GROUP BY nomor_dinas) AND a.nomor_dinas NOT IN (SELECT nomor_dinas FROM tb_dispo_bidang GROUP BY nomor_dinas) ORDER BY a.nomor_dinas DESC";
            } elseif ($posisi == '5' || $posisi == '6' || $posisi == '16' || $posisi == '17') {
                $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND MONTH(a.tgl_surat)='$bln' AND YEAR(a.tgl_surat)='$thn' AND a.arsipkan_2='0' AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_sekdin WHERE posisi_sekdin='$posisi' GROUP BY nomor_dinas) AND a.nomor_dinas NOT IN (SELECT nomor_dinas FROM tb_dispo_pegawai WHERE seksi='$posisi' GROUP BY nomor_dinas) ORDER BY a.nomor_dinas DESC";
            } else {
                $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND MONTH(a.tgl_surat)='$bln' AND YEAR(a.tgl_surat)='$thn' AND a.arsipkan_3='0' AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_bidang WHERE posisi_bidang='$posisi' GROUP BY nomor_dinas) AND a.nomor_dinas NOT IN (SELECT nomor_dinas FROM tb_dispo_pegawai WHERE seksi='$posisi' GROUP BY nomor_dinas) ORDER BY a.nomor_dinas DESC";
            }
        } else {
            if ($posisi == '1') {
                $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND YEAR(a.tgl_surat)='$thn' ORDER BY a.nomor_dinas DESC";
            } elseif($posisi == '19') {
                $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND YEAR(a.tgl_surat)='$thn' AND a.arsipkan_2='0' AND a.nomor_dinas NOT IN (SELECT nomor_dinas FROM tb_dispo_sekdin GROUP BY nomor_dinas) ORDER BY a.nomor_dinas DESC";
            } elseif ($posisi > '1' && $posisi < '5') {
                $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND YEAR(a.tgl_surat)='$thn' AND a.arsipkan_2='0' AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_sekdin WHERE posisi_sekdin='$posisi' GROUP BY nomor_dinas) AND a.nomor_dinas NOT IN (SELECT nomor_dinas FROM tb_dispo_bidang GROUP BY nomor_dinas) ORDER BY a.nomor_dinas DESC";
            } elseif ($posisi == '5' || $posisi == '6' || $posisi == '16' || $posisi == '17') {
                $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND YEAR(a.tgl_surat)='$thn' AND a.arsipkan_2='0' AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_sekdin WHERE posisi_sekdin='$posisi' GROUP BY nomor_dinas) AND a.nomor_dinas NOT IN (SELECT nomor_dinas FROM tb_dispo_pegawai WHERE seksi='$posisi' GROUP BY nomor_dinas) ORDER BY a.nomor_dinas DESC";
            } else {
                $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND YEAR(a.tgl_surat)='$thn' AND a.arsipkan_3='0' AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_bidang WHERE posisi_bidang='$posisi' GROUP BY nomor_dinas) AND a.nomor_dinas NOT IN (SELECT nomor_dinas FROM tb_dispo_pegawai WHERE seksi='$posisi' GROUP BY nomor_dinas) ORDER BY a.nomor_dinas DESC";
            }
        }
        
        return $this->db->query($q);
    }

    public function getSuratMasukTerdispo($posisi, $bln, $thn)
    {
        if ($bln != 'all') {
            if($posisi == '19') {
                $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND MONTH(a.tgl_surat)='$bln' AND YEAR(a.tgl_surat)='$thn' AND (a.arsipkan_2='1' OR a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_sekdin GROUP BY nomor_dinas)) GROUP BY a.nomor_dinas ORDER BY a.nomor_dinas DESC";
            } elseif ($posisi > '1' && $posisi < '5') {
                $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND MONTH(a.tgl_surat)='$bln' AND YEAR(a.tgl_surat)='$thn' AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_sekdin WHERE posisi_sekdin='$posisi' GROUP BY nomor_dinas) AND ((a.arsipkan_2='0' AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_bidang GROUP BY nomor_dinas)) OR a.arsipkan_3='1') GROUP BY a.nomor_dinas ORDER BY a.nomor_dinas DESC";
            } elseif ($posisi == '5' || $posisi == '6' || $posisi == '16' || $posisi == '17') {
                $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND MONTH(a.tgl_surat)='$bln' AND YEAR(a.tgl_surat)='$thn' AND a.arsipkan_2='0' AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_sekdin WHERE posisi_sekdin='$posisi' GROUP BY nomor_dinas) AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_pegawai WHERE seksi='$posisi' GROUP BY nomor_dinas) ORDER BY a.nomor_dinas DESC";
            } else {
                $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND MONTH(a.tgl_surat)='$bln' AND YEAR(a.tgl_surat)='$thn' AND a.arsipkan_3='0' AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_bidang WHERE posisi_bidang='$posisi' GROUP BY nomor_dinas) AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_pegawai WHERE seksi='$posisi' GROUP BY nomor_dinas) ORDER BY a.nomor_dinas DESC";
            }
        } else {
            if($posisi == '19') {
                $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND YEAR(a.tgl_surat)='$thn' AND (a.arsipkan_2='1' OR a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_sekdin GROUP BY nomor_dinas)) GROUP BY a.nomor_dinas ORDER BY a.nomor_dinas DESC";
            } elseif ($posisi > '1' && $posisi < '5') {
                $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND YEAR(a.tgl_surat)='$thn' AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_sekdin WHERE posisi_sekdin='$posisi' GROUP BY nomor_dinas) AND ((a.arsipkan_2='0' AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_bidang GROUP BY nomor_dinas)) OR a.arsipkan_3='1') GROUP BY a.nomor_dinas ORDER BY a.nomor_dinas DESC";
            } elseif ($posisi == '5' || $posisi == '6' || $posisi == '16' || $posisi == '17') {
                $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND YEAR(a.tgl_surat)='$thn' AND a.arsipkan_2='0' AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_sekdin WHERE posisi_sekdin='$posisi' GROUP BY nomor_dinas) AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_pegawai WHERE seksi='$posisi' GROUP BY nomor_dinas) ORDER BY a.nomor_dinas DESC";
            } else {
                $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND YEAR(a.tgl_surat)='$thn' AND a.arsipkan_3='0' AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_bidang WHERE posisi_bidang='$posisi' GROUP BY nomor_dinas) AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_pegawai WHERE seksi='$posisi' GROUP BY nomor_dinas) ORDER BY a.nomor_dinas DESC";
            }
        }

        return $this->db->query($q);
    }

    public function getSuratKeluarAll($id)
    {
        $this->db->select('*');
        $this->db->from('tb_surat_keluar');
        $this->db->join('tb_posisi', 'tb_surat_keluar.created_by = tb_posisi.id_posisi');
        $this->db->join('tb_jenis_surat', 'tb_surat_keluar.id_jenis_surat = tb_jenis_surat.id_jenis_surat');
        if ($id != '1' && $id != '6') {
            $this->db->where(['tb_surat_keluar.created_by'=>$id]);
        }
        $this->db->order_by('tb_surat_keluar.created_at', 'DESC');
        return $this->db->get();
    }

    public function getSuratTugasAll($id)
    {
        $this->db->select('*');
        $this->db->from('tb_surat_tugas');
        $this->db->join('tb_posisi', 'tb_surat_tugas.created_by = tb_posisi.id_posisi');
        if ($id != '6') {
            $this->db->where(['tb_surat_tugas.created_by'=>$id]);
        } else {
            $this->db->where(['tb_surat_tugas.sppd_surat'=>'1']);
            $this->db->where(['tb_surat_tugas.validasi'=>'0']);
        }
        
        if ($id == '6') {
            $this->db->order_by('tb_surat_tugas.tgl_kegiatan', 'asc');
        } else {
            $this->db->order_by('tb_surat_tugas.id_surat_tugas', 'desc');
        }
        
        return $this->db->get();
    }

    public function getSuratTugasBy($id)
    {
        $this->db->select('*');
        $this->db->from('tb_surat_tugas');
        $this->db->join('tb_posisi', 'tb_surat_tugas.created_by = tb_posisi.id_posisi');
        if ($id != '6') {
            $this->db->where(['tb_surat_tugas.created_by'=>$id]);
        } else {
            $this->db->where(['tb_surat_tugas.sppd_surat'=>'1']);
            $this->db->where(['tb_surat_tugas.validasi'=>'0']);
        }

        if ($_POST['dalam_luar'] != 'all') {
            $this->db->where(['tb_surat_tugas.dalam_luar_tugas'=>$_POST['dalam_luar']]);
        }
        if (isset($_POST['tgl_kegiatan'])) {
            $tgl = explode('-', $_POST['tgl_kegiatan']);
            $tgl1 = date('Y-m-d', strtotime($tgl[0]));
            $tgl2 = date('Y-m-d', strtotime($tgl[1]));
            $this->db->where("tb_surat_tugas.tgl_kegiatan BETWEEN '$tgl1' AND '$tgl2'");
        }
        if ($_POST['valid'] != 'all') {
            $this->db->where(['tb_surat_tugas.validasi'=>$_POST['valid']]);
        }
        
        if ($id == '6') {
            $this->db->order_by('tb_surat_tugas.tgl_kegiatan', 'asc');
        } else {
            $this->db->order_by('tb_surat_tugas.id_surat_tugas', 'desc');
        }
        
        return $this->db->get();
    }

    public function getSuratTugasAll2($id)
    {
        $this->db->select('*');
        $this->db->from('tb_surat_tugas');
        $this->db->join('tb_posisi', 'tb_surat_tugas.created_by = tb_posisi.id_posisi');
        if ($id != '6') {
            $this->db->where(['tb_surat_tugas.created_by'=>$id]);
        } else {
            $this->db->where("tb_surat_tugas.sppd_surat='1' AND tb_surat_tugas.validasi='1'");
            $this->db->or_where("tb_surat_tugas.sppd_surat='0'");
        }
        if ($id == '6') {
            $this->db->order_by('tb_surat_tugas.tgl_kegiatan', 'asc');
        } else {
            $this->db->order_by('tb_surat_tugas.id_surat_tugas', 'desc');
        }
        
        return $this->db->get();
    }

    public function getSuratTugasBy2($id)
    {
        $this->db->select('*');
        $this->db->from('tb_surat_tugas');
        $this->db->join('tb_posisi', 'tb_surat_tugas.created_by = tb_posisi.id_posisi');

        if ($id != '6') {
            $this->db->where(['tb_surat_tugas.created_by'=>$id]);
        } else {
            // $this->db->where("tb_surat_tugas.sppd_surat='1' AND tb_surat_tugas.validasi='1'");
            // $this->db->or_where("tb_surat_tugas.sppd_surat='0'");
        }

        if ($_POST['dalam_luar'] != 'all') {
            $this->db->where(['tb_surat_tugas.dalam_luar_tugas'=>$_POST['dalam_luar']]);
        }

        if (isset($_POST['tgl_kegiatan'])) {
            $tgl = explode('-', $_POST['tgl_kegiatan']);
            $tgl1 = date('Y-m-d', strtotime($tgl[0]));
            $tgl2 = date('Y-m-d', strtotime($tgl[1]));
            $this->db->where("tb_surat_tugas.tgl_kegiatan BETWEEN '$tgl1' AND '$tgl2'");
        }

        // if ($_POST['valid'] != 'all') {
        //     $this->db->where(['tb_surat_tugas.validasi'=>$_POST['valid']]);
        // }
        

        if ($id == '6') {
            $this->db->order_by('tb_surat_tugas.tgl_kegiatan', 'asc');
        } else {
            $this->db->order_by('tb_surat_tugas.id_surat_tugas', 'desc');
        }
        
        return $this->db->get();
    }
    
    
    public function getDataNotaDinas($id)
    {
        $this->db->select('*');
        $this->db->from('tb_nota_dinas');
        $this->db->join('tb_posisi', 'tb_nota_dinas.created_by = tb_posisi.id_posisi');
        if ($id != '5') {
            $this->db->where(['tb_nota_dinas.created_by'=>$id]);
        } else {
            $this->db->where(['tb_nota_dinas.id_dpa !='=>'']);
            $this->db->where(['tb_nota_dinas.valid'=>'0']);
        }
        $this->db->order_by('tb_nota_dinas.nomor_dinas', 'desc');
        
        return $this->db->get();
        // return $this->db->query("SELECT * FROM tb_nota_dinas WHERE created_by='$id' ORDER BY created_at DESC");
    }

    public function getDataNotaDinasValid()
    {
        $this->db->select('*');
        $this->db->from('tb_nota_dinas');
        $this->db->join('tb_posisi', 'tb_nota_dinas.created_by = tb_posisi.id_posisi');
        $this->db->where(['tb_nota_dinas.id_dpa !='=>'']);
        $this->db->where(['tb_nota_dinas.valid'=>'1']);
        $this->db->order_by('tb_nota_dinas.nomor_dinas', 'desc');
        
        return $this->db->get();
        // return $this->db->query("SELECT * FROM tb_nota_dinas WHERE created_by='$id' ORDER BY created_at DESC");
    }

    public function getJumlahSurat($id)
    {
        if ($id == '1') {
            $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat ORDER BY a.nomor_dinas DESC";
        } elseif($id == '19') {
            $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat ORDER BY a.nomor_dinas DESC";
        } elseif ($id > '1' && $id < '5') {
            $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_sekdin WHERE posisi_sekdin='$id' GROUP BY nomor_dinas) ORDER BY a.nomor_dinas DESC";
        } elseif ($id == '5' || $id == '6' || $id == '16' || $id == '17') {
            $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND a.arsipkan_2='0' AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_sekdin WHERE posisi_sekdin='$id' GROUP BY nomor_dinas) ORDER BY a.nomor_dinas DESC";
        } else {
            $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND a.arsipkan_3='0' AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_bidang WHERE posisi_bidang='$id' GROUP BY nomor_dinas) ORDER BY a.nomor_dinas DESC";
        }
        
        $suratMasuk = $this->db->query($q)->num_rows();
        
        $suratKeluar = $this->db->query("SELECT * FROM tb_surat_keluar WHERE created_by='$id'")->num_rows();
        if ($id == '6') {
            $suratTugas = $this->db->query("SELECT * FROM tb_surat_tugas")->num_rows();
        } else {
            $suratTugas = $this->db->query("SELECT * FROM tb_surat_tugas WHERE created_by='$id'")->num_rows();
        }
        

        if ($id == '5') {
            $notaDinas = $this->db->query("SELECT * FROM tb_nota_dinas")->num_rows();
        } else {
            $notaDinas = $this->db->query("SELECT * FROM tb_nota_dinas WHERE created_by='$id'")->num_rows();
        }

        $msg = array("surat_masuk" => $suratMasuk, "surat_keluar" => $suratKeluar, "surat_tugas" => $suratTugas, "nota_dinas" => $notaDinas);

        return json_encode($msg);
    }

    public function getNotif()
    {
        $suratMasuk = $this->db->query("SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND a.arsipkan_2='0' AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_sekdin WHERE posisi_sekdin='6' GROUP BY nomor_dinas) AND a.nomor_dinas NOT IN (SELECT nomor_dinas FROM tb_dispo_pegawai WHERE seksi='6' GROUP BY nomor_dinas) ORDER BY a.nomor_dinas DESC")->num_rows();
        $suratTugas = $this->db->query("SELECT * FROM tb_surat_tugas WHERE validasi='0' AND sppd_surat='1'")->num_rows();
        $jml = $suratMasuk+$suratTugas;

        $msg = array("jml" => $jml, "surat_masuk" => $suratMasuk, "surat_tugas" => $suratTugas);

        return json_encode($msg);
    }

    public function getNotif2($posisi)
    {
        // if ($posisi == '1') {
        //     $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat ORDER BY a.nomor_dinas DESC";
        // } else
        if($posisi == '19' || $posisi == '1') {
            $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND a.arsipkan_2='0' AND a.nomor_dinas NOT IN (SELECT nomor_dinas FROM tb_dispo_sekdin GROUP BY nomor_dinas) ORDER BY a.nomor_dinas DESC";
        } elseif ($posisi > '1' && $posisi < '5') {
            $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND a.arsipkan_2='0' AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_sekdin WHERE posisi_sekdin='$posisi' GROUP BY nomor_dinas) AND a.nomor_dinas NOT IN (SELECT nomor_dinas FROM tb_dispo_bidang GROUP BY nomor_dinas) ORDER BY a.nomor_dinas DESC";
        } elseif ($posisi == '5' || $posisi == '6' || $posisi == '16' || $posisi == '17') {
            $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND a.arsipkan_2='0' AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_sekdin WHERE posisi_sekdin='$posisi' GROUP BY nomor_dinas) AND a.nomor_dinas NOT IN (SELECT nomor_dinas FROM tb_dispo_pegawai WHERE seksi='$posisi' GROUP BY nomor_dinas) ORDER BY a.nomor_dinas DESC";
        } else {
            $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND a.arsipkan_3='0' AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_bidang WHERE posisi_bidang='$posisi' GROUP BY nomor_dinas) AND a.nomor_dinas NOT IN (SELECT nomor_dinas FROM tb_dispo_pegawai WHERE seksi='$posisi' GROUP BY nomor_dinas) ORDER BY a.nomor_dinas DESC";
        }
        
        $suratMasuk = $this->db->query($q)->num_rows();

        // $suratMasuk = $this->db->query("SELECT * FROM tb_surat_masuk WHERE dispo_surat='$id' AND validasi='0'")->num_rows();
        $jml = $suratMasuk;

        $msg = array("jml" => $jml, "surat_masuk" => $suratMasuk);

        return json_encode($msg);
    }

    public function getNotif3()
    {
        $q = "SELECT * FROM tb_surat_masuk a, tb_jenis_surat b WHERE a.id_jenis_surat=b.id_jenis_surat AND a.arsipkan_2='0' AND a.nomor_dinas IN (SELECT nomor_dinas FROM tb_dispo_sekdin WHERE posisi_sekdin='5' GROUP BY nomor_dinas) AND a.nomor_dinas NOT IN (SELECT nomor_dinas FROM tb_dispo_pegawai WHERE seksi='5' GROUP BY nomor_dinas) ORDER BY a.nomor_dinas DESC";
        $suratMasuk = $this->db->query($q)->num_rows();

        $notaDinas = $this->db->query("SELECT * FROM tb_nota_dinas WHERE valid='0' AND id_dpa != ''")->num_rows();
        $jml = $suratMasuk+$notaDinas;

        $msg = array("jml" => $jml, "surat_masuk" => $suratMasuk, "nota_dinas" => $notaDinas);

        return json_encode($msg);
    }

    public function _push()
    {
        require __DIR__ . '/vendor/autoload.php';
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        // $pusher = new Pusher\Pusher(
        //     'b1813ff66e7edbd37ba0',
        //     'eea4bd64f0a6fe38ec28',
        //     '921914',
        //     $options
        // );

        // $data['message'] = 'success';
        // $pusher->trigger('my-channel', 'my-event', $data);
    }

    public function getDPA()
    {
        $data = $this->db->get('tb_dpa')->result();
        return $data;
    }
    
    public function getRek()
    {
        $data = $this->db->get_where('tb_rekening', ['st' => '0'])->result();
        return $data;
    }
}

/* End of file ModelName.php */
