<form action="<?= site_url("../pengaturan/ubahSub/" . $data->kode_pusk); ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <input type="hidden" name="id_sub_kegiatan" value="<?= $data->id_sub_kegiatan; ?>">
            <label>Kode Sub Kegiatan</label>
            <input type="text" class="form-control" placeholder="Kode Sub Kegiatan" name="kode_sub_kegiatan" value="<?= $data->kode_sub_kegiatan; ?>">
        </div>
        <div class="form-group">
            <label>Nama Sub Kegiatan</label>
            <input type="text" class="form-control" placeholder="Nama Sub Kegiatan" name="nama_sub_kegiatan" value="<?= $data->nama_sub_kegiatan; ?>">
        </div>
        <div class="form-group">
            <label>Jenis Sumber Dana</label>
            <select name="jenis_sumber" style="width: 100%;" class="form-control select2">
                <option value="" disabled>Pilih</option>
                <option <?= ($data->jenis_sumber == "APBD") ? "selected" : ""; ?> value="APBD">APBD</option>
                <option <?= ($data->jenis_sumber == "BOK") ? "selected" : ""; ?> value="BOK">BOK</option>
            </select>
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

<script>
    $(".select2").select2();
</script>