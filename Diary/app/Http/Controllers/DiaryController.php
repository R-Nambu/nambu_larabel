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

    public function create()
    {
        // views/diaries/create.blade.phpを表示する
        return view('diaries.create');
    }

    public function store(Request $request)
    {
        $diary = new Diary();
        // dd('ここに保存処理');

        $diary->title = $request->title;
        $diary->body = $request->body;
        $diary->save();

        return redirect()->route('diary.index');
    }


}
