<?php $bln = date("m"); ?>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1 class="m-0 text-dark"></h1> -->
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container">
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
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title m-0">Daftar ROK Bulan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <a href="<?= site_url("../rok"); ?>" class="btn btn-warning text-white">
                                        <span class="fa fa-arrow-left"></span> Kembali
                                    </a>
                                </div>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="5%">No</th>
                                                    <th>Bulan</th>
                                                    <th>ROK</th>
                                                    <th>Realisasi</th>
                                                    <th width="10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php foreach ($bulan as $row => $val) : ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $val["nama_bulan"]; ?></td>
                                                        <td><?= number_format($val["rok"], 0, ",", "."); ?></td>
                                                        <td><?= number_format($val["realisasi"], 0, ",", "."); ?></td>
                                                        <td align="center">
                                                            <div class="btn-group">
                                                                <?php if ($val["valid"] == "0") : ?>
                                                                    <a href="<?= site_url("../rok/tambahDaftar/" . $id . "/" . $val["kode_bulan"] . "/" . $seksi); ?>" class="btn btn-primary btn-sm btn-flat">
                                                                        <span class="fa fa-plus"></span>
                                                                    </a>
                                                                <?php else : ?>
                                                                    <a href="<?= site_url("../rok/lihatDaftar/" . $id . "/" . $val["kode_bulan"] . "/" . $seksi); ?>" class="btn btn-primary btn-sm btn-flat">
                                                                        <span class="fa fa-eye"></span>
                                                                    </a>
                                                                <?php endif; ?>


                                                                <?php if ($kode_seksi == "DJ001" && ($val["valid"] == "0" || $val["valid"] == "2")) : ?>
                                                                    <a href="<?= site_url("../rok/valid/" . $id . "/" . $val["kode_bulan"] . "/" . $seksi); ?>" class="btn btn-success btn-sm btn-flat" onclick="return confirm('Yakin Validasi?')">
                                                                        <span class="fa fa-check"></span>
                                                                    </a>
                                                                <?php elseif ($kode_seksi == "DJ001" && $val["valid"] == "1") : ?>
                                                                    <a href="<?= site_url("../rok/batal/" . $id . "/" . $val["kode_bulan"] . "/" . $seksi); ?>" class="btn btn-danger btn-sm btn-flat" onclick="return confirm('Yakin Batalkan?')">
                                                                        <span class="fa fa-times"></span>
                                                                    </a>
                                                                <?php endif; ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
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