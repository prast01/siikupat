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
                            <h5 class="card-title m-0">Ubah Pengajuan SPJ GU</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mb-3">
                                    <a href="<?= site_url("../spj"); ?>" class="btn btn-warning text-white">
                                        <span class="fa fa-arrow-left"></span> Kembali
                                    </a>
                                </div>
                            </div>
                            <form action="<?= site_url("../spj/edit/" . $spj->kode_spj); ?>" method="post" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card card-warning">
                                            <div class="card-header">Detail Kegiatan</div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>Tanggal Kegiatan</label>
                                                    <input type="hidden" id="rek_hidden" value="<?= $spj->id_rekening; ?>">
                                                    <input type="hidden" id="rok_hidden" value="<?= $spj->id_rok; ?>">
                                                    <input type="hidden" name="jenis_spj" value="<?= $spj->jenis_spj; ?>">
                                                    <input type="hidden" name="tgl_lama" value="<?= $spj->tgl_kegiatan; ?>">
                                                    <input type="hidden" name="status_spj" value="<?= $spj->status_spj; ?>">
                                                    <input type="hidden" name="nominal_lama" value="<?= $spj->nominal; ?>">
                                                    <input type="date" name="tgl_kegiatan" id="tgl_kegiatan" class="form-control tanggal" placeholder="Tanggal Kegiatan" value="<?= $spj->tgl_kegiatan; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label>Sub Kegiatan</label>
                                                    <select name="id_sub_kegiatan" id="id_sub_kegiatan" class="form-control select2" style="width: 100%;" onchange="get_rekening(this.value)">
                                                        <option value="" disabled>Pilih</option>
                                                        <?php foreach ($sub_kegiatan as $row) : ?>
                                                            <option <?= ($row->id_sub_kegiatan == $spj->id_sub_kegiatan) ? "selected" : ""; ?> value="<?= $row->id_sub_kegiatan; ?>"><?= $row->nama_sub_kegiatan; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Rekening</label>
                                                    <select name="id_rekening" id="id_rekening" class="form-control select2" style="width: 100%;" onchange="get_rok_ubah(this.value)">
                                                        <option value="" disabled>Pilih</option>
                                                        <?php foreach ($list_rekening as $row) : ?>
                                                            <option <?= ($row->id_rekening == $spj->id_rekening) ? "selected" : ""; ?> value="<?= $row->id_rekening; ?>"><?= $row->nama_rekening; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Rencana Operasional Kegiatan (ROK)</label>
                                                    <select name="id_rok" id="id_rok" class="form-control select2" style="width: 100%;" onchange="get_uraian(this.value)">
                                                        <option value="" disabled>Pilih</option>
                                                        <?php foreach ($list_rok as $row) : ?>
                                                            <option <?= ($row->id_rok == $spj->id_rok) ? "selected" : ""; ?> value="<?= $row->id_rok; ?>">Rp<?= number_format($row->nominal, 0, ",", ".") . " - " . $row->uraian; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Uraian Kegiatan</label>
                                                    <textarea name="uraian" id="uraian" cols="30" rows="3" class="form-control" placeholder="Uraian Kegiatan"><?= $spj->uraian; ?></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nominal</label>
                                                    <input type="number" name="nominal" id="nominal" class="form-control" placeholder="Nominal" value="<?= $spj->nominal; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card card-warning">
                                            <div class="card-header">Upload Dokumen SPJ</div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file" name="dokumen_spj" class="custom-file-input file-upload" accept="application/pdf">
                                                            <label class="custom-file-label file-name" for="exampleInputFile"><?= $spj->dokumen_spj; ?></label>
                                                        </div>
                                                        <div class="input-group-append">
                                                            <a class="input-group-text" href="<?= site_url("../assets/upload/" . $spj->dokumen_spj); ?>" target="_blank">Lihat</a>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="dokumen_old" value="<?= $spj->dokumen_spj; ?>">
                                                    <input type="hidden" name="dokumen_up" id="dokumen_up" value="0">
                                                    <span class="text-red">* Dokumen maksimal 10MB</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card card-warning">
                                            <div class="card-header">Pelaksana Kegiatan</div>
                                            <div class="card-body">
                                                <button type="button" class="btn btn-warning mb-3 text-white" onclick="modalDefault('Tambah Pelaksana', 'addPelaksana')">
                                                    <span class="fa fa-plus"></span> Tambah Pelaksana
                                                </button>
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="table-pelaksana">
                                                        <thead>
                                                            <tr>
                                                                <th>Nama</th>
                                                                <th width="20%">Nominal</th>
                                                                <th width="5%">Hapus</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($pelaksana as $row) : ?>
                                                                <tr id="<?= $row->id_spj_detail; ?>">
                                                                    <td>
                                                                        <?php if ($row->pihak_ketiga == "") : ?>
                                                                            <?= $row->nama_pegawai; ?>
                                                                        <?php else : ?>
                                                                            <?= $row->pihak_ketiga; ?>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td><?= number_format($row->nominal, 0, ",", "."); ?></td>
                                                                    <td>
                                                                        <input type="hidden" name="id_pelaksana[]" value="<?= $row->id_pegawai; ?>">
                                                                        <input type="hidden" name="pihak_ketiga[]" value="<?= $row->pihak_ketiga; ?>">
                                                                        <input type="hidden" name="nominal_pelaksana[]" value="<?= $row->nominal; ?>">
                                                                        <button type="button" onclick="remove_pelaksana('<?= $row->id_spj_detail; ?>')" class="btn btn-danger btn-sm">
                                                                            <span class='fa fa-trash'></span>
                                                                        </button>
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
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-warning">Simpan</button>
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