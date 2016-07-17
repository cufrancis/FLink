@extends('theme::layout.space')

@section('seo')
  <title>@if(Auth()->check() && Auth()->user()->id === $userInfo->id )我的@else他的@endif回答 - {{ Setting()->get('website_name') }}</title>
@endsection
