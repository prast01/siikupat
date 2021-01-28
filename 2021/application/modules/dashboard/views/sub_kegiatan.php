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
                            <h5 class="card-title m-0">Realisasi Sub Kegiatan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <a href="<?= site_url("../"); ?>" class="btn btn-warning text-white">
                                        <span class="fa fa-arrow-left"></span> Kembali
                                    </a>
                                </div>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Sub Kegiatan</th>
                                                    <th>Pagu Anggaran</th>
                                                    <th>Realisasi Anggaran</th>
                                                    <th>Sisa Anggaran</th>
                                                    <th>Persentase</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php $total_p = 0; ?>
                                                <?php $total_r = 0; ?>
                                                <?php $total_s = 0; ?>
                                                <?php foreach ($sub_kegiatan as $row => $val) : ?>
                                                    <?php $total_p = $total_p + $val["pagu_anggaran"]; ?>
                                                    <?php $total_r = $total_r + $val["realisasi"]; ?>
                                                    <?php $total_s = $total_s + $val["sisa"]; ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $val["nama_sub_kegiatan"]; ?></td>
                                                        <td align="right"><?= number_format($val["pagu_anggaran"], 0, ",", "."); ?></td>
                                                        <td align="right"><?= number_format($val["realisasi"], 0, ",", "."); ?></td>
                                                        <td align="right"><?= number_format($val["sisa"], 0, ",", "."); ?></td>
                                                        <td><?= number_format($val["persen"], 2, ",", "."); ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="<?= site_url("../rekening/" . $val["kode_seksi"] . "/" . $val["id_sub_kegiatan"]); ?>" class="btn btn-primary btn-sm btn-flat">
                                                                    <span class="fa fa-align-justify"></span>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="2" align="right">Total</td>
                                                    <td align="right"><?= number_format($total_p, 0, ",", "."); ?></td>
                                                    <td align="right"><?= number_format($total_r, 0, ",", "."); ?></td>
                                                    <td align="right"><?= number_format($total_s, 0, ",", "."); ?></td>
                                                    <td colspan="2"></td>
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