@extends('layouts.app')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
        
                {{--  Back button  --}}
                <div class="col-md-2">
                    <a href="{{ URL::previous() }}" class="btn btn-default">
                        <i class="glyphicon glyphicon-chevron-left"></i> Back
                    </a>
                </div>

                {{--  Panel title  --}}
                <div class="col-md-10">
                    <strong class="panel-title">Create new discussion</strong>
                </div>
            </div>
        </div>

        <div class="panel-body">
            <form action="{{ route('discussions.store') }}" method="post">

                {{ csrf_field() }}

                {{--  Select a channel  --}}
                <div class="form-group">
                    <label for="channel_id">Select a channel</label>
                    <select name="channel_id" class="form-control">
                        @foreach ($channels as $channel)
                            <option value="{{ $channel->id }}"> {{ $channel->title }} </option>
                        @endforeach
                    </select>
                </div>

                {{--  Discussion title  --}}
                <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control" placeholder="Discussion title here..." value="{{ old('title') }}">
                    
                    @if ($errors->has('title'))
                        <span class="help-block">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>

                {{--  Discussion content  --}}
                <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
                    <label for="content">Content</label>
                    <textarea id="content" name="content" class="form-control" cols="30" rows="10" 
                        placeholder="Discussion content here">{{ old('content') }}</textarea>
            
                    @if ($errors->has('content'))
                        <span class="help-block">
                            <strong>{{ $errors->first('content') }}</strong>
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