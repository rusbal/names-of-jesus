@extends('layouts.app')

@section('content')
<div class="container">
    
    @include('_user_revisions')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            @include('_alerts')

            {{ Form::open(array('method' => 'PATCH', 'id' => 'names-show', 'class' => 'form-horizontal')) }}

                @include('_revision_form', ['showUpdateBtn' => true])

            {{ Form::close() }}

        </div>
    </div>
</div>
@endsection


@section('footer_script')
<script>
$(function(){
    autosize($('textarea'));
    $('#names-show').arrowNextField();

    var serialized = $('#names-show').serialize();

    $('#submit-new-revision').on('click', function(){
        if (serialized == $('#names-show').serialize()) {
            return;
        }

        bootbox.prompt({
            title: "Save to new revision:", 
            animate: false,
            callback: function(result){ 
                if (result === null) {
                    return;
                }
                if (result === '') {
                    $('#submit-new-revision').click();
                    return
                }
                
                $('#revision_title').val(result);
                $('button#submit-save').click();
            }
        });
    });

    $('form').submit(function(e){
        if (serialized == $('#names-show').serialize()) {
            e.preventDefault();
            return;
        }

        if ($('button#submit-save').hasClass('hidden')) {
            e.preventDefault();
            $('#submit-new-revision').click();
            return;
        }
    });

    $('form :input').on('input', function(){
        // Enable buttons
        $('.buttons-group .disabled').removeClass('disabled').addClass('enabled');
    });

    $('form input[type=reset]').on('click', function(){
        // Disable buttons
        $('.buttons-group .enabled').removeClass('enabled').addClass('disabled');
    });
});

</script>
@endsection
