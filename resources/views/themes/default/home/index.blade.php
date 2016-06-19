@extends('theme::layout.public')

@section('content')
  <ul>
  @foreach($links as $link)
    <li><a href="{{ url('/link', $link->id)}}">{{ $link->title }}</a></li>
  @endforeach
  </ul>
@endsection

@section('footer')
    
@endsection
