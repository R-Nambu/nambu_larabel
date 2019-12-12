<?php

namespace App\Http\Controllers;

use App\Diary;
use Illuminate\Http\Request;
use App\Http\Requests\CreateDiary;

class DiaryController extends Controller
{
    public function index()
    {
        $diaries = Diary::orderBy('id', 'desc')->get(); 

        // dd($diaries);
        return view('diaries.index',['diaries' => $diaries]);
    }

    public function create()
    {
        // views/diaries/create.blade.phpを表示する
        return view('diaries.create');
    }

    public function store(CreateDiary $request)
    {
        $diary = new Diary();
        // dd('ここに保存処理');

        $diary->title = $request->title;
        $diary->body = $request->body;
        $diary->save();

        return redirect()->route('diary.index');
    }

    public function destroy(int $id)
    {
        //Diaryモデルを使用して、diariesテーブルから$idと一致するidをもつデータを取得
        $diary = Diary::find($id); 
        //取得したデータを削除
        $diary->delete();
        return redirect()->route('diary.index');
    }



}
