<form action="<?= site_url("../pendapatan/ubahJenis/" . $data->kode_pusk); ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <input type="hidden" name="id_jenis_pendapatan" value="<?= $data->id_jenis_pendapatan; ?>">
            <label>Jenis Pendapatan</label>
            <input type="text" class="form-control" placeholder="Jenis Pendapatan" name="jenis_pendapatan" value="<?= $data->jenis_pendapatan; ?>">
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button> -->
        <a href="<?= site_url("../pendapatan/hapusJenis/" . $data->kode_pusk . "/" . $data->id_jenis_pendapatan); ?>" class="btn btn-danger" onclick="return confirm('Yakin Hapus?')">Hapus</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>