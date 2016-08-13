@extends('theme::layout.space')

@section('seo')
  <title>@if(Auth()->check() && Auth()->user()->id === $user->id )我的@else他的@endif回答 - {{ Setting()->get('website_name') }}</title>
@endsection

@section('space_content')
	{{-- <ul>
		@foreach($user->linkData as $link)
			@if(Auth::check() && Auth::user()->id === $link->user_id)
				<li><a href="{{ url('link/'.$link->id.'/edit') }}">{{ $link->title }}</a></li>
			@else
				<li><a href="{{ url('link/'.$link->id) }}">{{ $link->title }}</a></li>
			@endif
		@endforeach
	</ul> --}}
	{{-- {{dd($user->linkData)}} --}}
	<div class="col-md-10 profile-mine">
		<h4 class="profile-mine__heading">
			<span>@if(Auth::user()->id == $user->id)我@else 他 @endif分享的链接</span>
			<div class="pull-right profile-mine__heading--filter">
				<span>排序: </span>
				<div class="btn-group btn-group-xs">
					<a class="btn btn-default active " href="/u/dokelung/answers?sort=created" role="button">时间</a>
					<a class="btn btn-default  " href="/u/dokelung/answers?sort=vote" role="button">投票</a>
				</div>
			</div>
		</h4>
		<ul class="profile-mine__content">
			@foreach($user->linkData as $link)
				{{-- {{dd($link)}} --}}
				<li>
					<div class="row">
						<div class="col-md-1">
							<span class="label label-warning">{{$link->vote_up}}票</span>
						</div>
						<div class="col-md-9 profile-mine__content--title-warp">
							<a class="profile-mine__content--title" href="{{route('website.link.detail', ['id' => $link->id])}}">{{$link->title}}</a> 
						</div>
						<div class="col-md-2">
							<span class="profile-mine__content--date">{{$link->published_at->diffForHumans()}}</span>
						</div>
					</div>
				</li>
			@endforeach
		</ul>
		<div class="text-center">
			<ul class="pagination">
				<li class="active"><a href="javascript:void(0);">1</a></li>
				<li><a href="/u/dokelung/answers?page=2">2</a></li>
				<li><a href="/u/dokelung/answers?page=3">3</a></li>
				<li><a href="/u/dokelung/answers?page=4">4</a></li>
				<li><a href="/u/dokelung/answers?page=5">5</a></li>
				<li class="next"><a rel="next" href="/u/dokelung/answers?page=2">下一页</a></li>
			</ul>
		</div>
	</div>
@endsection
