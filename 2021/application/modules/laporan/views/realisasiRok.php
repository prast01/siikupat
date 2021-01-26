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
                            <h5 class="card-title m-0">Laporan Realisasi ROK</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <form action="" method="post">
                                        <div class="form-group row">
                                            <label class="col-form-label col-lg-2">Pilih Bulan</label>
                                            <div class="col-lg-4">
                                                <select name="bulan" class="form-control select2" style="width: 100%;">
                                                    <?php foreach ($bln as $key => $val) : ?>
                                                        <option <?= ($key == $bulan) ? "selected" : ""; ?> value="<?= $key; ?>"><?= $val; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-2">
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
                                                    <th width="5%" rowspan="2">No</th>
                                                    <th rowspan="2" width="40%">Nama Sub Kegiatan</th>
                                                    <th rowspan="2">Pelaksana</th>
                                                    <th rowspan="2" width="10%">Sisa Realisasi</th>
                                                    <th colspan="2">Bulan</th>
                                                    <th rowspan="2">Aksi</th>
                                                </tr>
                                                <tr>
                                                    <th width="10%">ROK</th>
                                                    <th width="10%">Realisasi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php foreach ($sub_kegiatan as $row => $val) : ?>
                                                    <?php $btn = ($val["valid"] == "0") ? "btn-primary" : "btn-success"; ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $val["nama_sub_kegiatan"]; ?></td>
                                                        <td><?= $val["nama"]; ?></td>
                                                        <td align="right"><?= $val["sisa"]; ?></td>
                                                        <td align="right"><?= $val["rok"]; ?></td>
                                                        <td align="right"><?= $val["realisasi"]; ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a target="_blank" href="<?= site_url("../rok/lihatDaftar/" . $val["id_sub_kegiatan"] . "/" . $bulan . "/" . $val["kode_seksi"]); ?>" class="btn <?= $btn; ?> btn-sm btn-flat">
                                                                    <span class="fa fa-eye"></span>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
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