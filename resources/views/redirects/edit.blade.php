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
        <form method="POST" action="{{ route('redirects.update', $redirect->id) }}">
            {{ method_field('PATCH') }}

            {{ csrf_field() }}

            <div class="form-item -padded">
                <label for="path" class="field-label">Path:</label>
                <input name="path" type="text" class="text-field" value="{{ $redirect->path }}"/>
            </div>

            <div class="form-item -padded">
                <label class="field-label">Target:</label>
                <input name="target" type="text" class="text-field" value="{{ $redirect->target }}"/>
            </div>

            <div class="form-item -padded">
                <label for="http_status" class="field-label">Response type:</label>
                <select name="http_status">
                    <option value="301" {{ $redirect->http_status == '301' ? 'selected' : '' }}>301 Permanent</option>
                    <option value="302" {{ $redirect->http_status == '302' ? 'selected' : '' }}>302 Temporary</option>
                </select>
            </div>

             <div class="form-item">
                <button type="submit" class="button">
                    Update redirect
                </button>
            </div>
        </form>
    </div>
</div>

@stop