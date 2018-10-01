<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Album;

class Image extends Model
{
    protected $table = 'images';
  
    protected $fillable = array('album_id','description','image');

    public function photos(){ 
        return $this->belongs_to(Album::class);
    }
}
