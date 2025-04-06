<?php

namespace App\Controllers;

use App\Models\OrdersModel;

class OrdersController extends BaseController{
    protected $ordersModel;
    protected $db;

    public function __construct(){
        $this->ordersModel = new OrdersModel();

        $this->db = db_connect();
    }

    public function index(){
        session();

        $data = [
            'message' => session()->get('message'),
        ];

        return view('pages/transactions/index', $data);
    }

    public function getTransactions(){
        $builder = $this->db->table('orders');

        $builder->select('orders.order_id, orders.tgl_order, orders.total_harga, orders.metode_pembayaran, orders.status_pembayaran, menus.name, order_items.qty, order_items.subtotal')
                ->join('order_items', 'orders.order_items_id = order_items.order_items_id')
                ->join('menus', 'order_items.menu_id = menus.menu_id');

        $query = $builder->get();
        $result = $query->getResult();

        $data = [
            'title' => 'Transaksi Order',
            'transactions' => $result,
        ];

        return view('pages/transaction/index', $data);
    }

    public function addTransaction(){
        session();

        $menu = $this->db->table('order_items')
            ->select('order_items.order_items_id, menus.name')
            ->join('menus', 'order_items.menu_id = menus.menu_id')
            ->get()
            ->getResult();

        $data = [
            'title' => 'Form pembuatan transaksi',
            'menus' => $menu,
            'validation' => session()->get('validation')
        ];

        return view('pages/transaction/addTransaction', $data);
    }

    public function saveTransaction(){
        $orderItemsId = $this->request->getVar('menu_name');

        $totalHarga = $this->db->table('order_items')
                ->select('subtotal')
                ->where('order_items_id', $orderItemsId)
                ->get()
                ->getRow();

        $data = [
            'order_id' => $this->request->getVar('order_id'),
            'order_items_id' => $orderItemsId,
            'tgl_order' => $this->request->getVar('tgl_order'),
            'total_harga' => $totalHarga->subtotal,
            'metode_pembayaran' => $this->request->getVar('metode_pembayaran'),
            'status_pembayaran' => 'Unpaid',
        ];

        if(!$this->validate([
            'order_id' => 'required',
            'menu_name' => 'required',
            'tgl_order' => 'required',
        ])){
            $validate = $this->validator->getErrors();
            return redirect()->to('/transactions/add')->withInput()->with('validation', $validate);
        };

        $this->db->table('orders')->insert($data);

        return redirect()->to('/transactions')->with('message', 'Berhasil membuat transaksi');
    }

    public function updateStatusPayment($orderId){
        if($orderId){
            $this->db->table('orders')->update([
                'status_pembayaran' => 'Paid',
            ], ['order_id' => $orderId]);

            return redirect()->to('/transactions')->with('message', 'Pembayaran berhasil');
        }
    }
}