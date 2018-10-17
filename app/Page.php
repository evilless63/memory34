<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title','meta_desc', 'meta_keys','slug','is_main'];

    public function menus()
    {
        return $this->belongsToMany('App\Menu');
    }

    public function albums()
    {
        return $this->belongsToMany('App\Album');
    }
}
