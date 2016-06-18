@extends('theme::layout.public')

@section('content')
  <ul>
    <li>{{ $who }}的名称：{{ $userInfo->name }}</li>
    <li>{{ $who }}的简介：{{ $userInfo->desc }}</li>
    <li>{{ $who }}的邮箱：{{ $userInfo->email }}</li>
    <li>{{ $who }}的手机号：{{ $userInfo->mobile }}</li>
    <li>{{ $who }}的性别：{{ $userInfo->gender }}</li>
    <hr />
    <li>{{ $who }}分享的连接：<a href="{{ url('user/'.$userInfo->id.'/article') }}">{{ count($userInfo->articleData) }}</a></li>
  </ul>
@endsection
