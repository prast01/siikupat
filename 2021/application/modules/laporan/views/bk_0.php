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
                            <h5 class="card-title m-0">Laporan Buku Kas Umum</h5>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <form action="" method="post">
                                        <!-- <div class="form-group row mb-0">
                                            <label for="" class="col-form-label col-lg-12">Sub Kegiatan</label>
                                            <div class="col-lg-12">
                                                <select name="id_sub_kegiatan" style="width: 100%;" class="form-control select2">
                                                    <option disabled value="" <?= ($id_sub_kegiatan == "") ? "selected" : ""; ?>>Pilih</option>
                                                    <?php foreach ($sub_kegiatan as $row) : ?>
                                                        <option <?= ($id_sub_kegiatan == $row->id_sub_kegiatan) ? "selected" : ""; ?> value="<?= $row->id_sub_kegiatan; ?>"><?= $row->nama_sub_kegiatan; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div> -->
                                        <div class="form-group row mb-2">
                                            <label for="" class="col-form-label col-lg-6">dari Tanggal</label>
                                            <label for="" class="col-form-label col-lg-6">sampai Tanggal</label>
                                            <div class="col-lg-6">
                                                <input type="date" class="form-control" name="dari" value="<?= $dari; ?>">
                                            </div>
                                            <div class="col-lg-6">
                                                <input type="date" class="form-control" name="sampai" value="<?= $sampai; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-primary btn-sm">Cari</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-sm">
                                            <thead>
                                                <tr>
                                                    <th style="width: 3%;" rowspan="2">No</th>
                                                    <th style="width: 12%;" rowspan="2">Tanggal</th>
                                                    <th rowspan="2">Uraian</th>
                                                    <th colspan="2">Realisasi Kegiatan</th>
                                                    <th style="width: 10%;" rowspan="2">Saldo</th>
                                                </tr>
                                                <tr>
                                                    <th style="width: 10%;">Debet</th>
                                                    <th style="width: 10%;">Kredit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $no = 1; ?>
                                                <?php if ($hide) : ?>
                                                    <?php $awal = 0; ?>
                                                    <?php foreach ($bk0 as $key => $val) : ?>
                                                        <?php
                                                        if ($val["tanggal"] == "-") {
                                                            $awal = $val["debet"];
                                                        } else {
                                                            if ($val["debet"] > 0) {
                                                                $awal = $awal + $val["debet"];
                                                            } else {
                                                                $awal = $awal - $val["kredit"];
                                                            }
                                                        }

                                                        $debet = ($val["tanggal"] == "-") ? "" : number_format($val["debet"], 0, ",", ".");
                                                        $kredit = ($val["tanggal"] == "-") ? "" : number_format($val["kredit"], 0, ",", ".");

                                                        $bg = ($no == 1) ? "bg-warning" : "";
                                                        ?>
                                                        <tr class="<?= $bg; ?>">
                                                            <td><?= $no++; ?></td>
                                                            <td><?= $val["tanggal"]; ?></td>
                                                            <td><?= $val["uraian"]; ?></td>
                                                            <td align="right"><?= $debet; ?></td>
                                                            <td align="right"><?= $kredit; ?></td>
                                                            <td align="right"><?= number_format($awal, 0, ",", "."); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
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