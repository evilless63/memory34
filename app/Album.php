<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Image;

class Album extends Model
{
    protected $table = 'albums';

    protected $fillable = array('name','description','cover_image');
  
    public function photos(){ 
      return $this->has_many(Image::class);
    }
}
