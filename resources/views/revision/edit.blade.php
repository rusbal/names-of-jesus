@extends('layouts.app')

@section('content')
<div class="container">
    
    @include('revision._user')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            @include('_alerts')

            {{ Form::open(array('method' => 'PATCH', 'id' => 'main-form', 'class' => 'form-horizontal')) }}

                @include('revision._form', ['showUpdateBtn' => true])

            {{ Form::close() }}

        </div>
    </div>
</div>
@endsection


@section('footer_script')
<script>
$(function(){

    autosize($('textarea'));

    $('#main-form').arrowNextField();

    var serialized = $('#main-form').serialize();

    $('#submit-new-revision').on('click', function(){
        if (serialized == $('#main-form').serialize()) {
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
                $('#main-form').submit();
            }
        });
    });

    $('#main-form').submit(function(e){
        if (serialized == $('#main-form').serialize()) {
            e.preventDefault();
            return;
        }

        if ($('#revision_title').val() == '') {
            if ($('button#submit-save').hasClass('out-of-view')) {
                e.preventDefault();
                $('#submit-new-revision').click();
                return;
            }
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
