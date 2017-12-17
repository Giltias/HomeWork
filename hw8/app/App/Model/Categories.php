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

    public function getListAttribute()
    {
        return Categories::where('subcategory_id', $this->id)->get();
    }

    public function getLists($original)
    {
        $arr = [];
        $arr[] = $original->id;
        foreach ($original->list as $list) {
           $arr = array_merge($arr, $list->getLists($list));
        }
        return $arr;
    }

    public function getListsAttribute()
    {
        return $this->getLists($this);
    }

    protected $appends = ['parent', 'lists', 'list'];
}