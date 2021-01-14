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
                            <h5 class="card-title m-0">Daftar Pengguna</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <a href="<?= site_url("../bidang"); ?>" class="btn btn-primary"><span class="fa fa-arrow-right"></span> Lihat Bidang</a>
                                </div>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Subbag/Seksi/UPT</th>
                                                    <th>Nama Kepala</th>
                                                    <th>NIP Kepala</th>
                                                    <th>Kesempatan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php foreach ($user as $row) : ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $row->nama; ?></td>
                                                        <td><?= $row->nama_pegawai; ?></td>
                                                        <td><?= $row->nip_kepala; ?></td>
                                                        <td><?= $row->kesempatan; ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button" onclick="modalDefault('Ubah User', 'ubahUser', '<?= $row->id_user; ?>')" class="btn btn-primary btn-sm btn-flat"><i class="fas fa-edit"></i></button>
                                                                <button type="button" onclick="modalDefault('Kesempatan', 'kesempatan', '<?= $row->id_user; ?>')" class="btn btn-warning text-white btn-sm btn-flat"><i class="fas fa-edit"></i></button>
                                                                <button type="button" onclick="modalDefault('Ubah Sandi', 'passwordUser', '<?= $row->id_user; ?>')" class="btn btn-success text-white btn-sm btn-flat"><i class="fas fa-lock"></i></button>
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