<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonversiPlu extends Model
{
    use HasFactory;
    protected $table = 'konversi_plu';
    protected $primaryKey = 'id';
    protected $guarded = [];
}
