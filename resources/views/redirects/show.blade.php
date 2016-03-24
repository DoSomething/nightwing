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

            </div>
        </div>
    </div>

@stop