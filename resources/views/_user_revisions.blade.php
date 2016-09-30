    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="well well-sm clearfix">
                <div class="pull-right">

                    @foreach ($users_revision as $user)

                        @if ($user->revisions->count() > 0)
                        <!-- Single button -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                style="color:{{ $user->color }}"> 
                                {{ $user->name }} <span class="caret"></span>
                            </button>

                            <ul class="dropdown-menu">

                            @foreach ($user->revisions as $key => $revision)
                                <li> 
                                    <a href="{{ route('revision', [$revision->name_id, $revision->id]) }}">
                                        @if ($loop->first) <b> @endif {{ $revision->revision_title }} @if ($loop->first) </b> @endif
                                        <small style="color:{{ $user->color }}">{{ $revision->created_at->diffForHumans() }}</small></a>
                                    @if ($loop->first) <li role="separator" class="divider"></li> @endif
                                </li>
                            @endforeach

                            </ul>
                        </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>
