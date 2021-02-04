<form action="<?= site_url("../up/edit/" . $up->id_up); ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label>Tanggal Pengajuan</label>
            <input type="date" name="tgl_up" class="form-control" value="<?= $up->tgl_up; ?>">
        </div>
        <div class="form-group">
            <label>Nominal</label>
            <input type="number" name="nominal" class="form-control" placeholder="Nominal" value="<?= $up->nominal; ?>">
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>