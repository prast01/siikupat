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
                            <h5 class="card-title m-0">Daftar Rekening</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <a href="<?= site_url("../kegiatan/sub/" . $id); ?>" class="btn btn-warning text-white"><span class="fa fa-arrow-left"></span> Kembali</a>
                                    <button class="btn btn-primary" onclick="modalDefault('Tambah Rekening', 'addRekening', '<?= $id_sub; ?>')">
                                        <span class="fa fa-plus"></span> Tambah Rekening
                                    </button>
                                </div>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th rowspan="2" width="5%">No</th>
                                                    <th rowspan="2" width="15%">Kode Rekening</th>
                                                    <th rowspan="2">Nama Rekening</th>
                                                    <th rowspan="2">Pagu</th>
                                                    <th colspan="2">Pemutihan</th>
                                                    <th rowspan="2" width="10%">Aksi</th>
                                                </tr>
                                                <tr>
                                                    <th>Tanggal</th>
                                                    <th>Realisasi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php $total = 0; ?>
                                                <?php foreach ($rekening as $row) : ?>
                                                    <?php $total = $total + $row->pagu_rekening; ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $row->kode_rekening; ?></td>
                                                        <td><?= $row->nama_rekening; ?></td>
                                                        <td align="right"><?= number_format($row->pagu_rekening, 0, ",", "."); ?></td>
                                                        <td><?= $row->tgl_pemutihan; ?></td>
                                                        <td><?= $row->realisasi_pemutihan; ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button" onclick="modalDefault('Ubah Rekening', 'ubahRekening', '<?= $row->id_rekening; ?>')" class="btn btn-primary btn-sm btn-flat"><i class="fas fa-edit"></i></button>
                                                                <a href="<?= site_url("../kegiatan/hapusRek/" . $id . "/" . $row->id_sub_kegiatan . "/" . $row->id_rekening); ?>" onclick="return confirm('Yakin Hapus?');" class="btn btn-danger btn-sm btn-flat"><i class="fas fa-trash"></i>
                                                                </a>
                                                                <button type="button" onclick="modalDefault('Pemutihan', 'pemutihan', '<?= $row->id_rekening; ?>')" class="btn btn-success btn-sm btn-flat"><i class="fas fa-edit"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3" align="right">TOTAL</td>
                                                    <td align="right"><?= number_format($total, 0, ",", "."); ?></td>
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