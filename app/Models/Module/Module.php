<?php

namespace App\Models\Module;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;
    protected $guarded = [];


    protected $appends = ['parentModule', 'parentMenus'];

    public function getParentModuleAttribute()
    {
        return $this->parent_module_id ? Module::select('name')->where(['type' => '1', 'id' => $this->parent_module_id])->first() : null;
    }

    public function getParentMenusAttribute()
    {
        return $this->parent_menu_id ? Module::select('id', 'name')->where(['type' => '2', 'id' => $this->parent_menu_id])->first() : null;
    }
}
