<form action="<?= site_url("../pegawai/statusPegawai/" . $pegawai->id_pegawai); ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label>Status Pegawai</label>
            <select name="aktif" style="width: 100%;" class="form-control select2">
                <option <?= ($pegawai->aktif == 0) ? "selected" : ""; ?> value="0">NON AKTIF</option>
                <option <?= ($pegawai->aktif == 1) ? "selected" : ""; ?> value="1">AKTIF</option>
            </select>
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