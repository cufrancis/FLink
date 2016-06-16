@extends('theme::layout.public')

@section('content')
  <ul>
  @foreach($articles as $article)
    <li><a href="{{ url('/article', $article->id)}}">{{ $article->title }}</a></li>
  @endforeach
  </ul>
@endsection

@section('footer')
    
@endsection
