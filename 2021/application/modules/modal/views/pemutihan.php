<form action="<?= site_url("../kegiatan/pemutihan/" . $rekening->id_rekening); ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label>Tanggal Pemutihan</label>
            <input type="hidden" name="id_kegiatan" value="<?= $sub->id_kegiatan; ?>">
            <input type="hidden" name="id_sub_kegiatan" value="<?= $rekening->id_sub_kegiatan; ?>">
            <input type="date" name="tgl_pemutihan" class="form-control" placeholder="Tanggal Pemutihan" value="<?= $rekening->tgl_pemutihan; ?>">
        </div>
        <div class="form-group">
            <label>Realisasi Pemutihan</label>
            <input type="number" name="realisasi_pemutihan" class="form-control" placeholder="Realisasi Pemutihan" value="<?= $rekening->realisasi_pemutihan; ?>">
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