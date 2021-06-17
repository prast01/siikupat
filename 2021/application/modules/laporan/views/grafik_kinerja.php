<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1 class="m-0 text-dark">Realisasi Pencairan Anggaran</h1> -->
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
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-5 mb-3">
                                    <form action="" method="post">
                                        <div class="form-group row">
                                            <!-- <div class="col-lg-2">
                                                <a href="<?= site_url("../laporan-kinerja"); ?>" class="btn btn-warning text-white">Kembali</a>
                                            </div> -->
                                            <label class="col-form-label col-lg-1">Filter</label>
                                            <div class="col-lg-4">
                                                <select id="kode_bidang" class="form-control select2" style="width: 100%;" onchange="get_seksi(this.value)">
                                                    <option value="all">Semua</option>
                                                    <?php foreach ($bidang as $key) : ?>
                                                        <option value="<?= $key->kode_bidang; ?>"><?= $key->nama_bidang; ?></option>
                                                    <?php endforeach; ?>
                                                    <option value="DK005">Faskes</option>
                                                </select>
                                            </div>
                                            <div class="col-lg-4">
                                                <select name="bulan" id="bulan" class="form-control select2" style="width: 100%;">
                                                    <?php foreach ($bln as $key => $val) : ?>
                                                        <option <?= ($key == $bulan) ? "selected" : ""; ?> value="<?= $key; ?>"><?= $val; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-1">
                                                <button class="btn btn-success" type="button" name="lihat" onclick="getGrafikKinerja()">Lihat</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-12 mb-5">
                                    <h4 class="text-center">
                                        GRAFIK REALISASI PENYERAPAN<br>
                                        DIBANDING RAK BULAN <span id="namaBulan"><?= strtoupper($bln[date("m")]); ?></span> TAHUN <?= date("Y"); ?> <br>
                                        <span class="text-sm">Update : <?= date("Y-m-d H:i:s"); ?></span>
                                    </h4>
                                    <div class="chart" id="barContainer">
                                        <canvas id="barChart" style="height:530px; min-height:230px"></canvas>
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