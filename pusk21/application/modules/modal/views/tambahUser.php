<form action="<?= site_url("../pengaturan/tambahUser"); ?>" method="post">
    <div class="modal-body">
        <div class="form-group">
            <label>Kode Puskesmas</label>
            <input type="text" class="form-control" placeholder="Kode Puskesmas" name="kode_pusk">
        </div>
        <div class="form-group">
            <label>Nama Puskesmas</label>
            <input type="text" class="form-control" placeholder="Nama Puskesmas" name="nama">
        </div>
        <div class="form-group">
            <label>Kepala Puskesmas</label>
            <input type="text" class="form-control" placeholder="Kepala Puskesmas" name="nama_kepala">
        </div>
        <div class="form-group">
            <label>NIP Kepala Puskesmas</label>
            <input type="text" class="form-control" placeholder="NIP Kepala Puskesmas" name="nip_kepala">
        </div>
    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>