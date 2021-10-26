<div class="card">
    <div class="card-header">
        Ubah Tema Pemilihan
    </div>
    <div class="card-body">
        <?= form_open_multipart('/Auth_Admin/Tema/ubahTema/'.$tema['tema_id']) ?>
            <div class="form-group">
                <label for="">Nama Tema</label>
                <input type="text" name="nama" class="form-control" value="<?= $tema['tema_nama']?>">
                <div style="color: red"><?= form_error('nama') ?></div>
            </div>
            <div class="form-group">
                <label for="">Mulai Pemilihan</label>
                <div class="input-group date" id="datetimepicker2" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker2" name="dateMulai" value="<?= date('m/d/Y h:i A', $tema['tema_mulai']) ?>"/>
                    <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
                <div style="color: red"><?= form_error('dateMulai') ?></div>
            </div>
            <div class="form-group">
                <label for="">Batas Pemilihan</label>
                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker1" name="date" value="<?= date('m/d/Y h:i A', $tema['tema_batas']) ?>"/>
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
                <img src="<?= base_url('/assets/img/'.$tema['tema_logo']) ?>" width="100" alt="" class="img-thumbnail"><br>
                <input type="file" name="foto">
            </div> -->
            <input type="submit" name="simpan-tema" class="btn btn-md btn-primary" value="Simpan">
        <?= form_close() ?>
    </div>
</div>