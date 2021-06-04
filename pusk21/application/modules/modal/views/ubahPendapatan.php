<form class="form-horizontal" action="<?= site_url("../pendapatan/ubahPendapatan/" . $kode_pusk); ?>" method="post" enctype="multipart/form-data">
    <div class="modal-body">
        <div class="form-group row">
            <label class="col-lg-2 col-form-label">Bulan</label>
            <div class="col-lg-4">
                <select style="width: 100%;" class="form-control select2" disabled>
                    <option value="" disabled>Pilih</option>
                    <?php foreach ($bulan as $key => $val) : ?>
                        <option <?= ($kode_bulan == $key) ? "selected" : ""; ?> value="<?= $key; ?>"><?= $val; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <label class="col-lg-2 col-form-label">Rekening Koran</label>
            <div class="col-lg-4">
                <input type="hidden" name="upload" value="0" id="upload">
                <input type="hidden" name="bulan" value="<?= $kode_bulan; ?>">
                <input type="hidden" name="dok_old" value="<?= $rek_koran; ?>">
                <div class="input-group">
                    <div class="custom-file">
                        <input style="cursor: pointer;" type="file" name="rek_koran" id="koran" class="custom-file-input" onchange="chang(this.files[0], 'koran')" accept="application/pdf">
                        <label class="custom-file-label" for="koran"><?= $rek_koran; ?></label>
                    </div>
                    <div class="input-group-append">
                        <a target="_blank" href="<?= site_url("../upload/koran/" . $rek_koran); ?>" class="input-group-text">Lihat</a>
                    </div>
                </div>
                <span class="text-red">* Dokumen maksimal 10MB</span>
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
    $(".select2").select2();

    function chang(asal, target) {
        var file = asal;

        if (file.type.match('application/pdf')) {
            var size = asal.size;
            if (size < 10000000) {
                // $("#name-koran").append(file.name);
                $("label[for = koran]").text(file.name);
                $("input[id = upload]").val("1");
            } else {
                // sweet("Opss !", "Ukuran File Anda melebihi 5MB", "error");
                $("#" + target).val("");
                $("input[id = upload]").val("0");
                alert("Ukuran File Anda melebihi 10MB");
                $("label[for = koran]").text("Pilih File");
            }
        } else {
            // sweet("Opss !", "Extensi File tidak diizinkan ! Hanya file PDF", "error");
            alert("Extensi File tidak diizinkan ! Hanya file PDF !");
            $("#" + target).val("");
            $("input[id = upload]").val("0");
            // $("#name-" + target).text("Pilih File");
            $("label[for = koran]").text("Pilih File");
        }
    }
</script>