<?php
$class = Session::get('messageClass') ? Session::get('messageClass') : 'alert alert-success';

$m = Session::get('message');
$m = $m ? (is_array($m) ? Html::ul($m) : '<p>'.$m.'</p>') : '';

$e = $errors->any() ? Html::ul($errors->all()) : '';

Session::forget('message');
Session::forget('messageClass');
Session::save();
?>
@if($m!='' || $e!='')
    <div ng-controller="MessageController"></div>
    @section('scripts')
    @parent
        <script>
            (function(app){
                app.controller('MessageController',['notify',function(notify) {
                  @if($m!='')
                    notify({duration:5000,messageTemplate:'{!! $m !!}',classes:'{{$class}}'});
                  @endif
                  @if($e!='')
                    notify({duration:5000,messageTemplate:'{!! $e !!}',classes:'alert alert-danger'});
                  @endif
                }]);
            })(angular.module("AntVel"));
        </script>
    @stop
@endif