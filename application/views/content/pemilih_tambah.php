<div class="card">
    <div class="card-header">
        <h3>Tambah Pemilih</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <?= form_open_multipart('/Auth_Admin/Pemilih/tambahPemilih') ?>
                    <div class="form-group">
                        <label for="nopemilih">Nomor Pemilih</label>
                        <input type="text" name="nopemilih" class="form-control" value="<?= set_value('nopemilih') ?>">
                        <div style="color:red"><?= form_error('nopemilih') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="namapemilih">Nama Pemilih</label>
                        <input type="text" name="namapemilih" class="form-control" value="<?= set_value('namapemilih') ?>">
                        <div style="color:red"><?= form_error('namapemilih') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="">Utusan</label>
                        <input type="text" name="pemilih_utusan" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="pemilih_email">Email</label>
                        <input type="text" name="pemilih_email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Kontak</label>
                        <input type="text" name="pemilih_contact" class="form-control">
                    </div>
                    <!--<div class="form-group">
                        <label for="">Jenis Pegawai</label>
                        <select name="jnspegawai" id="" class="form-control">
                            <option value="">----</option>
                            <option value="PNS">PNS</option>
                            <option value="CPNS">CPNS</option>
                        </select>
                        <div style="color:red"><?= form_error('jnspegawai') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="">Gelar Depan</label>
                        <input type="text" class="form-control" name="gelardpn" value="<?= set_value('gelardpn') ?>">
                        <div style="color:red"><?= form_error('gelardpn') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="">Gelar S3</label>
                        <input type="text" class="form-control" name="gelars3" value="<?= set_value('gelars3') ?>">
                        <div style="color:red"><?= form_error('gelars3') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="">Gelar Belakang</label>
                        <input type="text" class="form-control" name="gelarblkng" value="<?= set_value('gelarblkng') ?>">
                        <div style="color:red"><?= form_error('gelarblkng') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="">Jenis Kelamin</label><br>
                        <input type="radio" name="jkelamin" value="L"> <label for="">Laki-laki</label>
                        <input type="radio" name="jkelamin" value="P"> <label for="">Perempuan</label>
                    </div>
                    <div class="form-group">
                        <label for="">NIDN/NIDK/NUPN</label>
                        <input type="text" class="form-control" name="nidn" value="<?= set_value('nidn') ?>">
                        <div style="color:red"><?= form_error('nidn') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="">Pendidikan Terakhir</label>
                        <input type="text" class="form-control" name="pendterakhir" value="<?= set_value('pendterakhir') ?>">
                        <div style="color:red"><?= form_error('pendterakhir') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="">Golongan Terakhir</label>
                        <input type="text" class="form-control" name="golterakhir" value="<?= set_value('golterakhir') ?>">
                        <div style="color:red"><?= form_error('golterakhir') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="">Jabatan Terakhir</label>
                        <select class="form-control" name="jabterakhir">
                            <option value="">-----</option>
                            <option value="Profesor">Profesor</option>
                            <option value="Lektor Kepala">Lektor Kepala</option>
                            <option value="Lektor">Lektor</option>
                            <option value="Asisten Ahli">Asisten Ahli</option>
                            <option value="Dosen">Dosen</option>
                        </select>
                        <div style="color:red"><?= form_error('jabterakhir') ?></div>
                    </div>
                    <div class="form-group">
                        <label for="">Program Studi</label>
                        <input type="text" name="prodi" class="form-control" value="<?= set_value('prodi') ?>">
                        <div style="color:red"><?= form_error('prodi') ?></div>
                    </div> -->
                    <div class="form-group">
                        <label for="">Foto</label><br>
                        <input type="file" name="foto">
                    </div>
                    <input type="submit" class="btn btn-md btn-primary" value="Simpan" name="simpan-pemilih">
                <?= form_close() ?>
            </div>
            <div class="col-md-6">
                <div class="card-title"><h5>Import Excel</h5></div>
                <a href="<?= base_url() ?>/assets/template/template_data_pemilih.xlsx" class="btn btn-sm btn-success">Download Template Excel</a><br><br>
                <?= form_open_multipart('/Auth_Admin/Pemilih/importExcel') ?>
                    <div class="form-group">
                        <label for="fileexcel">Import File Excel</label>
                        <input type="file" name="fileexcel">
                        <div style="color:red"><?= form_error('fileexcel') ?></div>
                        <input type="checkbox" name="hapus" value="1"> <label for="">Hapus Semua Data</label>
                    </div>
                    <input type="submit" name="import-excel" class="btn btn-md btn-primary" value="Import Excel">
                <?= form_close() ?>
            </div>
        </div>
        
    </div>
</div>