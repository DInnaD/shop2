@extends('layouts.panel')
<?php  /** @var \Illuminate\Support\ViewErrorBag $errors */  ?>
@section('panel')
    <div class="panel-heading container-fluid">
        <div class="form-group">
        <a class="btn btn-info btn-xs col-md-1 col-sm-2 col-xs-2" href="{{route('subscriber.index', compact('bunch'))}}">
                <i class="fa fa-backward" aria-hidden="true"></i> back
            </a>
            <div class="centered-child col-md-11 col-sm-10 col-xs-10"><b>New Subscriber</b></div>
        </div>
    </div>

    <div class="panel-body">
        {!! Form::open(['route' => ['subscriber.store', 'bunch' => $bunch]]) !!}

        @include('subscriber._form')
        <input type="hidden" name="created_by" value="{{Auth::id()}}">
        <div class="form-group">
            {!! Form::button('Create', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

@endsection
