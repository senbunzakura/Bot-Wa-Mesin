<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LaporanKerusakan;

class LaporanKerusakanController extends Controller
{
    public function index(){
        $kerusakan = LaporanKerusakan::with('mesin')->get();
        return view('kerusakan.index', compact('kerusakan'));
    }
}
