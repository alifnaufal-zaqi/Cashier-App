<?= $this->extend('main'); ?>
<?= $this->section('content'); ?>

<h2 class="fs-2 mb-3"><?= $title ?></h2>

<?php if(session()->getFlashdata('message')) : ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('message') ?>
    </div>
<?php endif ?>

<a href="/transactions/add" class="btn btn-success mb-3">Buat Transaksi</a>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Tanggal Order</th>
            <th scope="col">Metode Pembayaran</th>
            <th scope="col">Status Pembayaran</th>
            <th scope="col">Nama Menu</th>
            <th scope="col">Jumlah</th>
            <th scope="col">Subtotal</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($transactions as $transaction) : ?>
            <tr>
                <td><?= $transaction->order_id ?></td>
                <td><?= $transaction->tgl_order ?></td>
                <td><?= $transaction->metode_pembayaran ?></td>
                <td>
                    <div class="<?= $transaction->status_pembayaran === 'Unpaid' ? 'bg-danger' : 'bg-success' ?> d-inline p-1 px-2 rounded text-white fw-bolder">
                        <?= $transaction->status_pembayaran ?>
                    </div>
                </td>
                <td><?= $transaction->name ?></td>
                <td><?= $transaction->qty ?></td>
                <td><?= $transaction->subtotal ?></td>
                <td>
                    <form action="/transactions/update/<?= $transaction->order_id ?>" method="POST">
                        <input type="hidden" name="status_pain" value="<?= $transaction->order_id ?>">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-lg"></i>
                        </button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection(); ?>