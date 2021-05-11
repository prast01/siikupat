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
                            <h5 class="card-title m-0">Realisasi Pendapatan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <button class="btn btn-success" onclick="modalXl('Tambah Pendapatan', 'tambahPendapatan/<?= $kode_pusk; ?>')">
                                        <span class="fa fa-plus"></span> Tambah Data
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="5%">No</th>
                                                    <th>Pendapatan Bulan</th>
                                                    <th width="20%">Realisasi Anggaran</th>
                                                    <th width="10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php $jumlah = 0; ?>
                                                <?php foreach ($realisasi as $key => $val) : ?>
                                                    <?php $jumlah = $jumlah + $val["realisasi"]; ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td>Realisasi Bulan <?= $val["bulan"]; ?></td>
                                                        <td align="right"><?= number_format($val["realisasi"], 0, ",", "."); ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button class="btn btn-sm btn-warning text-white" onclick="modalXl('Ubah Pendapatan', 'ubahPendapatan/<?= $kode_pusk . '/' . $val['kode_bulan']; ?>')">
                                                                    <span class="fa fa-edit"></span>
                                                                </button>
                                                                <a href="<?= site_url("../Pendapatan/hapusPendapatan/" . $kode_pusk . "/" . $val["kode_bulan"]); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Hapus?')">
                                                                    <span class="fa fa-trash"></span>
                                                                </a>
                                                                <a href="<?= site_url("../Pendapatan/print/" . $kode_pusk . "/" . $val["kode_bulan"]); ?>" class="btn btn-sm btn-success" target="_blank">
                                                                    <span class="fa fa-print"></span>
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <tr>
                                                    <td colspan="2" align="right">
                                                        <b>JUMLAH</b>
                                                    </td>
                                                    <td align="right">
                                                        <b><?= number_format($jumlah, 0, ",", "."); ?></b>
                                                    </td>
                                                    <td></td>
                                                </tr>
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