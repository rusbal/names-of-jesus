@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left"> Names List </h3>
                    <a href="{{ url('/names/new') }}" class="btn btn-primary pull-right">New</a>
                    <div class="clearfix"></div>
                </div>

            @include('_alerts')

            @if ($names->isEmpty())
                <div class="panel-body">
                    There is no name.
                </div>
            @else
                <div class="panel-body">

                    <div class="form-group" id="sort-messages">
                        <span class="help-block">
                            <strong id="form-sort-messages"></strong>
                        </span>
                    </div>

                    <ul class="list-group" id="names-list">
                    @foreach($names as $name)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-xs-1 name-order" data-id="{{ $name->id }}">
                                    {{ $name->order }}
                                </div>
                                <div class="col-xs-9">
                                    <span class="drag-handle">☰</span>
                                    <a href="{{ route('revision', [$name->id, $name->latestRevision->id]) }}">{{ $name->latestRevision->name }} </a>
                                </div>
                                <div class="col-xs-2">
                                    <div class="pull-right">
                                        <span class="badge">14</span>
                                        <span class="badge">1</span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                    </table>
                </div>
            @endif

            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')
<script>
$(function(){
    var collectNameOrder = function() {
        var order = Array();

        $('.name-order').each(function(){
            order.push($(this).data('id'));
        });
        return order;
    };

    var reNumber = function(order_arr) {
        var idx = 0;

        $('.name-order').each(function(){
            $(this).html(order_arr[idx]);
            idx += 1;
        });
    };

    var ajaxSetup = function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#sort-messages")
            .removeClass("has-success")
            .removeClass("has-error");
        $('#form-sort-messages').html('');
    };

    var el = document.getElementById('names-list');
    var sortable = Sortable.create(el, {
        chosenClass: 'sortable-dragged',
        handle: '.drag-handle',

        onUpdate: function (evt) {
            ajaxSetup();
            var data = {
                order: collectNameOrder()
            };
            $.ajax({
                type: "POST",
                url: 'ajax/names/sort',
                data: data,
                success: function(response) {
                    $("#sort-messages").addClass("has-success");
                    $('#form-sort-messages').append('Name order was successfully updated.');
                    reNumber(response.order);
                },
                error: function(data) {
                    var obj = jQuery.parseJSON(data.responseText);
                    if (obj.order) {
                        $("#sort-messages").addClass("has-error");
                        $('#form-sort-messages').append(obj.order);
                    }
                },
                dataType: 'json'
            });
        }
    });
});
</script>
@endsection

