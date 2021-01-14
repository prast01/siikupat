<div class="modal-body">
    <div class="form-group">
        <label>Pilih Pegawai</label>
        <select id="id_pegawai" style="width: 100%;" class="form-control">
            <option value="" selected disabled>Pilih</option>
            <?php foreach ($pegawai as $row) : ?>
                <option value="<?= $row->id_pegawai; ?>"><?= $row->nama_pegawai; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group" id="form-pihak" style="display: none;">
        <label>Nama Pihak Luar</label>
        <input type="text" id="pihak_ketiga" class="form-control" placeholder="Nama Pihak Luar">
    </div>
    <div class="form-group">
        <label>Nominal</label>
        <input type="number" id="nominal_pelaksana" class="form-control" placeholder="Nominal">
    </div>
</div>
<div class="modal-footer justify-content-between">
    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
    <button type="submit" class="btn btn-primary" onclick="add_pelaksana()" data-dismiss="modal">Simpan</button>
</div>

<script>
    $(function() {
        $("#id_pegawai").select2();

        $("#id_pegawai").change(function() {
            var id = $("#id_pegawai").val();
            if (id == "128") {
                $('#form-pihak').show();
                $("#pihak_ketiga").focus();
                console.log(id);
            } else {
                $('#form-pihak').hide();
                $("#pihak_ketiga").val("");
            }
        })
    })
</script>