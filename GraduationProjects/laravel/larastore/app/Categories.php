<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $appends = ['list', 'lists'];

    public function getParentnameAttribute()
    {
        $cat = Categories::find($this->parent);
        if ($cat) {
            return $cat->name;
        }

        return '';
    }

    public function getListAttribute()
    {
        return Categories::where('active', 1)->where('parent', $this->id)->get();
    }

    public function getLists($original)
    {
        $arr = [];
        $arr[] = $original->id;
        /**
         * @var $list Categories
         */
        foreach ($original->list as $list) {
            $arr = array_merge($arr, $list->getLists($list));
        }
        return $arr;
    }

    public function getListsAttribute()
    {
        return $this->getLists($this);
    }
}
