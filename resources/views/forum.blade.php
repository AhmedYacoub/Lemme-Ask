@extends('layouts.app')

@section('content')

        @if ($discussions->count() > 0)
            @foreach ($discussions as $dis)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h3>{{ $dis->title }}</h3>
                        <p>{{ str_limit($dis->content, 200) }}</p>

                        <div class="col-md-2 text-muted">
                            <a href="{{ route('channels.show', ['slug' => $dis->channel->slug]) }}">
                                <i class="fa fa-star"></i>
                                <small>{{ $dis->channel->title }}</small>
                            </a>
                        </div>
                        <div class="col-md-2 text-muted">
                            <i class="fa fa-clock-o"></i>
                            <small>{{ $dis->created_at->diffForHumans() }}</small>
                        </div>
                        <div class="col-md-2 text-muted">
                            <i class="fa fa-comments-o"></i> 
                            <small>{{ $dis->replies->count() }}</small>
                        </div>
                        <div class="col-md-4 text-muted">
                            <i class="fa fa-user"></i> 
                            <small>{{ $dis->user->name }}</small>
                        </div>
                        <div class="col-md-2 text-muted">
                            <a href="{{ route('discussions.show', ['id' => $dis->slug]) }}" class="btn btn-info">Read more</a>
                        </div>

                    </div>
                </div>

            @endforeach    
        @else
            <div class="panel panel-default text-center">
                <div class="panel-body">
                    <h2>Nothing in the forum</h2>
                    <a href="{{ route('discussions.create') }}">Create a new discussion</a>
                </div>
            </div>
        @endif


    <div class="text-center">
        {{ $discussions->links() }}
    </div>

@endsection
