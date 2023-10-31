<?= $this->extend('/layout/template'); ?>
<?= $this->section('content'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="my-3">ini adalah halaman edit data</h2>
            <?php if (session()->has('errors')) : ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach (session('errors') as $error) : ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif ?>
            <form action="<?= base_url('/komik/update/' . $komik['id']); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="slug" value="<?= $komik['slug']; ?>">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control <?= (session('errors.judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" placeholder="judul" value="<?= (old('judul')) ? old('judul') : $komik['judul'] ?>">
                    <?php if (session('errors.judul')) : ?>
                        <div class="invalid-feedback">
                            <?= session('errors.judul') ?>
                        </div>
                    <?php endif ?>
                </div>
                <div class="form-group mt-3">
                    <label for="penulis">Penulis</label>
                    <input type="text" class="form-control" id="penulis" name="penulis" placeholder="penulis" value="<?= (old('penulis')) ? old('penulis') : $komik['penulis'] ?>">
                </div>
                <div class="form-group mt-3">
                    <label for="penerbit">penerbit</label>
                    <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="penerbit" value="<?= (old('penerbit')) ? old('penerbit') : $komik['penerbit'] ?>">
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
                    <button class="btn btn-warning mt-4" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>