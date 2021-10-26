<div class="card">
    <div class="card-header">
        <h4>Tambah User</h4>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Fakultas Aktif</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="fakultas" value="<?php echo $fakultas[0]['nama_fakultas'];?>" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-6 col-md-6 col-sm-6">
                <div class="form-group">
                    <label for="">NIM/NIP/NIK</label>
                    <input type="text" class="form-control" id="idNIMgetUser">
                </div>
            </div>
            <div class="col-xl-6 col-md-6 col-sm-6">
                <div class="form-group">
                    <label for="role">Role</label>
                    <select name="role" class="form-control" id="idRoleGetUser">
                        <option value="0">Mahasiswa</option>
                        <option value="1">Pegawai</option>
                        <option value="2">Dosen</option>
                    </select>
                </div>
            </div>
        </div>
        <button class="btn btn-md btn-success" onclick="get_user()" style="margin-right:10px">Cari</button>
        <span id="loader"></span>
        
    </div>

</div>



<div class="card" style="margin-top: 20px">
    <div class="card-header">
        <h4>Set Role</h4>
    </div>
    <div class="card-body">
        <?= form_open('/Auth_Admin/UserAuth/tambahUser') ?>
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" class="form-control" name="nama" id="idNama" readonly>
                <div style="color: red"><?= form_error('nama') ?></div>
            </div>
            <div class="form-group">
                <label for="">NIM/NIP/NIK</label>
                <input type="text" class="form-control" name="username" id="idNIM" readonly>
                <div style="color: red"><?= form_error('username') ?></div>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" class="form-control" id="">
                    <?php foreach($role as $r) {?>
                        <option value="<?= $r['role_id'] ?>"><?= $r['role_name'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <div style="color: red"><?= form_error('role') ?></div>
            </div>
            <input type="submit" value="Simpan" name="simpan-user" class="btn btn-md btn-primary">
            <input type="hidden" name="id_fakultas" value="<?php echo $fakultas[0]['id_fakultas'];?>">
            <input type="hidden" name="nama_fakultas" value="<?php echo $fakultas[0]['nama_fakultas'];?>">
        <?= form_close() ?>
    </div>
</div>