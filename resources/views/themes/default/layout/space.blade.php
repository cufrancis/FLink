@extends('theme::layout.public')
@section('css')
    <link href="{{ asset('/css/default/space.css')}}" rel="stylesheet">
@endsection

@section('jumbotron')
    <header class="space-header">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <a class="text-left" href="{{ route('auth.space.index',['user_id'=>$user->id]) }}"><img class="avatar-128" src="{{ route('website.image.avatar',['avatar_name'=>$user->id.'_big'])}}" alt="{{ $user->name }}"></a>
                </div>
                <div class="col-md-7">
                    <div class="space-header-name h3">
                        {{ $user->name }}  @if($user->title)<small> - {{ $user->title }}</small>  @endif
                        {{-- @if($user->userData->authentication_status === 1)
                        <div class="space-header-authentication pull-right">
                            <span class="space-header-item"><i class="fa fa-user fa-border text-blue" aria-hidden="true"></i> 实名认证</span>
                            <span class="space-header-item"><i class="fa fa-graduation-cap fa-border" aria-hidden="true"></i> 专业认证</span>
                        </div>
                        @endif --}}
                    </div>
                    <hr />
                    {{-- <div class="space-header-social">
                        <span class="space-header-item">性别： @if($user->gender===1) <i class="fa fa-mars"></i> @elseif($user->gender===2) <i class="fa fa-venus"></i> @else <i class="fa fa-genderless"></i> @endif</span>
                        {{-- <span class="space-header-item"><i class="fa fa-map-marker"></i> {{ Area()->getName($user->province) }} @if($user->city>0 &&  Area()->getName($user->province)!=Area()->getName($user->city)) - {{ Area()->getName($user->city) }} @endif</span> --}}
                        {{-- <span class="space-header-item"><i class="fa fa-calendar"></i> 注册于 {{ $user->created_at->toDateString() }}</span> --}}
                    {{-- </div>  --}}
                    {{-- @if($user->userData->authentication_status === 1)
                    <div class="space-authentication-skill mt-15"><p>擅长：{{ $user->authentication->skill }}</p></div>
                    @endif --}}
                    <div class="space-header-desc mt-15"><p>{{ $user->description }}</p></div>
                </div>
                <div class="col-md-3">
                    <div class="mt-10">
                        @if(Auth()->check() && Auth()->user()->id === $user->id)
                            <a href="{{ route('auth.profile.base') }}" class="btn mr-10 btn-primary">编辑个人资料</a>
                        @else
                        @if(Auth()->check() && Auth()->user()->isFollowed(get_class($user),$user->id))
                            <button type="button" id="follow-button" class="btn mr-10 btn-success active" data-source_type = "user" data-source_id = "{{ $user->id }}"  data-show_num="true"  data-toggle="tooltip" data-placement="right" title="" data-original-title="关注后将获得更新提醒">已关注</button>
                        @else
                            <button type="button" id="follow-button" class="btn mr-10 btn-success" data-source_type = "user" data-source_id = "{{ $user->id }}"  data-show_num="true" data-toggle="tooltip" data-placement="right" title="" data-original-title="关注后将获得更新提醒">关注</button>
                        @endif
                        {{-- <a class="btn btn-warning mr-10" href="{{ route('ask.question.create') }}?to_user_id={{ $user->id }}">向TA求助</a> --}}
                        <button class="btn btn-default btnMessageTo" data-toggle="modal" data-target="#sendTo_message_model"   data-to_user_id = "{{ $user->id }}" data-to_user_name="{{ $user->name }}" >发私信</button>
                        {{--<a class="btn mr-10 btn-default">举报</a>--}}
                        @endif
                    </div>
                    <div class="space-header-info row mt-30">
                        <div class="col-md-4">
                            {{-- <span class="h3"><a href="{{ route('auth.space.coins',['user_id'=>$user->id]) }}">{{ $user->userData->coins }}</a></span><span>金币数</span> --}}
                        </div>
                        <div class="col-md-4">
                            {{-- <span class="h3"><a href="{{ route('auth.space.credits',['user_id'=>$user->id]) }}">{{ $user->userData->credits }}</a></span> --}}
                            <span>经验值</span>
                        </div>
                        <div class="col-md-4">
                            {{-- <span class="h3"><a id="follower-num" href="{{ route('auth.space.followers',['user_id'=>$user->id]) }}" >{{ $user->userData->followers }}</a></span><span>个粉丝</span> --}}
                        </div>
                    </div>
                    <div class="mt-10 border-top" style="color:#999;padding-top:10px; ">
                        {{-- <i class="fa fa-paw"></i> 主页被访问 {{ $user->userData->views }} 次 --}}
                    </div>
                </div>
            </div>
        </div>
    </header>
@endsection


@section('content')
	{{-- {{dd(request()->route()->getName())}} --}}
    <div class="row mt-30">
        <div class="col-md-2">
            <ul class="nav nav-pills nav-stacked space-nav">
                @if(Auth()->check() && Auth()->user()->id === $user->id)
                    <li @if(request()->route()->getName() == 'auth.space.index') class="active" @endif ><a href="{{ route('auth.space.index',['user_id'=>$user->id]) }}">我的主页</a></li>
                    <li @if(request()->route()->getName() == 'auth.space.links') class="active" @endif ><a href="{{ route('auth.space.links',['user_id'=>$user->id]) }}">我的链接</a></li>
                    
                    <li @if(request()->route()->getName() == 'auth.space.articles') class="active" @endif ><a href="{{ route('auth.space.links',['user_id'=>$user->id]) }}">我的文章</a></li> 
                    <li role="separator" class="divider"><a></a></li>
                    <li @if(request()->route()->getName() == 'auth.space.coins') class="active" @endif ><a href="{{ route('auth.space.coins',['user_id'=>$user->id]) }}">我的金币</a></li>
                    <li @if(request()->route()->getName() == 'auth.space.exp') class="active" @endif ><a href="{{ route('auth.space.exp',['user_id'=>$user->id]) }}">我的经验</a></li>
                    <li @if(request()->route()->getName() == 'auth.space.followers') class="active" @endif ><a href="{{ route('auth.space.followers',['user_id'=>$user->id]) }}">我的粉丝</a></li>
                    <li @if(request()->route()->getName() == 'auth.space.attentions') class="active" @endif ><a href="{{ route('auth.space.attentions',['user_id'=>$user->id,'source_type'=>'questions']) }}">我的的关注</a></li>
                    <li @if(request()->route()->getName() == 'auth.space.collections') class="active" @endif ><a href="{{ route('auth.space.collections',['user_id'=>$user->id,'source_type'=>'questions']) }}">我的的收藏</a></li>
                @else
                    <li @if(request()->route()->getName() == 'auth.space.index') class="active" @endif ><a href="{{ route('auth.space.index',['user_id'=>$user->id]) }}">他的主页</a></li>
                    <li @if(request()->route()->getName() == 'auth.space.links') class="active" @endif ><a href="{{ route('auth.space.links',['user_id'=>$user->id]) }}">他的回答</a></li>
                    <li @if(request()->route()->getName() == 'auth.space.links') class="active" @endif ><a href="{{ route('auth.space.links',['user_id'=>$user->id]) }}">他的提问</a></li>
                    <li @if(request()->route()->getName() == 'auth.space.links') class="active" @endif ><a href="{{ route('auth.space.links',['user_id'=>$user->id]) }}">他的文章</a></li>
                    <li role="separator" class="divider"><a></a></li>
                    <li @if(request()->route()->getName() == 'auth.space.coins') class="active" @endif ><a href="{{ route('auth.space.coins',['user_id'=>$user->id]) }}">他的金币</a></li>
                    <li @if(request()->route()->getName() == 'auth.space.exp') class="active" @endif ><a href="{{ route('auth.space.exp',['user_id'=>$user->id]) }}">他的经验</a></li>
                    <li @if(request()->route()->getName() == 'auth.space.followers') class="active" @endif ><a href="{{ route('auth.space.followers',['user_id'=>$user->id]) }}">他的粉丝</a></li>
                @endif
            </ul>
        </div>
        <!-- Nav tabs -->
        <div class="col-md-10">
            @yield('space_content')
        </div>
    </div>
@endsection
