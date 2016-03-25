@extends('layouts.master')

@section('title', 'Edit '. $redirect->path)

@section('main_content')
<div class='container__block'>
    <div class='wrapper'>
        <p>Edit this redirect below. <a href="{{ route('redirects.index') }}">Go back to all redirects.</a></p>
    </div>
</div>
<div class='container__block'>
    <div class='wrapper'>
        {!! Form::model($redirect, ['method' => 'PATCH', 'route' => ['redirects.update', $redirect->id]]) !!}

            <div class="form-item">
                {!! Form::label('path', 'Path: ', array('class' => 'field-label')) !!}
                {!! Form::text('path', NULL, array('class' => 'text-field')) !!}
            </div>

            <div class="form-item">
                {!! Form::label('target', 'Target: ', array('class' => 'field-label')) !!}
                {!! Form::text('target', NULL, array('class' => 'text-field')) !!}
            </div>

            <div class="form-item -padded">
                {!! Form::label('http_status', 'Response type:', ['class' => 'field-label'])!!}
                {!! Form::select('http_status', ['301' => '301 Permanent', '302' => '302 Temporary']) !!}
            </div>

            <div class="form-item">
                {!! Form::submit('Update Redirect',  ['class' => 'button']) !!}
            </div>

        {!! Form::close() !!}
    </div>
</div>

@stop