@extends('frontend/layouts/default')

{{-- Page title --}}
@section('title')
{{ $page->title }}
@parent
@stop

{{-- Page content --}}
@section('content')
<div class="block large-margin-top margin-bottom">

    <h3 class="block-title">{{ $page->title }}</h3>

    <div class="with-padding">

        {{ $page->content }}

    </div>

</div>
@stop