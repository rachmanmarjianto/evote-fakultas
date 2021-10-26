<div class="card">
    <div class="card-header">
        Tambah Tema Pemilihan
    </div>
    <div class="card-body">
        <?= form_open_multipart('/Auth_Admin/Tema/tambahTema') ?>
            <div class="form-group">
                <label for="">Nama Tema</label>
                <input type="text" name="nama" class="form-control">
                <div style="color: red"><?= form_error('nama') ?></div>
            </div>
            <div class="form-group">
                <label for="">Mulai Pemilihan</label>
                <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" name="dateMulai" value="<?= set_value('date'); ?>"/>
                    <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
                <div style="color: red"><?= form_error('dateMulai') ?></div>
            </div>
            <div class="form-group">
                <label for="">Batas Pemilihan</label>
                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" name="date" value="<?= set_value('date'); ?>"/>
                    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
                <div style="color: red"><?= form_error('date') ?></div>
            </div>
            <div class="form-check" style="margin-bottom:10px">
                <input class="form-check-input" type="checkbox" name="prodi" value="1" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                    Menyertakan Program Studi
                </label>
            </div>
            <!-- <div class="form-group">
                <label for="foto">Logo</label><br>
                <input type="file" name="foto">
            </div> -->
            <input type="submit" name="simpan-tema" class="btn btn-md btn-primary" value="Simpan">
        <?= form_close() ?>
    </div>
</div>