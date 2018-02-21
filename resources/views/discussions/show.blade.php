@extends('layouts.app')

@section('content')

{{--  Back button  --}}
<a href="{{ route('discussions.index') }}" class="btn btn-default">
    <i class="glyphicon glyphicon-chevron-left"></i> Back
</a>

{{--  Watch button  --}}
@auth
    @if ($dis->isWatched($dis->id))
        <a href="{{ route('watchers.watch', ['id' => $dis->id]) }}" class="btn btn-primary pull-right">
            <i class="fa fa-eye"></i>
            Watch
        </a>
    @else 
        <a href="{{ route('watchers.unwatch', ['id' => $dis->id]) }}" class="btn btn-danger pull-right">
            <i class="fa fa-eye-slash"></i>
            Unwatch
        </a>
    @endif
@endauth  

<br><br>

<div class="panel panel-default">

    {{--  Discussion title and meta information  --}}
    <div class="panel-heading">
          

        <h2>{{ $dis->title }}</h2>
        
        <span class="text-muted">
            <a href="{{ route('channels.show', ['slug' => $dis->channel->slug]) }}">
                <i class="fa fa-star"></i>
                <small>{{ $dis->channel->title }}</small>
            </a>
        </span>
        &nbsp;&nbsp;&nbsp;
        <small class="text-muted">
            <i class="glyphicon glyphicon-time"></i> 
            {{ $dis->created_at->diffForHumans() }}
        </small>
        &nbsp;&nbsp;&nbsp;
        <small class="text-muted">
            <i class="fa fa-comments-o"></i> 
            {{ $dis->replies->count() }}
        </small>
        &nbsp;&nbsp;&nbsp;
        <small class="text-muted">
            <i class="glyphicon glyphicon-user"></i> 
            {{ $dis->user->name }}
        </small>
    </div>

    {{--  Discussion content  --}}
    <div class="panel-body">

        {{--  Discussion main content  --}}
        <div>
            {!! $dis->content !!}
        </div>

        <br>

        {{--  Best answer  --}}
        @if ($best_reply)
            <h3 class="text-primary">Best Reply</h3>
            <div class="panel panel-success">
                <div class="panel-heading text-center">
                    <strong>{{ $best_reply->user->name }}</strong>
                </div>
                <div class="panel-body">
                    <div>
                        {!! $best_reply->content !!}
                    </div>
                </div>
            </div>
        
        @endif

        <br>

        {{--  Replies  --}}
        <h3 class="text-primary">Replies</h3>

        @foreach ($dis->replies as $r)
            <div class="row">

                {{--  Arrow up and down  --}}
                <div class="col-md-1 text-center">

                    {{--  arrow up  --}}
                    <a href="{{ route('replies.up', ['id' => $r->id]) }}" 
                        class="text-muted btn {{ $r->is_reply_up($r->id) ? 'disabled' : '' }}" 
                        title="mark as helpful reply">
                        <i class="fa fa-arrow-circle-up fa-lg"></i>
                    </a>

                    {{--  count  --}}
                    <p class="text-info text-center">
                        {{ $r->ups->count() }}
                    </p>

                    {{--  arrow down  --}}
                    <a href="{{ route('replies.down', ['id' => $r->id]) }}" 
                        class="text-muted btn {{ $r->is_reply_up($r->id) ? '' : 'disabled' }}" 
                        title="mark as not helpful">
                        <i class="fa fa-arrow-circle-down fa-lg"></i>
                    </a>

                </div>

                {{--  Reply content  --}}
                <div class="col-md-11">

                    {{--  user avatar and name  --}}
                    <div class="row">

                        {{--  avatar  --}}
                        <div class="col-md-1">
                            <img src="{{ asset($r->user->avatar) }}" alt="{{ $r->user->name .'\'s avatar' }}" class="reply-avatar">
                        </div>

                        {{--  username  --}}
                        <div class="col-md-10">
                            <strong>{{ $r->user->name }}</strong>
                            <br>
                            <div>
                                {!! $r->content !!}
                            </div>
                        </div>
                    </div>

                    {{--  like counter, like, unlinke buttons and time of creation  --}}
                    <div class="row">

                        <div class="col-md-1"></div>
                        {{--  like and unlike button  --}}
                        <div class="col-md-2">
                            @if ($r->is_liked_by_auth_user($r->id))
                                <a href="{{ route('replies.unlike', ['id' => $r->id]) }}" class="text-danger" title="unlike this reply">
                                    Unlike
                                </a>
                            @else
                                <a href="{{ route('replies.like', ['id' => $r->id]) }}" title="like this reply">
                                    Like 
                                </a>
                            @endif
                        </div>

                        {{--  likes count  --}}
                        <div class="col-md-1 text-primary">
                            <i class="fa fa-thumbs-up text-primary"></i>
                            {{ $r->likes->count() }}
                        </div>
            
            
                        {{--  creation time  --}}
                        <div class="col-md-7 text-right">
                            <i class="fa fa-clock-o"></i>
                            {{ $r->created_at->diffForHumans() }}
                        </div>
                        <br>
                        <hr>

                    </div>
                </div>
            </div>
        @endforeach

        @auth
            <form action="{{ route('discussions.addReply', ['id' => $dis->id]) }}" method="POST">
                {{ csrf_field() }}
                
                <div class="form-group {{ $errors->has('new_reply') ? 'has-error' : '' }}">
                    <label for="new_reply">Have something to reply?!</label>
                    <textarea id="content" name="new_reply" cols="30" rows="5" class="form-control" required>{{ old('new_reply') }}</textarea>
                
                    @if ($errors->has('new_reply'))
                        <span class="help-block">
                            <strong>{{ $errors->first('new_reply') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-info">Add reply</button>
                </div>

            </form>
        @endauth

        @guest
            <div class="text-center">
                <h3>You have to <a href="/login">login</a> or <a href="/register">register</a></h3>
                <br>
                
            </div>
        @endguest

    </div>

</div>
@endsection
