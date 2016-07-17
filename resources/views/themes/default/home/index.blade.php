@extends('theme::layout.public')

@section('content')
  <ul>
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
				{{-- {{dd($link->published_at)}} --}}
        @if($link->published_at)
            {{ $link->published_at->diffForHumans() }}
        @endif
        {{-- {{dd($link->topicss)}} --}}
         <a href="{{ route('auth.space.index', $link->user->id) }}">{{ $link->user->name }}</a> 分享于@if($link->topicss)
             @foreach($link->topicss as $topics)
                 <span class="label label-primary">{{ $topics->name }}</span>
             @endforeach
         @endif
    </div>
    <hr />
  @endforeach
  </ul>
@endsection

@section('footer')
    
@endsection
