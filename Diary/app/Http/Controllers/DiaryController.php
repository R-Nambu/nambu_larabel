<?php

namespace App\Http\Controllers;

use App\Diary;
use Illuminate\Http\Request;

class DiaryController extends Controller
{
    public function index()
    {
        $diaries = Diary::all(); 

        // dd($diaries);

        return view('diaries.index',['diaries' => $diaries]);
    }
}
