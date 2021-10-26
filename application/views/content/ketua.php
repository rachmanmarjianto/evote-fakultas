<div class="card">
    <div class="card-header">
        <h3>Daftar Calon Ketua</h3>
    </div>
    <div class="card-body">
        <?php if($user['role_id'] == 1) { ?>
            <a href="<?= base_url('/Auth_Admin/Ketua/tambahKetua') ?>" class="btn btn-sm btn-primary">Tambah Calon Ketua</a>
        <?php } else {} ?>
        <br>
        <br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Calon</th>
                    <th>Nomor Urut</th>
                    <th>Jenis Pemilihan</th>
                    <th>Prodi</th>
                    <th>Foto</th>
                    <!-- <th>Detail</th>                     -->
                    <th>Aksi</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($ketua as $k) {
                ?>
                <tr>
                    <td><?= $k['calon_ketua_nama'] ?></td>
                    <td><?= $k['calon_ketua_nourut'] ?></td>
                    <td><?= $k['tema_nama'] ?></td>
                    <td><?= $k['nama_jenjang']." ".$k['nama_prodi'] ?></td>
                    <td><img src="<?= base_url('/assets/img/'.$k['calon_ketua_foto']) ?>" alt="" width="100" class="img-thumbnail"></td>
                    <!-- <td><a href="<?= base_url('/Auth_Admin/Ketua/detailKetua/'.$k['calon_ketua_id']) ?>" class="btn btn-sm btn-success">Detail</a></td>
                    
                    <td>
                        <a href="<?= base_url('/Auth_Admin/Ketua/ubahKetua/'.$k['calon_ketua_id']) ?>" class="btn btn-sm btn-warning">Ubah</a>
                        <a href="<?= base_url('/Auth_Admin/Ketua/hapusKetua/'.$k['calon_ketua_id']) ?>" class="btn btn-sm btn-danger tombol-hapus">Hapus</a>
                    </td> -->
                    <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Aksi
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="<?= base_url('/Auth_Admin/Ketua/detailKetua/'.$k['calon_ketua_id']) ?>" style="color:blue">Detail</a>
                                <a class="dropdown-item" href="<?= base_url('/Auth_Admin/Ketua/ubahKetua/'.$k['calon_ketua_id']) ?>" style="color:green">Ubah</a>
                                <a class="dropdown-item" href="<?= base_url('/Auth_Admin/Ketua/hapusKetua/'.$k['calon_ketua_id']) ?>" style="color:red">Hapus</a>
                            </div>
                        </div>
                    </td>
                    
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>