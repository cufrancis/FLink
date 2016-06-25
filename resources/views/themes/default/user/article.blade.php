@extends('theme::layout.public')

@section('content')
  <ul>
    @foreach($userInfo->articleData as $article)
      @if(Auth::check() && Auth::user()->id === $article->author_id)
        <li><a href="{{ url('article/'.$article->id.'/edit') }}">{{ $article->title }}</a></li>
      @else
        <li><a href="{{ url('article/'.$article->id) }}">{{ $article->title }}</a></li>
      @endif
    @endforeach
  </ul>
@endsection
