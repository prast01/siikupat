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
        <div class="container">
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
                <div class="col lg-12 mb-3">
                    <a href="<?= site_url("../"); ?>" class="btn btn-warning text-white">
                        <span class="fa fa-arrow-left"></span> Kembali
                    </a>
                </div>
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title m-0">Data - <?= $data["nama_data"]; ?></h5>
                        </div>
                        <div class="card-body">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-lg-12 mb-3">
                                        <div class="form-group row">
                                            <input type="hidden" name="id_data" value="<?= $data["id_data"]; ?>">
                                            <label class="col-form-label col-lg-1">Tahun</label>
                                            <div class="col-lg-3">
                                                <select name="tahun" class="form-control select2" style="width: 100%;">
                                                    <?php for ($i = 2019; $i <= date("Y"); $i++) { ?>
                                                        <option <?= ($i == $tahun) ? "selected" : ""; ?> value="<?= $i; ?>"><?= $i; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-2">
                                                <button class="btn btn-success" name="lihat">
                                                    <span class="fa fa-search"></span> Lihat
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($show) : ?>
                                        <div class="col-lg-12">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th width="5%">No</th>
                                                            <th>Nama Kecamatan</th>
                                                            <th width="10%">Nilai</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $no = 1; ?>
                                                        <?php foreach ($data["data"] as $key => $val) : ?>
                                                            <tr>
                                                                <td><?= $no++; ?></td>
                                                                <td>KECAMATAN <?= $val["nama_kecamatan"]; ?></td>
                                                                <td>
                                                                    <div class="form-group">
                                                                        <input type="hidden" name="kode_kecamatan[]" value="<?= $val["kode_kecamatan"]; ?>">
                                                                        <input type="text" name="nilai[]" class="form-control" value="<?= $val["nilai"]; ?>">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                        <tr>
                                                            <td colspan="3" align="right">
                                                                <button class="btn btn-primary" name="simpan" onclick="return confirm('Yakin simpan data??')">
                                                                    <span class="fa fa-save"></span> Simpan
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>