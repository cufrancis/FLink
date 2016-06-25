@extends('theme::layout.public')

@section('content')
  <ul>
    @foreach($userInfo->linkData as $link)
      @if(Auth::check() && Auth::user()->id === $link->user_id)
        <li><a href="{{ url('link/'.$link->id.'/edit') }}">{{ $link->title }}</a></li>
      @else
        <li><a href="{{ url('link/'.$link->id) }}">{{ $link->title }}</a></li>
      @endif
    @endforeach
  </ul>
@endsection
