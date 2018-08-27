<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title','description','meta_desc', 'meta_keys','slug'];

    public function page()
    {
        return $this->belongsTo('App\Menu');
    }
}
