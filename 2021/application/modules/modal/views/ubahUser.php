<form action="<?= site_url("../user/edit/" . $user->id_user); ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label>Bidang</label>
            <select name="kode_bidang" class="form-control select2" style="width: 100%;">
                <option value="XXXX" <?= ($user->kode_bidang == "XXXX") ? "selected" : ""; ?>>Pilih</option>
                <?php foreach ($bidang as $row) : ?>
                    <option <?= ($row->kode_bidang == $user->kode_bidang) ? "selected" : ""; ?> value="<?= $row->kode_bidang; ?>"><?= $row->nama_bidang; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Nama Subbag/Seksi/UPT</label>
            <input type="text" class="form-control" name="nama" placeholder="Nama Seksi" value="<?= $user->nama; ?>">
        </div>
        <div class="form-group">
            <label>Kepala Subbag/Seksi/UPT</label>
            <select name="nip_kepala" class="form-control select2" style="width: 100%;">
                <option value="" disabled>Pilih</option>
                <?php foreach ($pegawai as $row) : ?>
                    <option <?= ($row->nip_pegawai == $user->nip_kepala) ? "selected" : ""; ?> value="<?= $row->nip_pegawai; ?>"><?= $row->nama_pegawai; ?></option>
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