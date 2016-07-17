@extends('adminTheme::layout.public')

@section('title')话题管理@endsection
@section('content')
    <section class="content-header">
        <h1>
            话题管理
            <small>管理系统的所有话题</small>
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
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.topics.destroy') }}','确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                                    <a class="btn btn-default" href="{{ route('admin.topics.create') }}" data-toggle="tooltip" title="编辑"><i class="fa fa-edit"></i></a>
                                </div>
                            </div>
                            <div class="col-xs-9">
                                <div class="row">
                                    <form name="searchForm" action="{{ route('admin.topics.index') }}">
                                        {!! csrf_field() !!}
                                        <div class="col-xs-3">
                                            <input type="text" class="form-control" name="word" placeholder="关键词" value="{{ $filter['word'] or '' }}"/>
                                        </div>
                                        <div class="col-xs-4">
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
                                    <th>ID</th>
                                    <th>图标</th>
                                    <th>名称</th>
                                    <th>简介</th>
                                    <th>粉丝数</th>
                                    <th>创建时间</th>
                                    <th>操作</th>
                                </tr>
                                @foreach($topics as $topic)
                                    <tr>
                                        <td><input type="checkbox" name="id[]" value="{{ $topic->id }}"/></td>
                                        <td>{{ $topic->id }}</td>
                                        <td> @if($topic->logo)
                                                    <img src="{{ route('website.image.show',['image_name'=>$topic->logo]) }}"  style="width: 27px;"/>
                                            @endif
                                        </td>
                                        <td><a href="{{ route('website.index',['name'=>$topic->name,'source_type'=>'admin']) }}" target="_blank">{{ $topic->name }}</a></td>
                                        <td width="50%">{{ $topic->summary }}</td>
                                        <td>{{ $topic->followers }}</td>
                                        <td>{{ timestamp_format($topic->created_at) }}</td>
                                        <td>
                                            <div class="btn-group-xs" >
                                                <a class="btn btn-default" href="{{ route('admin.topics.edit',['id'=>$topic->id]) }}" data-toggle="tooltip" title="编辑"><i class="fa fa-edit"></i></a>
                                            </div>
                                            <div class="btn-group-xs" >
                                                <a class="btn btn-default" href="{{ route('admin.topics.destroy',['id'=>$topic->id]) }}" data-toggle="tooltip" title="删除"><i class="fa fa-edit"></i></a>
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
                                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="删除选中项" onclick="confirm_submit('item_form','{{  route('admin.topics.destroy') }}','确认删除选中项？')"><i class="fa fa-trash-o"></i></button>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="text-right">
                                    <span class="total-num">共 {{ $topics->total() }} 条数据</span>
                                    {!! str_replace('/?', '?', $topics->render()) !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection
