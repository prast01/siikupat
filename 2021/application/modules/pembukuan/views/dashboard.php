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
                            <h5 class="card-title m-0">Daftar SPJ</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th width="5%">No SPJ</th>
                                                    <th width="10%">Tgl Kegiatan</th>
                                                    <th>Uraian Kegiatan</th>
                                                    <th width="15%">Nominal</th>
                                                    <th>Pelaksana</th>
                                                    <th width="5%">Status</th>
                                                    <!-- <th>Catatan</th> -->
                                                    <th width="5%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php foreach ($spj as $row => $val) : ?>
                                                    <tr>
                                                        <td><?= $val["no_seksi"]; ?></td>
                                                        <td><?= $val["tgl_kegiatan"]; ?></td>
                                                        <td><?= $val["uraian"]; ?></td>
                                                        <td><?= $val["nominal"]; ?></td>
                                                        <td>
                                                            <ol>
                                                                <?php foreach ($val["pelaksana"] as $row) : ?>
                                                                    <li class="my-0">
                                                                        <?php if ($row->pihak_ketiga == "") : ?>
                                                                            <?= $row->nama_pegawai; ?>
                                                                        <?php else : ?>
                                                                            <?= $row->pihak_ketiga; ?>
                                                                        <?php endif; ?>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ol>
                                                        </td>
                                                        <td><?= $val["nama_status"] . "<br>" . $val["tanggal"]; ?></td>
                                                        <!-- <td><?= $val["verif_spj"]; ?></td> -->
                                                        <td>
                                                            <div class="btn-group">
                                                                <!-- <a href="<?= site_url("../pembukuan/tambah/" . $val["kode_spj"]); ?>" class="btn btn-success btn-sm">
                                                                    <span class="fa fa-check"></span>
                                                                </a> -->
                                                                <a href="<?= site_url("../pembukuan/transfer/" . $val["kode_spj"]); ?>" class="btn btn-success btn-sm" onclick="return confirm('Yakin SPJ Sudah di transfer?')">
                                                                    <span class="fa fa-check"></span>
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