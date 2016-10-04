@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">User Profile</div>

                <div class="panel-body">

                    @include('_alerts')

                    {{ Form::open(array('method' => 'PATCH', 'id' => 'main-form', 'class' => 'form-horizontal')) }}
            
                        <div class="form-group">
                            <label for="color" class="col-md-4 control-label">Color</label>

                            <div class="col-md-6">
                                <input id="color" type="color" class="abc form-control" name="color" value="{{ Auth::user()->color }}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    
                    {{ Form::close() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')
<script>
$(function(){
    $('.abc').labelColorPicker();
});

</script>
@endsection

