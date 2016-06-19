@extends('theme::layout.public')

@section('content')
<h4><a href="{{ $link->url }}" target="_blank">{{$link->title}}</a> <small>({{$link->url}})</small></h4>

{{ $link->created_at }} <a href="{{ url('user', $link->authorInfo->id) }}">{{ $link->authorInfo->name }}</a> 分享于
{{-- <p>{{$article->content}} </p> --}}
<hr />
{{-- {{dd($article->authorInfo->name)}} --}}
{{-- <p>Created_at {{ $article->created_at }} </p>
<p>updated_at:{{ $article->updated_at }} </p> --}}
{{-- <p>Author: <a href="{{ url('user', $article->authorInfo->id) }}">{{ $article->authorInfo->name }}</a></p> --}}
@endsection

@section('footer')
  <a href="{{url('/') }}">返回首页</a>
@endsection
