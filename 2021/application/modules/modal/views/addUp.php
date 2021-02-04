<form action="<?= site_url("../up/add"); ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label>Tanggal Pengajuan</label>
            <input type="date" name="tgl_up" class="form-control">
        </div>
        <div class="form-group">
            <label>Nominal</label>
            <input type="number" name="nominal" class="form-control" placeholder="Nominal">
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>