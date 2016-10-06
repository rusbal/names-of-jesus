@extends('layouts.app')

@section('content')
<div class="container">
    
    @include('revision._user')

    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            @include('_alerts')

            {{ Form::open(['action' => ['RevisionController@update', $name->id, $revision->id], 'method' => 'PATCH', 'id' => 'main-form', 'class' => 'form-horizontal']) }}

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

});

/**
 * Status submission handling
 */
$(function(){

    var ajaxSetup = function() {
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    };

    var ajaxSetStatus = function($this) {
        ajaxSetup();
        var data = {
            status: $($this).html()
        };
        $.ajax({
            type: "POST",
            url: '/ajax/names/status/' + window.NameID,
            data: data,
            success: function(response) {
                $('#update-status').html(response.html);
                $('.update-status').on('click', function(){ ajaxSetStatus(this); });
            },
            dataType: 'json'
        });
    };

    $('.update-status').on('click', function(){ ajaxSetStatus(this); });

});

</script>
@endsection
