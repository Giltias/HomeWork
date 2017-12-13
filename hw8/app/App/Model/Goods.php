<?php

namespace HW8\App\App\Model;

use Illuminate\Database\Eloquent\Model;

class Goods extends Model
{
    public function category()
    {
        return $this->belongsTo('HW8\App\App\Model\Categories', 'category_id');
    }
}