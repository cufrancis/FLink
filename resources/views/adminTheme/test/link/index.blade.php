@extends('adminTheme::layout.public')

@section('title')文章管理@endsection
@section('content')
    <section class="content-header">
        <h1>
            文章管理
            <small>管理系统的所有文章</small>
        </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="btn-group">
                                    <a href="{{ route('website.link.create') }}" target="_blank" class="btn btn-default btn-sm" data-toggle="tooltip" title="创建新文章"><i class="fa fa-plus"></i></a>
                                    {{-- <button class="btn btn-default btn-sm" data-toggle="tooltip" title="通过审核" onclick="confirm_submit('item_form','{{  route('admin.article.verify') }}','确认审核通过选中项？')"><i class="fa fa-check-square-o"></i></button> --}}
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.link.destroy') }}','确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="row">
                                    <form name="searchForm" action="{{ route('admin.link.index') }}" method="GET">
                                        {!! csrf_field() !!}
                                        <div class="col-xs-2">
                                            <input type="text" class="form-control" name="user_id" placeholder="作者UID" value="{{ $filter['user_id'] or '' }}"/>
                                        </div>
                                        <div class="col-xs-2">
                                            <input type="text" class="form-control" name="word" placeholder="关键词" value="{{ $filter['word'] or '' }}"/>
                                        </div>
                                        <div class="col-xs-2">
                                            <select class="form-control" name="status">
                                                <option value="-1">不选择</option>
                                                @foreach(trans_common_status('all') as $key => $status)
                                                    <option value="{{ $key }}" @if( isset($filter['status']) && $filter['status']==$key) selected @endif >{{ $status }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-xs-3">
                                            <input type="text" name="date_range" id="date_range" class="form-control" placeholder="时间范围" value="{{ $filter['date_range'] or '' }}" />
                                        </div>
                                        <div class="col-xs-1">
                                            <button type="submit" class="btn btn-primary">搜索</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-body  no-padding">
                        <form name="itemForm" id="item_form" method="POST">
                            {!! csrf_field() !!}
                            <table class="table table-striped">
                                <tr>
                                    <th><input type="checkbox" class="checkbox-toggle" /></th>
                                    <th>标题</th>
                                    <th>作者</th>
                                    <th>收藏/查看</th>
                                    <th>时间</th>
                                    <th>状态</th>
                                    <th>操作</th>
                                </tr>
                                @foreach($links as $link)
                                    <tr>
                                        <td><input type="checkbox" name="id[]" value="{{ $link->id }}"/></td>
                                        <td><a href="{{ route('website.link.detail',['id'=>$link->id]) }}" target="_blank">{{ $link->title }}</a></td>
                                        <td>{{ $link->user->name }}<span class="text-muted">[UID:{{ $link->user_id }}]</span></td>
                                        <td>{{ $link->collections }} / {{ $link->views }}</td>
                                        <td>{{ timestamp_format($link->created_at) }}</td>
                                        <td><span class="label @if($link->status===0) label-danger  @else label-success @endif">{{ trans_common_status($link->status) }}</span> </td>
                                        <td>
                                            <div class="btn-group-xs" >
                                                <a class="btn btn-default" target="_blank" href="{{ route('website.link.edit',['id'=>$link->id]) }}" data-toggle="tooltip" title="编辑"><i class="fa fa-edit"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </form>
                    </div>
                    <div class="box-footer clearfix">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="btn-group">
                                    <a href="{{ route('website.link.create') }}" target="_blank" class="btn btn-default btn-sm" data-toggle="tooltip" title="创建新文章"><i class="fa fa-plus"></i></a>
                                    {{-- <button class="btn btn-default btn-sm" data-toggle="tooltip" title="通过审核" onclick="confirm_submit('item_form','{{  route('admin.article.verify') }}','确认审核通过选中项？')"><i class="fa fa-check-square-o"></i></button> --}}
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.link.destroy') }}','确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="text-right">
                                    <span class="total-num">共 {{ $links->total() }} 条数据</span>
                                    {!! str_replace('/?', '?', $links->render()) !!}
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
