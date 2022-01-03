<?php

namespace App\Http\Controllers;

use App\Charts\CovidChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PositifController extends Controller
{
    public function index()
    {
        $suspects = collect(Http::get('https://api.kawalcorona.com/positif')->json());
        $suspects1 = collect(Http::get('https://api.kawalcorona.com/sembuh')->json());
        $suspects2 = collect(Http::get('https://api.kawalcorona.com/meninggal')->json());

        $positif = $suspects;
        $sembuh = $suspects1;
        $meninggal = $suspects2;
        $data = $positif->pluck('value');
        $data1 = $sembuh->pluck('value');
        $data2 = $meninggal->pluck('value');

    return view('positif', compact([
        'data', 'data1', 'data2', 'positif', 'sembuh', 'meninggal'
    ]));
}
}
