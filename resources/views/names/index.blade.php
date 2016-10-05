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
                    <ul class="list-group" id="names-list">
                    @foreach($names as $name)
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-xs-1">
                                    {{ $name->id }}
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
    var el = document.getElementById('names-list');
    var sortable = Sortable.create(el, {
        chosenClass: 'sortable-dragged',
        handle: '.drag-handle',
    });
});
</script>
@endsection

