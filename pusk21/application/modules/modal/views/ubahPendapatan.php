<form class="form-horizontal" action="<?= site_url("../pendapatan/ubahPendapatan/" . $kode_pusk); ?>" method="post">
    <div class="modal-body">
        <div class="form-group row">
            <label class="col-lg-2 col-form-label">Bulan</label>
            <div class="col-lg-3">
                <select name="bulan" style="width: 100%;" class="form-control select2" disabled>
                    <option value="" disabled>Pilih</option>
                    <?php foreach ($bulan as $key => $val) : ?>
                        <option <?= ($kode_bulan == $key) ? "selected" : ""; ?> value="<?= $key; ?>"><?= $val; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($pendapatan as $key => $val) : ?>
                        <tr>
                            <td width="5%"><?= $no++; ?></td>
                            <td><?= $val["jenis_pendapatan"]; ?></td>
                            <td width="20%">
                                <div class="form-group">
                                    <input type="hidden" name="id_realisasi[]" value="<?= $val["id_realisasi"]; ?>">
                                    <input type="number" name="real_pendapatan[]" class="form-control" value="<?= $val["realisasi"]; ?>">
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

<script>
    $(function() {
        $(".select2").select2();
    });
</script>