@extends('theme::layout.space')

@section('seo')
    <title>@if(Auth()->check() && Auth()->user()->id === $userInfo->id )我的@else他的@endif首页 - {{ Setting()->get('website_name') }}</title>
@endsection

@section('space_content')
  <ul>
    <li>{{ $who }}的名称：{{ $userInfo->name }}</li>
    <li>{{ $who }}的简介：{{ $userInfo->desc }}</li>
    <li>{{ $who }}的邮箱：{{ $userInfo->email }}</li>
    <li>{{ $who }}的手机号：{{ $userInfo->mobile }}</li>
    <li>{{ $who }}的性别：{{ $userInfo->gender }}</li>
    <hr />
    <li>{{ $who }}分享的连接：<a href="{{ url('user/'.$userInfo->id.'/link') }}">{{ count($userInfo->linkData) }}</a></li>
  </ul>
@endsection
