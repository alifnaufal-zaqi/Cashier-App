<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderItemsModel extends Model{
    protected $table = 'order_items';

    protected $primaryKey = 'order_items_id';

    protected $allowedFields = ['order_items_id', 'order_id', 'menu_id', 'qty', 'subtotal'];
}