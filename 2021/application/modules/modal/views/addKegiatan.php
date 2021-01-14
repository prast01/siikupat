<form action="<?= site_url("../kegiatan/add"); ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label>Kode Kegiatan</label>
            <input type="text" name="kode_kegiatan" class="form-control" placeholder="Kode Kegiatan">
        </div>
        <div class="form-group">
            <label>Nama Kegiatan</label>
            <input type="text" name="nama_kegiatan" class="form-control" placeholder="Nama Kegiatan">
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>