<?= $this->extend('/layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h3>Halaman detail komik</h3>
            <div class="card-group">
                <div class="col-md-2"> <!-- Mengatur lebar kartu menjadi 4 kolom -->
                    <div class="card">
                        <?php



                        if ($komik && isset($komik['sampul'])) : ?>
                            <img class="card-img-top sampul" src="/img/<?= $komik['sampul']; ?>" alt="Card image cap">
                        <?php else : ?>
                            <p>Gambar sampul tidak tersedia.</p>
                        <?php endif; ?>
                        <div class="card-body">
                            <?php if ($komik && isset($komik['judul'])) : ?>
                                <h5 class="card-title"><?= $komik['judul']; ?></h5>
                            <?php else : ?>
                                <h5 class="card-title">Judul tidak tersedia.</h5>
                            <?php endif; ?>
                            <?php if ($komik && isset($komik['penulis'])) : ?>
                                <p class="card-text">Penulis : <?= $komik['penulis']; ?></p>
                            <?php else : ?>
                                <p class="card-text">Penulis tidak tersedia.</p>
                            <?php endif; ?>
                            <?php if ($komik && isset($komik['penerbit'])) : ?>
                                <p class="card-text"><small class="text-muted">Penerbit : <?= $komik['penerbit']; ?></small></p>
                            <?php else : ?>
                                <p class="card-text"><small class="text-muted">Penerbit tidak tersedia.</small></p>
                            <?php endif; ?>
                            <a href="<?= base_url('/komik/edit/' . $komik['slug']); ?>" class="btn btn-warning">Edit</a>
                            <form action="<?= base_url('/komik/' . $komik['id']); ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="btn btn-danger" type="submit" onclick="return confirm('hapus data ?');">Hapus</button>
                            </form>
                            <a href="<?= base_url('komik/index'); ?>" class="">Kembali</a></br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?= $this->endSection(); ?>