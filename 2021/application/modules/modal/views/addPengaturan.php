<form action="<?= site_url("../lain/add"); ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label>Nama Pengaturan</label>
            <input type="text" name="nama_pengaturan" class="form-control" placeholder="Nama Pengaturan">
        </div>
        <div class="form-group">
            <label>Nilai</label>
            <input type="text" name="nilai_pengaturan" class="form-control" placeholder="Nilai">
        </div>
        <div class="form-group">
            <label>Satuan</label>
            <input type="text" name="satuan_pengaturan" class="form-control" placeholder="Satuan">
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
    })
</script>