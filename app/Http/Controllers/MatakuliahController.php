<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matakuliah;

class MatakuliahController extends Controller
{
     public function index()
    {
        $data = Matakuliah::all();
        return view('matakuliah.index', compact('data'));
    }

    public function store(Request $request)
    {
        Matakuliah::create($request->only('matkul', 'deskripsi'));
        return redirect()->back();
    }
}
