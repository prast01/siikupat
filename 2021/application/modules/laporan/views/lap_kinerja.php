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
                                <?php if ($detail) : ?>
                                    <div class="col-lg-6 mb-3">
                                        <form action="" method="post">
                                            <div class="form-group row">
                                                <div class="col-lg-2">
                                                    <a href="<?= site_url("../laporan-kinerja"); ?>" class="btn btn-warning text-white">Kembali</a>
                                                </div>
                                                <label class="col-form-label col-lg-1">Filter</label>
                                                <div class="col-lg-3">
                                                    <select name="kode_bidang" class="form-control select2" style="width: 100%;" onchange="get_seksi(this.value)">
                                                        <option <?= ($kode_bidang == "all") ? "selected" : ""; ?> value="all">Semua</option>
                                                        <?php foreach ($bidang as $key) : ?>
                                                            <option <?= ($key->kode_bidang == $kode_bidang) ? "selected" : ""; ?> value="<?= $key->kode_bidang; ?>"><?= $key->nama_bidang; ?></option>
                                                        <?php endforeach; ?>
                                                        <option <?= ("DK005" == $kode_bidang) ? "selected" : ""; ?> value="DK005">Faskes</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3">
                                                    <select name="kode_seksi" id="kode_seksi" class="form-control select2" style="width: 100%;">
                                                        <option <?= ($kode_seksi == "all") ? "selected" : ""; ?> value="all">Semua</option>
                                                        <?php foreach ($seksi as $key) : ?>
                                                            <option <?= ($key->kode_seksi == $kode_seksi) ? "selected" : ""; ?> value="<?= $key->kode_seksi; ?>"><?= $key->nama; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-1">
                                                    <button class="btn btn-success" name="lihat">Lihat</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                <?php endif; ?>
                                <?php if ($detail && $kode_bidang == "DK005") : ?>
                                    <div class="col-lg-3">
                                        <a href="<?= site_url("../laporan-kinerja/faskes"); ?>" class="btn btn-primary">Update Data</a>
                                    </div>
                                <?php endif; ?>
                                <div class="col-lg-3">
                                    <h4>Catatan :</h4>
                                    <ul>
                                        <li>A => Anggaran RAK</li>
                                        <li>R => Realisasi Anggaran</li>
                                    </ul>
                                </div>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th width="2%">No</th>
                                                    <th width="10%"><?= $judul; ?></th>
                                                    <th width="3%"></th>
                                                    <?php foreach ($bln as $row => $val) : ?>
                                                        <th><?= $val; ?></th>
                                                    <?php endforeach; ?>
                                                    <th>Jumlah</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $no = 1;
                                                $total_all = 0;
                                                $b_1 = 0;
                                                $b_2 = 0;
                                                $b_3 = 0;
                                                $b_4 = 0;
                                                $b_5 = 0;
                                                $b_6 = 0;
                                                $b_7 = 0;
                                                $b_8 = 0;
                                                $b_9 = 0;
                                                $b_10 = 0;
                                                $b_11 = 0;
                                                $b_12 = 0;
                                                $rak_1 = 0;
                                                $rak_2 = 0;
                                                $rak_3 = 0;
                                                $rak_4 = 0;
                                                $rak_5 = 0;
                                                $rak_6 = 0;
                                                $rak_7 = 0;
                                                $rak_8 = 0;
                                                $rak_9 = 0;
                                                $rak_10 = 0;
                                                $rak_11 = 0;
                                                $rak_12 = 0;
                                                ?>
                                                <?php foreach ($kinerja as $row => $val) :
                                                ?>
                                                    <?php
                                                    $total_samping = 0;
                                                    $total_samping2 = 0;
                                                    $b_01 = $b_01 + $val["01"];
                                                    $b_02 = $b_02 + $val["02"];
                                                    $b_03 = $b_03 + $val["03"];
                                                    $b_04 = $b_04 + $val["04"];
                                                    $b_05 = $b_05 + $val["05"];
                                                    $b_06 = $b_06 + $val["06"];
                                                    $b_07 = $b_07 + $val["07"];
                                                    $b_08 = $b_08 + $val["08"];
                                                    $b_09 = $b_09 + $val["09"];
                                                    $b_10 = $b_10 + $val["10"];
                                                    $b_11 = $b_11 + $val["11"];
                                                    $b_12 = $b_12 + $val["12"];
                                                    $rak_01 = $rak_01 + $val["rak01"];
                                                    $rak_02 = $rak_02 + $val["rak02"];
                                                    $rak_03 = $rak_03 + $val["rak03"];
                                                    $rak_04 = $rak_04 + $val["rak04"];
                                                    $rak_05 = $rak_05 + $val["rak05"];
                                                    $rak_06 = $rak_06 + $val["rak06"];
                                                    $rak_07 = $rak_07 + $val["rak07"];
                                                    $rak_08 = $rak_08 + $val["rak08"];
                                                    $rak_09 = $rak_09 + $val["rak09"];
                                                    $rak_10 = $rak_10 + $val["rak10"];
                                                    $rak_11 = $rak_11 + $val["rak11"];
                                                    $rak_12 = $rak_12 + $val["rak12"];
                                                    ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td>
                                                            <?php if (!$detail) : ?>
                                                                <a href="<?= site_url("../laporan-kinerja/detail"); ?>">
                                                                    <?= $val["skpd"]; ?>
                                                                </a>
                                                            <?php else : ?>
                                                                <!-- <a href="#"> -->
                                                                <?= $val["skpd"]; ?>
                                                                <!-- </a> -->
                                                            <?php endif; ?>
                                                        </td>
                                                        <td align="center">
                                                            A <br>
                                                            R <br>
                                                            % <br>
                                                        </td>
                                                        <?php foreach ($bln as $row2 => $val2) : ?>
                                                            <?php
                                                            $total_samping = $total_samping + $val["rak" . $row2];
                                                            $total_samping2 = $total_samping2 + $val[$row2];
                                                            $persen_bln = ($val["rak" . $row2] != 0) ? ($val[$row2] / $val["rak" . $row2]) * 100 : 0;

                                                            $p_bln = ($val["rak" . $row2] == 0 && $val[$row2] != 0) ? 100 : $persen_bln;

                                                            $blns = date("m");
                                                            if ($row2 > $blns) {
                                                                $color = "";
                                                            } else {
                                                                $color = ($p_bln >= 75) ? "text-success" : "text-danger";
                                                            }

                                                            ?>
                                                            <td align="right" class="<?= $color; ?>">
                                                                <?= number_format($val["rak" . $row2], 0, ",", "."); ?> <br>
                                                                <?= number_format($val[$row2], 0, ",", "."); ?> <br>
                                                                <?= number_format($p_bln, 2, ",", "."); ?>% <br>
                                                            </td>
                                                        <?php endforeach; ?>
                                                        <td align="right">
                                                            <?= number_format($total_samping, 0, ",", "."); ?> <br>
                                                            <?= number_format($total_samping2, 0, ",", "."); ?> <br>
                                                            <?php
                                                            $persen_all = ($total_samping != 0) ? ($total_samping2 / $total_samping) * 100 : 0;
                                                            ?>
                                                            <?= number_format($persen_all, 2, ",", "."); ?>% <br>
                                                        </td>
                                                    </tr>
                                                <?php endforeach;
                                                ?>
                                            </tbody>
                                            <?php if ($detail) : ?>
                                                <tfoot>
                                                    <tr>
                                                        <td align="right" colspan="3"><b>JUMLAH</b></td>
                                                        <td align="right">
                                                            <b><?= number_format($rak_01, 0, ",", "."); ?></b> <br>
                                                            <b><?= number_format($b_01, 0, ",", "."); ?></b> <br>
                                                            <?php
                                                            $persen_b_all_01 = ($rak_01 != 0) ? ($b_01 / $rak_01) * 100 : 0;
                                                            ?>
                                                            <?= number_format($persen_b_all_01, 2, ",", "."); ?>% <br>
                                                        </td>
                                                        <td align="right">
                                                            <b><?= number_format($rak_02, 0, ",", "."); ?></b> <br>
                                                            <b><?= number_format($b_02, 0, ",", "."); ?></b> <br>
                                                            <?php
                                                            $persen_b_all_02 = ($rak_02 != 0) ? ($b_02 / $rak_02) * 100 : 0;
                                                            ?>
                                                            <?= number_format($persen_b_all_02, 2, ",", "."); ?>% <br>
                                                        </td>
                                                        <td align="right">
                                                            <b><?= number_format($rak_03, 0, ",", "."); ?></b> <br>
                                                            <b><?= number_format($b_03, 0, ",", "."); ?></b> <br>
                                                            <?php
                                                            $persen_b_all_03 = ($rak_03 != 0) ? ($b_03 / $rak_03) * 100 : 0;
                                                            ?>
                                                            <?= number_format($persen_b_all_03, 2, ",", "."); ?>% <br>
                                                        </td>
                                                        <td align="right">
                                                            <b><?= number_format($rak_04, 0, ",", "."); ?></b> <br>
                                                            <b><?= number_format($b_04, 0, ",", "."); ?></b> <br>
                                                            <?php
                                                            $persen_b_all_04 = ($rak_04 != 0) ? ($b_04 / $rak_04) * 100 : 0;
                                                            ?>
                                                            <?= number_format($persen_b_all_04, 2, ",", "."); ?>% <br>
                                                        </td>
                                                        <td align="right">
                                                            <b><?= number_format($rak_05, 0, ",", "."); ?></b> <br>
                                                            <b><?= number_format($b_05, 0, ",", "."); ?></b> <br>
                                                            <?php
                                                            $persen_b_all_05 = ($rak_05 != 0) ? ($b_05 / $rak_05) * 100 : 0;
                                                            ?>
                                                            <?= number_format($persen_b_all_05, 2, ",", "."); ?>% <br>
                                                        </td>
                                                        <td align="right">
                                                            <b><?= number_format($rak_06, 0, ",", "."); ?></b> <br>
                                                            <b><?= number_format($b_06, 0, ",", "."); ?></b> <br>
                                                            <?php
                                                            $persen_b_all_06 = ($rak_06 != 0) ? ($b_06 / $rak_06) * 100 : 0;
                                                            ?>
                                                            <?= number_format($persen_b_all_06, 2, ",", "."); ?>% <br>
                                                        </td>
                                                        <td align="right">
                                                            <b><?= number_format($rak_07, 0, ",", "."); ?></b> <br>
                                                            <b><?= number_format($b_07, 0, ",", "."); ?></b> <br>
                                                            <?php
                                                            $persen_b_all_07 = ($rak_07 != 0) ? ($b_07 / $rak_07) * 100 : 0;
                                                            ?>
                                                            <?= number_format($persen_b_all_07, 2, ",", "."); ?>% <br>
                                                        </td>
                                                        <td align="right">
                                                            <b><?= number_format($rak_08, 0, ",", "."); ?></b> <br>
                                                            <b><?= number_format($b_08, 0, ",", "."); ?></b> <br>
                                                            <?php
                                                            $persen_b_all_08 = ($rak_08 != 0) ? ($b_08 / $rak_08) * 100 : 0;
                                                            ?>
                                                            <?= number_format($persen_b_all_08, 2, ",", "."); ?>% <br>
                                                        </td>
                                                        <td align="right">
                                                            <b><?= number_format($rak_09, 0, ",", "."); ?></b> <br>
                                                            <b><?= number_format($b_09, 0, ",", "."); ?></b> <br>
                                                            <?php
                                                            $persen_b_all_09 = ($rak_09 != 0) ? ($b_09 / $rak_09) * 100 : 0;
                                                            ?>
                                                            <?= number_format($persen_b_all_09, 2, ",", "."); ?>% <br>
                                                        </td>
                                                        <td align="right">
                                                            <b><?= number_format($rak_10, 0, ",", "."); ?></b> <br>
                                                            <b><?= number_format($b_10, 0, ",", "."); ?></b> <br>
                                                            <?php
                                                            $persen_b_all_10 = ($rak_10 != 0) ? ($b_10 / $rak_10) * 100 : 0;
                                                            ?>
                                                            <?= number_format($persen_b_all_10, 2, ",", "."); ?>% <br>
                                                        </td>
                                                        <td align="right">
                                                            <b><?= number_format($rak_11, 0, ",", "."); ?></b> <br>
                                                            <b><?= number_format($b_11, 0, ",", "."); ?></b> <br>
                                                            <?php
                                                            $persen_b_all_11 = ($rak_11 != 0) ? ($b_11 / $rak_11) * 100 : 0;
                                                            ?>
                                                            <?= number_format($persen_b_all_11, 2, ",", "."); ?>% <br>
                                                        </td>
                                                        <td align="right">
                                                            <b><?= number_format($rak_12, 0, ",", "."); ?></b> <br>
                                                            <b><?= number_format($b_12, 0, ",", "."); ?></b> <br>
                                                            <?php
                                                            $persen_b_all_12 = ($rak_12 != 0) ? ($b_12 / $rak_12) * 100 : 0;
                                                            ?>
                                                            <?= number_format($persen_b_all_12, 2, ",", "."); ?>% <br>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </tfoot>
                                            <?php endif; ?>
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