@extends('admin.module.master')
@section('content')
{{-- @dd($categories); --}}
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 class="text-uppercase">{{ trans('product.manage')}}</h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          @include('admin.module.message')
        </div> 
        <div class="col-xs-12">
          <!-- ./product info box -->
          <div class="box box-primary">
            <div class="box-header with-border">
                <!-- form start -->            
                <form class="form-import col-sm-6 col-sm-offset-3 form-horizontal form-label-left" 
                  method="post" action="{{ route('admin.product.import.process')}}" enctype="multipart/form-data">
                  @csrf
                  <h2 class="text-center padding-bot-20">@lang('common.upload')</h2>
                  <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <input type="file" id="csv_file" name="csv_file">
                      @if ($errors->has('csv_file'))
                        <span class="help-block">
                          <strong>{{ $errors->first('csv_file') }}</strong>
                        </span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="padding-20 col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                      <button type="reset" class="btn btn-primary">@lang('common.reset')</button>
                      <button type="submit" class="btn btn-success">@lang('common.submit')</button>
                    </div>
                  </div>
                </form>
            </div>
            <!-- /.box-header -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
  </div>
@endsection
