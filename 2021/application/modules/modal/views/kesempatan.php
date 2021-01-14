<form action="<?= site_url("../user/kesempatan/" . $user->id_user); ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label>Kesempatan</label>
            <input type="number" class="form-control" name="kesempatan" placeholder="Kesempatan" value="<?= $user->kesempatan; ?>">
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