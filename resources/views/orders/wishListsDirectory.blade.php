@extends('layouts.master')
@section('title')@parent - {{trans('store.your_wish_lists') }} @stop
@section('page_class') 'products_view' @stop

@section('css')
    @parent
@stop

@section('content')
    @parent

    @section('center_content')

    @include('partial.message')

    <div class="panel panel-primary">
        
        <div class="panel-heading">

            <div class="row">
                <div class="col-md-8 text-left">
                    <h6><span class="glyphicon glyphicon-gift"></span>&nbsp;{{trans('store.your_wish_lists') }}</h6>
                </div>
                <div class="col-md-4 text-right">
                    <button ng-controller="ModalCtrl" ng-click="modalOpen({templateUrl:'/wishes/create',controller:'WishListControllerModal',resolve:'wishList'})" class="btn btn-warning btn-sm">
                    <span class="glyphicon glyphicon-plus"></span>&nbsp;
                    {{ trans('store.CreateWishList') }}
                    </button>
                </div>
            </div>

        </div>
        
        <div class="panel-body">

            @if (is_object($orders) && count($orders) > 0)
                <div class="row">
                    <div class="col-md-6 col-xs-8 text-left">
                        <h6>{{ trans('globals.name') }}</h6>
                    </div>
                    
                    <div class="col-md-3 col-xs-4 text-center">
                        <h6>{{ trans('store.items') }}</h6>
                    </div>
                    
                    <div class="col-sm-3 text-center hidden-xs hidden-sm">
                        <h6>{{ trans('store.wish_list_view.update_label') }}</h6>
                    </div>
                </div>
                
                <hr>
            
                @foreach ($orders as $order)
                    <?php
                    $order->description = $order->description!='' ? $order->description : trans('store.basic_wish_list');
                    ?>
                    <div class="row">
                        <div class="col-md-6 col-xs-8 text-left">
                            <a href="@if ($order->details->count()>0) {{ route('orders.show_wish_list_by_id', [$order->id]) }} @else javascript:void(0) @endif">{{ $order->description }}</a>
                        </div>
                        <div class="col-md-3 col-xs-4 text-center">
                            <a href="@if ($order->details->count()>0) {{ route('orders.show_wish_list_by_id', [$order->id]) }} @else javascript:void(0) @endif">{{ $order->details->count() }}</a>
                        </div>

                        <div class="col-sm-3 text-center hidden-xs hidden-sm">
                            <a href="@if ($order->details->count()>0) {{ route('orders.show_wish_list_by_id', [$order->id]) }} @else javascript:void(0) @endif">{{ $order->updated_at }}</a>
                        </div>
                    </div>
                    <hr>
                @endforeach
            @else
                
                <div class="row">&nbsp;</div>
                <div class="row">&nbsp;</div>
                <div class="row">&nbsp;</div>
                <div class="row">
                    <div class="col-lg-12 text-center">{{ trans('store.wish_list_view.empty_directory_message') }}</div>
                </div>
                <div class="row">&nbsp;</div>
                <div class="row">&nbsp;</div>
                <div class="row">&nbsp;</div>
    
            @endif

        </div> {{-- panel body --}}

        <div class="panel-footer clearfix">
            @if (is_object($orders) && count($orders) > 0)
                <div class="row">
                    <div class="col-md-12">
                        {{ trans('store.priceDisclaimer') }}
                    </div>
                </div>
                <div class="row">&nbsp;</div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <a class="btn btn-success btn-sm" href="{{ route('products') }}">
                        <span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;
                        {{trans('store.continue_shopping')}}
                    </a>
                </div>
            </div>
        </div> {{-- panel footer --}}

    </div> {{-- panel --}}

    @endsection
@stop