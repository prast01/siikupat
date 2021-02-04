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
                <?php if ($kode_bidang != "DK005") : ?>
                    <div class="col-lg-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fa fa-book"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">
                                    <h3>Antrian SPJ Saat Ini :</h3>
                                </span>
                                <span class="info-box-number">
                                    No SPJ. <i id="antrian" style="font-size: 22px; color: red;">XXXXX</i> <br>
                                    dari <i id="total" style="font-size: 22px; color: red;">XX</i> SPJ Menunggu
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="col-lg-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <?php if ($kode_bidang != "DK005") : ?>
                                <h5 class="card-title m-0">Daftar Pengajuan SPJ</h5>
                            <?php else : ?>
                                <h5 class="card-title m-0">Daftar Pencatatan SPJ</h5>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <!-- <div class="col-lg-12 mb-3">
                                    <div class="card">
                                        <div class="card-header p-0 pt-1 border-bottom-0">
                                            <ul class="nav nav-tabs" id="custom-tabs-two-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-tabs-two-home-tab" data-toggle="pill" href="#custom-tabs-two-home" role="tab" aria-controls="custom-tabs-two-home" aria-selected="true">Daftar Contoh Dokumen</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-two-tabContent">
                                                <div class="tab-pane fade show" id="custom-tabs-two-home" role="tabpanel" aria-labelledby="custom-tabs-two-home-tab">
                                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-lg-5 mb-3">
                                    <?php if ($kode_bidang != "DK005") : ?>
                                        <a href="<?= site_url("../spj/tambahGu"); ?>" class="btn btn-primary">
                                            <span class="fa fa-plus"></span> Tambah GU
                                        </a>
                                        <a href="<?= site_url("../spj/tambahLs"); ?>" class="btn btn-success">
                                            <span class="fa fa-plus"></span> Tambah LS
                                        </a>
                                        <a href="<?= site_url("../spj/a21"); ?>" class="btn btn-warning text-white" target="_blank">
                                            <span class="fa fa-plus"></span> Buat A2.1
                                        </a>
                                    <?php else : ?>
                                        <a href="<?= site_url("../spj/addGu"); ?>" class="btn btn-primary">
                                            <span class="fa fa-plus"></span> Tambah GU
                                        </a>
                                        <a href="<?= site_url("../spj/addTu"); ?>" class="btn btn-warning">
                                            <span class="fa fa-plus"></span> Tambah TU
                                        </a>
                                        <a href="<?= site_url("../spj/addLs"); ?>" class="btn btn-success">
                                            <span class="fa fa-plus"></span> Tambah LS
                                        </a>
                                    <?php endif; ?>
                                </div>
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
                                                    <th>Catatan</th>
                                                    <th width="5%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php foreach ($spj as $row => $val) : ?>
                                                    <?php $bg = ($val["status_spj"] == "2") ? "bg-red" : ""; ?>
                                                    <tr class="<?= $bg; ?>">
                                                        <!-- <td><?= $val["no_spj"] . " /<br>" . $val["no_seksi"]; ?></td> -->
                                                        <td><?= $val["no_seksi"]; ?></td>
                                                        <td><?= $val["tgl_kegiatan"]; ?></td>
                                                        <td><?= $val["uraian"]; ?></td>
                                                        <td><?= $val["nominal"]; ?></td>
                                                        <td>
                                                            <ol>
                                                                <?php foreach ($val["pelaksana"] as $row) : ?>
                                                                    <li class="my-0"><?= $row->nama_pegawai; ?></li>
                                                                <?php endforeach; ?>
                                                            </ol>
                                                        </td>
                                                        <td><?= $val["nama_status"]; ?><br><?= $val["tanggal"]; ?></td>
                                                        <td><?= $val["verif_spj"]; ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="<?= site_url("../spj/lihat/" . $val["kode_spj"]); ?>" class="btn btn-primary btn-sm">
                                                                    <span class="fa fa-eye"></span>
                                                                </a>
                                                                <?php if ($val["status_spj"] <= "3") : ?>
                                                                    <a href="<?= site_url("../spj/ubah/" . $val["kode_spj"]); ?>" class="btn btn-warning text-white btn-sm">
                                                                        <span class="fa fa-edit"></span>
                                                                    </a>
                                                                    <a href="<?= site_url("../spj/hapus/" . $val["kode_spj"]); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">
                                                                        <span class="fa fa-trash"></span>
                                                                    </a>
                                                                <?php endif; ?>
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