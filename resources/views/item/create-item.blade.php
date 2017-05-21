@extends('layouts.app')
<style>
    .btn-toolbar{
        float: right;
    }
</style>
@section('content')
<div class="container">
    @if(\Session::has('message'))
    <div class="col-md-offset-2 col-md-5">
        <div class="col-md-12 alert-success">
            {{\Session::get('message')}}
        </div>
        <a href="/" class="btn btn-info">Back</a> 
    </div>
    @else
    <div class="col-md-offset-1 col-md-8">
        {!!$form!!}
    </div>
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="/js/autoNumeric.js"></script>
<script type="text/javascript">
        $("#cost").autoNumeric('init', {
            aSep: '.',
            aDec: ',',
            vMax: '9999999999',
            aSign: '$'});
</script>
@endif
@endsection
