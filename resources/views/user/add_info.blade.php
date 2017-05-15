@extends('layouts.app')

@section('content')
@if(\Session::has('message'))
    <div class="col-md-offset-2 col-md-5">
        <div class="col-md-12 alert-success">
            {{\Session::get('message')}}
        </div>
        <a href="/" class="btn btn-info">Back</a> 
    </div>
@else
<div class="col-md-offset-2 col-md-5">
    {!!$form!!}
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/js/jquery.numeric.js"></script>
<script>
    $("#phone").numeric();
</script>
@endif
@endsection
