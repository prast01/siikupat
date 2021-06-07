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
                                                    <a href="<?= site_url("../laporan-kinerja/detail"); ?>" class="btn btn-warning text-white">Kembali</a>
                                                </div>
                                                <label class="col-form-label col-lg-1">Filter</label>
                                                <div class="col-lg-3">
                                                    <select name="kode_bidang" class="form-control select2" style="width: 100%;" onchange="get_seksi(this.value)">
                                                        <option <?= ("DK005" == $kode_bidang) ? "selected" : ""; ?> value="DK005">Faskes</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3">
                                                    <select name="kode_seksi" id="kode_seksi" class="form-control select2" style="width: 100%;">
                                                        <option <?= ($kode_seksi == "all") ? "selected" : ""; ?> value="" disabled>Pilih</option>
                                                        <?php foreach ($seksi as $key) : ?>
                                                            <option <?= ($key->kode_seksi == $kode_seksi) ? "selected" : ""; ?> value="<?= $key->kode_seksi; ?>"><?= $key->nama; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-1">
                                                    <button class="btn btn-success" name="cari">Cari</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-3">
                                        <h4>Catatan :</h4>
                                        <ul>
                                            <li>A => Anggaran RAK</li>
                                            <li>R => Realisasi Anggaran</li>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                                <?php if ($show) : ?>
                                    <div class="col-lg-12">
                                        <form action="" method="post">
                                            <input type="hidden" name="kode_seksi" value="<?= $kode_seksi; ?>">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-bordered datatable">
                                                    <thead>
                                                        <tr>
                                                            <th width="6%"><?= $judul; ?></th>
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
                                                                <td>
                                                                    <?= $val["skpd"]; ?>
                                                                </td>
                                                                <td align="center">
                                                                    A <br> <br>
                                                                    R <br>
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
                                                                    <td>
                                                                        <div class="form-group">
                                                                            <input type="hidden" name="bulan[]" value="<?= $row2; ?>">
                                                                            <input type="number" name="rak[]" value="<?= $val["rak" . $row2]; ?>" class="form-control mb-1">
                                                                            <input type="number" name="realisasi[]" value="<?= $val[$row2]; ?>" class="form-control">
                                                                        </div>
                                                                    </td>
                                                                <?php endforeach; ?>
                                                                <td align="right">
                                                                    <?= number_format($total_samping, 0, ",", "."); ?> <br> <br>
                                                                    <?= number_format($total_samping2, 0, ",", "."); ?> <br> <br>
                                                                    <button type="submit" name="simpan" class="btn btn-primary">
                                                                        Simpan
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>