<form action="<?= site_url("../pengaturan/ubahRek/" . $kode_pusk); ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label>Kode Rekening</label>
            <input type="hidden" name="id_rekening" value="<?= $data->id_rekening; ?>">
            <input type="hidden" name="id_sub_kegiatan" value="<?= $data->id_sub_kegiatan; ?>">
            <select name="kode_rekening" id="kode_rekening" class="form-control" style="width: 100%;">
                <option value="<?= $data->kode_rekening; ?>"><?= $data->kode_rekening . " - " . $data->nama_rekening; ?></option>
            </select>
        </div>
        <div class="form-group">
            <label>Nama Rekening</label>
            <input type="text" name="nama_rekening" id="nama_rekening" class="form-control" placeholder="Nama Rekening" readonly>
            <input type="hidden" id="h_nama_rekening" value="<?= $data->nama_rekening; ?>">
        </div>
        <div class="form-group">
            <label>Pagu Rekening</label>
            <input type="number" name="pagu_rekening" class="form-control" placeholder="Pagu Rekening" value="<?= $data->pagu_rekening; ?>">
        </div>
        <div class="form-group">
            <label>Realisasi Rekening</label>
            <input type="number" name="realisasi_rekening" class="form-control" placeholder="Realisasi Rekening" value="<?= $data->realisasi_rekening; ?>">
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

        var nama_rek = $("#h_nama_rekening").val();
        $("#nama_rekening").val(nama_rek);

    });
</script>