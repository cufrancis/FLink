@extends('theme::layout.public')

@section('content')
  <ul>
      {{-- {{dd($links)}} --}}
  @foreach($links as $link)
      {{-- {{dd($link->userInfo)}} --}}
    <div class="">
        <li>
            <h4>
                <a href="{{ route('website.link.voteUp', $link->id) }}"><i class="fa fa-btn glyphicon glyphicon-thumbs-up"></i></a>{{ $link->vote_up }} 
                <a href="{{ route('website.link.voteDown', $link->id) }}"><i class="fa fa-btn glyphicon glyphicon-thumbs-down"></i></a> | 
                <a href="{{ url('/link', $link->id)}}">{{ $link->title }}</a>
            </h4>
        </li>
        @if($link->published_at)
            {{ $link->published_at->diffForHumans() }}
        @endif
         <a href="{{ route('website.user.index', $link->user->id) }}">{{ $link->user->name }}</a> 分享于
    </div>
    <hr />
  @endforeach
  </ul>
@endsection

@section('footer')
    
@endsection
