@extends('theme::layout.public')

@section('content')
<h4><center><a href="{{ route('link.voteUp', $link->id) }}"><i class="fa fa-btn glyphicon glyphicon-thumbs-up
"></i></a> {{ $link->vote_up }} <a href="{{ route('link.voteDown', $link->id) }}"><i class="fa fa-btn glyphicon glyphicon-thumbs-down
"></i></a>  <a href="{{ $link->url }}" target="_blank">{{$link->title}}</a> <small>({{$link->url}})</small></center></h4>
<br />

<p>{{$link->content}} </p>
<hr />

<a href="{{ url('user', $link->userInfo->id) }}">{{ $link->userInfo->name }}</a> 分享于@if($link->created_at)
    {{ $link->created_at->diffForHumans() }}
@endif
@endsection

@section('footer')
    <hr />
  <p><a href="{{url('/') }}">返回首页</a></p>
@endsection
