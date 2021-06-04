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
                            <h5 class="card-title m-0">Daftar Sub Kegiatan</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <?php if ($kode_pusk == "super") : ?>
                                        <a href="<?= site_url("../anggaran"); ?>" class="btn btn-warning text-white">
                                            <span class="fa fa-arrow-left"></span> Kembali
                                        </a>
                                    <?php endif; ?>
                                    <button class="btn btn-success" onclick="modalDefault('Tambah Sub Kegiatan', 'tambahSubKegiatan/<?= $kode_pusk; ?>')">
                                        <span class="fa fa-plus"></span> Tambah Data
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered datatable">
                                            <thead>
                                                <tr>
                                                    <th width="5%">No</th>
                                                    <th width="15%">Kode Sub Kegiatan</th>
                                                    <th>Nama Sub Kegiatan</th>
                                                    <th width="5%">Sumber</th>
                                                    <th width="20%">Pagu Anggaran</th>
                                                    <th width="5%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php foreach ($data as $key => $val) : ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= $val["kode_sub_kegiatan"]; ?></td>
                                                        <td><?= $val["nama_sub_kegiatan"]; ?></td>
                                                        <td><?= $val["jenis_sumber"]; ?></td>
                                                        <td align="right"><?= $val["pagu"]; ?></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="<?= site_url("../rekening/" . $val['kode_pusk'] . "/" . $val["id_sub_kegiatan"]); ?>" class="btn btn-sm btn-primary">
                                                                    <span class="fa fa-book"></span>
                                                                </a>
                                                                <button class="btn btn-sm btn-warning text-white" onclick="modalDefault('Ubah Sub Kegiatan', 'ubahSubKegiatan/<?= $kode_pusk . '/' . $val['id_sub_kegiatan']; ?>')">
                                                                    <span class="fa fa-edit"></span>
                                                                </button>
                                                                <a href="<?= site_url("../pengaturan/hapusSub/" . $val['kode_pusk'] . "/" . $val["id_sub_kegiatan"]); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin Hapus?')">
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