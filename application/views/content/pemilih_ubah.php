<div class="card">
    <div class="card-header">
        <h4>Ubah Pemilih</h4>
    </div>
    <div class="card-body">
        <?= form_open_multipart('/Auth_Admin/Pemilih/ubahPemilih/'.$pemilih['pemilih_id']) ?>
            <div class="form-group">
                <label for="nopemilih">Nomor Pemilih</label>
                <input type="text" name="nopemilih" class="form-control" value="<?= $pemilih['pemilih_akun'] ?>">
                <div style="color:red"><?= form_error('nopemilih') ?></div>
            </div>
            <div class="form-group">
                <label for="namapemilih">Nama Pemilih</label>
                <input type="text" name="namapemilih" class="form-control" value="<?= $pemilih['pemilih_nama'] ?>">
                <div style="color:red"><?= form_error('namapemilih') ?></div>
            </div>
            <div class="form-group">
                <label for="">Utusan</label>
                <input type="text" name="pemilih_utusan" class="form-control" value="<?= $pemilih['pemilih_utusan'] ?>">
            </div>
            <div class="form-group">
                <label for="pemilih_email">Email</label>
                <input type="text" name="pemilih_email" class="form-control" value="<?= $pemilih['pemilih_email'] ?>">
            </div>
            <div class="form-group">
                <label for="">Kontak</label>
                <input type="text" name="pemilih_contact" class="form-control" value="<?= $pemilih['pemilih_contact'] ?>">
            </div>

            

            <!--<div class="form-group">
                <label for="namapemilih">Foto</label>
                
                <input type="file" id="file" name="file" />
                <button type="button" class="btn btn-md btn-primary" id="but_upload">Upload Foto</button>

            </div>
            <div class="form-group">
                <label for="">Jenis Pegawai</label>
                <select name="jnspegawai" id="" class="form-control">
                    <option value="<?= $pemilih['pemilih_jenis_pegawai'] ?>"><?= $pemilih['pemilih_jenis_pegawai'] ?></option>
                    <option value="">----</option>
                    <option value="PNS">PNS</option>
                    <option value="CPNS">CPNS</option>
                </select>
                <div style="color:red"><?= form_error('jnspegawai') ?></div>
            </div>
            <div class="form-group">
                <label for="">Gelar Depan</label>
                <input type="text" class="form-control" name="gelardpn" value="<?= $pemilih['pemilih_gelar_depan'] ?>">
                <div style="color:red"><?= form_error('gelardpn') ?></div>
            </div>
            <div class="form-group">
                <label for="">Gelar S3</label>
                <input type="text" class="form-control" name="gelars3" value="<?= $pemilih['pemilih_gelar_s3'] ?>">
                <div style="color:red"><?= form_error('gelars3') ?></div>
            </div>
            <div class="form-group">
                <label for="">Gelar Belakang</label>
                <input type="text" class="form-control" name="gelarblkng" value="<?= $pemilih['pemilih_gelar_belakang'] ?>">
                <div style="color:red"><?= form_error('gelarblkng') ?></div>
            </div>
            <div class="form-group">
                <label for="">Jenis Kelamin</label><br>
                <input type="radio" name="jkelamin" value="L" <?php if($pemilih['pemilih_jk'] == "L"){echo "checked";} ?>> <label for="">Laki-laki</label>
                <input type="radio" name="jkelamin" value="P" <?php if($pemilih['pemilih_jk'] == "P"){echo "checked";} ?>> <label for="">Perempuan</label>
            </div>
            <div class="form-group">
                <label for="">NIDN/NIDK/NUPN</label>
                <input type="text" class="form-control" name="nidn" value="<?= $pemilih['pemilih_nidn'] ?>">
                <div style="color:red"><?= form_error('nidn') ?></div>
            </div>
            <div class="form-group">
                <label for="">Pendidikan Terakhir</label>
                <input type="text" class="form-control" name="pendterakhir" value="<?= $pemilih['pemilih_pend_akhir'] ?>">
                <div style="color:red"><?= form_error('pendterakhir') ?></div>
            </div>
            <div class="form-group">
                <label for="">Golongan Terakhir</label>
                <input type="text" class="form-control" name="golterakhir" value="<?= $pemilih['pemilih_golongan'] ?>">
                <div style="color:red"><?= form_error('golterakhir') ?></div>
            </div>
            <div class="form-group">
                <label for="">Jabatan Terakhir</label>
                <select class="form-control" name="jabterakhir">
                    <option value="<?= $pemilih['pemilih_jabatan'] ?>"><?= $pemilih['pemilih_jabatan'] ?></option>
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
                <input type="text" name="prodi" class="form-control" value="<?= $pemilih['pemilih_prodi'] ?>">
                <div style="color:red"><?= form_error('prodi') ?></div>
            </div>-->
            <div class="form-group">
                <label for="">Foto</label><br>
                <img src="<?= base_url('assets/img/img-pemilih/'.$pemilih['pemilih_foto']) ?>" class="img-thumbnail mb-2" width="100" alt=""><br>
                <input type="file" name="foto">
            </div>
            <div class="form-group">
                <label for="verifikasi">Status Verifikasi</label><br>
                <input type="radio" name="verifikasi" value="0"<?php if($pemilih['pemilih_verifikasi'] == 0){echo "checked";} ?>> <label>Belum Verifikasi</label>
                <input type="radio" name="verifikasi" value="1"<?php if($pemilih['pemilih_verifikasi'] == 1){echo "checked";} ?>> <label>Sudah Verifikasi</label>
            </div>
            <div class="form-group">
                <label for="verifikasi">Status Memilih</label><br>
                <input type="radio" name="memilih" value="0"<?php if($pemilih['pemilih_status'] == 0){echo "checked";} ?>> <label>Belum Memilih</label>
                <input type="radio" name="memilih" value="1"<?php if($pemilih['pemilih_status'] == 1){echo "checked";} ?>> <label>Sudah Memilih</label>
            </div>
            <input type="submit" class="btn btn-md btn-primary" value="Simpan" name="ubah-pemilih">
        <?= form_close() ?>
    </div>
</div>

<?php
    if($pemilih['pemilih_foto'] == '' || $pemilih['pemilih_foto'] == null)
    {
        echo "<input type='hidden' name='flag' value='0'>";
    }
    else
    {
        echo "<input type='hidden' name='flag' value='1'>";
    }
?>
