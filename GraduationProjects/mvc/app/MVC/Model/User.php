<?php

namespace MVC\MVC\Model;


use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $guarded = ['role'];
}