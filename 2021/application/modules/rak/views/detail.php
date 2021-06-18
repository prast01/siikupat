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
                            <h5 class="card-title m-0">Rencana Anggaran Kas</h5>
                            <br>
                            <p class="py-0">
                                Silahkan diisi sesuai dengan yang sudah dientrikan di <a target="_blank" href="http://rak.apbdjepara.org/">Aplikasi simRAK (http://rak.apbdjepara.org/)</a> atau
                                <br>
                                di <a target="_blank" href="https://sipd.kemendagri.go.id/siap/login">Aplikasi SIPD (https://sipd.kemendagri.go.id/siap/login)</a>
                            </p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-2 mb-3">
                                    <a href="<?= site_url("../rak"); ?>" class="btn btn-warning text-white">
                                        <span class="fa fa-arrow-left"></span> Kembali
                                    </a>
                                </div>
                                <div class="col-lg-10">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td class="p-0" width="16%">
                                                <h5 class="mb-2">Pagu Anggaran</h5>
                                            </td>
                                            <td class="p-0" width="2%">
                                                <h5 class="mb-2">:</h5>
                                            </td>
                                            <td class="p-0" width="16%">
                                                <h5 class="mb-2 text-bold"><?= number_format($rekap["pagu"], 0, ",", "."); ?></h5>
                                            </td>
                                            <td class="p-0" width="16%">
                                                <h5 class="mb-2">Total RAK</h5>
                                            </td>
                                            <td class="p-0" width="2%">
                                                <h5 class="mb-2">:</h5>
                                            </td>
                                            <td class="p-0" width="16%">
                                                <h5 class="mb-2 text-bold"><?= number_format($rekap["rak"], 0, ",", "."); ?></h5>
                                            </td>
                                            <td class="p-0" width="16%">
                                                <h5 class="mb-2">Selisih</h5>
                                            </td>
                                            <td class="p-0" width="2%">
                                                <h5 class="mb-2">:</h5>
                                            </td>
                                            <?php $selisih = $rekap["pagu"] - $rekap["rak"]; ?>
                                            <?php $warna = ($selisih > 0 || $selisih < 0) ? "text-danger" : ""; ?>
                                            <td class="p-0" width="16%">
                                                <h5 class="mb-2 text-bold <?= $warna; ?>"><?= number_format($selisih, 0, ",", "."); ?></h5>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-lg-12">
                                    <form action="" method="post">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th width="5%">No</th>
                                                        <th>Bulan</th>
                                                        <th width="25%">RAK</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1; ?>
                                                    <?php $rd = ($lock) ? "readonly" : ""; ?>
                                                    <?php foreach ($detail as $row => $val) : ?>
                                                        <tr>
                                                            <td><?= $no++; ?></td>
                                                            <td><?= $val["nama_bulan"]; ?></td>
                                                            <td>
                                                                <div class="form-group">
                                                                    <input type="hidden" name="id_sub_kegiatan" value="<?= $id_sub_kegiatan; ?>">
                                                                    <input <?= $rd; ?> type="number" name="b<?= $val["kode_bulan"]; ?>" value="<?= $val["rak"]; ?>" class="form-control">
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                    <tr>
                                                        <td colspan="2"></td>
                                                        <td align="center">
                                                            <?php if (!$lock) : ?>
                                                                <button type="submit" class="btn btn-primary btn-sm">
                                                                    Simpan
                                                                </button>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>