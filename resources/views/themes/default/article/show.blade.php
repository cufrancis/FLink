@extends('theme::layout.public')

@section('content')
<h3><center><a href="{{ $article->link }}">{{$article->title}}</a></center></h3>

<p>{{$article->content}} <small><em>(点击标题进入网站)</em></small></p>
@endsection

@section('footer')
  <a href="{{url('/') }}">返回首页</a>
@endsection
