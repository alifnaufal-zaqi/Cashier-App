<?php

namespace App\Controllers;

use App\Models\MenuModel;

class MenuController extends BaseController
{
    protected $menuModel;
    protected $db;

    public function __construct()
    {
        $this->db = db_connect();

        $this->menuModel = new MenuModel();
    }

    public function index()
    {
        session();

        $data = [
            'message' => session()->getFlashdata('message'),
        ];

        return view('pages/menus/index', $data);
    }

    public function getAllMenu()
    {
        $builder = $this->db->table('menus');

        $builder->select('menus.menu_id, menus.name AS menu_name, menus.price, menus.stock, category.name AS category_name');
        $builder->join('category', 'menus.category_id = category.category_id');
        $query = $builder->get();
        $result = $query->getResult();

        $data = [
            'title' => 'Daftar Menu',
            'menus' => $result,
            'categorys' => $this->db->table('category')->select('name')->get()->getResult(),
        ];

        return view('pages/menus/index', $data);
    }

    public function addMenu()
    {
        session();
        $data = [
            'title' => 'Form Tambah Menu',
            'validation' => session()->get('validate'),
            'categorys' => $this->db->table('category')->select('category_id ,name')->get()->getResult(),
        ];

        return view('pages/menus/addMenu', $data);
    }

    public function generateUniqueId()
    {
        $lastId = $this->db->table('menus')
            ->select('menu_id')
            ->orderBy('menu_id', 'DESC')
            ->limit(1)
            ->get()
            ->getRow();

        if (!$lastId) {
            $number = 1;
        } else {
            $number = intval(substr($lastId->menu_id, 2)) + 1;
        }

        $uniqueId = 'M-' . sprintf('%02d', $number);

        return $uniqueId;
    }

    public function saveMenu()
    {
        $data = [
            'menu_id' => $this->generateUniqueId(),
            'name' => $this->request->getVar('name'),
            'category_id' => $this->request->getVar('category'),
            'price' => $this->request->getVar('price'),
            'stock' => $this->request->getVar('stock'),
        ];

        if (!$this->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ])) {
            $validate = $this->validator->getErrors();
            return redirect()->to('/menus/add')->withInput()->with('validate', $validate);
        }

        $this->db->table('menus')->insert($data);
        return redirect()->to('/menus');
    }

    public function updateMenu($menuId)
    {
        session();

        $data = [
            'title' => 'Form Update Menu',
            'validation' => session()->get('validate'),
            'menu' => $this->menuModel->getMenus($menuId),
            'categorys' => $this->db->table('category')->select('name, category_id')->get()->getResult(),
        ];

        return view('/pages/menus/updateMenu', $data);
    }

    public function updateData($menuId)
    {
        if (!$this->validate([
            'name' => 'required',
            'price' => 'required',
            'stock' => 'required',
        ])) {
            $validate = $this->validator->getErrors();
            return redirect()->to('/menus/updateMenu/' . $menuId)->withInput()->with('validate', $validate);
        }

        $data = [
            'name' => $this->request->getVar('name'),
            'category_id' => $this->request->getVar('category'),
            'price' => $this->request->getVar('price'),
            'stock' => $this->request->getVar('stock'),
        ];

        $where = ['menu_id' => $menuId];
        $this->db->table('menus')->update($data, $where);
        return redirect()->to('/menus');
    }

    public function deleteMenu($menuId)
    {
        $this->menuModel->delete($menuId);

        return redirect()->to('/menus');
    }
}
