<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>

<div class="container my-2">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center">
                    <h4><?= $title ?></h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="/menus/saveMenu">
                        <?= csrf_field(); ?>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Menu</label>
                            <input type="text" class="form-control <?= isset($validation['name']) ? 'is-invalid' : ''; ?>" id="name" name="name" placeholder="Masukkan nama menu">
                            <?php if (isset($validation['name'])) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation['name']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="mb-1">Kategori</label>
                            <select name="category" id="category" class="form-select">
                                <?php foreach ($categorys as $category) : ?>
                                    <option value="<?= $category->category_id ?>"><?= $category->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Harga Menu</label>
                            <input type="text" class="form-control <?= isset($validation['price']) ? 'is-invalid' : ''; ?>" id="price" name="price" placeholder="Masukkan harga menu">
                            <?php if (isset($validation['price'])) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation['price']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="stock" class="form-label">Stok Menu</label>
                            <input type="text" class="form-control <?= isset($validation['stock']) ? 'is-invalid' : ''; ?>" id="stock" name="stock" placeholder="Masukkan stok menu">
                            <?php if (isset($validation['stock'])) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation['stock']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Buat</button>
                            <a href="/menus" class="btn btn-secondary btn-lg text-center">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>