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
                            <h5 class="card-title m-0">Laporan Buku Kendali per Rekening</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <form action="" method="post">
                                        <div class="form-group row mb-0">
                                            <label for="" class="col-form-label col-lg-12">Sub Kegiatan</label>
                                            <div class="col-lg-12">
                                                <select name="id_sub_kegiatan" style="width: 100%;" class="form-control select2" onchange="get_rekening(this.value)">
                                                    <option disabled value="" <?= ($id_sub_kegiatan == "") ? "selected" : ""; ?>>Pilih</option>
                                                    <?php foreach ($sub_kegiatan as $row) : ?>
                                                        <option <?= ($id_sub_kegiatan == $row->id_sub_kegiatan) ? "selected" : ""; ?> value="<?= $row->id_sub_kegiatan; ?>"><?= $row->nama_sub_kegiatan; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-0">
                                            <label for="" class="col-form-label col-lg-12">Rekening</label>
                                            <div class="col-lg-12">
                                                <select name="id_rekening" id="id_rekening" class="form-control select2" style="width: 100%;">
                                                    <option value="" <?= ($id_rekening == "") ? "selected" : ""; ?>>Pilih</option>
                                                    <?php if ($hide) : ?>
                                                        <?php foreach ($rekening as $row) : ?>
                                                            <option <?= ($id_rekening == $row->id_rekening) ? "selected" : ""; ?> value="<?= $row->id_rekening; ?>"><?= $row->nama_rekening; ?></option>
                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
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
                                                    <th style="width: 11%;" rowspan="2">Tgl Kegiatan</th>
                                                    <th style="width: 11%;" rowspan="2">Tgl Transfer</th>
                                                    <th rowspan="2">Uraian</th>
                                                    <th style="width: 25%;" rowspan="2">Pelaksana</th>
                                                    <th colspan="2">Realisasi Kegiatan</th>
                                                </tr>
                                                <tr>
                                                    <th style="width: 10%;">GU</th>
                                                    <th style="width: 10%;">LS</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php if ($hide) : ?>
                                                    <?php foreach ($bk2 as $key => $val) : ?>
                                                        <tr>
                                                            <td><?= $no++; ?></td>
                                                            <td><?= $val["tgl_kegiatan"]; ?></td>
                                                            <td><?= $val["tgl_transfer"]; ?></td>
                                                            <td><?= $val["uraian"]; ?></td>
                                                            <td>
                                                                <ol>
                                                                    <?php foreach ($val["pelaksana"] as $row) : ?>
                                                                        <li class="my-0">
                                                                            <?php if ($row->pihak_ketiga == "") : ?>
                                                                                <?= $row->nama_pegawai; ?>
                                                                            <?php else : ?>
                                                                                <?= $row->pihak_ketiga; ?>
                                                                            <?php endif; ?>
                                                                        </li>
                                                                    <?php endforeach; ?>
                                                                </ol>
                                                            </td>
                                                            <td align="right"><?= number_format($val["gu"], 0, ",", "."); ?></td>
                                                            <td align="right"><?= number_format($val["ls"], 0, ",", "."); ?></td>
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