<form action="<?= site_url("../kegiatan/addRek"); ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label>Kode Rekening</label>
            <input type="hidden" name="id_kegiatan" value="<?= $sub->id_kegiatan; ?>">
            <input type="hidden" name="id_sub_kegiatan" value="<?= $id; ?>">
            <select name="kode_rekening" id="kode_rekening" class="form-control" style="width: 100%;">
            </select>
        </div>
        <div class="form-group">
            <label>Nama Kegiatan</label>
            <input type="text" name="nama_rekening" id="nama_rekening" class="form-control" placeholder="Nama Kegiatan" readonly>
        </div>
        <div class="form-group">
            <label>Pagu Kegiatan</label>
            <input type="number" name="pagu_rekening" class="form-control" placeholder="Pagu Kegiatan">
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

    });
</script>