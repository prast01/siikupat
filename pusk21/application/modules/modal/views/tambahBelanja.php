<form action="<?= site_url("../belanja/tambahBelanja/" . $jenis); ?>" method="post" enctype="multipart/form-data">
    <div class="modal-body">
        <div class="form-group">
            <label>Tanggal Belanja</label>
            <input type="date" class="form-control" placeholder="" name="tgl_belanja">
        </div>
        <div class="form-group">
            <label>Uraian Belanja</label>
            <textarea name="" style="resize: none;" rows="2" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label>Nominal</label>
            <input type="number" class="form-control" placeholder="Nominal" name="nominal_belanja">
        </div>
        <div class="form-group">
            <label>Dokumen</label>
            <div class="form-group">
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="dok_belanja" class="custom-file-input" onchange="chang(this.files[0], 'lampiran')" accept="application/pdf">
                        <label class="custom-file-label" id="name-lampiran">Pilih File</label>
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
    function chang(asal, target) {
        var file = asal;

        if (file.type.match('application/pdf')) {
            var size = asal.size;
            if (size < 10000000) {
                $("#name-" + target).text(file.name);
            } else {
                // sweet("Opss !", "Ukuran File Anda melebihi 5MB", "error");
                alert("Ukuran File Anda melebihi 10MB");
            }
        } else {
            // sweet("Opss !", "Extensi File tidak diizinkan ! Hanya file PDF", "error");
            alert("Extensi File tidak diizinkan ! Hanya file PDF !");
            $("#" + target).val("");
            $("#name-" + target).text("Pilih File");
        }
    }
</script>