@extends('layouts.master')

@section('title', 'Redirects')

@section('main_content')
    <div class ="container -padded">
        <div class="wrapper">
            <div class="container__block -narrow">

                <div class="container__block">
                    @if (count($redirects) > 0)
                        @include('redirects.partials.index-table', ['redirects' => $redirects])
                    @endif
                </div>

                <div class="container__block">
                    <a href="/redirects/create">Create redirect</a>
                </div>
            </div>
        </div>
    </div>
@stop
