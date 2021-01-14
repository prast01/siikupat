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
                            <h5 class="card-title m-0">Daftar Pegawai</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <button class="btn btn-primary" onclick="modalDefault('Tambah Pegawai', 'addPegawai')">
                                        <span class="fa fa-plus"></span> Tambah Pegawai
                                    </button>
                                </div>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>NIP</th>
                                                    <th>Nama Pegawai</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php foreach ($pegawai as $row) : ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $row->nip_pegawai; ?></td>
                                                        <td><?= $row->nama_pegawai; ?></td>
                                                        <td><?= ($row->aktif) ? "Aktif" : "Non Aktif"; ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button" onclick="modalDefault('Ubah Pegawai', 'ubahPegawai', '<?= $row->id_pegawai; ?>')" class="btn btn-primary btn-sm btn-flat"><i class="fas fa-edit"></i></button>
                                                                <a href="<?= site_url("../pegawai/hapus/" . $row->id_pegawai); ?>" onclick="return confirm('Yakin Hapus?')" class="btn btn-danger text-white btn-sm btn-flat"><i class="fas fa-trash"></i></a>
                                                                <button type="button" onclick="modalDefault('Status Pegawai', 'statusPegawai', '<?= $row->id_pegawai; ?>')" class="btn btn-primary btn-sm btn-flat"><i class="fas fa-user"></i></button>
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