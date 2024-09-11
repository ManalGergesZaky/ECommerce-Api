<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category() {
        return $this->belongsTo(Category::class, "cat_id", "id");
    }

    public function getImagePathAttribute() {
        if( $this->image ) {
            return asset("uploads/images/".$this->image);
        }
        return asset("images/logo.png");
    }
}
