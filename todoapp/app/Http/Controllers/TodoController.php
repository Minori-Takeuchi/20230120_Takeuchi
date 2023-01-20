<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Http\Requests\FindRequest;
use Illuminate\Support\Facades\Auth;


class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        $tags = Tag::all();
        $user = Auth::id();
        return view('index',[
            'todos' => $todos,
            'tags' => $tags,
            'user' => $user,
        ]);
    }

    public function create(TodoRequest $request)
    {
        $todo =$request->input('content');
        $user = Auth::id();
        $tag_id = $request->input('tag_id');
        unset($request['_token']);
        Todo::create(['content'=>$todo,'user_id'=>$user,'tag_id'=>$tag_id]);
        return redirect('/home');
    }

    public function update(TodoRequest $request)
    {
        $todo = $request->input('content');
        $user= Auth::id();
        $tag_id = $request->input('tag_id');
        unset($request['_token']);
        Todo::find($request->id)->update(['content'=>$todo,'user_id'=>$user,'tag_id'=>$tag_id]);
        return redirect('/home');
    }

    public function delete(Request $request)
    {
        $todo = Todo::find($request->id)->delete();
        return redirect('/home');
    }

    public function find()
    {
        $tags = Tag::all();
        $user = Auth::id();
        return view('find',[
            'tags' => $tags,
            'user' => $user,
        ]);
    }

    public function getSearch(FindRequest $request)
    {
        $gettodo = session()->get('todo');
        $gettag = session()->get('tag');
        if(empty($gettodo) && empty($gettag)) {
            $todos = Todo::all();
        } elseif(empty($gettodo)) {
            $todos = Todo::where('tag_id',$gettag)->get();
        } elseif(empty($gettag)) {
            $todos = Todo::where('content','LIKE',"%{$gettodo}%")->get();
        } else {
            $todos = Todo::where('tag_id',$gettag)->where('content','LIKE',"%{$gettodo}%")->get();
        }

        $user = Auth::id();
        $tags = Tag::all();
        
        return view('find',[
            'todos' => $todos,
            'tags' => $tags,
            'user' => $user,
        ]);
    }

    public function search(FindRequest $request)
    {
        session()->put('todo',$request->input('content'));
        session()->put('tag',$request->input('tag_id'));
        if(empty($request->content) && empty($request->tag_id)) {
            $todos = Todo::all();
        } elseif(empty($request->content)) {
            $todos = Todo::where('tag_id',$request->input('tag_id'))->get();
        } elseif(empty($request->tag_id)) {
            $todos = Todo::where('content','LIKE',"%{$request->input('content')}%")->get();
        } else {
            $todos = Todo::where('tag_id',$request->input('tag_id'))->where('content','LIKE',"%{$request->input('content')}%")->get();
        }
        $user = Auth::id();
        $tags = Tag::all();
        unset($request['_token']);
        

        return view('find',[
            'todos' => $todos,
            'tags' => $tags,
            'user' => $user,
        ]);
    }

    public function findUpdate(TodoRequest $request)
    {
        $todo = $request->input('content');
        $user= Auth::id();
        $tag_id = $request->input('tag_id');
        unset($request['_token']);
        Todo::find($request->id)->update(['content'=>$todo,'user_id'=>$user,'tag_id'=>$tag_id]);
        return redirect('/search');
    }

    public function findDelete(Request $request)
    {
        $todo = Todo::find($request->id)->delete();
        return redirect('/search');
    }
}