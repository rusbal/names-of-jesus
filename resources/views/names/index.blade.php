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

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if ($names->isEmpty())
                <div class="panel-body">
                    There is no name.
                </div>
            @else
                <table class="table">
                    <tbody>
                        @foreach($names as $name)
                            <tr>
                                <td>{!! $name->id !!} </td>
                                <td>
                                    <a href="{{ route('revision', [$name->id, $name->latestRevision->id]) }}">{{ $name->latestRevision->name }} </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

            </div>
        </div>
    </div>
</div>
@endsection

