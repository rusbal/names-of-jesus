@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            @include('_alerts')

            {{ Form::open(array('method' => 'PATCH', 'id' => 'main-form', 'class' => 'form-horizontal')) }}

                <fieldset>
                    <legend>User Profile</legend>
                    <div class="form-group">
                        <label for="verse" class="col-lg-3 control-label">Verse</label>
                        <div class="col-lg-9">
                            <input class="form-paper-control" type="text" id="name" name="name" value="" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-9 col-lg-offset-3 buttons-group">
                            <input class="btn btn-default disabled" type="reset">
                            <button class="btn btn-primary disabled" id="submit-save">Save</button>
                        </div>
                    </div>
                </fieldset>

            {{ Form::close() }}

        </div>
    </div>
</div>
@endsection
