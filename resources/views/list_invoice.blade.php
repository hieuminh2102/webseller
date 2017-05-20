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
    a{
        text-decoration: none!important;
    }
    a.update-status{
        color: green;
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
    $('.update-status').click(function(event) {
    event.preventDefault();

    var element_id = $(this).attr('id'),
        _this   = this,
        message_span = $(this).siblings('.message');

    var html_loading    = '<span><i class="fa fa-spin fa-spinner"></i></span>',
        html_success    = '<span class="alert-success">Success</span>',
        html_error      = '<span class="alert-danger">Error</span>';

    $(html_loading).appendTo($(message_span));
    $.ajax({
        type: 'GET',
        url: "/invoice-info/update-invoice/" + element_id,
        success: function (data) {
            if((data != "Invoice Not Found") || (data != "")){
                $(_this).text(data);
            }
            $(message_span).children($(html_loading)).remove();
            $(html_success).appendTo($(message_span));
            $(message_span).children($(html_success)).fadeOut(1000);
        },
        error: function (){
            $(_this).siblings($(html_loading)).remove();
            $(html_error).appendTo($(message_span));
        }
    });
});

</script>
@endsection
