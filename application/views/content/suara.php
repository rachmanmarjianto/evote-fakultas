

<div class="card">
    <div class="card-header">
        <h4>Daftar Jenis Pemilihan</h4>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Pemilihan</th>
                    <th>Status Publikasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach($tema as $t) { ?>
                    <tr>
                        <td><?= $no ?></td>
                        <td><?= $t['tema_nama'] ?></td>
                        <td>
                            <?php
                            if($t['status']==1)
                            {
                                echo '<a href="'.base_url('/Auth_Admin/Suara/publish/'.$t['status']).'" class="btn btn-sm btn-warning">Terbuka</a>';
                            }
                            else
                            {
                                echo '<a href="'.base_url('/Auth_Admin/Suara/publish/'.$t['status']).'" class="btn btn-sm btn-danger">Tertutup</a>';
                            }

                            ?>
                        </td>
                        <td>
                            <a href="<?= base_url('/Auth_Admin/Suara/detailSuara/') ?>" class="btn btn-sm btn-success">Detail</a>
                            
                        </td>
                    </tr>
                <?php $no++;
                } ?>
            </tbody>
        </table>
    </div>
</div>