<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model{
    protected $table = 'menus';

    protected $primaryKey = 'menu_id';

    protected $allowedFields = ['menu_id', 'name', 'category_id', 'price', 'stock'];

    public function getMenus($menuId = false){
        if($menuId === false){
            return $this->findAll();
        };

        return $this->where(['menu_id' => $menuId])->first();
    }
}