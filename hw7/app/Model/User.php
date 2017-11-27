<?php

namespace HW7\App\Model;


use Illuminate\Database\Eloquent\Model;

class User extends Model {
    public $table = 'user';

    protected $fillable = ['email', 'phone', 'name', 'ip'];
}