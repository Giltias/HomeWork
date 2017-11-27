<?php

namespace HW7\App\Model;


use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $table = 'order';
    public function user()
    {
        return $this->belongsTo('HW7\App\Model\User');
    }

    public function getAddressAttribute()
    {
        $arr[0] = ($this->street)   ? ' ул.'   . $this->street  : null;
        $arr[1] = ($this->house)    ? ' д.'    . $this->house   : null;
        $arr[2] = ($this->fraction) ? ' корп.' . $this->fraction: null;
        $arr[3] = ($this->room)     ? ' кв.'   . $this->room    : null;
        $arr[4] = ($this->floor)    ? ' этаж ' . $this->floor   : null;
        return implode(',', array_filter($arr));
    }
}