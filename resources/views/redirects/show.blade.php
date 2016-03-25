@extends('layouts.master')

@section('title', $redirect->path)

@section('main_content')

    <div class ="container -padded">
        <div class="wrapper">
            <div class="container__block -narrow">
                <h1>{{ $redirect->path }}</h1>

                @include('layouts.errors')

            	<ul>
            		<li class='container__block'>
            			<p><strong>Path: </strong>{{ $redirect->path }}</p>
            			<p><strong>Target: </strong><a target='_blank' href="{{ $redirect->target }}">{{ $redirect->target }}</a></p>
            			<p><strong>HTTP Status: </strong>{{ $redirect->http_status }}</p>

            		</li>
				</ul>

				<ul class="form-actions -inline">
					<li>
						<a href="{{ route('redirects.edit', $redirect->id) }}" class="button">Edit redirect</a>
					</li>
					<li>
						{!! Form::open(['method' => 'DELETE','route' => ['redirects.destroy', $redirect->id]]) !!}
						{!! Form::submit('Delete', array('class' => 'button delete')) !!}
						{!! Form::close() !!}
					</li>
				</ul>

            </div>
        </div>
    </div>

@stop