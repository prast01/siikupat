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
                            <h5 class="card-title m-0">Rencana Anggaran Kas</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <?php if ($this->session->userdata("kode_seksi") == "XXXX") : ?>
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
                                <?php endif; ?>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" width="5%">No</th>
                                                    <th rowspan="2">Nama Sub Kegiatan</th>
                                                    <th rowspan="2" width="10%">Subbag/Seksi/UPT</th>
                                                    <th colspan="4">Triwulan</th>
                                                    <th rowspan="2" width="5%">Aksi</th>
                                                </tr>
                                                <tr>
                                                    <th width="10%">TW 1</th>
                                                    <th width="10%">TW 2</th>
                                                    <th width="10%">TW 3</th>
                                                    <th width="10%">TW 4</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php foreach ($sub_kegiatan as $row => $val) : ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $val["nama_sub_kegiatan"]; ?></td>
                                                        <td><?= $val["nama"]; ?></td>
                                                        <td align="right"><?= number_format($val["tw1"], 0, ",", "."); ?></td>
                                                        <td align="right"><?= number_format($val["tw2"], 0, ",", "."); ?></td>
                                                        <td align="right"><?= number_format($val["tw3"], 0, ",", "."); ?></td>
                                                        <td align="right"><?= number_format($val["tw4"], 0, ",", "."); ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="<?= site_url("../rak/detail/" . $val["id_sub_kegiatan"]); ?>" class="btn btn-primary btn-sm btn-flat">
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