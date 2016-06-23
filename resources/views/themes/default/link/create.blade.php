@extends('theme::layout.public')


@section('content')
  {{-- {{dd($link)}} --}}
  <div class="wrap publish">
    <div class="container">
      
      <form action="{{ url('/link/'.$action[0]) }}" method="POST" role="form">
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
        
        <!-- Single button -->
        话题分类：
        <div class="form-group">
            <select multiple class="form-control" name="topics"> 
                @foreach($topics as $topic)
                    <option value="">{{ $topic->name }}</option> 
                @endforeach
              
            </select>
        </div>
        
        <div class="form-group">
            <div class="col-md-6 col-md-offset-10">
              @if($action[1] == 'Update')
                  <a href="{{ url('link/'.$link->id.'/delete') }}">删除</a>
              @endif
              
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-btn glyphicon glyphicon-floppy-saved"></i> {{ $action[1] }}
                </button>
            </div>
        </div>
        
  </form>
</div>
</div>
@endsection
