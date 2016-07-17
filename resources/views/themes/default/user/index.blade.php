@extends('theme::layout.space')

@section('seo')
    <title>@if(Auth()->check() && Auth()->user()->id === $user->id )我的@else他的@endif首页 - {{ Setting()->get('website_name') }}</title>
@endsection

@section('space_content')
  <ul>
    <li>{{ $who }}的名称：{{ $user->name }}</li>
    <li>{{ $who }}的简介：{{ $user->desc }}</li>
    <li>{{ $who }}的邮箱：{{ $user->email }}</li>
    <li>{{ $who }}的手机号：{{ $user->mobile }}</li>
    <li>{{ $who }}的性别：{{ $user->gender }}</li>
    <hr />
    {{-- <li>{{ $who }}分享的连接：<a href="{{ url('user/'.$user->id.'/links') }}">{{ count($user->linkData) }}</a></li> --}}
		<li>{{ $who }}分享的连接：<a href="{{route('auth.space.links', ['user_id' => $user->id])}}">{{ count($user->linkData) }}</a></li>
  </ul>
@endsection
