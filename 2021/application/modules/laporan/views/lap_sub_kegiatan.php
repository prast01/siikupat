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
                            <h5 class="card-title m-0">Laporan Realisasi Sub Kegiatan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <form action="" method="post">
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-1">Filter</label>
                                            <div class="col-lg-3">
                                                <select name="kode_bidang" class="form-control select2" style="width: 100%;" onchange="get_seksi(this.value)">
                                                    <option <?= ($kode_bidang == "all") ? "selected" : ""; ?> value="all">Semua</option>
                                                    <?php foreach ($bidang as $key) : ?>
                                                        <option <?= ($key->kode_bidang == $kode_bidang) ? "selected" : ""; ?> value="<?= $key->kode_bidang; ?>"><?= $key->nama_bidang; ?></option>
                                                    <?php endforeach; ?>
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
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th width="5%">No</th>
                                                    <th>Nama Sub Kegiatan</th>
                                                    <th width="30%">Pelaksana</th>
                                                    <th width="10%">Pagu Anggaran</th>
                                                    <th width="10%">Realisasi Anggaran</th>
                                                    <th width="10%">Sisa Anggaran</th>
                                                    <th width="5%">Persentase</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php
                                                $pagu_anggaran = 0;
                                                $realisasi = 0;
                                                $sisa = 0;
                                                ?>
                                                <?php foreach ($sub_kegiatan as $key => $val) : ?>
                                                    <?php
                                                    $pagu_anggaran = $pagu_anggaran + $val["pagu_anggaran"];
                                                    $realisasi = $realisasi + $val["realisasi"];
                                                    $sisa = $sisa + $val["sisa"];
                                                    ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $val["nama_sub_kegiatan"]; ?></td>
                                                        <td><?= $val["nama"]; ?></td>
                                                        <td align="right"><?= number_format($val["pagu_anggaran"], 0, ".", ","); ?></td>
                                                        <td align="right"><?= number_format($val["realisasi"], 0, ".", ","); ?></td>
                                                        <td align="right"><?= number_format($val["sisa"], 0, ".", ","); ?></td>
                                                        <td><?= number_format($val["persen"], 2, ".", ","); ?>%</td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <?php
                                                $persen = ($realisasi / $pagu_anggaran) * 100;
                                                ?>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td align="right"><b><?= number_format($pagu_anggaran, 0, ".", ","); ?></b></td>
                                                    <td align="right"><b><?= number_format($realisasi, 0, ".", ","); ?></b></td>
                                                    <td align="right"><b><?= number_format($sisa, 0, ".", ","); ?></b></td>
                                                    <td><b><?= number_format($persen, 2, ".", ","); ?>%</b></td>
                                                </tr>
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