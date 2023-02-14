<?php

namespace App\Http\Controllers;

use App\Services\ChartService;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index(ChartService $service)
    {
        return view('welcome', $service->drawChart());
    }
}
