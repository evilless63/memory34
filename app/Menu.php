<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['title','is_active','is_footer', 'parent_id','order'];

    public function pages()
    {
        return $this->belongsToMany('App\Page');
    }
}
