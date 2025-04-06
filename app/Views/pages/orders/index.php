<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>

<h2 class="fs-2"><?= $title ?></h2>

<?php if(session()->getFlashdata('message')) : ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('message') ?>
    </div>
<?php endif ?>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Nama Menu</th>
            <th scope="col">QTY</th>
            <th scope="col">Subtotal</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order) : ?>
            <tr>
                <td><?= $order->menu_name; ?></td>
                <td><?= $order->qty; ?></td>
                <td><?= $order->subtotal; ?></td>
                <td>
                    <form action="/orders/delete/<?= $order->order_items_id ?>" method="POST">
                        <input type="hidden" name="order_items" value="<?= $order->order_items_id ?>">
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection(); ?>