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
    var revisionId = {{ $revision->id }};

    var submitNewRevision = function() {
        if (serialized == $('#main-form').serialize()) { return; }

        bootbox.prompt({
            title: "Save to new revision:", 
            animate: false,
            callback: function(result){ 
                if (result === null) { return; }

                if (result === '') {
                    submitNewRevision();
                    return
                }
                
                $('#revision_title').val(result);
                $('#main-form').submit();
            }
        });
    };

    $('.submit-new-revision').on('click', function(){
        submitNewRevision();
    });

    $('#menu-submit-save').on('click', function(){
        $('#main-form').submit();
    });

    $('#main-form').submit(function(e){
        if (serialized == $('#main-form').serialize()) {
            e.preventDefault();
            return;
        }

        if ($('#revision_title').val() == '') {
            if ($('input[type=submit]').hasClass('out-of-view')) {
                e.preventDefault();
                submitNewRevision();
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

    $('.btn-danger-hover').hover(
        function(){
            $(this).addClass('btn-danger');
        }, function(){
            $(this).removeClass('btn-danger');
        });

});

</script>
@endsection
