<form action="<?= site_url("../ubahSandi"); ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label>Sandi Baru</label>
            <input type="password" name="sandi" class="form-control" placeholder="Sandi Baru">
        </div>
        <div class="form-group">
            <label>Ulangi Sandi Baru</label>
            <input type="password" name="sandi2" class="form-control" placeholder="Ulangi Sandi Baru">
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>