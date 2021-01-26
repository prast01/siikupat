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
                                    <a href="<?= site_url("../pembukuan"); ?>" class="btn btn-warning text-white">
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
                                                <label>Uraian Kegiatan</label>
                                                <textarea readonly name="uraian" cols="30" rows="3" class="form-control" placeholder="Uraian Kegiatan"><?= $buku->uraian; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Nominal</label>
                                                <input readonly type="number" name="nominal" id="nominal" class="form-control" placeholder="Nominal" value="<?= $buku->nominal; ?>">
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
                                                    <input readonly type="text" name="ntpn_ppn" class="form-control" value="<?= $buku->ntpn_ppn; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-12 col-form-label">PPh Ps. 21</label>
                                                <div class="col-lg-6">
                                                    <input readonly type="number" name="pph21" class="form-control" placeholder="Masukkan PPh Ps. 21" value="<?= $buku->pph21; ?>">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input readonly type="text" name="ntpn_pph21" class="form-control" value="<?= $buku->ntpn_pph21; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-12 col-form-label">PPh Ps. 22</label>
                                                <div class="col-lg-6">
                                                    <input readonly type="number" name="pph22" class="form-control" placeholder="Masukkan PPh Ps. 22" value="<?= $buku->pph22; ?>">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input readonly type="text" name="ntpn_pph22" class="form-control" value="<?= $buku->ntpn_pph22; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-12 col-form-label">PPh Ps. 23</label>
                                                <div class="col-lg-6">
                                                    <input readonly type="number" name="pph23" class="form-control" placeholder="Masukkan PPh Ps. 23" value="<?= $buku->pph23; ?>">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input readonly type="text" name="ntpn_pph23" class="form-control" value="<?= $buku->ntpn_pph23; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-12 col-form-label">PPh Final</label>
                                                <div class="col-lg-6">
                                                    <input readonly type="number" name="pph_final" class="form-control" placeholder="Masukkan PPh Final" value="<?= $buku->pph_final; ?>">
                                                </div>
                                                <div class="col-lg-6">
                                                    <input readonly type="text" name="ntpn_pph_final" class="form-control" value="<?= $buku->ntpn_pph_final; ?>">
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