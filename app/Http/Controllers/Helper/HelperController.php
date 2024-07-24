<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function buatPlu($tanggal, $id)
    {
        $plu = $tanggal->format('ymd') . str_pad($id, 4, 0, STR_PAD_LEFT);
        return $plu;
    }

    public function buatInvnoBarang($tanggal, $id, $tipe)
    {
        $invno = "INV-$tipe" . $tanggal->format('ymd') . str_pad($id, 6, 0, STR_PAD_LEFT);
        return $invno;
    }
}
