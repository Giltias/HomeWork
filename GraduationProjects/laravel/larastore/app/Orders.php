<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    public function goods()
    {
        return $this->belongsTo('App\Goods');
    }
}
