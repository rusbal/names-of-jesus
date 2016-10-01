                @foreach ($errors->all() as $error)
                    <p class="alert alert-danger">{{ $error }}</p>
                @endforeach

                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <input type="hidden" name="id" value="{!! $name->id !!}">
                <input type="hidden" id="revision_title" name="revision_title" value="">
                <fieldset>
                    <legend><input class="form-paper-control" type="text" id="name" name="name" value="{!! $revision->name !!}" autocomplete="off"></legend>
                    <div class="form-group">
                        <label for="verse" class="col-lg-3 control-label">Verse</label>
                        <div class="col-lg-9">
                            <textarea class="form-paper-control" rows="1" id="verse" name="verse">{!! $revision->verse !!}</textarea>
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
                        <div class="col-lg-9 col-lg-offset-3 buttons-group">
                            <input class="btn btn-default disabled" type="reset">
                            <button class="btn btn-primary disabled {{ $isOwner ? '' : 'hidden' }}" id="submit-hidden">Save edits</button>
                            <input class="btn btn-primary disabled" id="submit" type="button" value="Save as new revision">
                        </div>
                    </div>
                </fieldset>

