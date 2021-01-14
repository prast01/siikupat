<form action="<?= site_url("../pegawai/add"); ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label>Jenis Tenaga</label>
            <select name="status_pegawai" style="width: 100%;" class="form-control select2">
                <option value="" selected disabled>Pilih</option>
                <option value="0">NON ASN</option>
                <option value="1">ASN</option>
            </select>
        </div>
        <div class="form-group">
            <label>NIP/Kode Pegawai Non ASN</label>
            <input type="number" name="nip_pegawai" class="form-control" placeholder="NIP/Kode Pegawai Non ASN">
        </div>
        <div class="form-group">
            <label>Nama Pegawai</label>
            <input type="text" name="nama_pegawai" class="form-control" placeholder="Nama Pegawai">
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