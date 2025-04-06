<?php

namespace App\Controllers;

use App\Models\OrderItemsModel;


class OrderItemsController extends BaseController{
    protected $orderItemsModel;

    protected $db;

    public function __construct()
    {
        $this->db = db_connect();

        $this->orderItemsModel= new OrderItemsModel();
    }

    public function index(){
        session();

        $data = [
            'message' => session()->get('message'),
        ];

        return view('pages/orders/index', $data);
    }

    public function getOrder(){
        $builder = $this->db->table('order_items');

        $builder->select('order_items.order_items_id, menus.name AS menu_name, order_items.qty, order_items.subtotal')
                ->join('menus', 'menus.menu_id = order_items.menu_id');

        $query = $builder->get();
        $result = $query->getResult();

        $data = [
            'title' => 'Order Menu',
            'orders' => $result,
        ];

        return view('pages/orders/index', $data);
    }

    public function generateUniqueId(){
        $lastId = $this->db->table('order_items')
            ->select('order_items_id') 
            ->orderBy('order_items_id', 'DESC')
            ->limit(1)
            ->get()
            ->getRow();
    
        if (!$lastId || !isset($lastId->order_items_id)) {
            $number = 1;
        } else {
            $lastNumber = preg_replace('/[^0-9]/', '', $lastId->order_items_id);
            $number = intval($lastNumber) + 1;
        }
    
        $uniqueId = 'OI-' . sprintf('%02d', $number);
    
        return $uniqueId;
    }    

    public function addToCart(){
        $menuId = $this->request->getVar('order_menu');
        $quantity = 1;

        $orderItemsId = $this->db->table('order_items')
                ->select('order_items_id, qty')
                ->where('menu_id', $menuId)
                ->get()
                ->getRow();
        
        $menu = $this->db->table('menus')
                ->select('price, stock, menu_id')
                ->where('menu_id', $menuId)
                ->get()
                ->getRow();

        if($orderItemsId){
            $newQty = $orderItemsId->qty + $quantity;
            $newSubtotal = $menu->price * $newQty;

            $this->db->table('menus')->update([
                'stock' => $menu->stock - $quantity,
            ], ['menu_id' => $menu->menu_id]);

            $this->db->table('order_items')->update([
                'qty' => $newQty,
                'subtotal' => $newSubtotal,
            ], ['order_items_id' => $orderItemsId->order_items_id]);
        }else{
            $this->db->table('order_items')->insert([
                'order_items_id' => $this->generateUniqueId(),
                'menu_id' => $menuId,
                'qty' => $quantity,
                'subtotal' => $menu->price * $quantity,
            ]);

            $this->db->table('menus')->where('menu_id', $menu->menu_id)->update([
                'stock' => $menu->stock - $quantity,
            ]);
        }

        return redirect()->to('/menus')->with('message', 'Berhasil Menambahkan Menu Ke Keranjang');
    }

    public function deleteOrder($orderItemsId) {
        $item = $this->db->table('order_items')
            ->select('qty, menu_id')
            ->where('order_items_id', $orderItemsId)
            ->get()
            ->getRow();
    
        if (!$item) {
            return redirect()->to('/orders')->with('message', 'Item tidak ditemukan.');
        }
    
        $oldStock = $this->db->table('menus')
            ->select('stock')
            ->where('menu_id', $item->menu_id)
            ->get()
            ->getRow();
    
        if (!$oldStock) {
            return redirect()->to('/orders')->with('message', 'Menu tidak ditemukan.');
        }
    
        $this->orderItemsModel->delete($orderItemsId);
    
        $this->db->table('menus')
            ->where('menu_id', $item->menu_id)
            ->update([
                'stock' => $oldStock->stock + $item->qty,
            ]);
    
        return redirect()->to('/orders')->with('message', 'Order item dibatalkan');
    }    
};