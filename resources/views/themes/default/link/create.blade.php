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
  <div class="wrap publish">
    <div class="container">
      
      <form action="{{ route('website.link.create') }}" method="POST" role="form">
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
            <textarea class="mono form-control wmd-input tabIndent" rows="5" placeholder="简介，尽量精简" name="content">@if(isset($link)){{ $link->content  }}@endif</textarea>
          </div>
        </div>
        
        <div class="form-group">
            {!! Form::label('topics_list','选择话题') !!}
            {!! Form::select('topics_list[]',$topics,null,['class'=>'form-control js-example-basic-multiple','multiple'=>'multiple']) !!}
        </div>
        
        {{-- 话题分类： --}}
        <div class="form-group">
            <select multiple class="form-control" name="topics"> 
                @foreach($topics as $topic)
                    <option value="">{{ $topic }}</option> 
                @endforeach
              
            </select>
        </div>
                
        <div class="form-group">
            <div class="col-md-6 col-md-offset-10">
              @if($action[1] == 'Update')
                  <a href="{{ url('link/'.$link->id.'/delete') }}">删除</a>
              @endif
              
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn glyphicon glyphicon-floppy-saved"></i> 创建
                </button>
            </div>
        </div>
        
  </form>
</div>
</div>
@endsection
