<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('/css/style.css')}}">
  <title>COACHTECH</title>
</head>
<body>
  <div class="container">
    <div class="card">
      <div class="frex card__header">
        <p class="card__ttl">@yield('title')</p>
          <div class="frex auth">
            <p class="detail">「{{Auth::user()->name}}」でログイン中</p>
            <form action="{{route('logout')}}" method="post">
            @csrf
              <button type="submit" class="btn btn-logout">ログアウト</button>
            </form>
          </div>
      </div>
      <div class="todo">
        @yield('todo')
      </div>
    </div>
  </div>
</body>
</html>