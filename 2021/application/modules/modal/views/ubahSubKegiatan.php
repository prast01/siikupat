<form action="<?= site_url("../kegiatan/editSub/" . $sub->id_sub_kegiatan); ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label>Kode Sub Kegiatan</label>
            <input type="hidden" name="id_kegiatan" value="<?= $sub->id_kegiatan; ?>">
            <input type="text" name="kode_sub_kegiatan" class="form-control" placeholder="Kode Sub Kegiatan" value="<?= $sub->kode_sub_kegiatan; ?>">
        </div>
        <div class="form-group">
            <label>Nama Sub Kegiatan</label>
            <input type="text" name="nama_sub_kegiatan" class="form-control" placeholder="Nama Sub Kegiatan" value="<?= $sub->nama_sub_kegiatan; ?>">
        </div>
        <div class="form-group">
            <label>Subbag/Seksi/UPT</label>
            <select name="kode_seksi" class="form-control select2" style="width: 100%;">
                <option value="" disabled>Pilih</option>
                <?php foreach ($seksi as $row) : ?>
                    <option <?= ($row->kode_seksi == $sub->kode_seksi) ? "selected" : ""; ?> value="<?= $row->kode_seksi; ?>"><?= $row->nama; ?></option>
                <?php endforeach; ?>
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