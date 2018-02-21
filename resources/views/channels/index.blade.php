@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-3">
                <a href="/forum" class="btn btn-default">
                    <i class="glyphicon glyphicon-chevron-left"></i> Back
                </a>
            </div>

            <div class="col-md-6 text-center">
                <strong class="panel-title">Channels</strong>
            </div>

            @auth
                <div class="col-md-3">
                    <a href="{{ route('channels.create') }}" class="btn btn-info">
                        <i class="glyphicon glyphicon-plus"></i> Create new channel
                    </a>
                </div>
            @endauth

            
        </div>
    </div>

    @auth
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                    <th class="col-md-8">Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </thead>
                <tbody>
                    @foreach ($channels as $channel)
                        <tr>
                            <td>{{ $channel->title}}</td>
                            <td>
                                <a href="{{ route('channels.edit', ['channel' => $channel->id]) }}" class="btn btn-info btn-xs">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('channels.destroy', ['channel' => $channel->id]) }}" method="post">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE') }}
                                    <button type="submit" class="btn btn-danger btn-xs">
                                            <i class="glyphicon glyphicon-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endauth

    @guest
    <table class="table table-hover">
        <thead>
            <th>Channel name</th>
            <th class="text-center">Discussions</th>
        </thead>
        <tbody>
            @foreach ($channels as $channel)
                <tr>
                    <td>
                        <a href="{{ route('channels.show', ['slug' => $channel->slug]) }}">{{ $channel->title }}</a>
                    </td>
                    <td class="text-center">
                        <span class="badge badge-default badge-pill">
                            {{ $channel->discussions->count() }}    
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endguest

</div>

@endsection
