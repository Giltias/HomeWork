<?php

namespace HW8\App\App\Model;


use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public function good()
    {
        return $this->hasMany('HW8\App\App\Model\Goods');
    }

    public function getParentAttribute()
    {
        $parent = Categories::find($this->subcategory_id);
        if (!$parent) {
            return '';
        }
        return $parent->name;
    }

    protected $appends = ['parent'];
}