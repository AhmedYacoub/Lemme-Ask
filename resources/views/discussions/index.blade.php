@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                
                {{--  Back button  --}}
                <div class="col-md-2">
                    <a href="/forum" class="btn btn-default">
                        <i class="glyphicon glyphicon-chevron-left"></i> Back
                    </a>
                </div>

                {{--  Panel title  --}}
                <div class="col-md-7">
                    <strong class="panel-title">Discussions</strong>
                </div>

                {{--  Add new discussion  --}}
                <div class="col-md-3">
                    <a href="{{ route('discussions.create') }}" class="btn btn-info">
                        <i class="glyphicon glyphicon-plus"></i> Add a discussion
                    </a>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                    <th class="col-md-8">Title</th>
                    <th>Created at</th>
                </thead>
                <tbody>
                    @foreach ($discussions as $dis)
                        <tr>
                            <td>
                                <a href="{{ route('discussions.show', ['discussion' => $dis->slug]) }}">
                                    {{ $dis->title}}
                                </a>
                            </td>
                            <td>
                                {{ $dis->created_at->diffForHumans() }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection