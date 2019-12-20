<?php

namespace App\Http\Controllers;

use App\Diary;
use Illuminate\Http\Request;
use App\Http\Requests\CreateDiary;
use Illuminate\Support\Facades\Auth;

class DiaryController extends Controller
{
    public function index()
    {
        // $diaries = Diary::orderBy('id', 'desc')->get(); 
        $diaries = Diary::with('likes')->orderBy('id', 'desc')->get(); 

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
        $diary->user_id = Auth::user()->id; //追加 ログインしてるユーザーのidを保存
        $diary->save();

        return redirect()->route('diary.index');
    }

    public function destroy(Diary $diary)
    {
        if (Auth::user()->id !== $diary->user_id) {
            abort(403);
        } 
        //Diaryモデルを使用して、diariesテーブルから$idと一致するidをもつデータを取得
        // $diary = Diary::find($id); 
        //取得したデータを削除
        $diary->delete();
        return redirect()->route('diary.index');
    }

    // public function edit({})
    // {
    //     $diary = Diary::find($id); 
    //     return view('diaries.edit', [
    //             'diary' => $diary,
    //     ]);
    // }
    public function edit(Diary $diary)
    {
        if (Auth::user()->id !== $diary->user_id) {
            abort(403);
        } 

        return view('diaries.edit', [
            'diary' => $diary,
        ]);
    }

    public function update(int $id, CreateDiary $request)
    {
        if (Auth::user()->id !== $diary->user_id) {
            abort(403);
        } 
        
        $diary = Diary::find($id);
        $diary->title = $request->title; //画面で入力されたタイトルを代入
        $diary->body = $request->body; //画面で入力された本文を代入
        $diary->save(); //DBに保存
        return redirect()->route('diary.index'); //一覧ページにリダイレクト
    }

    public function like(int $id)
    {
        $diary = Diary::where('id', $id)->with('likes')->first();
        $diary->likes()->attach(Auth::user()->id);

        return response()
        ->json(['success' => 'いいね完了！']);

    }

    public function dislike(int $id)
    {
        $diary = Diary::where('id', $id)->with('likes')->first();
        $diary->likes()->detach(Auth::user()->id);
        // 通信が成功したことを返す
        return response()
            ->json(['success' => 'いいね完了！']);
    }



}
