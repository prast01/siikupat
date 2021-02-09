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
                            <h5 class="card-title m-0">DOKUMEN SPJ</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-lg-12">
                                    <a href="<?= site_url("../verifikasi"); ?>" class="btn btn-warning text-white">
                                        <span class="fa fa-arrow-left"></span> Kembali
                                    </a>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <div class="card card-primary">
                                        <div class="card-header">Detail Kegiatan</div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Tanggal Kegiatan</label>
                                                <input readonly type="date" name="tgl_kegiatan" class="form-control tanggal" placeholder="Tanggal Kegiatan" value="<?= $spj->tgl_kegiatan; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Sub Kegiatan</label>
                                                <input readonly type="text" class="form-control" value="<?= $sub_kegiatan->nama_sub_kegiatan; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Rekening</label>
                                                <input readonly type="text" class="form-control" value="<?= $rekening->nama_rekening; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Rencana Operasional Kegiatan (ROK)</label>
                                                <input readonly type="text" class="form-control" value="<?= $rok->uraian; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label>Uraian Kegiatan</label>
                                                <textarea readonly name="uraian" id="uraian" cols="30" rows="3" class="form-control" placeholder="Uraian Kegiatan"><?= $spj->uraian; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Nominal</label>
                                                <input readonly type="number" name="nominal" id="nominal" class="form-control" placeholder="Nominal" value="<?= $spj->nominal; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="card card-primary">
                                        <div class="card-header">Upload Dokumen SPJ</div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="text" class="form-control" readonly value="<?= $spj->dokumen_spj; ?>">
                                                    </div>
                                                    <div class="input-group-append">
                                                        <a class="input-group-text" href="<?= site_url("../assets/upload/" . $spj->dokumen_spj); ?>" target="_blank">Lihat</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-primary">
                                        <div class="card-header">Pelaksana Kegiatan</div>
                                        <div class="card-body">
                                            <!-- <button type="button" class="btn btn-primary mb-3" onclick="modalDefault('Tambah Pelaksana', 'addPelaksana')">
                                                <span class="fa fa-plus"></span> Tambah Pelaksana
                                            </button> -->
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="table-pelaksana">
                                                    <thead>
                                                        <tr>
                                                            <th>Nama</th>
                                                            <th width="20%">Nominal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($pelaksana as $row) : ?>
                                                            <tr>
                                                                <td>
                                                                    <?php if ($row->pihak_ketiga == "") : ?>
                                                                        <?= $row->nama_pegawai; ?>
                                                                    <?php else : ?>
                                                                        <?= $row->pihak_ketiga; ?>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td><?= number_format($row->nominal, 0, ",", "."); ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form action="<?= site_url("../verifikasi/add/" . $spj->kode_spj); ?>" method="post">
                                <div class="row mb-3">
                                    <div class="col-lg-6">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                Verifikasi
                                            </div>
                                            <div class="card-body pad">
                                                <div class="mb-3">
                                                    <textarea class="textarea" name="verif_spj" placeholder="Place some text here">
                                                    <?= $spj->verif_spj; ?>
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="card-footer justify-content-between">
                                                <?php if ($spj->status_spj <= "2") : ?>
                                                    <button type="submit" name="rekom" class="btn btn-success" onclick="return confirm('Yakin SPJ sudah valid?')">Rekomendasi</button>
                                                    <button type="submit" name="setuju" class="btn btn-primary" onclick="return confirm('Yakin SPJ sudah valid?')">Setuju</button>
                                                <?php else : ?>
                                                    <a href="<?= site_url("../verifikasi/pembukuan/" . $spj->kode_spj); ?>" class="btn btn-success" onclick="return confirm('Bukukan SPJ?')">
                                                        <span class="fa fa-book"></span> Bukukan
                                                    </a>
                                                <?php endif; ?>
                                                <button type="submit" name="tolak" class="btn btn-danger" onclick="return confirm('SPJ akan ditolak ! Apakah Anda yakin?')">Tolak</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card card-primary">
                                            <div class="card-header">
                                                Hasil Verifikasi
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered datatable">
                                                        <thead>
                                                            <tr>
                                                                <th width="20%">Tanggal Verifikasi</th>
                                                                <th>Hasil Verifikasi</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($verif as $row) : ?>
                                                                <tr>
                                                                    <td><?= $row->tgl_riwayat; ?></td>
                                                                    <td><?= $row->riwayat_spj; ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>