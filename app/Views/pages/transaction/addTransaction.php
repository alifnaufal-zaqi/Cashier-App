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
                    <form method="POST" action="/transactions/create">
                        <?= csrf_field(); ?>
                        <div class="mb-3">
                            <label for="order_id" class="form-label">Order ID</label>
                            <input type="text" class="form-control <?= isset($validation['order_id']) ? 'is-invalid' : ''; ?>" id="order_id" name="order_id" placeholder="Masukkan order id">
                            <?php if (isset($validation['order_id'])) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation['order_id']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="menu_name">Menu</label>
                            <select name="menu_name" id="menu_name" class="form-select">
                                <option selected>Pilih Menu Order Items</option>
                                <?php foreach($menus as $menu) : ?>
                                    <option value="<?= $menu->order_items_id ?>"><?= $menu->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tgl_order" class="form-label">Tanggal Order</label>
                            <input type="date" class="form-control <?= isset($validation['tgl_order']) ? 'is-invalid' : ''; ?>" id="tgl_order" name="tgl_order">
                            <?php if (isset($validation['tgl_order'])) : ?>
                                <div class="invalid-feedback">
                                    <?= $validation['tgl_order']; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                            <select name="metode_pembayaran" class="form-select">
                                <option selected>Pilih Metode Pembayaran</option>
                                <option value="Cash">Cash</option>
                                <option value="E-Wallet">E-Wallet</option>
                                <option value="QRIS">QRIS</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-lg">Buat</button>
                            <a href="/transactions" class="btn btn-secondary btn-lg text-center">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>