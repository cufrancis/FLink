@extends('adminTheme::layout.public')

@section('content')
    <ul> <h4>系统设置</h4>
        <li><a href="{{ route('admin.setting.website') }}">系统设置</a></li>
        <li><a href="{{ route('admin.setting.time') }}">时间设置</a></li>
    </ul>
    
    <ul>
        {{-- <li><a href="{{ route('admin.topics.create') }}">新增话题</a></li> --}}
        <li><a href="{{ url('admin/link') }}">链接管理</a></li>
    </ul>

@endsection
