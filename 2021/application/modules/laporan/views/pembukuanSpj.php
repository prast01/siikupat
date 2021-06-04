<div class="content-wrapper">
    <div class="content-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <!-- <h1 class="m-0 text-dark"></h1> -->
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mb-5">
                    <div class="card card-danger">
                        <div class="card-header">
                            <h5 class="card-title m-0">DAFTAR SPJ DIBUKUKAN</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <form action="" method="post">
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-1">Filter</label>
                                            <div class="col-lg-3">
                                                <select name="bulan" class="form-control select2" style="width: 100%;">
                                                    <?php foreach ($bln as $key => $val) : ?>
                                                        <option <?= ($key == $bulan) ? "selected" : ""; ?> value="<?= $key; ?>"><?= $val; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
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
                                                    <th width="5%">No SPJ</th>
                                                    <th width="10%">Tgl Kegiatan</th>
                                                    <th>Uraian Kegiatan</th>
                                                    <th width="15%">Nominal</th>
                                                    <th>Pelaksana</th>
                                                    <th width="5%">Status</th>
                                                    <th>Catatan</th>
                                                    <th width="5%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php $total = 0; ?>
                                                <?php foreach ($spj as $row => $val) : ?>
                                                    <?php $total = $total + $val["nominal_real"]; ?>
                                                    <tr>
                                                        <td><?= $val["no_seksi"]; ?></td>
                                                        <td><?= $val["tgl_kegiatan"]; ?></td>
                                                        <td><?= $val["uraian"]; ?></td>
                                                        <td><?= $val["nominal"]; ?></td>
                                                        <td>
                                                            <ol>
                                                                <?php foreach ($val["pelaksana"] as $row) : ?>
                                                                    <li class="my-0"><?= $row->nama_pegawai; ?></li>
                                                                <?php endforeach; ?>
                                                            </ol>
                                                        </td>
                                                        <td><?= $val["nama_status"]; ?><br><?= $val["tanggal"]; ?></td>
                                                        <td><?= $val["verif_spj"]; ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="<?= site_url("../lihat-spj/2/" . $val["kode_spj"]); ?>" class="btn btn-primary btn-sm">
                                                                    <span class="fa fa-eye"></span>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th align="right" colspan="3">Total</th>
                                                    <th><?= number_format($total, 0, ",", "."); ?></th>
                                                    <th colspan="4"></th>
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