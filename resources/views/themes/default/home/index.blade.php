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
                <a href="{{ $link->url }}" target="_blank">{{ $link->title }}</a>
                <!-- 如果在用户收藏链接中没有此链接，则显示添加收藏，如果有，则显示已收藏，并且不可点击 -->
                @if(!Auth::guest())
                    @if(!Auth::guest() && $user->isLinkCollection($link->id))
                        <div><small>已收藏（<a href="{{ route('website.link.deCollection', $link->id) }}">取消收藏</a>）</small></div>
                    @else
                        <div><small><a href="{{ route('website.link.collection', $link->id) }}">收藏链接</a></small></div>
                    @endif
                @else
                    <div><small><a href="{{ route('website.link.collection', $link->id) }}">收藏链接</a></small></div>
                @endif
                {{-- @if(!Auth::guest() && $user->isLinkCollection($link->id))
                    <div><small>已收藏（<a href="{{ route('website.link.deCollection', $link->id) }}">取消收藏</a>）</small></div>
                @else
                    <div><small><a href="{{ route('website.link.collection', $link->id) }}">收藏链接</a></small></div>
                @endif --}}
            </h4>
        </li>
				{{-- {{dd($link->published_at)}} --}}
        @if($link->published_at)
            {{ $link->published_at->diffForHumans() }}
        @endif
        {{-- {{dd($link->topicss)}} --}}
         <a href="{{ route('auth.space.index', $link->user->id) }}">{{ $link->user->name }}</a> 分享于@if($link->topicss)
             @foreach($link->topicss as $topics)
                 <span class="label label-primary"><a href="{{route('website.topic.index', $topics->id)}}">{{ $topics->name }}</a></span>
             @endforeach
         @endif
    </div>
    <hr />
  @endforeach
  </ul>
  {!! $links->links() !!}
@endsection


@section('footer')

@endsection
