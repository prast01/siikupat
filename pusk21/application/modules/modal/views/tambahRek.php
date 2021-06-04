<form action="<?= site_url("../pengaturan/tambahRek/" . $kode_pusk); ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label>Kode Rekening</label>
            <input type="hidden" name="id_sub_kegiatan" value="<?= $id_sub_kegiatan; ?>">
            <select name="kode_rekening" id="kode_rekening" class="form-control" style="width: 100%;">
            </select>
        </div>
        <div class="form-group">
            <label>Nama Rekening</label>
            <input type="text" name="nama_rekening" id="nama_rekening" class="form-control" placeholder="Nama Rekening" readonly>
        </div>
        <div class="form-group">
            <label>Pagu Rekening</label>
            <input type="number" name="pagu_rekening" class="form-control" placeholder="Pagu Rekening">
        </div>
        <div class="form-group">
            <label>Realisasi Rekening</label>
            <input type="number" name="realisasi_rekening" class="form-control" placeholder="Realisasi Rekening">
            <span class="text-sm text-danger">* Isi Realisasi, jika sudah terdapat Realisasi Belanja.</span>
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