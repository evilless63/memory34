<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['title','is_active','is_footer', 'path','parent_id','order'];

    public function page()
    {
        return $this->hasOne('App\Page');
    }
}
