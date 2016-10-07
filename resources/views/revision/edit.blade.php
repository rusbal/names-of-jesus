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
            url: '/ajax/names/status/' + window.Laravel.name.id,
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

/**
 * Comments handling
 */
$(function(){

    var hideComment = function($this) {
        /**
         * Close this list item
         */
        $($this).closest('li').slideUp('slow', function(){
            /**
             * Hide parent ul if all children is hidden
             */
            var comments = $($this).parents('ul.comments');
            if (comments.find('li:visible').length == 0) {
                comments.hide();
            }
        });
    };

    $('ul.comments button.close').on('click', function(){
        hideComment(this);
    });

    $('.see-comment-button').on('click', function(){
        var comments = $(this).parents('div.form-group').find('ul.comments');
        if (comments.is(':visible')) {
            comments.find('li').slideUp('slow', function(){ 
                if (comments.find('li:visible').length == 0) {
                    comments.hide();
                }
            });
        } else {
            comments
                .show()
                .find('li').slideDown('slow');
        }
    });

    var increaseCommentCount = function($this){
        var commentCount = $($this).closest('.form-group').find('.comment-count');
        commentCount.html( parseInt(commentCount.html()) + 1 );
    };

    var addCommentRow = function($this){
        var formItem = $($this).closest('li');

        var authorSpan = $('<span>')
            .attr('class', 'label')
            .css('background', window.Laravel.user.color)
            .html(window.Laravel.user.initials);

        var newItem = $('<li>')
            .attr('class', 'list-group-item list-group-item-warning');

        var closeButton = $('<button>')
            .attr('type', 'button')
            .attr('class', 'close')
            .attr('data-dismiss', 'alert')
            .attr('aria-label', 'Close')
            .html('<span aria-hidden="true">×</span>')
            .on('click', function(){ hideComment(this); });

        var entryComment = $('<small>').html(' ' + Global.nl2br( $($this).siblings('textarea').val() ));
            
        $( newItem )
            .append(closeButton)
            .append(authorSpan)
            .append(entryComment)
        .insertBefore( formItem );
    };

    $('.add-comment-btn').on('click', function(){
        increaseCommentCount(this);
        addCommentRow(this);
        $(this).siblings('textarea').val('');
    });
});

</script>
@endsection
