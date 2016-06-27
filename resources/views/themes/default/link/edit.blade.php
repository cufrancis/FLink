@extends('theme::layout.public')

@section('header')
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

@endsection

@section('footer')
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
       $(function() {
           $(".js-example-basic-multiple").select2({
               placeholder: "添加标签"
           });
       });
   </script>
@endsection

@section('content')
  {{-- {{dd($link)}} --}}
  {{-- {{dd($action)}} --}}
  <div class="wrap publish">
    <div class="container">
      
      {{-- 可以自动获取表单初始值 --}}
      {!! Form::model($link, ['route' => ['website.link.edit', $link->id]]) !!} 
      <form action="{{ route('website.link.edit', ['id' => $link->id]) }}" method="POST" role="form">
        {!! csrf_field() !!}
        
        <div class="form-group">
          <label for="title" class="sr-only">标题</label>
          <input id="myTitle" type="text" name="title" required data-error="" autocomplete="off" class="form-control tagClose input-lg" placeholder="标题" @if(isset($link))value="{{ $link->title }}"@endif>
        </div>
        
        <div class="form-group">
          <label for="link" class="sr-only">链接</label>
          <input id="link" type="text" name="url" class="form-control input-lg" placeholder="输入网址链接,必须要加http:// 或者https://" @if(isset($link))value="{{ $link->url }}"@endif/>
        </div>
        
        <div class="form-group">
          <div id="questionText" class="editor">
              {!! Form::textarea('content', $link->content, ['class' => 'mono form-control wmd-input tabIndent', 'placeholder' => '简介']) !!}
          </div>
        </div>
        
        <div class="form-group">
            {!! Form::label('published_at', '发布日期') !!}
            {!! Form::input('date', 'published_at', $link->published_at->format('Y-m-d'), ['class' => 'form-control']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('topics_list','选择话题') !!}
            {!! Form::select('topics_list[]',$topics,null,['class'=>'form-control js-example-basic-multiple','multiple'=>'multiple']) !!}
        </div>
        
        <div class="form-group">
            <div class="col-md-6 col-md-offset-10">
                  <a href="{{ url('link/'.$link->id.'/delete') }}">删除</a>
              
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn glyphicon glyphicon-floppy-saved"></i> 更新
                </button>
            </div>
        </div>
        
  {!! Form::close() !!}
</div>
</div>
@endsection
