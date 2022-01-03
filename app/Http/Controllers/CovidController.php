<?php

namespace App\Http\Controllers;

use App\Charts\CovidChart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CovidController extends Controller
{
    public function chart()
    {
        $suspects = collect(Http::get('https://api.kawalcorona.com/')->json());
        $suspectData = $suspects->flatten(1);

        $labels = $suspectData->pluck('Country_Region');
        $data = $suspectData->pluck('Confirmed');
        $colors = $labels->map(function($item)
        {
            return "#" . substr(md5(mt_rand()), 0, 6);
        });

        $chart = new CovidChart;
        $chart->labels($labels);
        $chart->dataset('Data Kasus Positif di dunia', 'pie', $data)->backgroundColor($colors);


    return view('covid',[
        'chart'=> $chart,
    ]);
}
}
