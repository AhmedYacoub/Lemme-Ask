@extends('layouts.app')

  @section('content')

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="row">
            <div class="col-md-2">
                <a href="{{ route('channels.index') }}" class="btn btn-default">
                    <i class="glyphicon glyphicon-chevron-left"></i> Back
                </a>
            </div>
            <div class="col-md-8 text-center">
                <strong class="panel-title">Edit channel</strong>
            </div>
        </div>
    </div>

    <div class="panel-body">

        <form action="{{ route('channels.update', ['channel' => $channel->id]) }}" method="POST">

            {{--  Cross Site Request Forgery field  --}}
            {{ csrf_field() }}
            {{ method_field('PUT') }}

            {{--  Channel Title  --}}
            <div class="form-group {{ $errors->has('channel_title') ? 'has-error' : 'channel_title' }}">
                <label for="channel_title">New channel title</label>
                <input type="text" name="channel_title" class="form-control" value="{{ $channel->title }}">

                @if ($errors->has('channel_title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('channel_title') }}</strong>
                    </span>
                @endif
            </div>

            {{--  Submit Button  --}}
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sub">Update</button>
            </div>

        </form>
    </div>
</div>

@endsection
  