<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdersModel extends Model{
    protected $table = 'orders';

    protected $primaryKey = 'order_id';

    protected $allowedFields = ['order_id', 'order_items_id', 'tgl_order', 'total_harga', 'metode_pembayaran', 'status_pembayaran' ];
}