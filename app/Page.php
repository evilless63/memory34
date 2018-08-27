<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['title','is_active','is_footer', 'path','parent_id','order'];

    public function page()
    {
        return $this->belongsTo('App\Menu');
    }
}
