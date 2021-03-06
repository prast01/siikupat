<form action="<?= site_url("../rok/edit/" . $rok->id_rok); ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label>Kode Rekening</label>
            <input type="hidden" name="id_sub_kegiatan" value="<?= $rok->id_sub_kegiatan; ?>">
            <input type="hidden" name="bulan" value="<?= $rok->bulan; ?>">
            <input type="hidden" name="kode_seksi" value="<?= $kode_seksi; ?>">
            <select name="id_rekening" class="form-control select2" style="width: 100%;">
                <option value="" disabled>Pilih Kode Rekening</option>
                <?php foreach ($rek as $row) : ?>
                    <option <?= ($row->id_rekening == $rok->id_rekening) ? "selected" : ""; ?> value="<?= $row->id_rekening; ?>"><?= $row->kode_rekening . " - " . $row->nama_rekening; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Uraian Kegiatan</label>
            <input type="text" name="uraian" class="form-control" placeholder="Uraian Kegiatan" value="<?= $rok->uraian; ?>">
        </div>
        <div class="form-group">
            <label>Nominal</label>
            <input type="number" name="nominal" class="form-control" placeholder="Nominal" value="<?= $rok->nominal; ?>">
            <input type="hidden" name="nominal_lama" class="form-control" placeholder="Nominal" value="<?= $rok->nominal; ?>">
        </div>
        <div class="form-group">
            <label>Keterangan</label>
            <input type="text" name="keterangan" class="form-control" placeholder="Keterangan" value="<?= $rok->keterangan; ?>">
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

        $('#kode_rekening').select2({
            ajax: {
                url: "<?= site_url("../service/data_rekening_seksi/" . $rok->id_sub_kegiatan); ?>",
                dataType: 'json',
                delay: 500,
                data: function(params) {
                    return {
                        search: params.term
                    };
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(item) {
                            return {
                                text: item.kode_rekening + " - " + item.nama_rekening,
                                id: item.id_rekening
                            }
                        })
                    }
                },
                cache: true
            },
            placeholder: 'Masukkan Kode atau Nama Rekening',
            minimumInputLength: 3,
            escapeMarkup: function(markup) {
                return markup;
            },
            templateResult: function(data) {
                return data.text;
            },
            templateSelection: function(data) {
                return data.text;
            }
        });

    });
</script>