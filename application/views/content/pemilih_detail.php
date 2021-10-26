<div class="card">
    <div class="card-header">
        <h3>Detail Pemilih</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-3">
            <?php if($pemilih['pemilih_foto'] == '' || $pemilih['pemilih_foto'] == null)
                {
            ?>
                    <img src="<?php echo base_url('assets/icon/index.png')?>" class="img-thumbnail rounded-circle mb-2" width="200" alt="">
            <?php
                }
                else
                {
            ?>
                    <img src="<?= base_url('assets/img/img-pemilih/'.$pemilih['pemilih_foto']) ?>" class="img-thumbnail rounded-circle mb-2" width="200" alt="">
            <?php
                }
            ?>
            </div>
            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Nomor Pemilih</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for=""><?= $pemilih['pemilih_akun'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Nama Pemilih</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for=""><?= $pemilih['pemilih_nama'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Email</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for=""><?= $pemilih['pemilih_email'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Contact</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for=""><?= $pemilih['pemilih_contact'] ?></label>
                    </div>
                </div>
                <!--<div class="row">
                    <div class="col-md-3">
                        <label for="">Gelar Depan</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for=""><--?= $pemilih['pemilih_gelar_depan'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Gelar S3</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for=""><--?= $pemilih['pemilih_gelar_s3'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Gelar Belakang</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for=""><--?= $pemilih['pemilih_gelar_belakang'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Jenis Kelamin</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for=""><--?= $pemilih['pemilih_jk'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">NIDN/NDIK/NUPN</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for=""><--?= $pemilih['pemilih_nidn'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Pendidikan Terakhir</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for=""><--?= $pemilih['pemilih_pend_akhir'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Golongan Terakhir</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for=""><--?= $pemilih['pemilih_golongan'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Jabatan Terakhir</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for=""><--?= $pemilih['pemilih_jabatan'] ?></label>
                    </div>
                </div>-->
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Prodi</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-5">
                        <label for=""><?= $pemilih['pemilih_utusan'] ?></label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label for="">Status Pemilih</label>
                    </div>
                    <div class="col-md-1">:</div>
                    <div class="col-md-3">
                        <label for="">
                            <?php
                            if($pemilih['pemilih_status'] == 0) {
                                echo 'Belum memilih';
                            } else {
                                echo "Sudah memilih";
                            }
                            ?>
                        </label>
                    </div>
                </div>
            </div>
        </div>
        
        
        <?php
        if($pemilih['pemilih_verifikasi'] == 0) {
            echo "Belum Diverifikasi";
        } else {
            echo "Sudah Diverifikasi";
        }
        ?>
    </div>
</div>