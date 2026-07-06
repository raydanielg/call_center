@extends('layouts.landing')

@section('title', config('app.name', 'Zerixa Call Center - For Business'))

@section('content')
    @include('landing.partials.header')
    @include('landing.partials.hero')
    @include('landing.partials.features')
    @include('landing.partials.about')
    @include('landing.partials.services')
    @include('landing.partials.stats')
    @include('landing.partials.cta')
    @include('landing.partials.footer')
@endsection
