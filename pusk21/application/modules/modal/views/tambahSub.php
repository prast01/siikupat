<form action="<?= site_url("../pengaturan/tambahSub/" . $kode_pusk); ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label>Kode Sub Kegiatan</label>
            <input type="text" class="form-control" placeholder="Kode Sub Kegiatan" name="kode_sub_kegiatan">
        </div>
        <div class="form-group">
            <label>Nama Sub Kegiatan</label>
            <input type="text" class="form-control" placeholder="Nama Sub Kegiatan" name="nama_sub_kegiatan">
        </div>
        <div class="form-group">
            <label>Jenis Sumber Dana</label>
            <select name="jenis_sumber" style="width: 100%;" class="form-control select2">
                <option value="" selected disabled>Pilih</option>
                <option value="APBD">APBD</option>
                <option value="BOK">BOK</option>
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