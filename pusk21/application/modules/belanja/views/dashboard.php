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
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5 class="card-title m-0">DAFTAR BELANJA <?= $judul; ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <button class="btn btn-success" onclick="modalDefault('Tambah Belanja', 'tambahBelanja/<?= $judul; ?>')">
                                        <span class="fa fa-plus"></span> Tambah Data <?= $judul; ?>
                                    </button>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <form action="" method="post">
                                        <div class="form-group row">
                                            <label for="inputEmail3" class="col-lg-2 col-form-label">Filter</label>
                                            <div class="col-lg-5">
                                                <select name="bulan" style="width: 100%" class="form-control select2">
                                                    <option <?= ($bln == "all") ? "selected" : ""; ?> value="all">Semua Bulan</option>
                                                    <?php foreach ($arr_bln as $key => $val) : ?>
                                                        <option <?= ($bln == $key) ? "selected" : ""; ?> value="<?= $key; ?>"><?= $val; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="col-lg-5">
                                                <button type="submit" class="btn btn-success">Lihat</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th width="15%">No SPJ</th>
                                                    <th>Uraian</th>
                                                    <th width="15%">Nominal</th>
                                                    <th width="10%">Aksi</th>
                                                </tr>
                                            </thead>
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