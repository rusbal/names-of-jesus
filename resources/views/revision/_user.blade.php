    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="well well-sm clearfix">
                <div class="panel-title pull-left">
                    Revision: <strong>{{ $revision->revision_title }}</strong>
                </div>

                <div class="pull-right">

                    @foreach ($authors as $authorRevisions)

                        <!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                style="color:{{ $authorRevisions[0]->user->color }}"> 
                                {{ $authorRevisions[0]->user->name }} <span class="caret"></span>
                            </button>

                            <ul class="dropdown-menu">

                            @foreach ($authorRevisions as $key => $revision)
                                @if ($key == 1) <li role="separator" class="divider"></li> @endif
                                <li> 
                                    <a href="{{ route('revision', [$revision->name_id, $revision->id]) }}">
                                        @if ($loop->first) <b> @endif {{ $revision->revision_title }} @if ($loop->first) </b> @endif
                                        <small style="color:{{ $revision->user->color }}">{{ $revision->updated_at->diffForHumans() }}</small></a>
                                </li>
                            @endforeach

                            </ul>
                        </div>
                        
                    @endforeach

                </div>
            </div>
        </div>
    </div>
