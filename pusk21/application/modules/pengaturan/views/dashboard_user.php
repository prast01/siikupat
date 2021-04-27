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
                            <h5 class="card-title m-0">Data Pengguna</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mb-4">
                                    <button class="btn btn-success" onclick="modalDefault('Tambah Pengguna', 'tambahUser')">
                                        <span class="fa fa-plus"></span> Tambah Data
                                    </button>
                                </div>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th width="5%">No</th>
                                                    <th width="15%">Kode Puskesmas</th>
                                                    <th width="20%">Nama Puskesmas</th>
                                                    <th>Nama Kepala</th>
                                                    <th width="20%">NIP</th>
                                                    <th width="5%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php foreach ($data as $key) : ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $key->kode_pusk; ?></td>
                                                        <td><?= $key->nama; ?></td>
                                                        <td><?= $key->nama_kepala; ?></td>
                                                        <td><?= $key->nip_kepala; ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button class="btn btn-sm btn-primary" onclick="modalDefault('Ubah Pengguna', 'ubahUser/<?= $key->id_user; ?>')">
                                                                    <span class="fa fa-edit"></span>
                                                                </button>
                                                                <button class="btn btn-sm btn-warning" onclick="modalDefault('Ubah Sandi', 'ubahSandi/<?= $key->id_user; ?>')">
                                                                    <span class="fa fa-lock"></span>
                                                                </button>
                                                                <a href="<?= site_url("../pengaturan/hapusUser/" . $key->id_user); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">
                                                                    <span class="fa fa-trash"></span>
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