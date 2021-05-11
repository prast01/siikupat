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
                            <h5 class="card-title m-0">Pagu Pendapatan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <button class="btn btn-success" onclick="modalDefault('Tambah Jenis Pendapatan', 'tambahJenisPendapatan/<?= $kode_pusk; ?>')">
                                        <span class="fa fa-plus"></span> Tambah Data
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <form action="" method="post">
                                        <input type="hidden" name="kode_pusk" value="<?= $kode_pusk; ?>">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">No</th>
                                                        <th>Jenis Pendapatan</th>
                                                        <th width="20%">Pagu Anggaran</th>
                                                        <th width="20%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; ?>
                                                    <?php $jumlah = 0; ?>
                                                    <?php foreach ($pendapatan_def as $key => $val) : ?>
                                                        <?php $jumlah = $jumlah + $val["pagu_pendapatan"]; ?>
                                                        <tr>
                                                            <td style="vertical-align: middle;"><?= $no++; ?></td>
                                                            <td style="vertical-align: middle;">
                                                                <?= $val["jenis_pendapatan"]; ?>
                                                            </td>
                                                            <td style="vertical-align: middle;" align="right"><?= number_format($val["pagu_pendapatan"], 0, ",", "."); ?></td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-group">
                                                                    <input type="hidden" name="id_jenis_pendapatan[]" value="<?= $val["id_jenis_pendapatan"]; ?>">
                                                                    <input type="number" name="pagu_pendapatan[]" value="<?= $val["pagu_pendapatan"]; ?>" class="form-control">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    <tr style="background-color: lightgray;">
                                                        <td colspan="4">
                                                            <b>Jenis Pendapatan Tambahan</b> <br>
                                                            <span class="text-danger">Catatan : </span> Untuk mengubah dan menghapus data, silahkan klik pada nama jenis pendapatan.
                                                        </td>
                                                    </tr>
                                                    <?php foreach ($pendapatan_pusk as $key => $val) : ?>
                                                        <?php $jumlah = $jumlah + $val["pagu_pendapatan"]; ?>
                                                        <tr style="background-color: lightgray;">
                                                            <td style="vertical-align: middle;"><?= $no++; ?></td>
                                                            <td style="vertical-align: middle;">
                                                                <span style="cursor: pointer;" onclick="modalDefault('Ubah Jenis Pendapatan', 'ubahJenisPendapatan/<?= $val['id_jenis_pendapatan']; ?>')"><?= $val["jenis_pendapatan"]; ?></span>
                                                            </td>
                                                            <td style="vertical-align: middle;" align="right"><?= number_format($val["pagu_pendapatan"], 0, ",", "."); ?></td>
                                                            <td style="vertical-align: middle;">
                                                                <div class="form-group">
                                                                    <input type="hidden" name="id_jenis_pendapatan[]" value="<?= $val["id_jenis_pendapatan"]; ?>">
                                                                    <input type="number" name="pagu_pendapatan[]" value="<?= $val["pagu_pendapatan"]; ?>" class="form-control">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    <tr>
                                                        <td colspan="2" align="right"><b>JUMLAH</b></td>
                                                        <td align="right">
                                                            <b><?= number_format($jumlah, 0, ",", "."); ?></b>
                                                        </td>
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