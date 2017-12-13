<?php
/**
 * Created by PhpStorm.
 * User: VDolinger
 * Date: 13.12.2017
 * Time: 16:01
 */

namespace HW8\App\App\Model;


use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    public function good()
    {
        return $this->hasMany('HW8\App\App\Model\Goods');
    }
}