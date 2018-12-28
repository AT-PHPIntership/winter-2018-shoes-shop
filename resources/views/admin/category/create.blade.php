@extends('admin.module.masterpage')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-uppercase">{{ trans('category.manage') }}</h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="box" style="padding: 20px">
        @if (session()->has('message'))
          <div id="alert-message">
            <strong style="padding: 10px 20px; display: block;">{{ session('message') }}</strong>
          </div>
          <script type="text/javascript">
            setTimeout(function(){
              document.getElementById("alert-message").innerHTML = '';
            }, 2000);
          </script>
        @endif
        <div class="row">
          <form class="col-sm-6 col-sm-offset-3 form-horizontal form-label-left" 
            style="background: #ecf0f5; padding:20px;" method="post" action="{{ route('category.store')}}">
            @csrf
            <h2 class="text-center" style="padding-bottom: 20px">@lang('category.create')</h2>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">@lang('category.name')</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control" required placeholder="@lang('category.new')" name="name">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12">@lang('category.parent_name')</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="parent_id">
                  <option value=""></option>
                  @foreach($categories as $category)
                    @if(!$category->parent)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endif
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                <button type="reset" class="btn btn-primary">Reset</button>
                <button type="submit" class="btn btn-success">submit</button>
              </div>
            </div>
          </form>
        </div>
      </div>      
    </section>
  </div>
@endsection