@extends('layouts.master')
@section('page_class')@parent- {{ trans('about.contact_us') }}@stop
{{-- NAVBAR --}}
@section('navigation')
@include('partial.navigation_basic')
@stop
{{-- CONTENT --}}
@section('content')
<div class="container-fluid">
  <div class="row col-md-12">
    <div class="panel panel-default">
      
      <div class="panel-heading clearfix">
        <h4 class="panel-title pull-left" style="padding-top: 7.5px;"><span class="glyphicon glyphicon-envelope"></span> {{trans('about.contact')}}</h4>
      </div>
      <div class="panel-body">
        <div class="col-sm-12 col-md-12 col-lg-6">
          @include('about.info')
          @include('about.map')
        </div>
        <div class="col-sm-12 col-md-12 col-lg-6">
          @include('about.contact_form')
        </div>
      </div>
    </div>
  </div>
</div>
@stop
@endsection
{{-- Pie de pagina --}}
@section('footer')
@parent
@stop
{{-- Angular --}}
@section('before.angular') @stop
{{-- Javascript --}}
@section('scripts')
@parent
@stop