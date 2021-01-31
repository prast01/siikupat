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
                            <h5 class="card-title m-0">Laporan Buku Kendali Sub Kegiatan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <form action="" method="post">
                                        <div class="form-group row mb-0">
                                            <label for="" class="col-form-label col-lg-12">Sub Kegiatan</label>
                                            <div class="col-lg-12">
                                                <select name="id_sub_kegiatan" style="width: 100%;" class="form-control select2">
                                                    <option disabled value="" <?= ($id_sub_kegiatan == "") ? "selected" : ""; ?>>Pilih</option>
                                                    <?php foreach ($sub_kegiatan as $row) : ?>
                                                        <option <?= ($id_sub_kegiatan == $row->id_sub_kegiatan) ? "selected" : ""; ?> value="<?= $row->id_sub_kegiatan; ?>"><?= $row->nama_sub_kegiatan; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="" class="col-form-label col-lg-6">dari Tanggal</label>
                                            <label for="" class="col-form-label col-lg-6">sampai Tanggal</label>
                                            <div class="col-lg-6">
                                                <input type="date" class="form-control" name="dari" value="<?= $dari; ?>">
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="date" class="form-control" name="sampai" value="<?= $sampai; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-sm">Cari</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th style="width: 3%;" rowspan="2">No</th>
                                                    <th style="width: 12%;" rowspan="2">Kode Rekening</th>
                                                    <th rowspan="2">Nama Rekening</th>
                                                    <th style="width: 10%;" rowspan="2">Pagu Anggaran</th>
                                                    <th style="width: 10%;" rowspan="2">Realisasi Sebelumnya</th>
                                                    <th colspan="2">Realisasi Kegiatan</th>
                                                    <th style="width: 10%;" rowspan="2">Total Realisasi</th>
                                                    <th style="width: 10%;" rowspan="2">Sisa Pagu Anggaran</th>
                                                </tr>
                                                <tr>
                                                    <th style="width: 10%;">GU</th>
                                                    <th style="width: 10%;">LS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php if ($hide) : ?>
                                                    <?php foreach ($bk1 as $key => $val) : ?>
                                                        <tr>
                                                            <td><?= $no++; ?></td>
                                                            <td><?= $val["kode_rekening"]; ?></td>
                                                            <td>
                                                                <a target="_blank" href="<?= site_url("../bk-2/" . $id_sub_kegiatan . "/" . $val["id_rekening"] . "/" . $dari . "/" . $sampai); ?>">
                                                                    <?= $val["nama_rekening"]; ?>
                                                                </a>
                                                            </td>
                                                            <td align="right"><?= number_format($val["pagu_rekening"], 0, ",", "."); ?></td>
                                                            <td align="right"><?= number_format($val["realisasi_sblm"], 0, ",", "."); ?></td>
                                                            <td align="right"><?= number_format($val["gu"], 0, ",", "."); ?></td>
                                                            <td align="right"><?= number_format($val["ls"], 0, ",", "."); ?></td>
                                                            <td align="right"><?= number_format($val["total"], 0, ",", "."); ?></td>
                                                            <td align="right"><?= number_format($val["sisa"], 0, ",", "."); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
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