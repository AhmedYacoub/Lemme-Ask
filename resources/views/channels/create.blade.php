{{--  
    <div class="form-group {{ $errors->has('') ? 'has-error' : '' }}">
        <label for=""></label>
        <input type="text" name="" class="form-control">

        @if ($errors->has(''))
            <span class="help-block">
                <strong>{{ $errors->first('') }}</strong>
            </span>
        @endif
    </div>
  --}}

@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">

        <div class="row">
            <div class="col-md-4">
                {{--  back button  --}}
                <a href="{{ route('channels.index') }}" class="btn btn-default">
                    <i class="glyphicon glyphicon-chevron-left"></i> Back
                </a>
            </div>
            <div class="col-md-8">
                <strong class="panel-title">Create new channel</strong>
            </div>
        </div>
    </div>
    <div class="panel-body">
        <form action="{{ route('channels.store') }}" method="post">

            {{--  Cross Site Request Forgery field  --}}
            {{ csrf_field() }}

            {{--  Channel Title  --}}
            <div class="form-group {{ $errors->has('channel_title') ? 'has-error' : 'channel_title' }}">
                <label for="channel_title">Channel title</label>
                <input type="text" name="channel_title" class="form-control" >

                @if ($errors->has('channel_title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('channel_title') }}</strong>
                    </span>
                @endif
            </div>

            {{--  Submit Button  --}}
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-sub">Submit</button>
            </div>

        </form>
    </div>
</div>
@endsection
