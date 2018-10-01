<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title','meta_desc', 'meta_keys','slug'];

    public function menus()
    {
        return $this->belongsToMany('App\Menu');
    }
}
