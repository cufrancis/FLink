@extends('theme::layout.public')

@section('content')
<h4><center><a href="{{ route('link.voteUp', $link->id) }}"><i class="fa fa-btn glyphicon glyphicon-thumbs-up
"></i></a> {{ $link->vote_up }} <a href="{{ route('link.voteDown', $link->id) }}"><i class="fa fa-btn glyphicon glyphicon-thumbs-down
"></i></a>  <a href="{{ $link->url }}" target="_blank">{{$link->title}}</a> <small>({{$link->url}})</small></center></h4>
<br />

<p>{{$link->content}} </p>
<hr />

@if($link->created_at){{ $link->created_at->diffForHumans() }}@endif <a href="{{ url('user', $link->user->id) }}">{{ $link->user->name }}</a> 分享于 
@if($link->topicss)
    @foreach($link->topicss as $topics)
        <span class="label label-primary">{{ $topics->name }}</span>
    @endforeach
@endif
@endsection


@section('footer')
    <hr />
  <p><a href="{{url('/') }}">返回首页</a></p>
@endsection
