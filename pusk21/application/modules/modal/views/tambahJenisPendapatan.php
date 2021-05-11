<form action="<?= site_url("../pendapatan/tambahJenis/" . $kode_pusk); ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label>Jenis Pendapatan</label>
            <input type="text" class="form-control" placeholder="Jenis Pendapatan" name="jenis_pendapatan">
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>