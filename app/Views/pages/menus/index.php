<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>

<h2 class="fs-2"><?= $title ?></h2>

<?php if(session()->getFlashdata('message')) : ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('message') ?>
    </div>
<?php endif ?>

<div class="d-flex align-items-center justify-content-between">
    <a href="/menus/add" class="btn btn-success my-3">Buat Menu</a>
    <form action="" class="w-50">
        <div class="d-flex gap-2">
            <input type="search" class="form-control" name="keyword" placeholder="Cari Menu">
            <button class="btn btn-primary"><i class="bi bi-search"></i></button>
        </div>
    </form>
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Nama Menu</th>
            <th scope="col">Kategori</th>
            <th scope="col">Harga</th>
            <th scope="col">Stok</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($menus as $menu) : ?>
            <tr>
                <td><?= $menu->menu_name; ?></td>
                <td><?= $menu->category_name; ?></td>
                <td><?= $menu->price; ?></td>
                <td><?= $menu->stock; ?></td>
                <td>
                    <div class="d-flex gap-3">
                        <a href="/menus/updateMenu/<?= $menu->menu_id ?>" class="btn btn-warning"><i class="bi bi-pen"></i></a>
                        <form action="/menus/delete/<?= $menu->menu_id ?>" method="POST" class="d-inline">
                            <input type="hidden" name="menu_id" value="<?= $menu->menu_id; ?>">
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                        <form action="/orders/add" method="POST">
                            <input type="hidden" name="order_menu" value="<?= $menu->menu_id; ?>">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-cart"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection(); ?>