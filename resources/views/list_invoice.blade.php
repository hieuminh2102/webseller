@extends('layouts.app')
<style>
    h1{
        text-align: center;
    }
    table{
        line-height: 30px;
    }
    .table th,
    .table td{
        text-align: center;
        border: 1px solid black!important;
    }
    .table{
        margin-top: 30px;
        border: 1px solid black;
    }
    .table th{
        background: #f2dede;
    }
    .table td{
        background: #faebcc;
    }

</style>
@section('content')
<div class="container">
    <div class="invoice col-md-12">
        <div class="col-md-12" style="background: white;">
            <div class="panel" style="border-bottom: 3px solid rgba(0, 0, 0, 0.21); margin-bottom: 20px;">
                <h3>Danh sách hóa đơn</h3>
            </div>
            <div class="col-md-12">
                {!!$grid!!}
            </div>
        </div>

    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
</script>
@endsection
