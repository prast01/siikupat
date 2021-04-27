<form action="<?= site_url("../pengaturan/ubahSandi/" . $id_user); ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label>Sandi Baru</label>
            <input type="text" class="form-control" placeholder="Sandi Baru" name="sandi">
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>