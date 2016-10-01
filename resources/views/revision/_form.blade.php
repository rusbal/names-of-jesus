        <div class="panel panel-default">
            <div class="panel-body">

                <fieldset>

                    <input type="hidden" name="id" value="{!! $name->id !!}">
                    <input type="hidden" id="revision_title" name="revision_title" value="">

                    <legend><input class="form-paper-control" type="text" id="name" name="name" value="{!! $revision->name !!}" autocomplete="off"></legend>

                    <div class="form-group">
                        <label for="verse" class="col-lg-3 control-label">Verse</label>
                        <div class="col-lg-9">
                            <textarea class="form-paper-control" rows="1" id="verse" name="verse" autofocus>{!! $revision->verse !!}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="meaning_function" class="col-lg-3 control-label">Meaning &amp; Function</label>
                        <div class="col-lg-9">
                            <textarea class="form-paper-control" rows="1" id="meaning_function" name="meaning_function">{!! $revision->meaning_function !!}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="identical_titles" class="col-lg-3 control-label">Identical Titles</label>
                        <div class="col-lg-9">
                            <textarea class="form-paper-control" rows="1" id="identical_titles" name="identical_titles">{!! $revision->identical_titles !!}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="significance" class="col-lg-3 control-label">Significance for Believers</label>
                        <div class="col-lg-9">
                            <textarea class="form-paper-control" rows="1" id="significance" name="significance">{!! $revision->significance !!}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="responsibility" class="col-lg-3 control-label">Our Responsibility</label>
                        <div class="col-lg-9">
                            <textarea class="form-paper-control" rows="1" id="responsibility" name="responsibility">{!! $revision->responsibility !!}</textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-12">

                            @if ($isOwner)
                            <div class="pull-left">
                            </div>
                            @endif

                            <div class="pull-right buttons-group">
                                <input class="btn btn-default disabled" type="reset">
                                <input class="btn btn-primary disabled {{ $isOwner ? '' : 'out-of-view' }}" type="submit" value="Save">
                                <input class="btn btn-primary disabled submit-new-revision" type="button" value="Save as new revision">
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
