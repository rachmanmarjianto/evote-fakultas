<div class="card">
    <div class="card-header">
        <h4>Tambah Saksi</h4>
    </div>
    <div class="card-body">
        <?= form_open('Auth_Admin/Saksi/editSaksi/'.$saksi['saksi_id']) ?>
            <div class="form-group">
                <label for="">Nama Saksi</label>
                <input type="text" name="nama" class="form-control" value="<?= $saksi['saksi_nama'] ?>">
                <div style="color:red"><?= form_error('nama') ?></div>
            </div>
            <div class="form-group">
                <label for="">NIP</label>
                <input type="text" name="nip" class="form-control" value="<?= $saksi['saksi_nip'] ?>">
                <div style="color:red"><?= form_error('nip') ?></div>
            </div>
            <div class="form-group">
                <label for="">Pangkat</label>
                <input type="text" name="pangkat" class="form-control" value="<?= $saksi['saksi_pangkat'] ?>">
                <div style="color:red"><?= form_error('pangkat') ?></div>
            </div>
            <input type="submit" value="Edit" class="btn btn-sm btn-primary" name="edit">
        <?= form_close() ?>
    </div>
</div>