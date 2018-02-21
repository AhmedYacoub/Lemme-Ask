<div class="col-md-4">

    {{--  Quick links  --}}
    <ul class="list-group">
        <li class="list-group-item active">
            <h3>
                <a data-toggle="collapse" href="#collapse1" style="text-decoration: none; color: white;">Quick links</a>
            </h3>
        </li>
        <div id="collapse1" class="panel-collapse collapse in">
            <a href="/forum" class="list-group-item list-group-item-action">Forum</a>
            <a href="{{ route('channels.index') }}" class="list-group-item list-group-item-action">All channels</a>
            <a href="{{ route('discussions.index') }}" class="list-group-item list-group-item-action">All discussions</a>
            <a href="{{ route('discussions.create') }}" class="list-group-item list-group-item-action">Create new discussion</a>
        </div>
    </ul>

    {{--  Top 10 channels  --}}
    <ul class="list-group">
        <li class="list-group-item active">
            <h3>
                <a data-toggle="collapse" href="#collapse2" style="text-decoration: none; color: white;">
                    Top 10 discussed channels
                </a>
            </h3>
        </li>
        <div id="collapse2" class="panel-collapse collapse in">
            @foreach ($top_channels as $channel)
                <a href="{{ route('channels.show', ['id' => $channel->slug]) }}" class="list-group-item list-group-item-action">
                    {{ str_limit($channel->title, 30) }}

                    <span class="badge badge-default badge-pill">
                        {{ $channel->discussions->count() }}    
                    </span>
                </a>
            @endforeach
        </div>
    </ul>   

</div>