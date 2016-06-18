@extends('theme::layout.public')


@section('content')
  {{-- {{dd($article)}} --}}
  <div class="wrap publish">
    <div class="container">
      
      <form action="{{ url('/article/'.$action[0]) }}" method="POST" role="form">
        {!! csrf_field() !!}
        
        <div class="form-group">
          <label for="title" class="sr-only">标题</label>
          <input id="myTitle" type="text" name="title" required data-error="" autocomplete="off" class="form-control tagClose input-lg" placeholder="标题" value="{{ $article->title }}">
        </div>
        
        <div class="form-group">
          <label for="link" class="sr-only">链接</label>
          <input id="link" type="text" name="link" class="form-control input-lg" placeholder="输入网址链接,必须要加http:// 或者https://" value="{{ $article->link }}"/>
        </div>
        
        <div class="form-group">
          <div id="questionText" class="editor">
            <textarea class="mono form-control wmd-input tabIndent" rows="5" placeholder="简介，尽量精简" name="content">{{ $article->content  }}</textarea>
          </div>
        </div>
        
        <div class="form-group">
            <div class="col-md-6 col-md-offset-11">
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn glyphicon glyphicon-floppy-saved"></i> {{ $action[1] }}
                </button>
            </div>
        </div>
        
  </form>
</div>
</div>
@endsection
