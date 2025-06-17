<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AjaxLoadController extends Controller
{
    public function getKodePengangkutan()
    {
        $pengangkutan = \App\Models\Pengangkutan::whereHas('pengangkutanHasilPanen', function ($query) {
            $query->where(function ($query) {
                $query->whereNull('muatan_pabrik')
                    ->orWhereNull('tandan_pabrik');
            });
        })->get()->toArray();
        return response()->json($pengangkutan);
    }
}
