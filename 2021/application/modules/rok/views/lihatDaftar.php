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
                            <h5 class="card-title m-0">Daftar ROK</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php if ($this->session->userdata("kode_seksi") != "XXXX") : ?>
                                    <div class="col-lg-12 mb-3">
                                        <a href="<?= site_url("../rok/bulan/" . $id . "/" . $kode_seksi); ?>" class="btn btn-warning text-white">
                                            <span class="fa fa-arrow-left"></span> Kembali
                                        </a>
                                        <?php if ($valid > 0) : ?>
                                            <a href="<?= site_url("../rok/cetak/" . $id . "/" . $bln . "/" . $kode_seksi); ?>" class="btn btn-success text-white" target="_blank">
                                                <span class="fa fa-print"></span> Cetak ROK
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php else : ?>
                                    <div class="col-lg-12 mb-3">
                                        <!-- <a href="<?= site_url("../realisasi-rok"); ?>" class="btn btn-warning text-white">
                                            <span class="fa fa-arrow-left"></span> Kembali
                                        </a> -->
                                        <button class="btn btn-danger" onclick="window.close()">
                                            <span class="fa fa-times"></span> tutup
                                        </button>
                                        <?php if ($valid == 0) : ?>
                                            <a href="<?= site_url("../rok/valid_bend/" . $id . "/" . $bln . "/" . $kode_seksi); ?>" class="btn btn-warning text-white">
                                                <span class="fa fa-check"></span> Valid Verifikator
                                            </a>
                                        <?php elseif ($valid == 2) : ?>
                                            <a href="<?= site_url("../rok/valid/" . $id . "/" . $bln . "/" . $kode_seksi); ?>" class="btn btn-success text-white">
                                                <span class="fa fa-check"></span> Validasi ROK
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="5%">No</th>
                                                    <th>Uraian Kegiatan</th>
                                                    <th width="15%">Nominal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($rok as $row => $val) : ?>
                                                    <tr style="background-color: lightgrey;">
                                                        <td colspan="2">
                                                            <b><?= $val["kode_rekening"] . " - " . $val["nama_rekening"]; ?></b>
                                                        </td>
                                                        <td align="right">
                                                            <b><?= number_format($val["total_rok"], 0, ",", "."); ?></b>
                                                        </td>
                                                    </tr>
                                                    <?php if ($val["rok"] != "") : ?>
                                                        <?php $no = 1; ?>
                                                        <?php foreach ($val["rok"] as $row2) : ?>
                                                            <tr>
                                                                <td><?= $no++; ?></td>
                                                                <td>
                                                                    <?= $row2->uraian; ?>
                                                                    <p class="my-0"><?= $row2->keterangan; ?></p>
                                                                </td>
                                                                <td align="right"><?= number_format($row2->nominal, 0, ",", "."); ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
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