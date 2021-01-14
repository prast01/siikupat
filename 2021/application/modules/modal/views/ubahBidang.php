<form action="<?= site_url("../user/editBidang/" . $bidang->id_bidang); ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label>Nama Bidang</label>
            <input type="text" class="form-control" name="nama_bidang" placeholder="Nama Bidang" value="<?= $bidang->nama_bidang; ?>">
        </div>
        <div class="form-group">
            <label>Kepala Bidang</label>
            <select name="nip_kepala" class="form-control select2" style="width: 100%;">
                <option value="" disabled>Pilih</option>
                <?php foreach ($pegawai as $row) : ?>
                    <option <?= ($row->nip_pegawai == $bidang->nip_kepala) ? "selected" : ""; ?> value="<?= $row->nip_pegawai; ?>"><?= $row->nama_pegawai; ?></option>
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