<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function produks(){
        return $this->hasMany(Produk::class);
    }

    public function  getRouteKeyName(){
        return 'slug';
    }



}
