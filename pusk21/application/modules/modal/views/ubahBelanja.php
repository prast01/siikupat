<form action="<?= site_url("../belanja/ubahBelanja/" . $jenis); ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_belanja" value="<?= $belanja->id_belanja; ?>">
    <div class="modal-body">
        <div class="form-group">
            <label>Tanggal Belanja</label>
            <input type="date" class="form-control" placeholder="" name="tgl_belanja" value="<?= $belanja->tgl_belanja; ?>">
        </div>
        <?php if ($jenis == "BLUD") : ?>
            <div class="form-group">
                <label>Jenis Pendapatan</label>
                <select name="id_jenis_pendapatan" style="width: 100%;" class="form-control select2">
                    <option value="" disabled>Pilih</option>
                    <?php foreach ($pendapatan as $key => $val) : ?>
                        <option <?= ($val["id_jenis_pendapatan"] == $belanja->id_jenis_pendapatan) ? "selected" : ""; ?> value="<?= $val["id_jenis_pendapatan"]; ?>"><?= $val["jenis_pendapatan"]; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php else : ?>
            <div class="form-group">
                <label>Sub Kegiatan</label>
                <select name="id_sub_kegiatan" style="width: 100%;" class="form-control select2" onchange="get_rekening(this.value)">
                    <option value="" disabled>Pilih</option>
                    <?php foreach ($sub_kegiatan as $key) : ?>
                        <option <?= ($key->id_sub_kegiatan == $belanja->id_sub_kegiatan) ? "selected" : ""; ?> value="<?= $key->id_sub_kegiatan; ?>"><?= $key->kode_sub_kegiatan . " - " . $key->nama_sub_kegiatan; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        <?php endif; ?>
        <div class="form-group">
            <label>Rekening</label>
            <select name="kode_rekening" style="width: 100%;" class="form-control" id="id_rekening">
                <option value="" disabled>Pilih</option>
                <?php if ($jenis == "BLUD") : ?>
                    <?php foreach ($rekening_blud as $key => $val) : ?>
                        <option <?= ($val["kode_rekening"] == $belanja->kode_rekening) ? "selected" : ""; ?> value="<?= $val["kode_rekening"]; ?>"><?= $val["kode_rekening"] . " - " . $val["nama_rekening"]; ?></option>
                    <?php endforeach; ?>
                <?php else : ?>
                    <?php foreach ($rekening as $key => $val) : ?>
                        <option <?= ($val["kode_rekening"] == $belanja->kode_rekening) ? "selected" : ""; ?> value="<?= $val["kode_rekening"]; ?>"><?= $val["kode_rekening"] . " - " . $val["nama_rekening"]; ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Uraian Belanja</label>
            <textarea name="uraian_belanja" style="resize: none;" rows="2" class="form-control"><?= $belanja->uraian_belanja; ?></textarea>
        </div>
        <div class="form-group">
            <label>Nominal</label>
            <input type="number" class="form-control" placeholder="Nominal" name="nominal_belanja" value="<?= $belanja->nominal_belanja; ?>">
        </div>
        <div class="form-group">
            <label>Dokumen</label>
            <div class="form-group">
                <input type="hidden" name="upload" value="0" id="upload">
                <input type="hidden" name="dok_old" value="<?= $belanja->dok_belanja; ?>">
                <div class="input-group">
                    <div class="custom-file">
                        <input style="cursor: pointer;" type="file" name="dok_belanja" id="lampiran" class="custom-file-input" onchange="chang(this.files[0], 'lampiran')" accept="application/pdf">
                        <label class="custom-file-label" id="name-lampiran"><?= $belanja->dok_belanja; ?></label>
                    </div>
                    <div class="input-group-append">
                        <a target="_blank" href="<?= site_url("../upload/" . strtolower($jenis) . "/" . $belanja->dok_belanja); ?>" class="input-group-text">Lihat</a>
                    </div>
                </div>
                <span class="text-red">* Dokumen maksimal 10MB</span>
            </div>
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

<script>
    var base_url = $(location).attr("pathname");
    base_url.indexOf(1);
    base_url.toLowerCase();
    base_url =
        window.location.origin === "http://sikupat.mi-kes.net" ?
        base_url.split("/")[1] + "/" :
        base_url.split("/")[1] + "/" + base_url.split("/")[2] + "/";
    var url = window.location.origin + "/" + base_url;

    $(".select2").select2();
    $('#id_rekening').select2();

    function chang(asal, target) {
        var file = asal;

        if (file.type.match('application/pdf')) {
            var size = asal.size;
            if (size < 10000000) {
                $("#name-" + target).text(file.name);
                $("input[id = upload]").val("1");
            } else {
                // sweet("Opss !", "Ukuran File Anda melebihi 5MB", "error");
                alert("Ukuran File Anda melebihi 10MB");
                $("input[id = upload]").val("0");
            }
        } else {
            // sweet("Opss !", "Extensi File tidak diizinkan ! Hanya file PDF", "error");
            alert("Extensi File tidak diizinkan ! Hanya file PDF !");
            $("#" + target).val("");
            $("input[id = upload]").val("0");
            $("#name-" + target).text("Pilih File");
        }
    }

    function get_rekening(id) {
        var origin = url + "service/get_rekening/" + id;
        $.ajax({
            type: "POST",
            url: origin,
            dataType: "json",
            success: function(data) {
                // console.log(data)
                var html = '';
                var i;
                html += '<option value="" selected disabled>Pilih</option>';
                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].kode_rekening + '>' + data[i].kode_rekening + " - " + data[i].nama_rekening + '</option>';
                }
                $('#id_rekening').html(html);
                $('#id_rekening').select2();
            },
            error: function() {
                html += '<option value="" selected disabled>Pilih</option>';
                $("#id_rekening").html(html);
                $('#id_rekening').select2();
            }
        });
    }
</script>