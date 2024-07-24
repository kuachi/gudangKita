<?php

namespace App\Models\Inventory;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangMasuk extends Model
{
    use HasFactory;
    protected $table = 'barang_masuk';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
