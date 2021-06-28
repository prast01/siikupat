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
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title m-0">Kinerja Keuangan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-2 mb-3">
                                    <a href="<?= site_url("../laporan-kinerja/detail"); ?>" class="btn btn-warning text-white">Kembali</a>
                                </div>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th width="2%">No</th>
                                                    <th>Sub Kegiatan</th>
                                                    <th width="20%">Seksi</th>
                                                    <th width="10%">RAK</th>
                                                    <th width="10%">Realisasi</th>
                                                    <th width="10%">Sisa</th>
                                                    <th width="5%">Persen</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $total_all = 0;
                                                $b_01 = 0;
                                                $rak_01 = 0;
                                                $sisa = 0;
                                                ?>
                                                <?php foreach ($sub_kegiatan as $row => $val) :
                                                ?>
                                                    <?php
                                                    $total_samping = 0;
                                                    $total_samping2 = 0;
                                                    $b_01 = $b_01 + $val["realisasi"];
                                                    $rak_01 = $rak_01 + $val["rak"];
                                                    $sisa = $sisa + $val["sisa"];
                                                    $persen_bln = ($val["rak"] != 0) ? ($val["realisasi"] / $val["rak"]) * 100 : 0;

                                                    $p_bln = ($val["rak"] == 0 && $val["realisasi"] != 0) ? 100 : $persen_bln;
                                                    $color = ($p_bln >= 75) ? "text-success" : "text-danger";
                                                    ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td>
                                                            <?= $val["nama_sub"]; ?>
                                                        </td>
                                                        <td>
                                                            <?= $val["nama"]; ?>
                                                        </td>
                                                        <td align="right" class="<?= $color; ?>">
                                                            <?= number_format($val["rak"], 0, ".", ","); ?>
                                                        </td>
                                                        <td align="right" class="<?= $color; ?>">
                                                            <?= number_format($val["realisasi"], 0, ".", ","); ?>
                                                        </td>
                                                        <td align="right" class="<?= $color; ?>">
                                                            <?= number_format($val["sisa"], 0, ".", ","); ?>
                                                        </td>
                                                        <td class="<?= $color; ?>">
                                                            <?= number_format($p_bln, 2, ".", ","); ?>%
                                                        </td>
                                                    </tr>
                                                <?php endforeach;
                                                ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td align="right" colspan="3"><b>JUMLAH</b></td>
                                                    <td align="right">
                                                        <b><?= number_format($rak_01, 0, ".", ","); ?></b>
                                                    </td>
                                                    <td align="right">
                                                        <b><?= number_format($b_01, 0, ".", ","); ?></b>
                                                    </td>
                                                    <td align="right">
                                                        <b><?= number_format($sisa, 0, ".", ","); ?></b>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $persen_b_all_01 = ($rak_01 != 0) ? ($b_01 / $rak_01) * 100 : 0;
                                                        ?>
                                                        <?= number_format($persen_b_all_01, 2, ".", ","); ?>% <br>
                                                    </td>
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