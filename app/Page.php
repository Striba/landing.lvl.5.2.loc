<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    //Определяем список полей разрешенных к автозаполнению
    protected $fillable = ['name', 'text', 'alias', 'images'];
}
