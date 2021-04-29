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
                                        <?php if ($valid == 0) : ?>
                                            <a href="<?= site_url("../rok/valid_bend/" . $id . "/" . $bln . "/" . $kode_seksi); ?>" class="btn btn-warning text-white">
                                                <span class="fa fa-check"></span> Valid Verifikator
                                            </a>
                                        <?php elseif ($valid == 1) : ?>
                                            <a href="<?= site_url("../rok/batal/" . $id . "/" . $bln . "/" . $kode_seksi); ?>" class="btn btn-danger text-white">
                                                <span class="fa fa-check"></span> Batalkan ROK
                                            </a>
                                        <?php elseif ($valid == 2) : ?>
                                            <a href="<?= site_url("../rok/batal_bend/" . $id . "/" . $bln . "/" . $kode_seksi); ?>" class="btn btn-danger text-white">
                                                <span class="fa fa-check"></span> Batalkan Valid Verifikator
                                            </a>
                                            <a href="<?= site_url("../rok/valid/" . $id . "/" . $bln . "/" . $kode_seksi); ?>" class="btn btn-success text-white">
                                                <span class="fa fa-check"></span> Validasi ROK
                                            </a>
                                        <?php endif; ?>
                                        <a href="<?= site_url("../rok/cetak/" . $id . "/" . $bln . "/" . $kode_seksi); ?>" class="btn btn-success text-white" target="_blank">
                                            <span class="fa fa-print"></span> Cetak ROK
                                        </a>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <td width="33%">
                                                            <p class="my-0">Jumlah <span class="text-success">RAK</span> Bulan ini :</p>
                                                            <h3 class="py-2 my-0 text-success">
                                                                <?= number_format($jml_rak, 0, ",", "."); ?>
                                                            </h3>
                                                        </td>
                                                        <td>
                                                            <p class="my-0">Jumlah <span class="text-primary">ROK</span> Bulan ini :</p>
                                                            <h3 class="py-2 my-0 text-primary">
                                                                <?= number_format($jml_rok, 0, ",", "."); ?>
                                                            </h3>
                                                        </td>
                                                        <td width="33%">
                                                            <p class="my-0">Sisa <span class="text-danger">ROK</span> s.d Bulan kemarin :</p>
                                                            <h3 class="py-2 my-0 text-danger">
                                                                <?= number_format($jml_sisa, 0, ",", "."); ?>
                                                            </h3>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
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
                                                    <th width="5%">Blokir</th>
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
                                                        <td></td>
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
                                                                <td align="center">
                                                                    <?php if ($row2->blok) : ?>
                                                                        <a href="<?= site_url("../rok/blok/0/" . $id . "/" . $bln . "/" . $kode_seksi . "/" . $row2->id_rok); ?>" class="btn btn-sm btn-success" title="Buka Blokir" onclick="return confirm('Buka Blokir?')">
                                                                            <span class="fa fa-check-circle"></span>
                                                                        </a>
                                                                    <?php else : ?>
                                                                        <a href="<?= site_url("../rok/blok/1/" . $id . "/" . $bln . "/" . $kode_seksi . "/" . $row2->id_rok); ?>" class="btn btn-sm btn-danger" title="Blokir" onclick="return confirm('Blokir ROK?')">
                                                                            <span class="fa fa-ban"></span>
                                                                        </a>
                                                                    <?php endif; ?>
                                                                </td>
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