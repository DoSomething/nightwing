@extends('layouts.master')

@section('main_content')



    <div class ="container -padded">
        <div class="wrapper">
            <div class="container__block -narrow">
                <h1>Create a Redirect</h1>

                @include('layouts.errors')

                <form action="{{ url('redirects') }}" method="POST" class="form-horizontal">
                    {!! csrf_field() !!}

                    <div class="form-item -padded">
                        <label for="path" class="field-label">Path</label>
                        <input type="text" name="path" id="task-path" class="text-field">
                    </div>

                    <div class="form-item -padded">
                        <label for="target" class="field-label">Target URL</label>
                        <input type="text" name="target" id="task-target" class="text-field">
                    </div>

                    <div class="form-item -padded">
                        <label for="http_status" class="field-label">Response type</label>
                        <select name="http_status" id="task-http_status">
                            <option value="301">301 Permanent</option>
                            <option value="302">302 Temporary</option>
                        </select>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="button" name="complete">
                            Add redirect
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@stop
