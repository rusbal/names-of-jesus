@extends('layouts.app')

@section('content')
<div class="container">
    
    @include('_user_revisions')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            {{ Form::open(array('action' => ['NameController@update', $name->id], 'method' => 'PATCH', 'id' => 'names-show', 'class' => 'form-horizontal')) }}

                @include('_revision_form')

            {{ Form::close() }}

        </div>
    </div>
</div>
@endsection


@section('footer_script')
<script>
$(function(){

    var serialized = $('#names-show').serialize();

    $('#submit').on('click', function(){
        if (serialized == $('#names-show').serialize()) {
            return;
        }

        bootbox.prompt("Save to new revision with tag:", function(result){ 
            if (result !== null) {
                result = result != '' ? result : 'Empty';
                $('#revision_title').val(result);
                $('#submit-hidden').click();
            }
        });
    });

    $('#names-show').on('submit', function(e){
        if ($('#revision_title').val() == '') {
            e.preventDefault();
            $('#submit').click();
        }
    });

    autosize($('textarea'));

    $('#names-show').arrowNextField();
});

</script>
@endsection
