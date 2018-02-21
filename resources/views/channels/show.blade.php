@extends('layouts.app')

@section('content')

    @if( $discussions->count() )
        @foreach ($discussions as $dis)
            <div class="panel panel-default">
                <div class="panel-body">
                    <h3>{{ $dis->title }}</h3>
                    <p>{{ str_limit($dis->content, 200) }}</p>

                    <div class="col-md-2 text-muted">
                        <i class="fa fa-star"></i>
                        <small>{{ $dis->channel->title }}</small>
                    </div>
                    <div class="col-md-3 text-muted">
                        <i class="fa fa-clock-o"></i>
                        <small>{{ $dis->created_at->diffForHumans() }}</small>
                    </div>
                    <div class="col-md-1 text-muted">
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
        <div class="well text-center">
            <h1>Sorry ☹️</h1>
            <p>There is no discussions related with this channel!</p>
        </div>
    @endif

    <div class="text-center">
        {{ $discussions->links() }}
    </div>

@endsection
