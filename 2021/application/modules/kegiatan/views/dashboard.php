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
                            <h5 class="card-title m-0">Daftar Kegiatan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <button class="btn btn-primary" onclick="modalDefault('Tambah Kegiatan', 'addKegiatan')">
                                        <span class="fa fa-plus"></span> Tambah Kegiatan
                                    </button>
                                </div>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th width="5%">No</th>
                                                    <th width="15%">Kode Kegiatan</th>
                                                    <th>Nama Kegiatan</th>
                                                    <th width="15%">Pagu Anggaran</th>
                                                    <th width="10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php foreach ($kegiatan as $row) : ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $row->kode_kegiatan; ?></td>
                                                        <td><?= $row->nama_kegiatan; ?></td>
                                                        <td><?= $row->pagu_anggaran; ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button" onclick="modalDefault('Ubah Kegiatan', 'ubahKegiatan', '<?= $row->id_kegiatan; ?>')" class="btn btn-primary btn-sm btn-flat"><i class="fas fa-edit"></i></button>
                                                                <a href="<?= site_url("../kegiatan/hapus/" . $row->id_kegiatan); ?>" onclick="return confirm('Yakin Hapus?');" class="btn btn-danger btn-sm btn-flat"><i class="fas fa-trash"></i>
                                                                </a>
                                                                <a href="<?= site_url("../kegiatan/sub/" . $row->id_kegiatan); ?>" class="btn btn-success btn-sm btn-flat"><i class="fas fa-align-justify"></i>
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