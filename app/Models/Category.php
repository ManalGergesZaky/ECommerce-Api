<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getImagePathAttribute() {
        if( $this->image ) {
            return asset("uploads/images/".$this->image);
        }
        return asset("images/logo.png");
    }
}
