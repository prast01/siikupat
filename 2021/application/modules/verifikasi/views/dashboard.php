<?php
$st = 0;
if (isset($spj[0]["status_spj"])) {
    $st = $spj[0]["status_spj"];
    if ($spj[0]["status_spj"] == "1") {
        $antrian["baru"] = $antrian["baru"] - 1;
    } elseif ($spj[0]["status_spj"] == "2") {
        $antrian["revisi"] = $antrian["revisi"] - 1;
    }
}
?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <!-- <h1 class="m-0 text-dark"></h1> -->
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <?php if ($this->session->flashdata('sukses')) : ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Sukses!</h5>
                            <?php echo $this->session->flashdata('sukses'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('gagal')) : ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-ban"></i> Opss!</h5>
                            <?php echo $this->session->flashdata('gagal'); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if ($this->session->userdata("kode_bidang") != "XXXX") : ?>
                    <input type="hidden" id="status_spj" value="<?= $st; ?>">
                    <div class="col-lg-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fa fa-book"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">
                                    <h3>Antrian SPJ Baru</h3>
                                </span>
                                <span class="info-box-number">
                                    <i id="baru" style="color: red; font-size: 25px;"><?= $antrian["baru"]; ?></i> SPJ
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger"><i class="fa fa-book"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">
                                    <h3>Antrian SPJ Revisi</h3>
                                </span>
                                <span class="info-box-number">
                                    <i id="revisi" style="color: red; font-size: 25px;"><?= $antrian["revisi"]; ?></i> SPJ
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="fa fa-book"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">
                                    <h3>SPJ Rekomendasi</h3>
                                </span>
                                <span class="info-box-number">
                                    <i id="acc" style="color: red; font-size: 25px;"><?= $antrian["acc"]; ?></i> SPJ
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-lg-12 mb-5">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h5 class="card-title m-0">DAFTAR PENGAJUAN SPJ</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th width="5%">No SPJ</th>
                                                    <th width="10%">Tgl Kegiatan</th>
                                                    <th>Uraian Kegiatan</th>
                                                    <th width="15%">Nominal</th>
                                                    <th>Pelaksana</th>
                                                    <th width="5%">Status</th>
                                                    <th>Catatan</th>
                                                    <th width="5%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php $total = 0; ?>
                                                <?php foreach ($spj as $row => $val) : ?>
                                                    <?php $total = $total + $val["nominal_real"]; ?>
                                                    <tr>
                                                        <!-- <td><?= $val["no_spj"] . " /<br>" . $val["no_seksi"]; ?></td> -->
                                                        <td><?= $val["no_seksi"]; ?></td>
                                                        <td><?= $val["tgl_kegiatan"]; ?></td>
                                                        <td><?= $val["uraian"]; ?></td>
                                                        <td><?= $val["nominal"]; ?></td>
                                                        <td>
                                                            <ol>
                                                                <?php foreach ($val["pelaksana"] as $row) : ?>
                                                                    <li class="my-0"><?= $row->nama_pegawai; ?></li>
                                                                <?php endforeach; ?>
                                                            </ol>
                                                        </td>
                                                        <td><?= $val["nama_status"]; ?><br><?= $val["tanggal"]; ?></td>
                                                        <td><?= $val["verif_spj"]; ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="<?= site_url("../verifikasi/lihat/" . $val["kode_spj"]); ?>" class="btn btn-primary btn-sm">
                                                                    <span class="fa fa-eye"></span>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th align="right" colspan="3">Total</th>
                                                    <th><?= number_format($total, 0, ",", "."); ?></th>
                                                    <th colspan="4"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-5">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h5 class="card-title m-0">DAFTAR REKOM SPJ</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th width="5%">No SPJ</th>
                                                    <th width="10%">Tgl Kegiatan</th>
                                                    <th>Uraian Kegiatan</th>
                                                    <th width="15%">Nominal</th>
                                                    <th>Pelaksana</th>
                                                    <th width="5%">Status</th>
                                                    <th>Catatan</th>
                                                    <th width="5%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php $total_2 = 0; ?>
                                                <?php foreach ($acc as $row => $val) : ?>
                                                    <?php $total_2 = $total_2 + $val["nominal_real"]; ?>
                                                    <tr>
                                                        <td><?= $val["no_seksi"]; ?></td>
                                                        <td><?= $val["tgl_kegiatan"]; ?></td>
                                                        <td><?= $val["uraian"]; ?></td>
                                                        <td><?= $val["nominal"]; ?></td>
                                                        <td>
                                                            <ol>
                                                                <?php foreach ($val["pelaksana"] as $row) : ?>
                                                                    <li class="my-0"><?= $row->nama_pegawai; ?></li>
                                                                <?php endforeach; ?>
                                                            </ol>
                                                        </td>
                                                        <td><?= $val["nama_status"]; ?><br><?= $val["tanggal"]; ?></td>
                                                        <td><?= $val["verif_spj"]; ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="<?= site_url("../verifikasi/lihat/" . $val["kode_spj"]); ?>" class="btn btn-primary btn-sm">
                                                                    <span class="fa fa-eye"></span>
                                                                </a>
                                                                <a href="<?= site_url("../verifikasi/pembukuan/" . $val["kode_spj"]); ?>" class="btn btn-success btn-sm" onclick="return confirm('Bukukan SPJ?')">
                                                                    <span class="fa fa-book"></span>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th align="right" colspan="3">Total</th>
                                                    <th><?= number_format($total_2, 0, ",", "."); ?></th>
                                                    <th colspan="4"></th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>