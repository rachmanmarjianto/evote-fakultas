<div class="card">
    <div class="card-header">
        <h4>Tambah Saksi</h4>
    </div>
    <div class="card-body">
        <?= form_open('Auth_Admin/Saksi/tambahSaksi') ?>
            <div class="form-group">
                <label for="">Nama Saksi</label>
                <input type="text" name="nama" class="form-control" value="<?= set_value('nama') ?>">
                <div style="color:red"><?= form_error('nama') ?></div>
            </div>
            <div class="form-group">
                <label for="">NIP</label>
                <input type="text" name="nip" class="form-control" value="<?= set_value('nip') ?>">
                <div style="color:red"><?= form_error('nip') ?></div>
            </div>
            <div class="form-group">
                <label for="">Pangkat</label>
                <input type="text" name="pangkat" class="form-control" value="<?= set_value('pangkat') ?>">
                <div style="color:red"><?= form_error('pangkat') ?></div>
            </div>
            <input type="submit" value="Simpan" class="btn btn-sm btn-primary" name="tambah">
        <?= form_close() ?>
    </div>
</div>