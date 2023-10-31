<?= $this->extend('/layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="my-3">ini adalah halaman tambah data</h2>

            <form action="/komik/store" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control <?= (session('errors.judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" placeholder="judul">
                    <?php if (session('errors.judul')) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors.judul') ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="form-group mt-3">
                    <label for="penulis">Penulis</label>
                    <input type="text" class="form-control <?= (session('errors.penulis')) ? 'is-invalid' : ''; ?>" id="penulis" name="penulis" placeholder="penulis" value="<?= old('penulis'); ?>">
                    <?php if (session('errors.penulis')) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors.penulis') ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="form-group mt-3">
                    <label for="penerbit">penerbit</label>
                    <input type="text" class="form-control <?= (session('errors.penerbit')) ? 'is-invalid' : ''; ?>" id="penerbit" name="penerbit" placeholder="penerbit" value="<?= old('penerbit'); ?>">
                    <?php if (session('errors.penerbit')) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors.penerbit') ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="form-group mt-3">
                    <label for="sampul">sampul</label>
                    <input type="file" class="form-control <?= (session('errors.sampul.max_size')) ? 'is-invalid' : ''; ?>" id="sampul" name="sampul">

                    <?php if (session('errors.sampul')) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors.sampul') ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary mt-4" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>