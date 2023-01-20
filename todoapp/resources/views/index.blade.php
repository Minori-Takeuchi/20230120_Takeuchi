@extends('layouts.default')

@section('title','Todo List')

@section('todo')
  <a href="{{route('find')}}" class="btn btn-search">タスク検索</a>
  <ul>  
  @error('content')
    <li>{{$message}}</li>
  </ul>
  @enderror
  <form action="/create" method="post" class="frex">
  @csrf
    <input type="text" class="input-create" name="content">
    <select name="tag_id" class="select-tag">
    @foreach($tags as $tag)
      <option value="{{$tag->id}}">{{$tag->item}}</option>
    @endforeach
    </select>
    <button class="btn btn-create">追加</button>
  </form>
  <table>
    <tr>
      <th>作成日</th>
      <th>タスク名</th>
      <th>タグ</th>
      <th>更新</th>
      <th>削除</th>
    </tr>
    @foreach($todos as $todo)
    <tr>
      <td>{{$todo->created_at}}</td>
      <form action="/update" method="post">
      @csrf
        <td><input type="text" class="input-update" name="content" value="{{$todo->content}}"></td>
        <td>
          <select name="tag_id" class="select-tag">
          @foreach($tags as $tag)
          <option value = "{{$tag->id}}" @if($todo->tag_id == $tag->id) selected @endif>{{$tag->item}}</option>
          @endforeach
          </select>
        </td>
        <input type="hidden" name="id" value="{{$todo->id}}">
        <td><button class="btn btn-update">更新</button></td>
      </form>
      <form action="/delete" method="post">
      @csrf
        <input type="hidden" name="id" value="{{$todo->id}}">
        <td><button class="btn btn-delete">削除</button></td>
      </form>
    </tr>
    @endforeach
  </table>
@endsection