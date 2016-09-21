@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Names List<a href="{{ url('/names/new') }}" class="btn btn-primary">New</a></div>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            @if ($names->isEmpty())
                <p> There is no name.</p>
            @else
                <table class="table">
                    <tbody>
                        @foreach($names as $name)
                            <tr>
                                <td>{!! $name->id !!} </td>
                                <td>
                                    <a href="{!! action('NameController@show', $name->id) !!}">{!! $name->revision->name !!} </a>
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

