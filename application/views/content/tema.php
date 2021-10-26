<div class="card">
    <div class="card-header">
        <h4>Daftar Tema Pemilihan</h4>
    </div>
    <div class="card-body">
    <?php
        if($user['role_id'] < 3)
        {
    ?>
        <a href="<?= base_url('/Auth_Admin/Tema/tambahTema') ?>" class="btn btn-sm btn-primary">Tambah Tema Pemilihan</a>
    <?php 
        }
    ?>
        <table class="table table-bordered mt-5">
            <thead>
                <tr>
                    <th>Nama Tema</th>
                    <th>Mulai Pemilihan</th>
                    <th>Batas Pemilihan</th>
                    <th>Prodi</th>
                    <th>Status</th>
                    <th>E-vote</th>
                    <?php
                        if($user['role_id'] < 3)
                        {
                    ?>
                    <th>Aksi</th>
                    <?php }?>
                </tr>
            </thead>
            <tbody>
                <?php foreach($tema as $t) { ?>
                    <tr>
                        <td><?= $t['tema_nama'] ?></td>
                        <td><?= date('m-d-Y h:i A', $t['tema_mulai'])?></td>
                        <td><?= date('m-d-Y h:i A', $t['tema_batas'])?></td>
                    <?php
                        if($t['prodi']==1)
                            echo '<td style="text-align:center">Ya</td>';
                        else   
                            echo '<td></td>'
                    ?>
                        <td>
                            <?php
                            if($user['role_id'] < 3)
                            {
                                if($t['tema_is_active'] == 0) {
                                    ?>
                                    <a href="<?= base_url('/Auth_Admin/Tema/activeTema/'.$t['tema_id']) ?>" class="btn btn-sm btn-danger">Non-Aktif</a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="<?= base_url('/Auth_Admin/Tema/activeTema/'.$t['tema_id']) ?>" class="btn btn-sm btn-success">Aktif</a>
                                    <?php
                                }
                            }
                            else{
                                if($t['tema_is_active'] == 0) {
                                    ?>
                                    <span style="color:red">Non-Aktif</span>
                                    <?php
                                } else {
                                    ?>
                                    <span style="color:green">Aktif</span>
                                    <?php
                                }
                            }
                            
                            ?>
                        </td>
                        <td>
                            <?php
                            // if($user['role_id'] < 3)
                            // {
                                if($t['status_vote'] == 0) {
                                    ?>
                                    <a href="<?= base_url('/Auth_Admin/Tema/activeEvote/'.$t['tema_id']) ?>" class="btn btn-sm btn-danger">Non-Aktif</a>
                                    <?php
                                } else {
                                    ?>
                                    <a href="<?= base_url('/Auth_Admin/Tema/activeEvote/'.$t['tema_id']) ?>" class="btn btn-sm btn-success">Aktif</a>
                                    <?php
                                }
                            // }
                            // else{
                            //     if($t['tema_is_active'] == 0) {
                                    ?>
                                    <!-- <span style="color:red">Non-Aktif</span> -->
                                    <?php
                                // } else {
                                    ?>
                                    <!-- <span style="color:green">Aktif</span> -->
                                    <?php
                            //     }
                            // }
                            
                            ?>
                        </td>
                        
                        <?php
                            if($user['role_id'] < 3)
                            {
                        ?>
                        <td>
                            <a href="<?= base_url('/Auth_Admin/Tema/ubahTema/'.$t['tema_id']) ?>" class="btn btn-sm btn-warning">Ubah</a>
                            <!-- <a href="<?= base_url('/Auth_Admin/Tema/hapusTema/'.$t['tema_id']) ?>" class="btn btn-sm btn-danger tombol-hapus">Hapus</a> -->
                        </td>
                        <?php }?>
                    </tr>
                <?php } ?> 
            </tbody>
        </table>
    </div>
</div>