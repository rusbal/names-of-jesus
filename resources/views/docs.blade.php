@inject('helper', 'App\ViewHelper')
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title pull-left"> Generated File List </h3>
                    <a href="{{ url('/docs/new') }}" class="btn btn-primary pull-right">New</a>
                    <div class="clearfix"></div>
                </div>

            @include('_alerts')

            @if (!$documentFiles)
                <div class="panel-body">
                    No generated document yet.
                </div>
            @else
                <div class="panel-body">

                    <div class="form-group" id="sort-messages">
                        <span class="help-block">
                            <strong id="form-sort-messages"></strong>
                        </span>
                    </div>

                    <ul class="list-group" id="docs-list">

                        @foreach($documentFiles as $doc)
                            <li class="list-group-item">
                                <div class="row">

                                    <div class="col-xs-1 doc-order">
                                    </div>
                                    <div class="col-lg-8 col-xs-6">
                                        <a href="downloads/MSWord/{!! $doc !!}">{!! $doc !!} </a>
                                    </div>

                                    <div class="col-lg-3 col-xs-5">
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

