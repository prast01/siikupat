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
                            <h5 class="card-title m-0">Realisasi Penyerapan Anggaran</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mb-5">
                                    <div class="chart">
                                        <canvas id="barChart" style="height:230px; min-height:230px"></canvas>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Subbag/Seksi/UPT</th>
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
                                                <?php foreach ($seksi as $row) : ?>
                                                    <?php $total_p = $total_p + $row->pagu_anggaran; ?>
                                                    <?php $total_r = $total_r + $row->real_anggaran; ?>
                                                    <?php $total_s = $total_s + $row->sisa_anggaran; ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $row->nama; ?></td>
                                                        <td align="right"><?= number_format($row->pagu_anggaran, 0, ",", "."); ?></td>
                                                        <td align="right"><?= number_format($row->real_anggaran, 0, ",", "."); ?></td>
                                                        <td align="right"><?= number_format($row->sisa_anggaran, 0, ",", "."); ?></td>
                                                        <td><?= $row->persen_anggaran; ?></td>
                                                        <td>
                                                            <a class="btn btn-primary btn-sm" href="<?= site_url("../realisasi/" . $row->kode_seksi); ?>">
                                                                <span class="fa fa-book"></span> Lihat Detail
                                                            </a>
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