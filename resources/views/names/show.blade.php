@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <form class="form-horizontal" method="post" id="names-show">

                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                <input type="hidden" name="id" value="{!! $name->id !!}">
                <fieldset>
                    <legend><input class="form-paper-control" type="text" id="name" name="name" value="{!! $name->revision->name !!}" autocomplete="off"></legend>
                    <div class="form-group">
                        <label for="verse" class="col-lg-3 control-label">Verse</label>
                        <div class="col-lg-9">
                            <textarea class="form-paper-control" rows="1" id="verse" name="verse">{!! $name->revision->verse !!}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="meaning_function" class="col-lg-3 control-label">Meaning &amp; Function</label>
                        <div class="col-lg-9">
                            <textarea class="form-paper-control" rows="1" id="meaning_function" name="meaning_function">{!! $name->revision->meaning_function !!}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="identical_titles" class="col-lg-3 control-label">Identical Titles</label>
                        <div class="col-lg-9">
                            <textarea class="form-paper-control" rows="1" id="identical_titles" name="identical_titles">{!! $name->revision->identical_titles !!}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="significance" class="col-lg-3 control-label">Significance for Believers</label>
                        <div class="col-lg-9">
                            <textarea class="form-paper-control" rows="1" id="significance" name="significance">{!! $name->revision->significance !!}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="responsibility" class="col-lg-3 control-label">Our Responsibility</label>
                        <div class="col-lg-9">
                            <textarea class="form-paper-control" rows="1" id="responsibility" name="responsibility">{!! $name->revision->responsibility !!}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-9 col-lg-offset-3">
                            <input class="btn btn-default" type="reset">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </fieldset>
            </form>

        </div>
    </div>
</div>
<script>
$(function(){
    var serialized = $('#names-show').serialize();
    $('#names-show').on('submit', function(e){
        if (serialized == $('#names-show').serialize()) {
            e.preventDefault();
        }
    });
    
    autosize($('textarea'));
});
</script>
@endsection
