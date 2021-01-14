<form action="<?= site_url("../pegawai/edit/" . $pegawai->id_pegawai); ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label>Jenis Tenaga</label>
            <select name="status_pegawai" style="width: 100%;" class="form-control select2">
                <option value="" disabled>Pilih</option>
                <option <?= ($pegawai->status_pegawai == 0) ? "selected" : ""; ?> value="0">NON ASN</option>
                <option <?= ($pegawai->status_pegawai == 1) ? "selected" : ""; ?> value="1">ASN</option>
            </select>
        </div>
        <div class="form-group">
            <label>NIP/Kode Pegawai Non ASN</label>
            <input type="number" name="nip_pegawai" class="form-control" placeholder="NIP/Kode Pegawai Non ASN" value="<?= $pegawai->nip_pegawai; ?>">
            <input type="hidden" name="nip_pegawai_lama" class="form-control" placeholder="NIP/Kode Pegawai Non ASN" value="<?= $pegawai->nip_pegawai; ?>">
        </div>
        <div class="form-group">
            <label>Nama Pegawai</label>
            <input type="text" name="nama_pegawai" class="form-control" placeholder="Nama Pegawai" value="<?= $pegawai->nama_pegawai; ?>">
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