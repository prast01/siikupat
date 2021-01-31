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
                                    <a href="<?= site_url("../transfer"); ?>" class="btn btn-warning text-white">
                                        <span class="fa fa-arrow-left"></span> Kembali
                                    </a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="card card-primary">
                                        <div class="card-header">Detail Kegiatan</div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Tanggal Kegiatan</label>
                                                <input readonly type="date" name="tgl_kegiatan" class="form-control" placeholder="Tanggal Kegiatan" value="<?= $spj->tgl_kegiatan; ?>">
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
                            <div class="row mb-3">
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
                                <div class="col-lg-6">
                                    <div class="card card-primary">
                                        <div class="card-header">Perpajakan</div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <label class="col-lg-12 col-form-label">PPN</label>
                                                <div class="col-lg-6">
                                                    <input readonly type="number" name="ppn" class="form-control" placeholder="Masukkan PPN" value="<?= $buku->ppn; ?>">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input readonly value="<?= $buku->ntpn_ppn; ?>" type="text" name="ntpn_ppn" class="form-control" placeholder="Masukkan NTPN PPN">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-12 col-form-label">PPh Ps. 21</label>
                                                <div class="col-lg-6">
                                                    <input readonly type="number" name="pph21" class="form-control" placeholder="Masukkan PPh Ps. 21" value="<?= $buku->pph21; ?>">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input readonly value="<?= $buku->ntpn_pph21; ?>" type="text" name="ntpn_pph21" class="form-control" placeholder="Masukkan NTPN PPh Ps. 21">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-12 col-form-label">PPh Ps. 22</label>
                                                <div class="col-lg-6">
                                                    <input readonly type="number" name="pph22" class="form-control" placeholder="Masukkan PPh Ps. 22" value="<?= $buku->pph22; ?>">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input readonly value="<?= $buku->ntpn_pph22; ?>" type="text" name="ntpn_pph22" class="form-control" placeholder="Masukkan NTPN PPh Ps. 22">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-12 col-form-label">PPh Ps. 23</label>
                                                <div class="col-lg-6">
                                                    <input readonly type="number" name="pph23" class="form-control" placeholder="Masukkan PPh Ps. 23" value="<?= $buku->pph23; ?>">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input readonly value="<?= $buku->ntpn_pph23; ?>" type="text" name="ntpn_pph23" class="form-control" placeholder="Masukkan NTPN PPh Ps. 23">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-12 col-form-label">PPh Final</label>
                                                <div class="col-lg-6">
                                                    <input readonly type="number" name="pph_final" class="form-control" placeholder="Masukkan PPh Final" value="<?= $buku->pph_final; ?>">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input readonly value="<?= $buku->ntpn_pph_final; ?>" type="text" name="ntpn_pph_final" class="form-control" placeholder="Masukkan NTPN PPh Ps. Final">
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
        </div>
    </div>
</div>