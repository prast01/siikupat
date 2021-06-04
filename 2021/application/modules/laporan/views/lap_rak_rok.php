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
                            <h5 class="card-title m-0"><?= $laporan; ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <form action="" method="post">
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-1">Filter</label>
                                            <div class="col-lg-3">
                                                <select name="kode_bidang" class="form-control select2" style="width: 100%;" onchange="get_seksi(this.value)">
                                                    <option <?= ($kode_bidang == "") ? "selected" : ""; ?> value="">Semua</option>
                                                    <?php foreach ($bidang as $key) : ?>
                                                        <option <?= ($key->kode_bidang == $kode_bidang) ? "selected" : ""; ?> value="<?= $key->kode_bidang; ?>"><?= $key->nama_bidang; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-3">
                                                <select name="kode_seksi" id="kode_seksi" class="form-control select2" style="width: 100%;">
                                                    <option <?= ($kode_bidang == "") ? "selected" : ""; ?> value="">Semua</option>
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
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th width="3%">No</th>
                                                    <th width="8%">Nama Sub Kegiatan</th>
                                                    <th width="7%">Pelaksana</th>
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
                                                ?>
                                                <?php foreach ($sub_kegiatan as $row => $val) : ?>
                                                    <?php
                                                    $total_samping = 0;
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
                                                    ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $val["nama_sub_kegiatan"]; ?></td>
                                                        <td><?= $val["nama"]; ?></td>
                                                        <?php foreach ($bln as $row2 => $val2) : ?>
                                                            <?php
                                                            $total_samping = $total_samping + $val[$row2];
                                                            ?>
                                                            <td align="right"><?= number_format($val[$row2], 0, ",", "."); ?></td>
                                                        <?php endforeach; ?>
                                                        <td align="right"><?= number_format($total_samping, 0, ",", "."); ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td align="right" colspan="3"><b>JUMLAH</b></td>
                                                    <td align="right"><b><?= number_format($b_01, 0, ",", "."); ?></b></td>
                                                    <td align="right"><b><?= number_format($b_02, 0, ",", "."); ?></b></td>
                                                    <td align="right"><b><?= number_format($b_03, 0, ",", "."); ?></b></td>
                                                    <td align="right"><b><?= number_format($b_04, 0, ",", "."); ?></b></td>
                                                    <td align="right"><b><?= number_format($b_05, 0, ",", "."); ?></b></td>
                                                    <td align="right"><b><?= number_format($b_06, 0, ",", "."); ?></b></td>
                                                    <td align="right"><b><?= number_format($b_07, 0, ",", "."); ?></b></td>
                                                    <td align="right"><b><?= number_format($b_08, 0, ",", "."); ?></b></td>
                                                    <td align="right"><b><?= number_format($b_09, 0, ",", "."); ?></b></td>
                                                    <td align="right"><b><?= number_format($b_10, 0, ",", "."); ?></b></td>
                                                    <td align="right"><b><?= number_format($b_11, 0, ",", "."); ?></b></td>
                                                    <td align="right"><b><?= number_format($b_12, 0, ",", "."); ?></b></td>
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