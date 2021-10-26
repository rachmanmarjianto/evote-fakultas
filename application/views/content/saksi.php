<div class="card">
    <div class="card-header">
        <h4>Daftar Saksi</h4>
    </div>
    <div class="card-body">
        <a href="<?= base_url('/Auth_Admin/Saksi/tambahSaksi') ?>" class="btn btn-sm btn-primary">Tambah Saksi</a>
        <br><br>
        <table class="table table-bordered dataTable">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>Pangkat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($saksi as $s) { ?>
                    <tr>
                        <td><?= $s['saksi_nama'] ?></td>
                        <td><?= $s['saksi_nip'] ?></td>
                        <td><?= $s['saksi_pangkat'] ?></td>
                        <td>
                            <a href="<?= base_url('Auth_Admin/Saksi/editSaksi/'.$s['saksi_id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="<?= base_url('Auth_Admin/Saksi/hapusSaksi/'.$s['saksi_id']) ?>" class="btn btn-sm btn-danger">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>