@extends('admin.module.master')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-uppercase">@lang('category.manage')</h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          @include('admin.module.message')
        </div>
      </div>
      <div class="box padding-y-20">
        <div class="row">
          <form class="form-create col-sm-6 col-sm-offset-3 form-horizontal form-label-left" 
            method="post" action="{{ route('admin.category.store')}}">
            @csrf
            <h2 class="text-center padding-bot-20">@lang('category.create')</h2>
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
                <button type="reset" class="btn btn-primary">@lang('common.reset')</button>
                <button type="submit" class="btn btn-success">@lang('common.submit')</button>
              </div>
            </div>
          </form>
        </div>
      </div>      
    </section>
  </div>
@endsection