<form action="<?= site_url("../kegiatan/editRek/" . $rekening->id_rekening); ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label>Kode Rekening</label>
            <input type="hidden" name="id_kegiatan" value="<?= $sub->id_kegiatan; ?>">
            <input type="hidden" name="id_sub_kegiatan" value="<?= $rekening->id_sub_kegiatan; ?>">
            <select name="kode_rekening" id="kode_rekening" class="form-control" style="width: 100%;">
                <option selected value="<?= $rekening->kode_rekening; ?>"><?= $rekening->kode_rekening . " - " . $rekening->nama_rekening; ?></option>
            </select>
        </div>
        <div class="form-group">
            <label>Nama Rekening</label>
            <input type="text" name="nama_rekening" id="nama_rekening" class="form-control" placeholder="Nama Rekening" readonly>
            <input type="hidden" id="h_nama_rekening" value="<?= $rekening->nama_rekening; ?>">
        </div>
        <div class="form-group">
            <label>Pagu Rekening</label>
            <input type="number" name="pagu_rekening" class="form-control" placeholder="Pagu Rekening" value="<?= $rekening->pagu_rekening; ?>">
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
                url: "<?= site_url("../service/data_rekening"); ?>",
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
                                id: item.kode_rekening,
                                nama: item.nama_rekening,
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
                $("#nama_rekening").val(data.nama);
                return data.text;
            }
        });

        var h_nama_rekening = $("#h_nama_rekening").val();
        $("#nama_rekening").val(h_nama_rekening);
    })
</script>