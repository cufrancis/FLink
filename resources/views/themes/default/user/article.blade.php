@extends('theme::layout.public')

@section('content')
  <ul>
    @foreach($userInfo->articleData as $article)
      <li><a href="{{ url('article/'.$article->id.'/edit') }}">{{ $article->title }}</a></li>
    @endforeach
  </ul>
@endsection
