@extends('adminTheme::layout.public')

@section('content')

    <div class="row mt-10">
        <ol class="breadcrumb">
            <li><a href="{{ route('admin.topics.index') }}">文章</a></li>
            <li class="active">撰写文章</li>
        </ol>
        <form id="articleForm" method="POST" role="form" action="{{ route('admin.topics.store') }}">
            {!! csrf_field() !!}

            <div class="form-group">
                <label for="title">话题名称:</label>
                <input id="title" type="text" name="name"  class="form-control input-lg" placeholder="" value="" />
                {{-- <机翻名称> --}}
            </div>

            <div class="form-group">
                <label for="editor">简介</label>
                <textarea name="desc" id="article_editor" class="form-control"  style="height:300px;"></textarea>
            </div>

            <div class="row mt-20">
                <div class="col-md-4 col-md-offset-8">
                    <button type="submit" class="btn btn-primary pull-right">发布话题</button>
                </div>
            </div>
        </form>

    </div>

@endsection
