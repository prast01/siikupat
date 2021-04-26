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
                            <h5 class="card-title m-0">Rencana Anggaran Kas</h5>
                            <br>
                            <p class="py-0">
                                Silahkan diisi sesuai dengan yang sudah dientrikan di <a target="_blank" href="http://rak.apbdjepara.org/">Aplikasi simRAK (http://rak.apbdjepara.org/)</a> atau
                                <br>
                                di <a target="_blank" href="https://sipd.kemendagri.go.id/siap/login">Aplikasi SIPD (https://sipd.kemendagri.go.id/siap/login)</a>
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <a href="<?= site_url("../rak"); ?>" class="btn btn-warning text-white">
                                        <span class="fa fa-arrow-left"></span> Kembali
                                    </a>
                                </div>
                                <div class="col-lg-12">
                                    <form action="" method="post">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">No</th>
                                                        <th>Bulan</th>
                                                        <th width="25%">RAK</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; ?>
                                                    <?php foreach ($detail as $row => $val) : ?>
                                                        <tr>
                                                            <td><?= $no++; ?></td>
                                                            <td><?= $val["nama_bulan"]; ?></td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input type="hidden" name="id_sub_kegiatan" value="<?= $id_sub_kegiatan; ?>">
                                                                    <input type="number" name="b<?= $val["kode_bulan"]; ?>" value="<?= $val["rak"]; ?>" class="form-control">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    <tr>
                                                        <td colspan="2"></td>
                                                        <td align="center">
                                                            <button type="submit" class="btn btn-primary btn-sm">
                                                                Simpan
                                                            </button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>